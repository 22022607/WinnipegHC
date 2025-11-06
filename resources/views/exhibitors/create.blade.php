@extends('layouts.app')
@section('content')
<!-- Add this in <head> -->

<h2 class="row justify-content-center mt-2 ">Add Exhibitor</h2>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8"> 
            <div class="card shadow"> 
                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                <form method="POST" action="{{ route('admin.exhibitor.store') }}" enctype="multipart/form-data">  
                    @csrf
                      <div class="mb-3">
                <label for="name" class="form-label">Exhibitor Name</label>
                <input type="text" id="name" name="name" class="form-control" 
                        value="{{ old('name', $event->name ?? '') }}" required placeholder="e.g., John Doe">
            </div>
            <!-- Title -->
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" id="title" name="title" class="form-control" 
                        value="{{ old('title', $event->title ?? '') }}" required placeholder="e.g., Meditation Workshop, Reiki Level 1, Sound Bath">
            </div>

            <!-- Description -->
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea id="description" name="description" class="form-control" rows="3" required placeholder="Describe your event, what participants can expect, and any prerequisites...">{{ old('description', $event->description ?? '') }}</textarea>
            </div>

            <!-- Website -->
            <div class="mb-3">
                <label for="website" class="form-label">Website</label>
                <input type="url" id="website" name="website" class="form-control"
                        value="{{ old('website', $event->website ?? '') }}">
            </div>

            <!-- Contact -->
            <div class="mb-3">
                <label for="contact" class="form-label">Contact</label>
                <input type="text" id="contact" name="contact" class="form-control"
                        value="{{ old('contact', $event->contact ?? '') }}" placeholder="(555) 123-4567">
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" class="form-control"
                        value="{{ old('email', $event->email ?? '') }}" placeholder="event@yourbusiness.com">
            </div>

           

            <!-- Image Upload -->
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" id="image" name="image" class="form-control" accept="image/*">
                @if(isset($event) && $event->image)
                    <img src="{{ asset('storage/' . $event->image) }}" alt="Image" class="mt-2" style="max-width: 100%; height: auto;">
                @endif
            </div>

            <button type="submit" class="btn btn-success d-block mx-auto" style="width: 15%;">
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
