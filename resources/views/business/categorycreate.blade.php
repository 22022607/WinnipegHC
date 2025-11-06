@extends('layouts.app')
@section('content')
<!-- Add this in <head> -->

<h2 class="row justify-content-center mt-2 ">Add Category</h2>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8"> 
            <div class="card shadow"> 
                <div class="card-body">
                <form method="POST" action="{{ route('category.store') }}" enctype="multipart/form-data">  
                    @csrf

                        <!-- Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label"> Name</label>
                            <input type="text" id="name" name="name" class="form-control" 
                                value="{{ old('name', $category->name ?? '') }}" required 
                                placeholder="e.g., Serenity Wellness Center">
                        </div>

                       

                        <!-- Image Upload -->
                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" id="image" name="image" class="form-control" accept="image/*">
                            @if(isset($category) && $category->image)
                                <img src="{{ asset($category->image) }}" 
                                    alt="Category Image" class="mt-2 img-fluid rounded shadow-sm" 
                                    style="max-width: 300px;">
                            @endif
                        </div>

                       
                        </div>

                        <button type="submit" class="btn btn-success d-block mx-auto px-4 py-2">
                            Save
                        </button>
                </form>

                </div>
            </div>
        </div>
    </div>
</div>



@endsection
<!-- Optional Bootstrap JS -->
