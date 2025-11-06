<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Content;
use App\Models\Contact;
use App\Models\Faq;
use App\Models\SubscribeEmail;
class SettingController extends Controller
{
    public function index()
    {
        $contents = Content::all();
        $about= Content::where('slug', 'about_us')->first();
        $privacy= Content::where('slug', 'privacy_policy')->first();
        // dd($privacy);
        $terms= Content::where('slug', 'terms_and_conditions')->first();
        $data= Contact::first();
        $faqs= Faq::all();
        return view('settings.index', compact('contents', 'data', 'about', 'privacy', 'terms', 'faqs'));
    }
    
    public function contactDetails(Request $request)
    {
        $request->validate([
           
            'email' => 'required|email|max:255',
            'location' => 'required|string',
            'phone' => 'required|string',
            'office_hours' => 'required|string|max:255',
        ]);
        $data= Contact::first();
        if($data){
            $data->update($request->all());
            return redirect()->back()->with('success', 'Contact details updated successfully.');
        }else{
            Contact::create($request->all());
            return redirect()->back()->with('success', 'Contact details saved successfully.');
        }
    }
    public function aboutStore(Request $request)
    {
        $request->validate([
            'about' => 'required',
        ]);

        $slug = 'about_us'; 

  
        $data = Content::where('slug', $slug)->first();

        if ($data) {
            $data->update([
                'content' => $request->about,
            ]);
            return redirect()->back()->with('success', 'About details updated successfully.');
        } else {
            Content::create([
                'slug' => $slug,
                'content' => $request->about,
            ]);
            return redirect()->back()->with('success', 'About details saved successfully.');
        }
    }
    public function privacyStore(Request $request)
    {
        $request->validate([
            'privacy' => 'required',
        ]);

        $slug = 'privacy_policy'; 

  
        $data = Content::where('slug', $slug)->first();

        if ($data) {
            $data->update([
                'content' => $request->privacy,
            ]);
            return redirect()->back()->with('success', 'Privacy details updated successfully.');
        } else {
            Content::create([
                'slug' => $slug,
                'content' => $request->privacy,
            ]);
            return redirect()->back()->with('success', 'Privacy details saved successfully.');
        }
    }
    public function termsStore(Request $request)
    {
        $request->validate([
            'terms' => 'required',
        ]);

        $slug = 'terms_and_conditions'; 

  
        $data = Content::where('slug', $slug)->first();

        if ($data) {
            $data->update([
                'content' => $request->terms,
            ]);
            return redirect()->back()->with('success', 'Terms details updated successfully.');
        } else {
            Content::create([
                'slug' => $slug,
                'content' => $request->terms,
            ]);
            return redirect()->back()->with('success', 'Terms details saved successfully.');
        }
    }
    public function faq(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'question' => 'required',
                'answer' => 'required',
            ]);

            Faq::create($request->all());

            return redirect()->back()->with('success', 'FAQ created successfully.');
        } 
    }
    public function leads()
    {
        // dd('ok');
        $leads = SubscribeEmail::get();
        return view('user.leads', compact('leads'));
    }
           
    
    
}
