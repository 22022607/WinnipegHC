@extends('layouts.app')
@section('content')
<!-- Add this in <head> -->

<h2 class="row justify-content-center mt-2 ">Add Festival Event</h2>
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
                <form method="POST" action="{{ route('admin.festival.store') }}" enctype="multipart/form-data">  
                    @csrf

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
            
                <!-- Date -->
            <div class="mb-3">
                <label for="start_date" class="form-label">From Date</label>
                <input type="date" id="start_date" name="start_date" class="form-control"
                        value="{{ old('start_date', isset($event) ? $event->start_date->format('Y-m-d') : '') }}" required>
            </div>
              <div class="mb-3">
                <label for="end_date" class="form-label">To Date</label>
                <input type="date" id="end_date" name="end_date" class="form-control"
                        value="{{ old('end_date', isset($event) ? $event->end_date->format('Y-m-d') : '') }}" required>
            </div>

            <!-- Start Time -->
            <div class="mb-3">
                <label for="start_time" class="form-label">Start Time</label>
                <input type="time" id="start_time" name="start_time" class="form-control"
                        value="{{ old('start_time', isset($event) ? $event->start_time->format('TH:i') : '') }}" required>
            </div>

            <!-- End Time -->
            <div class="mb-3">
                <label for="end_time" class="form-label">End Time</label>
                <input type="time" id="end_time" name="end_time" class="form-control"
                        value="{{ old('end_time', isset($event) ? $event->end_time->format('TH:i') : '') }}" required>
            </div>

            <!-- Venue -->
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" id="address" name="address" class="form-control"
                        value="{{ old('address', $event->address ?? '') }}" required placeholder="e.g., Studio A, Main Hall, Online via Zoom">
            </div>

            <!-- Website -->
            <div class="mb-3">
                <label for="website" class="form-label">Website</label>
                <input type="url" id="website" name="website" class="form-control"
                        value="{{ old('website', $event->website ?? '') }}">
            </div>

            <!-- Host -->
            <div class="mb-3">
                <label for="host" class="form-label">Host</label>
                <input type="text" id="host" name="host" class="form-control"
                        value="{{ old('host', $event->host ?? '') }}" placeholder="Enter Host Name">
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

            <!-- Facebook -->
           <div class="mb-3">
                <label for="facebook" class="form-label">Facebook Link</label>
                <input type="url" id="facebook" name="facebook" class="form-control"
                        value="{{ old('facebook', $event->facebook ?? '') }}">
            </div>

            <!-- Admission -->
            <div class="mb-3">
                <label for="admission" class="form-label">Admission Fee</label>
                <input type="number" id="admission_fee" name="admission_fee" class="form-control"
                        value="{{ old('admission_fee', $event->admission_fee ?? '') }}" placeholder="e.g. 20 , 45">
            </div>
               <!-- Total Seats -->
            <div class="mb-3">
                <label for="total_seats" class="form-label">Total Seats</label>
                <input type="number" id="total_seats" name="total_seats" class="form-control"
                        value="{{ old('total_seats', $event->total_seats ?? '') }}" placeholder="e.g. 100">
            </div>
            <!-- Image Upload -->
            <div class="mb-3">
                <label for="image" class="form-label">Event Image</label>
                <input type="file" id="image" name="image" class="form-control" accept="image/*">
                @if(isset($event) && $event->image)
                    <img src="{{ asset('storage/' . $event->image) }}" alt="Event Image" class="mt-2" style="max-width: 100%; height: auto;">
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
