<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
class OrderController extends Controller
{
    public function index()
    {
       $orders= Order::where('type','event_ticket')->with('event','ticket','user')->get();
        return view('order.index',compact('orders'));
    }
}
