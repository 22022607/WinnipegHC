@extends('layouts.app')
@section('content')
<!-- Add this in <head> -->

<h2 class="row justify-content-center mt-2 ">Add Business</h2>
<div class="container" >
    <div class="row justify-content-center">
        <div class="col-md-8"> 
            <div class="card shadow"> 
                <div class="card-body">
                <form method="POST" action="{{ route('business.store') }}" enctype="multipart/form-data">  
                    @csrf

                        <!-- Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Business Name</label>
                            <input type="text" id="name" name="name" class="form-control" 
                                value="{{ old('name', $business->name ?? '') }}" required 
                                placeholder="e.g., Serenity Wellness Center">
                        </div>

                        <!-- Description -->
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea id="description" name="description" class="form-control" rows="3" required 
                                placeholder="Briefly describe your business, services, or specialties...">{{ old('description', $business->description ?? '') }}</textarea>
                        </div>

                        <!-- Category -->
                        <div class="mb-3">
                            <label for="category" class="form-label">Category</label>
                            <input type="text" id="category" name="category" class="form-control"
                                value="{{ old('category', $business->category ?? '') }}" required 
                                placeholder="e.g., Wellness, Fitness, Therapy, Coaching">
                        </div>

                        <!-- Location -->
                        <div class="mb-3">
                            <label for="location" class="form-label">Location</label>
                            <input type="text" id="location" name="location" class="form-control"
                                value="{{ old('location', $business->location ?? '') }}" required 
                                placeholder="e.g., Downtown Studio, Main Street, Online">
                        </div>

                        <!-- Rating -->
                        <!--<div class="mb-3">-->
                        <!--    <label for="rating" class="form-label">Rating</label>-->
                        <!--    <input type="number" step="0.1" min="0" max="5" id="rating" name="rating" class="form-control"-->
                        <!--        value="{{ old('rating', $business->rating ?? '') }}" placeholder="e.g., 4.5">-->
                        <!--</div>-->

                        <!-- Reviews -->
                        <!--<div class="mb-3">  -->
                        <!--    <label for="reviews" class="form-label">Reviews Count</label>-->
                        <!--    <input type="number" id="reviews" name="reviews" class="form-control"-->
                        <!--        value="{{ old('reviews', $business->reviews ?? '') }}" placeholder="e.g., 120">-->
                        <!--</div>-->

                        <!-- Website -->
                        <div class="mb-3">
                            <label for="website" class="form-label">Website</label>
                            <input type="url" id="website" name="website" class="form-control"
                                value="{{ old('website', $business->website ?? '') }}" 
                                placeholder="https://yourwebsite.com">
                        </div>

                        <!-- Contact -->
                        <div class="mb-3">
                            <label for="phone" class="form-label">Contact Number</label>
                            <input type="text" id="phone" name="phone" class="form-control"
                                value="{{ old('phone', $business->phone ?? '') }}" 
                                placeholder="+1 (555) 123-4567">
                        </div>

                        <!-- Hours -->
                        <div class="mb-3">  
                            <label for="hours" class="form-label">Business Hours</label>
                            <input type="text" id="hours" name="hours" class="form-control"
                                value="{{ old('hours', $business->hours ?? '') }}" 
                                placeholder="e.g., Mon–Fri 9am–5pm, Sat 10am–2pm">
                        </div>

                        <!-- Featured -->
                        <div class="mb-3 form-check">
                            <input type="checkbox" id="featured" name="featured" class="form-check-input"
                                {{ old('featured', $business->featured ?? 0) ? 'checked' : '' }}>
                            <label for="featured" class="form-check-label">Mark as Featured</label>
                        </div>

                        <!-- Image Upload -->
                        <div class="mb-3">
                            <label for="image" class="form-label">Featured Image</label>
                            <input type="file" id="image" name="image" class="form-control" accept="image/*">
                            @if(isset($business) && $business->image)
                                <img src="{{ asset($business->image) }}" 
                                    alt="Business Image" class="mt-2 img-fluid rounded shadow-sm" 
                                    style="max-width: 300px;">
                            @endif
                        </div>

                        <!-- Additional Images -->
                        <!--<div class="mb-3">-->
                        <!--    <label for="additional_images" class="form-label">Additional Images</label>-->
                        <!--    <input type="file" id="additional_images" name="additional_images[]" -->
                        <!--        class="form-control" accept="image/*" multiple>-->
                        <!--    {{-- Uncomment if you have multiple images stored as JSON/array --}}-->
                        <!--    {{-- @if(isset($business) && $business->additional_images)-->
                        <!--        @foreach($business->additional_images as $image)-->
                        <!--            <img src="{{ asset('events/' . $image) }}" -->
                        <!--                alt="Business Image" class="mt-2 img-fluid rounded shadow-sm" -->
                        <!--                style="max-width: 150px;">-->
                        <!--        @endforeach-->
                        <!--    @endif --}}-->
                        <!--</div>-->

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
