


@extends('layouts.app')

@section('content')
<style>
    .table-light {
    --bs-table-color: #000;
    
}
</style>
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h2 class="h4">Festival Transactions</h2>
     
    </div>

    @if($transactions->count() > 0)
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-light text-white text-sm ">
                    <tr>
                        <th>S.N</th>
                        <th>Name</th>
                        <th>Email ID</th>
                        <th>Contact</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Ticket Code</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    
                        @foreach($transactions as $key => $order)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{$order->name ?? $order->exhibitor->name ?? ''}}</td>
                                <td>{{ $order->email ?? $order->exhibitor->email ?? ''}}</td>
                                <td>{{ $order->contact ?? $order->exhibitor->contact ?? ''}}</td>
                                <td>{{ $order->quantity }}</td>
                                <td>{{ $order->price }}</td>
                                <td>{{ $order->ticket_code }}</td>
                                <td>{{ $order->type ?? '' }}</td>
                                <td>{{ $order->status }}</td>
                                <td>{{ $order->created_at->format('d M Y H:i') }}</td>
                            </tr>
                        @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p>No Ticket Data found.</p>
    @endif
   
</div>
@endsection

