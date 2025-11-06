@include('front.layout.header')
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Winnipeg Healing Connection</title>
</head>
<body class="flex flex-col min-h-screen">



<!-- Hero Section -->
<section class="bg-gradient-to-b from-purple-50 to-white py-16 sm:py-20">
  <div class="container mx-auto text-center px-6">
    <!-- Title -->
    <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold mb-4 leading-snug sm:leading-tight">
      <span class="text-gray-900 block sm:inline">Winnipeg</span> 
      <span class="text-purple-600 block sm:inline">Healing Connection</span>
    </h1>
    
    <!-- Subtitle -->
    <p class="text-base sm:text-lg text-gray-600 mb-8 sm:mb-12 leading-relaxed">
      Connect with trusted mental health professionals, healing practitioners, <br class="hidden sm:inline">
      and community events. Your journey to wellness starts here in Winnipeg.
    </p>
    
    <!-- Call-to-Action Buttons -->
    <div class="flex flex-col sm:flex-row justify-center items-center sm:space-x-4 space-y-4 sm:space-y-0 mb-12">
      <!--<a href="{{ route('join-community') }}" -->
      <!--   class="flex items-center justify-center space-x-2 bg-purple-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-purple-700 w-full sm:w-auto">-->
      <!--  <i class="fa-solid fa-users"></i>-->
      <!--  <span>Join Our Community</span>-->
      <!--</a>-->
      <a href="{{ route('event') }}" 
         class="flex items-center justify-center space-x-2 border border-purple-600 text-purple-600 px-6 py-3 rounded-lg font-medium hover:bg-purple-50 w-full sm:w-auto">
        <i class="fa-solid fa-calendar-days"></i>
        <span>Browse Events</span>
      </a>
    </div>

    <!-- 3 Feature Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 max-w-5xl mx-auto">
      <div class="bg-white shadow rounded-2xl p-6 text-center">
        <div class="w-12 h-12 rounded-full bg-purple-100 flex items-center justify-center mx-auto mb-4">
          <i class="fa-solid fa-user-group text-purple-600 text-xl"></i>
        </div>
        <h3 class="font-semibold text-lg">Connect</h3>
        <p class="text-sm text-gray-600 mt-2">
          Find trusted mental health professionals and healing practitioners in Winnipeg
        </p>
      </div>
      <div class="bg-white shadow rounded-2xl p-6 text-center">
        <div class="w-12 h-12 rounded-full bg-purple-100 flex items-center justify-center mx-auto mb-4">
          <i class="fa-solid fa-calendar-check text-purple-600 text-xl"></i>
        </div>
        <h3 class="font-semibold text-lg">Attend</h3>
        <p class="text-sm text-gray-600 mt-2">
          Join healing workshops, support groups, and wellness events in your city
        </p>
      </div>
      <div class="bg-white shadow rounded-2xl p-6 text-center">
        <div class="w-12 h-12 rounded-full bg-purple-100 flex items-center justify-center mx-auto mb-4">
          <i class="fa-solid fa-seedling text-purple-600 text-xl"></i>
        </div>
        <h3 class="font-semibold text-lg">Grow</h3>
        <p class="text-sm text-gray-600 mt-2">
          Build your practice with our community of like-minded professionals
        </p>
      </div>
    </div>
  </div>
</section>



<!-- Spotlight (This Month's) -->
@if($activeSpotlight)
<section id="spotlight" class="py-16">
  <div class="container mx-auto px-6">

    <!-- Section heading -->
    <h2 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-center">
      This Month's <span class="text-purple-600">Spotlight</span>
    </h2>
    <p class="mt-4 text-center text-gray-600 max-w-3xl mx-auto text-sm sm:text-base">
      Discover exceptional healing practitioners making a difference in our Winnipeg community
    </p>

    <!-- Spotlight content -->
    <div class="mt-10 grid grid-cols-1 lg:grid-cols-2 gap-8 max-w-6xl mx-auto items-stretch">

      <!-- Left: image with badge -->
      <div class="relative rounded-3xl shadow-2xl overflow-hidden h-64 sm:h-80 md:h-[486px]">
        <img
          src="{{ asset(@$activeSpotlight->business->image ?? '') }}"
          alt="{{ @$activeSpotlight->business->name ?? '' }}"
          class="w-full h-full object-cover"
        />
        <span class="absolute top-4 left-4 px-3 py-1 text-sm font-semibold bg-purple-600 text-white rounded-full shadow">
          Spotlight!
        </span>
      </div>

      <!-- Right: info card -->
      <div class="bg-gradient-to-b from-white to-purple-50 rounded-3xl shadow-xl ring-1 ring-purple-100/70">
        <div class="p-6 sm:p-8 md:p-10 h-full flex flex-col">

          <!-- Rating -->
          <!--<div class="flex items-center gap-2 mb-4 flex-wrap">-->
          <!--  <i class="fa-solid fa-star text-yellow-400"></i>-->
          <!--  <i class="fa-solid fa-star text-yellow-400"></i>-->
          <!--  <i class="fa-solid fa-star text-yellow-400"></i>-->
          <!--  <i class="fa-solid fa-star text-yellow-400"></i>-->
          <!--  <i class="fa-solid fa-star text-yellow-400"></i>-->
          <!--  <span class="text-gray-500 text-sm">(4.9/5)</span>-->
          <!--</div>-->

          <!-- Title -->
          <h3 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-gray-900 leading-tight">
                       {{ $activeSpotlight->business->name }}

          </h3>

          <!-- Location -->
          <div class="mt-3 flex items-center gap-2 text-gray-600">
            <i class="fa-solid fa-location-dot text-purple-600"></i>
            <span>{{ $activeSpotlight->business->location }}</span>
          </div>

          <!-- Description -->
          <p class="mt-4 sm:mt-6 text-gray-700 text-sm sm:text-base leading-relaxed">
            
                         {{ Str::limit($activeSpotlight->business->description, 150, '...') }}

          </p>

          <!-- Next workshop -->
          <div class="mt-4 sm:mt-6 flex items-start gap-3 text-gray-700">
            <i class="fa-regular fa-calendar text-purple-600 mt-1"></i>
            <p class="text-sm sm:text-base">
              <span class="font-semibold">Next Workshop:</span> Crystal Healing – March 23rd
            </p>
          </div>

          <!-- Actions -->
          <div class="mt-6 sm:mt-8 flex flex-col sm:flex-row gap-4">
            <a href="{{ route('business.details', $activeSpotlight->business->id) }}"
               class="flex-1 sm:flex-none inline-flex items-center justify-center px-6 py-3 rounded-full bg-purple-600 text-white font-medium hover:bg-purple-700 text-center">
              View Profile
            </a>
            <a href="#"
               class="flex-1 sm:flex-none inline-flex items-center justify-center px-6 py-3 rounded-full border-2 border-purple-600 text-purple-700 font-medium hover:bg-purple-50 text-center">
              Book Session
            </a>
          </div>

        </div>
      </div>

    </div>
  </div>
</section>
@endif
<!-- Featured Event -->
@if($spotlight_event)
<section id="featured-event" class="py-16 sm:py-20 bg-gradient-to-br from-purple-50 to-indigo-50">
  <div class="max-w-6xl mx-auto px-6">

    <!-- Heading -->
    <div class="text-center mb-12 sm:mb-16">
      <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold text-gray-800 mb-3">
        Featured <span class="text-purple-600">Event</span>
      </h2>
      <p class="text-base sm:text-lg text-gray-600 max-w-2xl mx-auto">
        Don’t miss this month’s highlighted healing experience
      </p>
    </div>

    <!-- Card -->
    <div class="max-w-5xl mx-auto bg-white shadow-xl rounded-3xl overflow-hidden border border-gray-100 hover:shadow-2xl transition-all duration-300">
      <div class="grid grid-cols-1 lg:grid-cols-2">

        <!-- Left: Image with badge -->
        <div class="relative h-64 sm:h-80 lg:h-full">
         @php
            $event = optional($spotlight_event)->events;
        @endphp
        
        <img 
            src="{{ $event && $event->image ? asset($event->image) : 'https://via.placeholder.com/600x400' }}" 
            alt="{{ $event->title ?? 'Event Image' }}"
            class="w-full h-full object-cover"
        />
          <div class="absolute top-4 left-4 bg-purple-600 text-white px-3 py-1.5 rounded-full text-xs sm:text-sm font-semibold flex items-center shadow-md">
            <i class="fa-regular fa-star mr-1.5"></i>
            Spotlight Event
          </div>
        </div>

        <!-- Right: Content -->
        <div class="p-8 sm:p-10 flex flex-col justify-center bg-gradient-to-br from-white to-purple-50">
            @php
                $event = optional($spotlight_event)->events;
            @endphp
          <h3 class="text-2xl sm:text-3xl font-bold text-gray-800 mb-3">
    {{ $event->title ?? 'No Title Available' }}
</h3>

          <!-- Date and Time -->
          <div class="space-y-2 text-gray-600 mb-5">
            <div class="flex items-center">
              <i class="fa-regular fa-calendar text-purple-600 mr-2"></i>
               @php
                $event = optional($spotlight_event)->events;
            @endphp
              @if(@$event->start_time && @$event->end_time)
                <span class="text-sm sm:text-base">
                  {{ \Carbon\Carbon::parse(@$event->start_time)->format('l, F jS Y • h:i A') }} – 
                  {{ \Carbon\Carbon::parse(@$event->end_time)->format('h:i A') }}
                </span>
              @else
                <span class="text-sm sm:text-base">Time not set</span>
              @endif
            </div>

            <!-- Location -->
            <div class="flex items-start">
              <i class="fa-solid fa-location-dot text-purple-600 mr-2 mt-1"></i>
               @php
                $event = optional($spotlight_event)->events;
            @endphp
              <span class="text-sm sm:text-base leading-snug">
                {{ $event->venue ?? 'Venue not available' }}
              </span>
            </div>
          </div>

          <!-- Description -->
           @php
                $event = optional($spotlight_event)->events;
            @endphp
          <p class="text-gray-700 text-sm sm:text-base leading-relaxed mb-6">
            {{ Str::limit(@$event->description, 180, '...') ?? 'No description available.' }}
          </p>

          <!-- Action Buttons -->
          <div class="flex flex-wrap gap-3">
            @if(!empty($spotlight_event->events) && $spotlight_event->events->id)
              <a href="{{ url('event/'.$spotlight_event->events->id) }}"
                 class="flex-1 sm:flex-none inline-flex items-center justify-center px-6 py-3 rounded-full bg-purple-600 hover:bg-purple-700 text-white font-medium shadow-md transition">
                <i class="fa-solid fa-ticket mr-2"></i>
                Get Tickets Now
              </a>
              <a href="{{ url('event/'.$spotlight_event->events->id) }}"
                 class="flex-1 sm:flex-none inline-flex items-center justify-center px-6 py-3 rounded-full border-2 border-purple-600 text-purple-700 hover:bg-purple-50 font-medium transition">
                Learn More
              </a>
            @else
              <span class="text-gray-500">No Spotlight Event Selected</span>
            @endif
          </div>
        </div>

      </div>
    </div>
  </div>
</section>
@endif


<!-- Upcoming Events -->
<section id="upcoming-events" class="py-16 bg-purple-50/50">
  <div class="container mx-auto px-6 max-w-6xl">

    <!-- Heading -->
    <h2 class="text-4xl md:text-5xl font-extrabold text-center">
      Upcoming <span class="text-purple-600">Events</span>
    </h2>
    <p class="mt-4 text-center text-gray-600 max-w-2xl mx-auto">
      Join our Winnipeg community events designed to support your healing journey
    </p>

    <!-- Event Cards -->
    <div class="mt-12 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

      <!-- Card 1 -->
      @foreach ($upcoming_event as $key=>$value)
          
      <div class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-xl transition">
        <div class="relative">
          <img src="{{ asset($value->image) }}" alt="Healing Circle Workshop" class="w-full h-48 object-cover" />
          <!--<span class="absolute top-3 right-3 bg-purple-600 text-white text-sm font-bold px-3 py-1 rounded-full">$35</span>-->
        </div>
        <div class="p-6">
          <h3 class="text-lg font-bold text-gray-900">{{ $value->title }}</h3>
          <div class="mt-3 flex items-center text-gray-600 text-sm space-x-2">
            <i class="fa-regular fa-calendar text-purple-600"></i>
            <span>{{ date('F j , y',strtotime($value->date)) }}</span>
          </div>
          <div class="mt-2 flex items-center text-gray-600 text-sm space-x-2">
            <i class="fa-solid fa-location-dot text-purple-600"></i>
            <span>{{ $value->venue }}</span>
          </div>
         
          <a href="{{ url('event/'.$value->id) }}"  class="mt-6 block text-center bg-purple-600 text-white font-medium px-5 py-3 rounded-full hover:bg-purple-700">
            <i class="fa-solid fa-ticket mr-2"></i> Get Tickets
          </a>
        </div>
      </div>
      @endforeach

     

    </div>
  </div>
</section>

<!-- View All Events Button -->
<div class="flex justify-center mt-8">
  <a href="{{ route('event') }}"
     class="px-8 py-2 border-2 border-purple-600 text-purple-600 rounded-full font-medium hover:bg-purple-600 hover:text-white transition">
    View All Events
  </a>
</div>

<!-- Section 2: Healing Connection Categories -->
<section class="max-w-6xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
   <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold text-center mb-2">
    Winnipeg Healing Connection <span class="text-purple-600">Categories</span>
  </h2>
  <p class="text-sm sm:text-base text-center text-gray-600 mb-20">
    Find the right type of support for your healing journey in Winnipeg
  </p>
  <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3">
    @foreach ($categories as $category)
      <div class="bg-white rounded-lg px-3 py-2 text-sm text-gray-700 hover:bg-purple-100 hover:text-purple-700 transition-colors cursor-pointer shadow-sm text-center">
        <a href="#" class="text-xs sm:text-sm text-blue-800 hover:underline truncate block">
          {{ $category->name }}
        </a>
      </div>
    @endforeach
  </div>
</section>





<!-- Newsletter Section -->
<section class="flex justify-center items-center py-16 px-4 sm:px-6 lg:px-8">
  <div class="bg-gradient-to-r from-purple-600 to-indigo-500 text-white rounded-2xl shadow-lg p-8 sm:p-10 max-w-3xl w-full text-center">
    
    <!-- Icon -->
    <div class="flex justify-center mb-4">
      <div class="bg-white/20 p-4 rounded-full">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-white">
          <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0l-7.5-4.615A2.25 2.25 0 013 6.993V6.75"/>
        </svg>
      </div>
    </div>

    <!-- Heading -->
    <h2 class="text-2xl sm:text-3xl font-bold mb-3">Stay Connected to Your Healing Journey</h2>

    <!-- Subtext -->
    <p class="mb-6 text-white/90">Get weekly updates on new events, featured businesses, and healing resources delivered straight to your inbox.</p>

    <!-- Form -->
   <form action="{{ route('subscribe.email') }}" method="post" class="flex flex-col sm:flex-row justify-center gap-3">
      @csrf
      <input type="email" name="email" placeholder="Enter your email address" class="px-5 py-3 rounded-full text-gray-800 w-full sm:w-2/3 focus:outline-none" required>

      <button type="submit" class="px-6 py-3 bg-white text-purple-600 font-semibold rounded-full hover:bg-purple-100 transition flex items-center justify-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
          <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0l-7.5-4.615A2.25 2.25 0 013 6.993V6.75"/>
        </svg>
        Subscribe
      </button>
    </form>
        <!-- Toast Container -->
    <div id="toast" class="fixed top-5 right-5 bg-green-500 text-white px-4 py-2 rounded shadow-lg opacity-0 transition-opacity duration-500">
    </div>

    <p class="mt-4 text-sm text-white/70">No spam, ever. Unsubscribe anytime with one click.</p>
  </div>
</section>

<!-- Healing Journey Section -->
<section class="bg-white-600   py-16 text-white text-center px-4 sm:px-6 lg:px-8">
  <div class="max-w-6xl mx-auto">

    <!-- Heading -->
    <h2 class="text-3xl sm:text-4xl font-bold mb-4 text-purple-600">Ready to Start Your Healing Journey?</h2>
    <p class="text-lg sm:text-xl text-purple-600 mb-12">Join thousands of individuals and practitioners creating a supportive community focused on mental health and healing in Winnipeg</p>

    <!-- Three Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
      
      <!-- Card 1 -->
      <div class="bg-purple-600 p-6 sm:p-8 rounded-2xl shadow-lg flex flex-col items-center text-center">
        <div class="mb-4 flex justify-center">
          <!-- Icon SVG -->
        </div>
        <h3 class="text-xl font-semibold mb-3">For Individuals</h3>
        <p class="mb-5 text-white/80">Find support, connect with professionals, and join healing events</p>
        <a href="{{route('event')}}" class="inline-block bg-white text-purple-700 font-semibold px-6 py-2 rounded-full hover:bg-purple-100 transition">Sign Up for Events</a>
      </div>

      <!-- Card 2 -->
      <div class="bg-purple-600 p-6 sm:p-8 rounded-2xl shadow-lg flex flex-col items-center text-center">
        <div class="mb-4 flex justify-center">
          <!-- Icon SVG -->
        </div>
        <h3 class="text-xl font-semibold mb-3">For Event Seekers</h3>
        <p class="mb-5 text-white/80">Discover workshops, healing circles, and wellness events</p>
        <a href="{{route('event')}}" class="inline-block bg-white text-purple-700 font-semibold px-6 py-2 rounded-full hover:bg-purple-100 transition">Browse Events</a>
      </div>

      <!-- Card 3 -->
      <div class="bg-purple-600 p-6 sm:p-8 rounded-2xl shadow-lg flex flex-col items-center text-center">
        <div class="mb-4 flex justify-center">
          <!-- Icon SVG -->
        </div>
        <h3 class="text-xl font-semibold mb-3">For Businesses</h3>
        <p class="mb-5 text-white/80">Grow your practice, host events, and connect with your community</p>
        <a href="{{route('business')}}" class="inline-block bg-white text-purple-700 font-semibold px-6 py-2 rounded-full hover:bg-purple-100 transition">Register Business</a>
      </div>

    </div>

    <!-- Bottom Buttons -->
    <div class="flex flex-col sm:flex-row justify-center gap-4">
      <a href="{{route('join-community')}}" class="inline-flex items-center justify-center bg-purple-600 text-white-700 font-semibold px-6 py-3 rounded-full shadow hover:bg-purple-100 transition">
        <!-- Icon SVG -->
        Join Community
      </a>
      <!--<a href="#" class="inline-flex items-center justify-center border border-white font-semibold px-6 py-3 rounded-full hover:bg-white hover:text-purple-700 transition">-->
      <!--  Business Membership-->
      <!--</a>-->
    </div>

  </div>
</section>


  
</body>
</html>
@include('front.layout.footer')
<script>
    @if(session('success'))
        const toast = document.getElementById('toast');
        toast.textContent = "{{ session('success') }}";
        toast.classList.remove('opacity-0');
        toast.classList.add('opacity-100');

        // Hide after 3 seconds
        setTimeout(() => {
            toast.classList.remove('opacity-100');
            toast.classList.add('opacity-0');
        }, 5000);
    @endif
</script>
