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
        <h2 class="h4">Events</h2>
        <a href="{{ route('events.create') }}" class="btn " style="background-color:  rgb(147 51 234)">
            Add New Event
        </a>
    </div>

    @if($events->count())
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-light text-white text-sm">
                    <tr>
                        <th>S.N</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Date</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Total Seats</th>
                        {{-- <th>Website</th> --}}
                        <th>Email</th>
                        <th>Contact</th>
                        <th>Host</th>
                        <th>Venue</th>
                        {{-- <th>Facebook Link</th> --}}
                        {{-- <th>Registration Link</th> --}}
                        <th>Admission</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="text-sm">

                    @foreach($events as $index => $event)

                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $event->title }}</td>
                            <td>{{ Str::words($event->description, 5, '...') }}</td>
                            <td>{{ date('F j, Y', strtotime($event->date)) }}</td>
                            <td>{{ $event->start_time }}</td>
                            <td>{{ $event->end_time }}</td>
                            <td>{{ $event->total_seats }}</td>
                            {{-- <td>{{ $event->website }}</td> --}}
                            <td>{{ $event->email }}</td>
                            <td>{{ $event->contact }}</td>
                            <td>{{ $event->host }}</td>
                            <td>{{ $event->venue }}</td>
                            {{-- <td>{{ $event->facebook_link }}</td> --}}
                            {{-- <td>{{ $event->registration_link }}</td> --}}
                            <td>${{ $event->admission_fee }}</td>

                            <td>
                                <div  class="flex gap-2">
                    
                                <a href="{{ route('events.edit', $event) }}" class="btn btn-sm btn-warning py-2 px-4 rounded w-32 h-12 flex items-center justify-center">
                                    Edit
                                </a>

                                <form action="{{ route('events.destroy', $event) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger py-2 px-4 rounded w-32 h-12 flex items-center justify-center">
                                        Delete
                                    </button>
                                </form>
                               <a href="{{route('ticket.show',$event)}}" class="btn btn-sm btn-primary  rounded  flex items-center justify-center">
                                    View Ticket
                                </a>
                            </td>
                            </div>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="alert alert-info">
            No events found.
        </div>
    @endif
</div>
@endsection
