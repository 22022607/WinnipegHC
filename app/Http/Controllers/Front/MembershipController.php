<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MembershipUser;
use Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\Models\MembershipPlan;
use App\Models\MembershipPayment;
use Stripe\Stripe;
use Stripe\Webhook;
use Illuminate\Support\Facades\Log;
use Stripe\PaymentIntent;
use Carbon\Carbon;
use App\Models\UserQuery;
use App\Models\Business;
use App\Models\BusinessService;
use App\Models\SocialMediaLinks;
use App\Models\BusinessAppointment;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use DB;

class MembershipController extends Controller
{
    public function create()
    {
        if (Auth::guard('member')->user()) {
             $userMembership = MembershipPayment::where('user_id', Auth::guard('member')->user()->id)
                        ->where('status', 'succeeded')
                        ->latest()
                        ->first();
                  return view('front.auth.joincommunity',compact('userMembership'));

        }else{
            return view('front.auth.joincommunity');
        }
       
         
                      
    }
    // public function store(Request $request)
    // {
    //     try {
    //         $data = $request->validate([
    //             'firstName' => 'required|string|max:255',
    //             'lastName'  => 'required|string|max:255',
    //             'email'     => 'required|email|unique',
    //             'phone'     => 'required|string|unique',
    //             'interests' => 'nullable|string',
    //             'terms'     => 'accepted',
    //             'password'  => 'required|string|min:6',
    //             'password_confirmation' => 'required_with:password|same:password|min:6',
    //             'membership_type' => 'required|in:yearly,lifetime'

    //         ]);
    //     } catch (\Illuminate\Validation\ValidationException $e) {
    //         \Log::error('Validation failed', $e->errors());
    //         return redirect()->back()->withErrors($e->errors())->withInput();
    //     }

    //   $data=  MembershipUser::create([
    //         'first_name' => $request->firstName,
    //         'last_name'  => $request->lastName,
    //         'email'      => $request->email,
    //         'phone'      => $request->phone,
    //         'interests'  => $request->interests,
    //         'password'   => Hash::make($request->password),
    //         'membership_type'=>$request->membership_type
    //     ]);
    //     // dd($data);

    //     return redirect()->back()->with('success', 'Membership submitted successfully!');
    // }
  public function store(Request $request)
    {
        try {
            // Validate user input
            $data = $request->validate([
                'firstName' => 'required|string|max:255',
                'lastName' => 'nullable|string|max:255',
                'email' => 'required|email|unique:membership_users,email',
                   'phone' => [
                        'required',
                        'unique:membership_users,phone',
                        'regex:/^(\+1\s?)?(\([0-9]{3}\)|[0-9]{3})[-.\s]?[0-9]{3}[-.\s]?[0-9]{4}$/',
                    ],
                'interests' => 'nullable|string',
                'terms' => 'accepted',
                'password' => 'required|string|min:8',
                'password_confirmation' => 'required_with:password|same:password|min:8',
                'membership_type' => 'required|in:yearly,lifetime'
            ]);

            $membership = MembershipPlan::where('type', $request->membership_type)->first();
            if (!$membership) {
                return redirect()->back()->withErrors(['membership_type' => 'Invalid membership type selected.']);
            }

            Stripe::setApiKey(env('STRIPE_SECRET'));

            $paymentIntent = PaymentIntent::create([
                'amount' => round($membership->price * 100),
                'currency' => 'usd',
                'description' => "Membership payment for {$data['firstName']} {$data['lastName']}",
                'metadata' => $data,
            ]);

            return response()->json([
                'client_secret' => $paymentIntent->client_secret,
                'payment_intent_id' => $paymentIntent->id,
                'membership_type' => $membership->type,
                'price' => $membership->price
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
        
        return response()->json([
            'error' => 'Validation failed',
            'messages' => $e->errors()
        ], 422);
    } catch (\Exception $e) {
        \Log::error('Registration error: ' . $e->getMessage());
        return response()->json([
            'error' => $e->getMessage() ?? 'Something went wrong. Please try again.'
        ], 500);
    }
    }
    public function finalizeRegistration(Request $request)
    {
        $data = $request->validate([
            'payment_intent_id' => 'required|string'
        ]);

        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            $intent = PaymentIntent::retrieve($data['payment_intent_id']);

            if ($intent->status !== 'succeeded') {
                return response()->json(['error' => 'Payment not completed.'], 400);
            }

            // Extract original metadata
            $meta = $intent->metadata;

            // Now create the user
            $user = MembershipUser::create([
                'first_name' => $meta->firstName,
                'last_name' => $meta->lastName,
                'email' => $meta->email,
                'phone' => $meta->phone,
                'interests' => $meta->interests,
                'password' => Hash::make($meta->password),
                'membership_type' => $meta->membership_type

            ]);

           

            $membership = MembershipPlan::where('type', $meta->membership_type)->first();

            MembershipPayment::create([
                'user_id' => $user->id,
                'membership_id' => $membership->id,
                'amount' => $membership->price,
                'currency' => 'usd',
                'stripe_payment_intent_id' => $intent->id,
                'status' => 'succeeded',
                'customer_email' => $user->email,
                'membership_type' => $membership->type,
                'start_date' => now(),
                'end_date' => now()->addMonths($membership->duration_months),
            ]);
               Mail::send('emails.user_membership_confirmation', [
                'user' => $user,
                'membership' => $membership,
                  'transactionId' => $intent->id
            ], function ($message) use ($user) {
                $message->to($user->email)
                        ->subject('Membership Registration Successful')
                        ->from(config('mail.from.address'), config('mail.from.name'));
            });
            Auth::guard('member')->login($user);

            return response()->json([
                'success' => true,
                'redirect_url' => route('memberdashboard')
            ]);
        } catch (\Exception $e) {
            \Log::error('Finalize Registration Error', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Could not complete registration.'], 500);
        }
    }

    public function login(Request $request)
    {
        if ($request->isMethod('GET')) {
            return view('front.auth.login');
        }

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('member')->attempt($credentials, $request->filled('remember'))) {
             $user = Auth::guard('member')->user();

    if (!$user) {
        // If null, the login failed silently
        dd('Member guard returned null!');
    }
            $user = MembershipUser::find(Auth::guard('member')->user()->id);
            $user->previous_login_at = $user->last_login_at;
            $user->previous_login_ip = $user->last_login_ip;
            $user->last_login_at = now();
            $user->last_login_ip = $request->ip();
       
            $user->save();
            $request->session()->regenerate();
            // $this->sendLoginMail(Auth::user()->email);

            return redirect()->route('memberdashboard'); 
            // dd('Oky');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function forgot()
    {
        return view('front.auth.forgot');
    }
     public function forgotPost(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:membership_users,email',
        ]);

        $user = MembershipUser::where('email', $request->email)->first();

        if ($user) {
            $token = Str::random(60);

            DB::table('password_reset_tokens')->insert([
                'email' => $user->email,
                'token' => $token,
                'created_at' => now()
            ]);

            Mail::send('front.auth.forgot_password_email', ['token' => $token, 'user' => $user], function ($message) use ($user) {
                $message->to($user->email)
                        ->subject('Password Reset Request');
            });
        }

        return back()->with('status', 'Password reset link has been sent to your email.');
    }

    public function resetPassword($token)
    {
        return view('front.auth.reset_password', ['token' => $token]);
    }
    public function resetPasswordPost(Request $request)
    {
        // Validate input
        $request->validate([
            'token' => 'required|string',
            'email' => 'required|email|exists:membership_users,email',
            'newPassword' => 'required|confirmed|min:8',
        ]);

        // Check token
        $record = DB::table('password_reset_tokens')
                    ->where('email', $request->email)
                    ->where('token', $request->token)
                    ->first();

        if (!$record) {
            // Return back with error
            return back()->withErrors(['token' => 'Invalid token or email.'])->withInput();
        }

        // Update password
        $user = MembershipUser::where('email', $request->email)->first();
        $user->password = Hash::make($request->newPassword);
        $user->save();

        // Delete token
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        // Redirect with success
        return redirect()->route('user.login')->with('status', 'Password has been reset successfully.');
    }
    public function memberDashboard()
    {
        $member=Auth::guard('member')->user()->id;
            // dd($member);
        $appointments= BusinessAppointment::where('business_id',$member)->get();

         $user_events= Event::where(['user_id'=>$member])->first();
         $event_count= Event::where(['user_id'=>$member])->count();
         $business_profile=Business::where('user_id',$member)->first();
            $userMembership = MembershipPayment::where('user_id', $member)
                                ->where('status', 'succeeded')
                                ->with('membership')
                                ->latest()
                                ->first();
            $business_spotlight = MembershipPayment::where(['user_id' => $member, 'status' => 'succeeded','membership_type'=>'spotlight'])
                                ->with('membership')
                                ->latest()
                                ->first();
             if ($business_spotlight) {
                $startDate = \Carbon\Carbon::parse($business_spotlight->created_at);
                $expiryDate = $startDate->copy()->addDays(28); // 🔥 Always 28 days
                $remainingDays = (int) ceil(Carbon::now()->floatDiffInDays($expiryDate));

                $business_spotlight->expiry_date = $expiryDate;
                $business_spotlight->remaining_days = $remainingDays;
                $business_spotlight->is_active = $remainingDays >= 0;
            }

        return view('front.member_dashboard.index',compact('user_events','userMembership','business_spotlight','event_count','business_profile','appointments'));
    }
  public function subscription()
    {
            $userMembership = MembershipPayment::where('user_id', Auth::guard('member')->id())
                            ->where('status', 'active')
                               ->with('membership')
                            ->latest()
                            ->first();
            $billing_history = MembershipPayment::where('user_id', Auth::guard('member')->id())
                                ->where('status', 'active')
                                ->with('membership_plan')
                                ->get();
                               
            $business_spotlight = MembershipPayment::where('user_id', Auth::guard('member')->id())
                                ->where('membership_type', 'spotlight')
                                ->where('status', 'succeeded')
                                ->latest()
                                ->first();
            $spotlight_event = MembershipPayment::where('user_id', Auth::guard('member')->id())
                            ->where('membership_type', 'spotlight_event')
                            ->where('status', 'succeeded')
                            ->with('events')
                            ->latest()
                            ->first();
            $userEvents = Event::where('user_id', Auth::guard('member')->id())->get();
                // dd($userEvents);
                               

        return view('front.member_dashboard.subscription', compact('userMembership', 'billing_history','business_spotlight','spotlight_event','userEvents'));
    }
    public function membershipLevels()
    {
        $membershipLevels = MembershipPlan::first();
        $userMembership = MembershipPayment::where('user_id', Auth::guard('member')->user())
                        ->where('status', 'succeeded')
                        ->latest()
                        ->first();
                        // dd($userMembership);
        return view('front.membership_levels.index', compact('membershipLevels', 'userMembership'));
    }
    public function checkout($id)
    {
        $membership = MembershipPlan::findOrFail($id); 
        return view('front.membership_levels.checkout', compact('membership'));
    }
 

    public function processPayment(Request $request)
    {
        // dd($request->all());
        $user = auth()->user();
        $membershipType = $request->membership_type;
        $membership_id = $request->membership_id;
        $price = $request->price;
        $currency = 'usd'; // Set dynamically if needed

        if (!$membershipType || !$price || !$membership_id) {
            return response()->json(['error' => 'Missing required fields'], 422);
        }

        Stripe::setApiKey(env('STRIPE_SECRET'));

        // Convert price to smallest currency unit
        $amount = (int) round($price * 100); // dollars -> cents

        // Minimum charge check
        $minAmount = match ($currency) {
            'usd' => 50, // $0.50
            'inr' => 100, // ₹1
            default => 50
        };

        if ($amount < $minAmount) {
            return response()->json([
                'error' => "Amount too low. Minimum for {$currency} is ".($minAmount/100)
            ], 422);
        }

        try {
            $paymentIntent = PaymentIntent::create([
                'amount' => $amount,
                'currency' => $currency,
                'description' => "Payment for {$membershipType} membership by {$user->name}",
                'metadata' => [
                    'user_id' => $user->id,
                    'membership_id' => $membership_id,
                ],
                'receipt_email' => $user->email,
                 'shipping' => [
                    'name' => $user->name,
                    'address' => [
                        'line1' => '123 Example Street',
                        'city' => 'Mumbai',
                        'state' => 'MH',
                        'postal_code' => '400001',
                        'country' => 'IN',
                    ],
                    ],

            ]);
     

         

            $startDate = now();
            $membership = MembershipPlan::find($membership_id);
            $endDate = $startDate->copy()->addMonths($membership->duration_months);
            // Save payment
            MembershipPayment::create([
                'user_id' => $user->id,
                'membership_id' => $membership_id,
                'amount' => $price,
                'currency' => $currency,
                'stripe_payment_intent_id' => $paymentIntent->id,
                'status' => 'pending',
                'customer_email' => $user->email,
                'membership_type' => $membershipType,
                 'start_date' => $startDate,
                'end_date' => $endDate,
            ]);

            return response()->json([
                'client_secret' => $paymentIntent->client_secret
            ]);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    // Stripe Webhook
    public function handleWebhook(Request $request)
    {
        $payload = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');
        $endpointSecret = env('STRIPE_WEBHOOK_SECRET');

        try {
            $event = Webhook::constructEvent($payload, $sigHeader, $endpointSecret);

            switch ($event->type) {
                case 'payment_intent.succeeded':
                    $paymentIntent = $event->data->object;

                    $payment = MembershipPayment::where('stripe_payment_intent_id', $paymentIntent->id)->first();
                    if ($payment) {
                        $payment->update(['status' => 'succeeded']);
                        $membership = $payment->membership;
                        $membership->update([
                            'status' => 'active',
                            'start_date' => now(),
                            'end_date' => now()->addYear(), // Example: 1-year membership
                        ]);
                    }
                    break;

                case 'payment_intent.payment_failed':
                    $paymentIntent = $event->data->object;
                    $payment = MembershipPayment::where('stripe_payment_intent_id', $paymentIntent->id)->first();
                    if ($payment) {
                        $payment->update(['status' => 'failed']);
                        $membership = $payment->membership;
                        $membership->update(['status' => 'canceled']);
                    }
                    break;

                case 'payment_intent.processing':
                    $paymentIntent = $event->data->object;
                    $payment = MembershipPayment::where('stripe_payment_intent_id', $paymentIntent->id)->first();
                    if ($payment) {
                        $payment->update(['status' => 'pending']);
                        $membership = $payment->membership;
                        $membership->update(['status' => 'pending']);
                    }
                    break;

                default:
                    Log::info('Unhandled Stripe event: ' . $event->type);
                    break;
            }

            return response()->json(['status' => 'success'], 200);

        } catch (\Exception $e) {
            Log::error('Stripe webhook error: ' . $e->getMessage());
            return response()->json(['status' => 'error'], 400);
        }
    }
    public function success()
    {
        return view('front.membership_levels.success'); 
    }
    public function updatePaymentStatus(Request $request)
    {
        $payment = MembershipPayment::where('stripe_payment_intent_id', $request->payment_intent_id)->first();

        if ($payment) {
            $status = $request->input('status');

            if (!$status) {
                return response()->json(['error' => 'Status is required'], 400);
            }

            $payment->status = $status;
            $payment->save();
        }

        return response()->json(['success' => true]);
    }

    public function security()
    {
        $user=Auth::guard('member')->user();
        // dd($user);
        return view('front.member_dashboard.security', compact('user'));
    }
    public function purchaseSpotlight()
    {
        return view('front.member_dashboard.purchase_spotlight');
    }
    public function checkoutSpotlight(Request $request)
    {
         $request->validate([
        'spotlight_month' => 'required|string',
    ]);
        $user = Auth::guard('member')->user();
        // dd($user);
        $spotlightPrice = 79.00; // Fixed price for spotlight purchase
        $currency = 'usd';

        Stripe::setApiKey(env('STRIPE_SECRET'));
        $spotlightMonth = $request->spotlight_month;
        try {
            $business = Business::where('user_id', $user->id)->first();

            if (!$business) {
                return response()->json([
                    'error' => 'You must have a registered business to purchase a spotlight.'
                ], 400);
            }
             $existingSpotlight = MembershipPayment::where('membership_type', 'spotlight')
            ->where('spotlight_month', $spotlightMonth)
            ->whereIn('status', ['pending', 'succeeded'])
            ->first();

            if ($existingSpotlight) {
                return response()->json([
                    'error' => "Sorry, the Business Spotlight for {$spotlightMonth} is already taken."
                ], 400);
            }
            
            $paymentIntent = PaymentIntent::create([
                'amount' => (int) round($spotlightPrice * 100), // Convert to cents
                'currency' => $currency,
                'description' => "Business Spotlight purchase by {$user->first_name} {$user->last_name}",
                'metadata' => [
                    'user_id' => $user->id,
                     'business_id' => $business->id,
                    'purchase_type' => 'spotlight',
                     'spotlight_month' => $spotlightMonth,
                ],
                'receipt_email' => $user->email,
                 'shipping' => [
                    'name' => $user->first_name.' '.$user->last_name,
                    'address' => [
                        'line1' => '123 Example Street',
                        'city' => 'Mumbai',
                        'state' => 'MH',
                        'postal_code' => '400001',
                        'country' => 'IN',
                    ],
                    ],
            ]);

            // Save spotlight purchase as a MembershipPayment record
            MembershipPayment::create([
                'user_id' => $user->id,
                  'business_id' => $business->id, 
                'membership_id' => null, // No specific membership plan
                'amount' => $spotlightPrice,
                'currency' => $currency,
                'stripe_payment_intent_id' => $paymentIntent->id,
                'status' => 'pending',
                'customer_email' => $user->email,
                'membership_type' => 'spotlight',
                 'start_date' => now(),
                'end_date' => now()->addMonth(), // Spotlight valid for 1 month
                // 'business_id'=>$request->business_spotlight,
                'spotlight_month' => $spotlightMonth,
            ]);
         $adminEmail = 'admin@example.com'; 
            $transactionId = $paymentIntent->id;

            Mail::send('emails.business_spotlight_confirmation', [
                'user' => $user,
                'transactionId' => $transactionId,
            ], function ($message) use ($user, $adminEmail) {
                $message->to($user->email)
                        ->cc($adminEmail)
                        ->subject('Business Spotlight Purchase Confirmation')
                        ->from(config('mail.from.address'), config('mail.from.name'));
            });

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function businessProfile()
    {
       
        $data= Business::where('user_id', Auth::guard('member')->user()->id)->first();
        // $services= BusinessService::where('business_id', $data->id)->get();
        $social_links= SocialMediaLinks::where('business_id', Auth::guard('member')->user()->id)->first();

        // dd($social_links);
        // dd(Auth::guard('member')->user()->id);
        // dd($data);
        return view('front.member_dashboard.business_profile', compact('data','social_links'));
    }
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed|min:8', 
        ]);

        $user = MembershipUser::find(Auth::guard('member')->user()); 

        
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

      
        $user->password = Hash::make($request->password);
        $user->password_changed_at = now();
        $user->save();

        return back()->with('status', 'Password updated successfully.');
    }
    public function deleteAccount(Request $request)
    {
        // $request->validate([
        //     'password' => 'required',
        // ]);

        $user = MembershipUser::find(Auth::guard('member')->user()->id);
        // if (!Hash::check($request->password, $user->password)) {
        //     return back()->withErrors(['password' => 'Password is incorrect.']);
        // }

           $user->last_active_at=' ';
           $user->last_active_at = now();

           $user->dormant_until = now()->addDays(30);
           $user->save();   
            Auth::guard('member')->logout();

        
        
        return response()->json([
            'message' => 'Your account is scheduled for deletion in 30 days.'
        ]);        
        // return redirect('/')->with('status', 'Account deleted successfully.');}
    }
    public function memberLogout(Request $request)
    {
        Auth::guard('member')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/')->with('status', 'You have been logged out.');
    }
     public function addBusinessProfile(Request $request)
    {
        $request->validate([
            'business_name' => 'required|string|max:255',
            'business_email' => 'required|email|max:255',
            'business_phone' => 'required|string|max:20',
            'business_address' => 'required|string|max:255',
            'business_category' => 'nullable|string|max:100',
            'business_website' => 'nullable|url|max:255',
            'business_description' => 'nullable|string|max:1000',

            // Socials
            'business_twitter' => 'nullable|string|max:255',
            'business_linkedin' => 'nullable|string|max:255',
            'business_instagram' => 'nullable|string|max:255',
            'business_facebook' => 'nullable|string|max:255',

            // Images
            'featured_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'additional_images' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        try {
            $userId = Auth::guard('member')->id();

        
            $business = Business::where('user_id', $userId)->first();

        
            $featuredPath = null;
            $additionalPath = null;

           if ($request->hasFile('featured_image')) {
            $file = $request->file('featured_image');
            $filename = time() . '_' . $file->getClientOriginalName();
            
            $destinationPath = base_path('../business_images');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
        
            $file->move($destinationPath, $filename);
            $featuredPath = 'business_images/' . $filename;
        }
        
        if ($request->hasFile('additional_images')) {
            $file = $request->file('additional_images');
            $filename = time() . '_' . $file->getClientOriginalName();
            
            $destinationPath = base_path('../business_images'); 
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
        
            $file->move($destinationPath, $filename);
            $additionalPath = 'business_images/' . $filename;
        }


            $data = [
                'name' => $request->business_name,
                'email' => $request->business_email,
                'category' => $request->business_category,
                'location' => $request->business_address,
                'phone' => $request->business_phone,
                'website' => $request->business_website,
                'description' => $request->business_description,
                'twitter' => $request->business_twitter,
                'linkedin' => $request->business_linkedin,
                'instagram' => $request->business_instagram,
                'facebook' => $request->business_facebook,
            ];

            if ($featuredPath) {
                $data['featured_image'] = $featuredPath;
            }

            if ($additionalPath) {
                $data['additional_images'] = $additionalPath;
            }

            if ($business) {
                $business->update($data);
                return redirect()->back()->with('status', 'Business profile updated successfully.');
            } else {
                $data['user_id'] = $userId;
                Business::create($data);
                return redirect()->back()->with('status', 'Business profile created successfully.');
            }

        } catch (\Exception $e) {
            \Log::error('Business profile error: ' . $e->getMessage());
            return redirect()->back()->withErrors('Something went wrong. Please try again later.');
        }
    }
    public function addBusinessServices(Request $request)
    {
        $request->validate([
            'service_name' => 'required|string|max:255',
        ]);

        $service = new BusinessService();
        $service->service_name = $request->service_name;
        $service->business_id = $request->business_id;
        $service->duration = $request->duration;
        $service->price = $request->price;
        $service->save();

        return redirect()->back()->with('status', 'Business service added successfully.');
    }
    public function socialMedialLinks(Request $request)
    {
        $request->validate([
            'business_twitter' => 'required|string|max:255',
            'business_linkedin' => 'required|string|max:255',
            'business_instagram' => 'required|string|max:255',
            'business_facebook' => 'required|string|max:255',
        ]);

        $social_links = SocialMediaLinks::updateOrCreate(
            ['business_id' => $request->business_id],
            [
                'twitter' => $request->business_twitter,
                'linkedin' => $request->business_linkedin,
                'instagram' => $request->business_instagram,
                'facebook' => $request->business_facebook,
            ]
        );

        return redirect()->back()->with('status', 'Social Media Links Updated successfully.');
    }
    public function addMedia(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'featured_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'additional_images' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $validated = [];

        if ($request->hasFile('featured_image')) {
            $file = $request->file('featured_image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $destinationPath = $_SERVER['DOCUMENT_ROOT'] . '/events';
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            $file->move($destinationPath, $filename);
            $validated['featured_image'] = 'business_images/' . $filename;
        }

        if ($request->hasFile('additional_images')) {
            $file = $request->file('additional_images');
            $filename = time() . '_' . $file->getClientOriginalName();
            $destinationPath = $_SERVER['DOCUMENT_ROOT'] . '/events';
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            $file->move($destinationPath, $filename);
            $validated['additional_images'] = 'business_images/' . $filename;
        }

        $business = Business::find($request->business_id);
        $business->update($validated);

        return redirect()->back()->with('success', 'Images updated successfully!');
    }
    public function purchaseSpotlightEvent()
    {
        return view('front.member_dashboard.purchase_spotlight_event');
    }
    public function checkoutSpotlightEvent(Request $request)
    {
        $user = Auth::guard('member')->user();
        // dd($user);
        $spotlightPrice = 79.00; // Fixed price for spotlight purchase
        $currency = 'usd';

        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            $paymentIntent = PaymentIntent::create([
                'amount' => (int) round($spotlightPrice * 100), // Convert to cents
                'currency' => $currency,
                'description' => "Spotlight Event purchase by {$user->first_name} {$user->last_name}",
                'metadata' => [
                    'user_id' => $user->id,
                    'purchase_type' => 'spotlight_event',
                ],
                'receipt_email' => $user->email,
                 'shipping' => [
                    'name' => $user->first_name.' '.$user->last_name,
                    'address' => [
                        'line1' => '123 Example Street',
                        'city' => 'Mumbai',
                        'state' => 'MH',
                        'postal_code' => '400001',
                        'country' => 'IN',
                    ],
                    ],
            ]);

            // Save spotlight purchase as a MembershipPayment record
            MembershipPayment::create([
                'user_id' => $user->id,
                'membership_id' => null, // No specific membership plan
                'amount' => $spotlightPrice,
                'currency' => $currency,
                'stripe_payment_intent_id' => $paymentIntent->id,
                'status' => 'pending',
                'customer_email' => $user->email,
                'membership_type' => 'spotlight_event',
                 'start_date' => now(),
                'end_date' => now()->addMonth(), // Spotlight valid for 1 month
                // 'business_id'=>$request->business_spotlight,
            ]);
             $adminEmail = 'admin@example.com'; 
            $message = "Hi {$user->first_name} {$user->last_name}, this is a test email from Event Spotlight Purchase.";

        $transactionId = $paymentIntent->id;

            Mail::send('emails.event_spotlight_confirmation', [
                'user' => $user,
                'transactionId' => $transactionId,
            ], function ($message) use ($user, $adminEmail) {
                $message->to($user->email)
                        ->cc($adminEmail)
                        ->subject('Event Spotlight Purchase Confirmation')
                        ->from(config('mail.from.address'), config('mail.from.name'));
            });
            return response()->json([
                'client_secret' => $paymentIntent->client_secret
            ]);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function updateSpotlightEvent(Request $request, $spotlight)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
        ]);

        $user = Auth::guard('member')->user();

        $spotlightPayment = MembershipPayment::where('id', $spotlight)
            ->where('user_id', $user->id)
            ->where('membership_type', 'spotlight_event')
            ->where('status', 'succeeded')
            ->first();

        if (!$spotlightPayment) {
            return response()->json(['error' => 'Invalid or inactive Spotlight record.'], 404);
        }

        $spotlightPayment->event_id = $request->event_id;
        $spotlightPayment->save();

        return response()->json([
            'success' => 'Spotlight Event updated successfully!',
            'spotlight_id' => $spotlightPayment->id,
            'event_id' => $spotlightPayment->event_id
        ]);
    }
     public function appointments()
    {
        $member=Auth::guard('member')->user()->id;
        $appointments= BusinessAppointment::where('business_id',$member)->get();
        // dd($appointments);
        return view('front.member_dashboard.appointments',compact('appointments'));
    }
     public function eventTickets($event)
    {

        $event = Event::with(['tickets', 'tickets.purchases'])->findOrFail($event);
        // dd($event);
        return view('front.member_dashboard.event_tickets',compact('event'));
    }
}

