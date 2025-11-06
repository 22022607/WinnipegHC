@include('front.layout.header')
 <!-- Hero Section -->
<section class="relative text-white py-16 overflow-hidden">
  <!-- Background Image -->
  <img src="{{ asset('festival_images/lake-sunset-bg.jpg') }}" 
       alt="Lake Sunset Background"
       class="absolute inset-0 w-full h-full object-cover ">

  <!-- Gradient Overlay -->
  <div class=""></div>

  <!-- Content -->
  <div class="relative max-w-6xl mx-auto px-6 text-center">
    <h1 class="text-4xl md:text-6xl font-bold mb-4">
     Exhibitors 2025
    </h1>
  </div>
</section>
@if($exhibitors->isEmpty())
  <div class="max-w-4xl mx-auto px-6 py-16 text-center">
    <p class="text-gray-700 text-lg">Exhibitor information will be available soon. Please check back later!</p>
  </div>
  @else
  @foreach($exhibitors as $exhibitor) 
  <section class="bg-white py-16">
    <div class="max-w-6xl mx-auto px-6 md:px-8">
      <div class="md:flex md:gap-10 items-start">
        
        <!-- Left: Image -->
        <div class="md:w-1/3">
          <img src="{{ asset($exhibitor->image) }}"
              alt="Meditation"
              class="rounded-lg shadow-lg w-full object-cover">
        </div>

        <!-- Right: Content and Contact Info -->
        <div class="md:w-2/3 mt-8 md:mt-0 relative">
          
          <!-- Text Content -->
          <div class="pr-0 md:pr-56">
            <h2 class="text-xl font-bold text-gray-900 mb-2">
            {{ $exhibitor->title }} - {{ $exhibitor->name }}
            </h2>

            

            <div class="text-gray-700 leading-relaxed space-y-2">
              <p>{{ $exhibitor->description }}</p>
            
            </div>
          </div>

          <!-- Contact Info (floats to right side of text) -->
          <div class="md:absolute md:top-10 md:right-0 md:w-52">
            <div class="bg-indigo-50 border border-indigo-100 rounded-xl p-6 shadow-sm">
              <h3 class="text-lg font-semibold text-gray-900 mb-4">Contact Info</h3>
              <p>
                <span class="font-semibold text-gray-800">Email:</span>
                <a href="mailto:{{ $exhibitor->email }}"
                  class="text-indigo-600 hover:underline block break-words">
                  {{ $exhibitor->email }}
                </a>
              </p>
              <p class="mt-2">
                <span class="font-semibold text-gray-800">Phone:</span> {{ $exhibitor->contact }}
              </p>
              @if(@$exhibitor->member_id)
              <a href="{{ route('business.details', ['id' => $exhibitor->member_id]) }}"
                class="inline-block mt-4 bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition">
                Learn More
              
              </a>
              @endif
            </div>
          </div>

        </div>
      </div>
    </div>
  </section>
@endforeach
@endif
@include('front.layout.footer')
