 @php use Illuminate\Support\Str; @endphp


@extends('layouts.app')

@section('content')
<style>
    .table-light {
    --bs-table-color: #000;
    
}
</style>
<div class="container mt-4" style="margin-left: 180px">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h4">Orders</h2>
     
    </div>

    @if($orders->count() > 0)
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-light text-white text-sm ">
                    <tr>
                        <th>S.N</th>
                        <th>User Name</th>
                        <th>Event</th>
                        <th>Ticket</th>
                        <th>Qty</th>
                        <th>Code</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    
                        @foreach($orders as $key => $order)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ Auth::user()->name }}</td>
                                <td>{{ $order->event->title }}</td>
                                <td>{{ $order->ticket->name }}</td>
                                <td>{{ $order->quantity }}</td>
                                <td>{{ $order->ticket_code }}</td>
                                <td>
                                    <span class="px-2 py-1 rounded text-sm
                                        {{ $order->status == 'paid' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td>{{ $order->created_at->format('d M Y H:i') }}</td>
                            </tr>
                        @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p>No orders found.</p>
    @endif
   
</div>
@endsection

