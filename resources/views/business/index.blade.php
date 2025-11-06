@php use Illuminate\Support\Str; @endphp

@extends('layouts.app')

@section('content')
<style>
    .table-light {
        --bs-table-color: #000;
    }
    .business-image {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 5px;
    }
    /* For better button spacing in table */
    .action-buttons {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
    }
    /* Make table scrollable on small screens */
    @media (max-width: 768px) {
        .table-responsive {
            overflow-x: auto;
        }
        .action-buttons a,
        .action-buttons button {
            flex: 1 1 100%;
        }
    }
</style>

<div class="container">
    <div class="d-flex justify-content-between align-items-center flex-wrap mb-2">
        <h2 class="h4">Business</h2>
        <a href="{{ route('admin.business.create') }}" class="btn text-white mb-2"
           style="background-color: rgb(147 51 234)">
            Add New Business
        </a>
    </div>

    @if($businesses->count())
        <div class="table-responsive" style="padding: 17px;">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-light text-white text-sm">
                    <tr>
                        <th>S.N</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Category</th>
                        <th>Location</th>
                        <th>Website</th>
                        <th>Contact</th>
                        <th>Hours</th>
                        <th>Image</th>
                        <th>Featured</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    @foreach($businesses as $index => $business)
                        <tr>
                            <td>{{ $businesses->firstItem() + $index }}</td>
                            <td>{{ $business->name }}</td>
                            <td>{{ Str::words($business->description, 5, '...') }}</td>
                            <td>{{ $business->category }}</td>
                            <td>{{ $business->location }}</td>
                            <td>{{ $business->website }}</td>
                            <td>{{ $business->phone  }}</td>
                            <td>{{ $business->hours }}</td>
                            <td><img src="{{ asset($business->image) }}" alt="" class="business-image"></td>
                            <td>{{ $business->featured ? 'Yes' : 'No' }}</td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('business.edit', $business) }}" 
                                       class="btn btn-warning btn-sm py-2 px-3">
                                        Edit
                                    </a>
                                    <form action="{{ route('business.destroy', $business) }}" method="POST" class="d-inline w-100">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm w-100 py-2 px-3">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center mt-3">
            {{ $businesses->links('pagination::bootstrap-5') }}
        </div>
    @else
        <div class="alert alert-info">
            No businesses found.
        </div>
    @endif
</div>
@endsection
