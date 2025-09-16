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
        // dd($request->all());
        $event = Event::with('tickets')->findOrFail($id);
        $ticket = $event->tickets->first();
        $event->tickets->decrement('quantity', $request->quantity);

        Stripe::setApiKey(env('STRIPE_SECRET'));
        // dd(env('STRIPE_SECRET'));

        // try {
            $order = Order::create([
                // "amount" => $ticket->price * 100, 
                // "currency" => "usd",
                // "source" => $request->stripeToken,
                // "description" => "Payment for Event: " . $event->title,
                'event_id'=>$request->event_id,
                'ticket_id'=>$request->ticket_id,
                'user_id'=>Auth::user()->id,
                'transaction_id'=>'TRAWINNI',
                'status'=>'success',
                'quantity'=>$request->quantity,
                'price'=>$request->total_price,
                'ticket_code' => strtoupper(Str::random(10)),
            ]);
            // dd($charge);
            return redirect()->route('front.tickets.purchasedticket', $order->id)
                             ->with('success', 'Payment successful! 🎉');
        // } catch (\Exception $e) {
        //     return back()->with('error', $e->getMessage());
        // }
    }
}
