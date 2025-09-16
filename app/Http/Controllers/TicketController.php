<?php

namespace App\Http\Controllers;
use App\Models\Event;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
 
class TicketController extends Controller
{
    public function index()
    {
        
        return view('tickets.index');
    }
    public function purchase($eventId, Request $request)
    {
        // $eventId=Event::select('id')->find($eventId);
        $ticket = Ticket::create([
            'event_id' => $eventId,
            'user_id' => Auth::id(),
            'status' => 'active',
            'qr_code' => Str::uuid()
        ]);
        $qr = QrCode::size(250)->generate(route('ticket.show', $ticket->id));
        // Return view with ticket, qr
        return view('tickets.show', compact('ticket', 'qr'));
    }
    public function create($eventId, Request $request)
    {
        // dd($eventId);
        $tickets = Ticket::create([
            'event_id' => $eventId,
            'user_id' => Auth::id(),
            'status' => 'active',
            'qr_code' => Str::uuid(),
            'name'=>$request->name,
            'quantity'=>$request->quantity,
            'price'=>$request->price,
        ]);
        // dd($ticket);
        $qr = QrCode::size(250)->generate(route('ticket.show', $tickets->id));
        // Return view with ticket, qr
        // return redirect()->route('tickets.show'), compact('tickets', 'qr','eventId');
        return redirect('tickets/' . $eventId)->with('success', 'Tickets added!');

    }
 
    public function show($eventId, Request $request)
    {
        // $tickets='';
        // $event_id = Event::where('id',$eventId)->get();
        // dd($event_id);
        $tickets  = Ticket::where('event_id',$eventId)->get();
        // dd($tickets);
        // $qr = QrCode::size(250)->generate(route('ticket.show', $tickets->id));
        return view('tickets.show',compact('eventId','tickets'));
    }
    
    

}
