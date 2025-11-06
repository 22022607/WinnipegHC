<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;
use App\Models\Event;
use App\Models\Order;
use Auth;
use Illuminate\Support\Str;
use Stripe\Checkout\Session;
use Illuminate\Support\Facades\Mail;

class PaymentController extends Controller
{
    public function checkout(Request $request, $id)
    {
        $event = Event::with('tickets')->findOrFail($id);

        $ticketId = $request->input('ticket_id');
        $quantity = $request->input('quantity', $request->quantity); 
        $ticket_name = $request->ticket_name; 
    
        $ticket = $event->tickets()->findOrFail($ticketId);

    
        session([
            'ticket_id' => $ticketId,
            'quantity'  => $quantity,
        ]);

        return view('front.event.checkout', compact('event', 'ticket', 'quantity','ticket_name'));
    }

    public function processPayment(Request $request, $id)
    {
         
         $event = Event::with('tickets')->findOrFail($id);
        $ticket = $event->tickets->first();
        $event->tickets->decrement('quantity', $request->quantity);
        Stripe::setApiKey(env('STRIPE_SECRET'));

       $order = Order::create([
                'event_id'=>$request->event_id,
                'ticket_id'=>$request->ticket_id,
                'transaction_id'=>'TRAWINNI',
                'status'=>'success',
                'quantity'=>$request->quantity,
                'price'=>$request->total_price,
                'ticket_code' => strtoupper(Str::random(10)),
                'type'=>'event_ticket',
                'name'=>$request->name,
                'email'=>$request->email,
                'contact'=>$request->contact,
                'status'=>'pending',
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
                    'unit_amount' => $order->price * 100, 
                ],
                'quantity' => 1,
            ]],
            'success_url' => route('event.ticket.success') . '?order_id=' . $order->id . '&session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('event.ticket.cancel', ['order_id' => $order->id]),
            'metadata' => [
                'order_id' => $order->id,
                'name'     => $request->name,
                'contact'  => $request->contact,
            ],
        ]);

        return redirect()->away($session->url);
        // dd($request->all());
        
    }
    public function ticketSuccess(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        if (!$request->has('order_id') || !$request->has('session_id')) {
            return redirect('/')->with('error', 'Missing session or order ID.');
        }

        $session = \Stripe\Checkout\Session::retrieve($request->session_id);
        $order = Order::where('id', $request->order_id)->with('event')->first();

        if ($order && $session) {
            $order->update([
                'transaction_id' => $session->payment_intent,
                'status' => 'paid',
            ]);
              
            $adminEmail = 'admin@example.com';

            Mail::send('front.event.ticketemail', [
                'order' => $order,
            ], function ($message) use ($order, $adminEmail) {
                $message->to($order->email)
                        ->cc($adminEmail)
                        ->subject('🎟️ Ticket Confirmation')
                        ->from(config('mail.from.address'), config('mail.from.name'));
            });
        }

        return view('front.event.success', compact('order'));
    }
    public function ticketCancel(Request $request)
    {
        if (!$request->has('order_id')) {
            return redirect('/')->with('error', 'Missing order ID.');
        }

        $order = Order::where('id', $request->order_id)->first();

        if ($order) {
            $order->update([
                'status' => 'cancelled',
            ]);
        }

        return view('front.event.cancel', compact('order'));
    }
}
