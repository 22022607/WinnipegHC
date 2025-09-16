 @php use Illuminate\Support\Str; @endphp


@extends('layouts.app')

@section('content')
<style>
    .table-light {
    --bs-table-color: #000;
    
}
</style>
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h4">Tickets</h2>
         <div class="d-flex gap-2">
           <a href="{{ url('events/index') }}" class="btn text-white" style="background-color:  rgb(147 51 234)">
            Back
        </a>
        <a href="#" class="btn text-white" style="background-color:  rgb(147 51 234)"
           data-bs-toggle="modal" data-bs-target="#addTicketModal">
            Add Ticket
        </a>
       
    </div>
    </div>

    {{-- @if($events->count()) --}}
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-light text-white text-sm">
                    <tr>
                        <th>S.N</th>
                        <th>Ticket Name</th>
                        <th>Ticket Price</th>
                        <th>Ticket Qunatity</th>
                    </tr>
                </thead>
             <tbody class="text-sm">
                    @foreach($tickets as $key => $ticket)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $ticket->name }}</td>
                            <td>${{ $ticket->price }}</td>
                            <td>{{ $ticket->quantity }}</td>
                         
                        </tr>
                    @endforeach
              </tbody>
            </table>
        </div>
   
</div>
@endsection
<!-- Add Ticket Modal -->
<div class="modal fade" id="addTicketModal" tabindex="-1" aria-labelledby="addTicketModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{url('tickets/create/'.$eventId)}}" method="POST">
        <input type="hidden" name="event_id" id="event_id" value="{{$eventId}}">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="addTicketModalLabel">Add New Ticket</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
        

          <div class="mb-3">
            <label for="type" class="form-label">Ticket Name</label>
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
