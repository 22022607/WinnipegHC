<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\UserQuery;
use App\Models\Faq;
use App\Models\Content;
class ContentController extends Controller
{
   public function about()
   {
    return view('front.content.about');
   }
    public function contact()
   {
       $data = Contact::first();
       $faqs = Faq::all();
       return view('front.content.contact', compact('data', 'faqs'));
   }
    public function privacy()
    {
        
        $privacy= Content::where('slug', 'privacy_policy')->first();
        // dd($privacy);
        return view('front.privacy', compact('privacy'));
    }
    public function terms()
    {
        $terms= Content::where('slug', 'terms_and_conditions')->first();

        return view('front.terms',compact('terms'));
    }
    public function queriesStore(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'first_name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string',
            'phone' => 'required|string|max:15',
            'subject' => 'required|string',


        ]);

        UserQuery::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'message' => $request->message,
            'phone' => $request->phone,
            'subject' => $request->subject,
        ]);
        // dd($dd);
        return redirect()->back()->with('success', 'Your message has been sent successfully.');
    }
}
