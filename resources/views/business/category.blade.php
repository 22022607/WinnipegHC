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
</style>

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h2 class="h4">Categories</h2>
        <a href="{{ route('category.create') }}" class="btn text-white" style="background-color: rgb(147 51 234)">
            Add New Category
        </a>
    </div>

    @if($categories->count())
        <div class="table-responsive" style="padding: 17px;">
            <table class="table table-bordered table-striped align-middle">
                <thead class="bg-dark text-white text-sm">
                    <tr>
                        <th>S.N</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th style="width:220px;">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    @foreach($categories as $index => $category)
                        <tr>
                            <td>{{ $categories->firstItem() + $index }}</td>
                            <td>{{ $category->name }}</td>
                            <td>
                           
                                @if($category->image)
                                    <img src="{{ asset($category->image) }}" alt="{{ $category->name }}" class="img-fluid" style="max-width: 100px;">
                                @endif
                            </td>
                           
                            <td>
                                <div class="d-flex gap-2">
                                    {{-- <a href="{{ route('categories.edit', $category) }}" class="btn btn-sm btn-warning">Edit</a>

                                    <form action="{{ route('categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form> --}}

                                    
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-3">
            {{ $categories->links('pagination::bootstrap-5') }}
        </div>
    @else
        <div class="alert alert-info">
            No categories found.
        </div>
    @endif
</div>
@endsection
