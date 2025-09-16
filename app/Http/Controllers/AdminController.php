<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
   public function __construct()
    {
        $this->middleware('role:admin');
    }

    public function index()
    {
        return view('admin.dashboard');
    }
}
