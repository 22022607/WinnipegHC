<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use PDF;
use App\Models\Content;
use App\Models\Category;
use App\Models\SubscribeEmail;
use App\Models\MembershipPayment;
use Validator;
use App\Models\EventFestival;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Stripe\Checkout\Session;
use Illuminate\Support\Facades\Mail;
use App\Models\Exhibitor;
use App\Models\Presenter;
class FrontController extends Controller
{
    public function index()
    {
        $upcoming_event = Event::whereDate('date', '>=', now())
                   ->orderBy('date', 'asc')
                   ->limit(3)
                   ->get();
                   
        $events = Event::whereDate('date', '>=', now())->first();
        // dd($upcoming_event);
        $categories = Category::select('id', 'name')->orderBy('id', 'asc')->get();
        $currentMonth = now()->format('F');
        $spotlight_event = MembershipPayment::where('membership_type', 'spotlight_event')
                            ->where('status', 'succeeded')
                             ->where('spotlight_month', $currentMonth)
                            ->with('events')
                            ->first();
        
        $activeSpotlight = MembershipPayment::with('business')
                ->where('membership_type', 'spotlight')
                ->where('spotlight_month', $currentMonth)
                ->where('status', 'succeeded')
                ->first();
                            // dd($spotlight_event);
        return view('front.index',compact('upcoming_event','events','categories','spotlight_event','activeSpotlight'));
    }
   
    public function event()
    {
        // $events=Event::get();
         $events = Event::whereDate('date', '>=', now())
                   ->orderBy('date', 'asc')
                   ->get();
        return view('front.event.index',compact('events'));
    }
    
    public function eventDetails($id)
    {
        $event_details=Event::with('eventOrganizer')->find($id);
          
         $attendees_count=Order::where('event_id',$id)->count();
        return view('front.event.eventdetails',compact('event_details','attendees_count'));
    }
    public function create()
    {
        return view('front.member_dashboard.eventcreate');
    }
   
     public function store(Request $request)
    {
        try {
            // ✅ Validate input
            $request->validate([
                'title' => 'required|string|max:255',
                'date' => 'required|date',
                'start_time' => 'required|date_format:H:i',
                'end_time' => 'required|date_format:H:i|after:start_time',
                'admission_fee' => 'required|numeric',
                'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
                'ticket_type' => 'required|in:internal,external',
            ]);

            // ✅ Begin DB transaction
            \DB::beginTransaction();

            // ✅ Handle image upload
            $image_path = null;
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
                $destinationPath = public_path('events');

                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }

                $file->move($destinationPath, $filename);
                $image_path = 'events/' . $filename;
            }

            // ✅ Save event
            $event = Event::create([
                'title' => $request->title,
                'description' => $request->description,
                'category' => $request->category,
                'duration' => $request->duration,
                'date' => $request->date,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
                'location' => $request->location,
                'venue' => $request->address,
                'prerequisites' => $request->prerequisites,
                'what_to_expect' => $request->what_to_expect,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'user_id' => Auth::guard('member')->id(),
                'admission_fee' => $request->admission_fee,
                'image' => $image_path,
            ]);

            if (!$event) {
                throw new \Exception('Event could not be saved.');
            }

            // ✅ Save ticket info
            if ($request->ticket_type === 'internal') {
                Ticket::create([
                    'user_id' => Auth::guard('member')->id(),
                    'event_id' => $event->id,
                    'price' => $request->ticket_price ?? 0,
                    'quantity' => $request->max_attendees ?? null,
                    'early_bird_price' => $request->early_price ?? null,
                    'ticket_sale_start' => $request->ticket_sale_start ?? null,
                    'ticket_sale_end' => $request->ticket_sale_end ?? null,
                
                    'ticket_type' => 'internal',
                ]);
            } else {
                Ticket::create([
                    'user_id' => Auth::guard('member')->id(),
                    'event_id' => $event->id,
                    'registration_url' => $request->registration_url,
                    'platform_name' => $request->platform_name,
                    'ticket_type' => 'external',
                ]);
            }

            // ✅ Commit transaction
            \DB::commit();

            return redirect()
                ->back()
                ->with('status', 'Event created successfully!');

        } catch (\Throwable $e) {
            // ❌ Rollback transaction if something fails
            \DB::rollBack();

            // Log the error for debugging
            \Log::error('Event creation failed: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'user_id' => Auth::guard('member')->id(),
            ]);

            // Return with error message
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Something went wrong while creating the event: ' . $e->getMessage());
        }
    }
    public function manage()
    {
       $user_events= Event::where(['user_id'=>Auth::guard('member')->id()])->with('tickets')->get();
    //    dd($user_events);
        return view('front.member_dashboard.manage',compact('user_events'));
    }
    public function edit($id)
    {
        $event=Event::with('tickets')->find($id);
        // dd($event);
        return view('front.member_dashboard.eventedit',compact('event'));
    }
    public function update(Request $request, $id)
    {
       
        $validated = $request->validate([
            'title'          => 'required|string|max:255',
            'description'    => 'required|string',
            'category'       => 'required|string',
            'location'       => 'required|string',
            'address'        => 'required|string',
            'contact'        => 'required|string',
            'email'          => 'required|email',
            'date'           => 'required|date',
            'start_time'     => 'required|date_format:H:i',
            'end_time'       => 'required|date_format:H:i|after_or_equal:start_time',
            'prerequisites'  => 'required|string',
            'what_to_expect' => 'required|string',
            'admission_fee'  =>'required',
            'image'          =>'required'
        ]);

       
        $event = Event::findOrFail($id);

       
        $event->update($validated);
       if ($event->tickets) {
   
        $ticketData = [
            'ticket_type' => $request->ticket_type,
        ];

        if ($request->ticket_type == 'external') {
            $ticketData['registration_url'] = $request->registration_url;
            $ticketData['platform_name'] = $request->platform_name;
           
            $ticketData['price'] = null;
            $ticketData['quantity'] = null;
            $ticketData['early_bird_price'] = null;
            $ticketData['ticket_sale_start'] = null;
            $ticketData['ticket_sale_end'] = null;
        } else {
            $ticketData['price'] = $request->ticket_price ?? 0;
            $ticketData['quantity'] = $request->max_attendees;
            $ticketData['early_bird_price'] = $request->early_bird_price;
            $ticketData['ticket_sale_start'] = $request->ticket_sale_start;
            $ticketData['ticket_sale_end'] = $request->ticket_sale_end;
           
            $ticketData['registration_url'] = null;
            $ticketData['platform_name'] = null;
        }

  
        $event->tickets->update($ticketData);

        } else {
          
            $ticketData = [
                'user_id' => Auth::guard('member')->id(),
                'event_id' => $event->id,
                'ticket_type' => $request->ticket_type,
            ];

            if ($request->ticket_type === 'external') {
                $ticketData['registration_url'] = $request->registration_url;
                $ticketData['platform_name'] = $request->platform_name;
            } else {
                $ticketData['price'] = $request->ticket_price ?? 0;
                $ticketData['attendees'] = $request->attendees;
                $ticketData['early_bird_price'] = $request->early_bird_price;
                $ticketData['ticket_sale_start'] = $request->ticket_sale_start;
                $ticketData['ticket_sale_end'] = $request->ticket_sale_end;
            }

            $event->tickets()->create($ticketData);
        }

 

        return redirect()->route('memberdashboard.events.manage')->with('success', 'Event updated successfully!');
    }
    public function delete($id)
    {
        $event = Event::with('tickets')->find($id);   

        if ($event) {
            $event->tickets()->delete();
            
            $event->delete();

            return redirect()->route('memberdashboard.events.manage')->with('success', 'Event deleted!');
        } else {
            return redirect()->back()->with('error', 'Event not found!');
        }
    }
    public function view($id)
    {
        $view_event=Event::find($id);
        return view('front.member_dashboard.viewevent',compact('view_event'));
    }
    public function getTicket($id)
    {
        $event_details=Event::with('eventtickets','tickets')->find($id);
        // dd($event_details);
        return view('front.event.getticket',compact('event_details'));
    }
    public function purchasedTicket(Order $order)
    {
       
        if ($order->user_id !== Auth::guard('member')->id()) {
            abort(403, 'Unauthorized access.');
        }

        $order->load('event', 'ticket'); 
        return view('front.event.purchased-ticket', compact('order'));
    }
    public function download($id)
    {
        $order = Order::with(['event', 'ticket'])->findOrFail($id);

        $pdf = PDF::loadView('front.event.pdf', compact('order'));

        return $pdf->download('ticket-' . $order->ticket_code . '.pdf');
    }
   
    public function subscribeEmail(Request $request)
   {
       $data= new SubscribeEmail;
       $data->email=$request->email;
       $data->save();
        return redirect()->back()->with('success', 'Email Sent successfully!');


   }
   public function festivalOverview()
    {
        $presenters = Presenter::get();
        $exhibitors = Exhibitor::get();
        $festival_details=EventFestival::first();
        return view('front.event_festival.overview', compact('presenters', 'exhibitors','festival_details'));
    }
    public function festivalTickets()
    {
        $festival_details=EventFestival::first();
        $orders_count=Order::whereNull('ticket_id')->where('status','success')->count();
        
        return view('front.event_festival.event_tickets', compact('festival_details', 'orders_count'));
    }
    public function festivalPresenters()
    {
        $presenters = Presenter::get();
        return view('front.event_festival.presenters_list', compact('presenters'));
    }
    public function festivalExhibitors()
    {
        $exhibitors = Exhibitor::get();
        return view('front.event_festival.exhibitors', compact('exhibitors'));
    }
      public function festivalExhibitorTables()
    {
        $event_festival=EventFestival::first();
       $exhibitor_member= Exhibitor::where('member_id', Auth::guard('member')->id())->first();
        return view('front.event_festival.exhibitor_table', compact('exhibitor_member','event_festival'));
    }
    public function festivalBuyTicket()
    {
        $festival_details = EventFestival::first();
        return view('front.event_festival.buy_tickets', compact('festival_details'));
    }
    public function festivalTicketCheckout(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:100',
            'email'   => 'required|email',
            
            'contact' => [
                'required',
              
                'regex:/^(\+1\s?)?(\([0-9]{3}\)|[0-9]{3})[-.\s]?[0-9]{3}[-.\s]?[0-9]{4}$/',
            ],

            'quantity' => 'required|integer|min:1|max:10',
        ]);

        Stripe::setApiKey(env('STRIPE_SECRET'));

        $pricePerTicket = 5;
        $amount = $pricePerTicket * $request->quantity;

        // Save pending order first
        $order = Order::create([
            'name' => $request->name,
            'email' => $request->email,
            'contact' => $request->contact,
            'price' => $amount,
            'quantity' => $request->quantity,
            'ticket_code' => 'TCK-' . str_pad(rand(1000, 9999), 5, '0', STR_PAD_LEFT),  
            'status' => 'pending',
            'type' => 'festival_ticket',
        ]);

        // Create Stripe Checkout session
        $session = Session::create([
            'payment_method_types' => ['card'],
            'mode' => 'payment',
            'customer_email' => $request->email,
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => 'Healing Connections Festival Ticket',
                    ],
                    'unit_amount' => $pricePerTicket * 100, // Stripe takes cents
                ],
                'quantity' => $request->quantity,
            ]],
            'success_url' => route('festival.ticket.success', ['order_id' => $order->id]) . '&session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('festival.ticket.cancel', ['order_id' => $order->id]),
            'metadata' => [
                'order_id' => $order->id,
                'name'     => $request->name,
                'contact'  => $request->contact,
            ],
        ]);

        return redirect()->away($session->url);
    }

    public function festivalTicketSuccess(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        if (!$request->session_id || !$request->order_id) {
            abort(400, 'Missing session or order ID.');
        }

        $session = \Stripe\Checkout\Session::retrieve($request->session_id);

        $order = Order::find($request->order_id);
        if ($order) {
            $order->update([
                'transaction_id' => $session->payment_intent,
                'status' => 'paid',
            ]);
            EventFestival::first()->increment('booked_seats', $order->quantity);
             $adminEmail = 'admin@example.com';

            Mail::send('front.event_festival.ticket_confirmation_email', [
                'order' => $order,
            ], function ($message) use ($order, $adminEmail) {
                $message->to($order->email)
                        ->cc($adminEmail)
                        ->subject('🎟️ Festival Ticket Confirmation')
                        ->from(config('mail.from.address'), config('mail.from.name'));
            });
        
        }

        return view('front.event_festival.success', compact('order'));
    }



    public function festivalTicketCancel(Request $request)
    {
        if ($request->has('order_id')) {
            $order = Order::find($request->order_id);
            if ($order) {
                $order->update(['status' => 'cancelled']);
            }
        }

        return view('front.event_festival.cancel', compact('order'));
    }
    public function downloadTicketPdf($order_id)
    {
        $order = Order::findOrFail($order_id);

        $data = [
            'festival_name' => 'Healing Connections Festival 2025',
            'ticket_code'   => 'TCK-' . str_pad($order->id, 5, '0', STR_PAD_LEFT),
            'name'          => $order->name,
            'email'         => $order->email,
            'quantity'      => $order->quantity,
            'amount'        => $order->amount,
        ];

        $pdf = Pdf::loadView('front.event_festival.ticket_pdf', $data);

        return $pdf->download('Festival_Ticket_' . $data['ticket_code'] . '.pdf');
    }
    public function festivalRegisterNonMember()
    {
        return view('front.event_festival.register_non_member');
    }
   
    public function BookFestivalTable(Request $request)
    {
        
        if (!Auth::guard('member')->check()) {
            return redirect()->route('user.login')->with('error', 'Please login first to book your table.');
        }

        $user = Auth::guard('member')->user();
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $amount = 79; 

       
        $order = Order::create([
            'user_id' => $user->id,
            'price'   => $amount,
            'type'    => 'exhibitor_table',
            'status'  => 'pending',
        ]);


        $session = Session::create([
            'payment_method_types' => ['card'],
            'mode' => 'payment',
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => 'Healing Connections Festival – Member Table',
                    ],
                    'unit_amount' => $amount * 100, 
                    
                ],
                
                'quantity' => 1,
            ]],
            'customer_email' => $user->email,
            'success_url' => route('festival.exhibitor.table.success') . '?order_id=' . $order->id . '&session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('festival.exhibitor.table.cancel', ['order_id' => $order->id]),
            'metadata' => [
                'order_id' => $order->id,
                'user_email' => $user->email,
                'user_name' => $user->first_name . ' ' . $user->last_name,
            ],
        ]);

      
        return redirect()->away($session->url);
    }
    public function festivalExhibitorTableSuccess(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        if (!$request->has('order_id') || !$request->has('session_id')) {
            return redirect('/')->with('error', 'Missing session or order ID.');
        }

        $session = \Stripe\Checkout\Session::retrieve($request->session_id);
        $order = \App\Models\Order::find($request->order_id);

        if ($order && $session) {
            $order->update([
                'transaction_id' => $session->payment_intent,
                'status' => 'paid',
            ]);
              $user = Auth::guard('member')->user();

            Exhibitor::create([
            'name'      => $user->first_name . ' ' . $user->last_name,
            'email'     => $user->email,
            'contact'   => $user->phone,
            'member_id' => $user->id,
           
        ]);     
            $adminEmail = 'admin@example.com';

            Mail::send('front.event_festival.exhibitor_confirmation_email', [
                'order' => $order,
                'user'  => $user,
            ], function ($message) use ($order, $adminEmail, $user) {
                $message->to($user->email)
                        ->cc($adminEmail)
                        ->subject('🎟️ Exhibitor Table Confirmation')
                        ->from(config('mail.from.address'), config('mail.from.name'));
            });
        }

        return view('front.event_festival.exhibitor_table_success', compact('order'));
    }
    public function storeNonMember(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:100',
            'title'   => 'required|string|max:100',
            'description' => 'required|string|max:500',
            'email'   => 'required|email',
           
            'phone' => [
                'required',
              
                'regex:/^(\+1\s?)?(\([0-9]{3}\)|[0-9]{3})[-.\s]?[0-9]{3}[-.\s]?[0-9]{4}$/',
            ],

            'website' => 'nullable|max:160',
            'image'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        Stripe::setApiKey(env('STRIPE_SECRET'));

       
        $amount = 144;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();

            $destinationPath = public_path('exhibitor_images');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $file->move($destinationPath, $filename);

            $imagePath = 'exhibitor_images/' . $filename;
        } else {
            $imagePath = null;
        }

        $data = Exhibitor::create([
            'name'        => $request->name,
            'email'       => $request->email,
            'contact'     => $request->phone,
            'website'     => $request->website,
            'title'       => $request->title,
            'description' => $request->description,
            'image'       => $imagePath,
        ]);

        $order = Order::create([
            'price'   => $amount,
            'type'    => 'exhibitor_table',
            'status'  => 'pending',
            'user_id' => $data->id,

        ]);

        // Create Stripe Checkout session
        $session = Session::create([
            'payment_method_types' => ['card'],
            'mode' => 'payment',
            'customer_email' => $request->email,
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => 'Healing Connections Festival – Member Table',
                    ],
                    'unit_amount' => $amount * 100, 
                ],
                'quantity' => 1,
            ]],
            'success_url' => route('festival.non.member.exhibitor.table.success') . '?order_id=' . $order->id . '&session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('festival.exhibitor.table.cancel', ['order_id' => $order->id]),
            'metadata' => [
                'order_id' => $order->id,
                'name'     => $request->name,
                'phone'  => $request->phone,
            ],
        ]);

        return redirect()->away($session->url);
    }
    public function NonMemberExhibitorTableSuccess( Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        if (!$request->has('order_id') || !$request->has('session_id')) {
            return redirect('/')->with('error', 'Missing session or order ID.');
        }

        $session = \Stripe\Checkout\Session::retrieve($request->session_id);
        $order = \App\Models\Order::find($request->order_id);

        if ($order && $session) {
            $order->update([
                'transaction_id' => $session->payment_intent,
                'status' => 'paid',
            ]);
              
              
            // $adminEmail = 'admin@example.com';

            // Mail::send('front.event_festival.exhibitor_confirmation_email', [
            //     'order' => $order,
            //     'user'  => $user,
            // ], function ($message) use ($order, $adminEmail, $user) {
            //     $message->to($user->email)
            //             ->cc($adminEmail)
            //             ->subject('🎟️ Exhibitor Table Confirmation')
            //             ->from(config('mail.from.address'), config('mail.from.name'));
            // });
        }

        return view('front.event_festival.non_exhibitor_table_success', compact('order'));
    }
}


