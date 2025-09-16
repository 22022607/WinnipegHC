<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContentController extends Controller
{
   public function about()
   {
    return view('front.content.about');
   }
    public function contact()
   {
    return view('front.content.contact');
   }
}
