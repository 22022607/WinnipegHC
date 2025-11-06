@php use Illuminate\Support\Str; @endphp

@extends('layouts.app')

@section('content')
<style>
    .table-light {
        --bs-table-color: #000;
    }
</style>

{{-- Check if tickets exist and determine ticket type safely --}}
@if(isset($tickets) &&  $tickets->ticket_type == 'internal')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h2 class="h4">Tickets</h2>
        <div class="d-flex gap-2">
            <a href="{{ url('events/index') }}" class="btn text-white" style="background-color: rgb(147 51 234)">
                Back
            </a>
            <a href="#" class="btn text-white" style="background-color: rgb(147 51 234)"
               data-bs-toggle="modal" data-bs-target="#addTicketModal">
                Add Ticket
            </a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-light text-white text-sm" style="background-color: rgb(147 51 234)">
                <tr>
                    <th>S.N</th>
                    <th>Ticket Name</th>
                    <th>Ticket Price</th>
                    <th>Ticket Quantity</th>
                </tr>
            </thead>
            <tbody class="text-sm">
                @foreach($tickets as $key => $ticket)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $ticket->name }}</td>
                        <td>${{ number_format($ticket->price, 2) }}</td>
                        <td>{{ $ticket->quantity }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@elseif(isset($tickets) && $tickets->ticket_type="external")

    <div class="container mt-4" style="margin-left: 180px">
    <h4>External Ticket URL:</h4>
   <p style="background-color: rgb(147, 51, 234);" class="p-2 rounded">
    <a href="{{ $tickets->registration_url }}" target="_blank" class="text-white text-decoration-none">
        {{ $tickets->registration_url }}
    </a>
</p>
</div>

    @else
     <div class="container mt-4" style="margin-left: 180px">
       <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h4">Tickets</h2>
        <div class="d-flex gap-2">
            <a href="{{ url('events/index') }}" class="btn text-white" style="background-color: rgb(147 51 234)">
                Back
            </a>
            <a href="#" class="btn text-white" style="background-color: rgb(147 51 234)"
               data-bs-toggle="modal" data-bs-target="#addTicketModal">
                Add Ticket
            </a>
        </div>
    </div>
       
       
    </div>
@endif

@endsection

{{-- Add Ticket Modal --}}
<div class="modal fade" id="addTicketModal" tabindex="-1" aria-labelledby="addTicketModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{ url('tickets/create/' . $eventId) }}" method="POST">
        @csrf
        <input type="hidden" name="event_id" value="{{ $eventId }}">

        <div class="modal-header">
          <h5 class="modal-title" id="addTicketModalLabel">Add New Ticket</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <div class="mb-3">
            <label for="name" class="form-label">Ticket Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="e.g. VIP, General" required>
          </div>

          <div class="mb-3">
            <label for="price" class="form-label">Ticket Price</label>
            <input type="number" step="0.01" class="form-control" id="price" name="price" required>
          </div>

          <div class="mb-3">
            <label for="quantity" class="form-label">Quantity</label>
            <input type="number" class="form-control" id="quantity" name="quantity" required>
          </div>
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Save Ticket</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>
