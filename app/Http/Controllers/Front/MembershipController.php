<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MembershipUser;
use Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;
class MembershipController extends Controller
{
    public function create()
    {
        return view('front.auth.joincommunity');
    }
    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'firstName' => 'required|string|max:255',
                'lastName'  => 'required|string|max:255',
                'email'     => 'required|email|unique',
                'phone'     => 'required|string|unique',
                'interests' => 'nullable|string',
                'terms'     => 'accepted',
                'password'  => 'required|string|min:6',
                'password_confirmation' => 'required_with:password|same:password|min:6',
                'membership_type' => 'required|in:yearly,lifetime'

            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Validation failed', $e->errors());
            return redirect()->back()->withErrors($e->errors())->withInput();
        }

      $data=  MembershipUser::create([
            'first_name' => $request->firstName,
            'last_name'  => $request->lastName,
            'email'      => $request->email,
            'phone'      => $request->phone,
            'interests'  => $request->interests,
            'password'   => Hash::make($request->password),
            'membership_type'=>$request->membership_type
        ]);
        // dd($data);

        return redirect()->back()->with('success', 'Membership submitted successfully!');
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

    if (Auth::attempt($credentials, $request->filled('remember'))) {
        $request->session()->regenerate();
        return redirect()->route('front.memberdashboard'); 
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
    public function memberDashboard()
    {
         $user_events= Event::where(['type'=>2,'user_id'=>Auth::user()->id])->first();
        return view('front.member_dashboard.index',compact('user_events'));
    }

}
