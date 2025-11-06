

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
</style>

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h2 class="h4">Festival Event</h2>
        <a href="{{ route('admin.festival.create') }}" class="btn text-white" style="background-color: rgb(147 51 234)">
            Add Festival Event
        </a>
    </div>

    @if($festivals->count())
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="bg-dark text-white text-sm">
                    <tr>
                        <th>S.N</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                         <th>Address</th>
                         <th>Website</th>
                        <th>Email</th>
                        <th>Contact</th>
                        <th>Host</th>
                        <th>Facebook</th>
                        <th>Admission</th>
                        <th>Total Seats</th>
                        <th>Image</th>
                        <th style="width:220px;">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    @foreach($festivals as $index => $festival)
                        <tr>
                            <td>{{ $festivals->firstItem() + $index }}</td>
                            <td>{{ $festival->title }}</td>
                            <td>{{ Str::words($festival->description, 8, '...') }}</td>
                            <td>{{ date('F j, Y', strtotime($festival->start_date)) }}</td>
                            <td>{{ date('F j, Y', strtotime($festival->end_date)) }}</td>
                            <td>{{ $festival->start_time }}</td>
                            <td>{{ $festival->end_time }}</td>
                            <td>{{ $festival->address }}</td>
                            <td>{{ $festival->website }}</td>
                            <td>{{ $festival->email }}</td>
                            <td>{{ $festival->contact }}</td>
                            <td>{{ $festival->host }}</td>
                            <td>{{ $festival->facebook }}</td>
                            <td>${{ $festival->admission_fee }}</td>
                            <td>{{ $festival->total_seats }}</td>
                            <td><img src="{{ asset($festival->image) }}" alt="{{ $festival->title }}" class="img-fluid" style="max-width: 100px;"></td>
                            <td>
                                <a href="{{ route('admin.festival.edit', $festival->id) }}" class="btn btn-sm btn-primary mb-1">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
       <div class="d-flex justify-content-center mt-3">
            {{ $festivals->links('pagination::bootstrap-5') }}
        </div>
    @else
        <div class="alert alert-info">
            No festivals found.
        </div>
    @endif 
</div>
@endsection
