@php use Illuminate\Support\Str; @endphp

@extends('layouts.app')

@section('content')
<style>
    .table thead th {
        white-space: nowrap;   /* Prevents header text from wrapping */
    }
    .table td, .table th {
        vertical-align: middle; /* Center vertically */
    }
    .table td {
        max-width: 200px;      /* Limit column width */
        word-wrap: break-word; /* Wrap long content */
    }
    .btn-sm i {
    font-size: 1rem;
}
.btn-sm:hover {
    transform: scale(1.1);
    transition: 0.2s ease-in-out;
}

</style>

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h2 class="h4">Events</h2>
        <a href="{{ route('events.create') }}" class="btn text-white" style="background-color: rgb(147 51 234)">
            Add New Event
        </a>
    </div>

    @if($events->count())
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="bg-dark text-white text-sm">
                    <tr>
                        <th>S.N</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Date</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Total Seats</th>
                        <th>Email</th>
                        <th>Contact</th>
                        <th>Host</th>
                        <th>Venue</th>
                        <th>Admission</th>
                        <th style="width:220px;">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    @foreach($events as $index => $event)
                        <tr>
                            <td>{{ $events->firstItem() + $index }}</td>
                            <td>{{ $event->title }}</td>
                            <td>{{ Str::words($event->description, 8, '...') }}</td>
                            <td>{{ date('F j, Y', strtotime($event->date)) }}</td>
                            <td>{{ $event->start_time }}</td>
                            <td>{{ $event->end_time }}</td>
                            <td>{{ $event->total_seats }}</td>
                            <td>{{ $event->email }}</td>
                            <td>{{ $event->contact }}</td>
                            <td>{{ $event->host }}</td>
                            <td>{{ $event->venue }}</td>
                            <td>${{ $event->admission_fee }}</td>
                          <td data-label="Actions">
                            <div class="d-flex justify-content-center gap-2">
                                
                                <!-- View Ticket -->
                                <a href="{{ route('ticket.show', $event) }}" 
                                class="btn btn-sm" 
                                style="background-color:#3b82f6; color:#fff; border-radius:8px;"
                                title="View Ticket">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <!-- Edit -->
                                <a href="{{ route('events.edit', $event) }}" 
                                class="btn btn-sm" 
                                style="background-color:#facc15; color:#000; border-radius:8px;"
                                title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>


                              <!-- Delete -->
                                <form action="{{ route('events.destroy', $event) }}" 
                                    method="POST" 
                                    onsubmit="return confirm('Are you sure?')" 
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="btn btn-sm" 
                                            style="background-color:#ef4444; color:#fff; border-radius:8px;"
                                            title="Delete">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </form>
                            </div>
                        </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-3">
            {{ $events->links('pagination::bootstrap-5') }}
        </div>
    @else
        <div class="alert alert-info">
            No events found.
        </div>
    @endif
</div>
@endsection
