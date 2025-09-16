@include('front.layout.header')
<!DOCTYPE html>
<html lang="en">

<body class="flex flex-col min-h-screen bg-white">


  <!-- Page Header -->
  <section class="bg-gradient-to-r from-purple-50 to-white text-center py-12">
    <h1 class="text-3xl font-bold text-gray-800">Healing Events</h1>
    <p class="mt-2 text-gray-600">Discover transformative workshops, meditation sessions, and healing experiences in Winnipeg</p>
  </section>

  <!-- Filters -->
  <div class="container mx-auto px-6 py-6 flex flex-col md:flex-row gap-4 justify-center">
    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search events..." class="flex-1 border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500">
    <select class="border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500">
      <option>All Categories</option>
      @foreach ($events as $event)
          <option value="{{ $event->id }}">{{ $event->category }}</option>
      @endforeach
    </select>
    <select class="border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500">
      <option>All Locations</option>
      <option>Downtown</option>
      <option>West End</option>
      <option>Online</option>
    </select>
  </div>

  <!-- Events Grid -->
  <main class="container mx-auto px-6 pb-12 grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
    @foreach ($events as $event)
        @php
            $attendees_count=App\Models\Order::where('event_id',$event->id)->count();
        @endphp
    <!-- Event Card -->
    <div class="border rounded-xl overflow-hidden shadow hover:shadow-lg transition">
        <div class="max-w-sm bg-white border rounded-2xl shadow hover:shadow-lg transition overflow-hidden">
        <!-- Image Section -->
        <div class="relative">
          <img src="{{ asset(@$event->image) }}" 
              alt="Healing Circle Workshop" 
              class="w-full h-40 object-cover rounded-t-2xl">

          <!-- Category Badge -->
          <span class="absolute top-3 left-3 bg-gray-800 text-white text-xs font-medium px-3 py-1 rounded-full">
            Workshop
          </span>

          <!-- Price Badge -->
          <span class="absolute top-3 right-3 bg-white text-gray-900 text-xs font-bold px-3 py-1 rounded-full shadow">
            $ {{ @$event->admission_fee }}
          </span>
        </div>

            <!-- Card Body -->
          <div class="p-5">
            <h3 class="text-lg font-bold text-gray-900">{{ $event->title }}</h3>
            <p class="text-gray-600 text-sm mt-1">{{ Str::limit($event->description, 50) }}</p>

            <!-- Details -->
            <div class="mt-4 space-y-2 text-sm text-gray-600">
              <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" 
                    viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" 
                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 
                    00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                  <span>{{ date('F j, Y', strtotime($event->date)) }}</span>
              </div>
              <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" 
                    viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" 
                    d="M12 11c.5304 0 1.0391-.2107 1.4142-.5858C13.7893 
                    10.0391 14 9.5304 14 9s-.2107-1.0391-.5858-1.4142C13.0391 
                    7.2107 12.5304 7 12 7s-1.0391.2107-1.4142.5858C10.2107 
                    7.9609 10 8.4696 10 9s.2107 1.0391.5858 1.4142C10.9609 
                    10.7893 11.4696 11 12 11zm0 0c-2.2091 0-4 1.7909-4 
                    4v1h8v-1c0-2.2091-1.7909-4-4-4z"/></svg>
                <span>{{ $event->venue }} , {{ $event->location }}</span>
              </div>
              <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" 
                    viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" 
                    d="M17 20h5v-2a8 8 0 00-16 0v2h5m0-2v2m6-2v2"/></svg>
                <span>{{ $attendees_count }} attending</span>
              </div>
            </div>

            <!-- Button -->
            <a href="{{ url('front/event/event-details/'.$event->id) }}" 
              class="mt-5 flex items-center justify-center gap-2 bg-gray-900 text-white text-sm font-medium px-4 py-2 rounded-full hover:bg-gray-800 transition">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" 
                  viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" 
                  d="M9 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m-9 4h14a2 2 0 
                  002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 
                  002 2z"/></svg>
              Get Tickets
            </a>
          </div>
        </div>
    </div>
    @endforeach

   
    {{-- <div class="border rounded-xl overflow-hidden shadow hover:shadow-lg transition">
        <div class="max-w-sm bg-white border rounded-2xl shadow hover:shadow-lg transition overflow-hidden">
        <!-- Image Section -->
        <div class="relative">
          <img src="{{ asset('events/mindfullness.jpg') }}" 
              alt="Healing Circle Workshop" 
              class="w-full h-40 object-cover rounded-t-2xl">

          <!-- Category Badge -->
          <span class="absolute top-3 left-3 bg-gray-800 text-white text-xs font-medium px-3 py-1 rounded-full">
            Workshop
          </span>

          <!-- Price Badge -->
          <span class="absolute top-3 right-3 bg-white text-gray-900 text-xs font-bold px-3 py-1 rounded-full shadow">
            $25
          </span>
        </div>

            <!-- Card Body -->
        <div class="p-5">
          <h3 class="text-lg font-bold text-gray-900">Mindfulness Meditation</h3>
          <p class="text-gray-600 text-sm mt-1">Join us for a transformative healing circle experience.</p>

          <!-- Details -->
          <div class="mt-4 space-y-2 text-sm text-gray-600">
            <div class="flex items-center gap-2">
              <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" 
                  viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" 
                  d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 
                  00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
              <span>March 18, 2024</span>
            </div>
            <div class="flex items-center gap-2">
              <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" 
                  viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" 
                  d="M12 11c.5304 0 1.0391-.2107 1.4142-.5858C13.7893 
                  10.0391 14 9.5304 14 9s-.2107-1.0391-.5858-1.4142C13.0391 
                  7.2107 12.5304 7 12 7s-1.0391.2107-1.4142.5858C10.2107 
                  7.9609 10 8.4696 10 9s.2107 1.0391.5858 1.4142C10.9609 
                  10.7893 11.4696 11 12 11zm0 0c-2.2091 0-4 1.7909-4 
                  4v1h8v-1c0-2.2091-1.7909-4-4-4z"/></svg>
              <span>Community Center, Winnipeg</span>
            </div>
            <div class="flex items-center gap-2">
              <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" 
                  viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" 
                  d="M17 20h5v-2a8 8 0 00-16 0v2h5m0-2v2m6-2v2"/></svg>
              <span>25 attending</span>
            </div>
          </div>

          <!-- Button -->
          <a href="{{ route('front.event.event-details') }}" 
            class="mt-5 flex items-center justify-center gap-2 bg-gray-900 text-white text-sm font-medium px-4 py-2 rounded-full hover:bg-gray-800 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" 
                viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" 
                d="M9 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m-9 4h14a2 2 0 
                002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 
                002 2z"/></svg>
            Get Tickets
          </a>
        </div>
        </div>
    </div>
    <div class="border rounded-xl overflow-hidden shadow hover:shadow-lg transition">
        <div class="max-w-sm bg-white border rounded-2xl shadow hover:shadow-lg transition overflow-hidden">
        <!-- Image Section -->
        <div class="relative">
          <img src="{{ asset('events/crystal.therapy.jpg') }}" 
              alt="Healing Circle Workshop" 
              class="w-full h-40 object-cover rounded-t-2xl">

          <!-- Category Badge -->
          <span class="absolute top-3 left-3 bg-gray-800 text-white text-xs font-medium px-3 py-1 rounded-full">
            Workshop
          </span>

          <!-- Price Badge -->
          <span class="absolute top-3 right-3 bg-white text-gray-900 text-xs font-bold px-3 py-1 rounded-full shadow">
            $25
          </span>
        </div>

            <!-- Card Body -->
        <div class="p-5">
          <h3 class="text-lg font-bold text-gray-900">Crystal Therapy Session</h3>
          <p class="text-gray-600 text-sm mt-1">Join us for a transformative healing circle experience.</p>

          <!-- Details -->
          <div class="mt-4 space-y-2 text-sm text-gray-600">
            <div class="flex items-center gap-2">
              <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" 
                  viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" 
                  d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 
                  00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
              <span>March 18, 2024</span>
            </div>
            <div class="flex items-center gap-2">
              <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" 
                  viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" 
                  d="M12 11c.5304 0 1.0391-.2107 1.4142-.5858C13.7893 
                  10.0391 14 9.5304 14 9s-.2107-1.0391-.5858-1.4142C13.0391 
                  7.2107 12.5304 7 12 7s-1.0391.2107-1.4142.5858C10.2107 
                  7.9609 10 8.4696 10 9s.2107 1.0391.5858 1.4142C10.9609 
                  10.7893 11.4696 11 12 11zm0 0c-2.2091 0-4 1.7909-4 
                  4v1h8v-1c0-2.2091-1.7909-4-4-4z"/></svg>
              <span>Community Center, Winnipeg</span>
            </div>
            <div class="flex items-center gap-2">
              <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" 
                  viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" 
                  d="M17 20h5v-2a8 8 0 00-16 0v2h5m0-2v2m6-2v2"/></svg>
              <span>25 attending</span>
            </div>
          </div>

          <!-- Button -->
          <a href="{{ route('front.event.event-details') }}" 
            class="mt-5 flex items-center justify-center gap-2 bg-gray-900 text-white text-sm font-medium px-4 py-2 rounded-full hover:bg-gray-800 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" 
                viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" 
                d="M9 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m-9 4h14a2 2 0 
                002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 
                002 2z"/></svg>
            Get Tickets
          </a>
        </div>
        </div>
    </div>
    <div class="border rounded-xl overflow-hidden shadow hover:shadow-lg transition">
        <div class="max-w-sm bg-white border rounded-2xl shadow hover:shadow-lg transition overflow-hidden">
        <!-- Image Section -->
        <div class="relative">
          <img src="{{ asset('events/reiki.level.jpg') }}" 
              alt="Healing Circle Workshop" 
              class="w-full h-40 object-cover rounded-t-2xl">

          <!-- Category Badge -->
          <span class="absolute top-3 left-3 bg-gray-800 text-white text-xs font-medium px-3 py-1 rounded-full">
            Workshop
          </span>

          <!-- Price Badge -->
          <span class="absolute top-3 right-3 bg-white text-gray-900 text-xs font-bold px-3 py-1 rounded-full shadow">
            $25
          </span>
        </div>

            <!-- Card Body -->
        <div class="p-5">
          <h3 class="text-lg font-bold text-gray-900">Reiki Level 1 Training</h3>
          <p class="text-gray-600 text-sm mt-1">Join us for a transformative healing circle experience.</p>

          <!-- Details -->
          <div class="mt-4 space-y-2 text-sm text-gray-600">
            <div class="flex items-center gap-2">
              <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" 
                  viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" 
                  d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 
                  00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
              <span>March 18, 2024</span>
            </div>
            <div class="flex items-center gap-2">
              <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" 
                  viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" 
                  d="M12 11c.5304 0 1.0391-.2107 1.4142-.5858C13.7893 
                  10.0391 14 9.5304 14 9s-.2107-1.0391-.5858-1.4142C13.0391 
                  7.2107 12.5304 7 12 7s-1.0391.2107-1.4142.5858C10.2107 
                  7.9609 10 8.4696 10 9s.2107 1.0391.5858 1.4142C10.9609 
                  10.7893 11.4696 11 12 11zm0 0c-2.2091 0-4 1.7909-4 
                  4v1h8v-1c0-2.2091-1.7909-4-4-4z"/></svg>
              <span>Community Center, Winnipeg</span>
            </div>
            <div class="flex items-center gap-2">
              <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" 
                  viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" 
                  d="M17 20h5v-2a8 8 0 00-16 0v2h5m0-2v2m6-2v2"/></svg>
              <span>25 attending</span>
            </div>
          </div>

          <!-- Button -->
          <a href="{{ route('front.event.event-details') }}" 
            class="mt-5 flex items-center justify-center gap-2 bg-gray-900 text-white text-sm font-medium px-4 py-2 rounded-full hover:bg-gray-800 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" 
                viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" 
                d="M9 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m-9 4h14a2 2 0 
                002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 
                002 2z"/></svg>
            Get Tickets
          </a>
        </div>
        </div>
    </div>
    <div class="border rounded-xl overflow-hidden shadow hover:shadow-lg transition">
        <div class="max-w-sm bg-white border rounded-2xl shadow hover:shadow-lg transition overflow-hidden">
        <!-- Image Section -->
        <div class="relative">
          <img src="{{ asset('events/sound.bath.jpg') }}" 
              alt="Healing Circle Workshop" 
              class="w-full h-40 object-cover rounded-t-2xl">

          <!-- Category Badge -->
          <span class="absolute top-3 left-3 bg-gray-800 text-white text-xs font-medium px-3 py-1 rounded-full">
            Workshop
          </span>

          <!-- Price Badge -->
          <span class="absolute top-3 right-3 bg-white text-gray-900 text-xs font-bold px-3 py-1 rounded-full shadow">
            $25
          </span>
        </div>

            <!-- Card Body -->
        <div class="p-5">
          <h3 class="text-lg font-bold text-gray-900">Sound Bath Meditation</h3>
          <p class="text-gray-600 text-sm mt-1">Join us for a transformative healing circle experience.</p>

          <!-- Details -->
          <div class="mt-4 space-y-2 text-sm text-gray-600">
            <div class="flex items-center gap-2">
              <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" 
                  viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" 
                  d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 
                  00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
              <span>March 18, 2024</span>
            </div>
            <div class="flex items-center gap-2">
              <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" 
                  viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" 
                  d="M12 11c.5304 0 1.0391-.2107 1.4142-.5858C13.7893 
                  10.0391 14 9.5304 14 9s-.2107-1.0391-.5858-1.4142C13.0391 
                  7.2107 12.5304 7 12 7s-1.0391.2107-1.4142.5858C10.2107 
                  7.9609 10 8.4696 10 9s.2107 1.0391.5858 1.4142C10.9609 
                  10.7893 11.4696 11 12 11zm0 0c-2.2091 0-4 1.7909-4 
                  4v1h8v-1c0-2.2091-1.7909-4-4-4z"/></svg>
              <span>Community Center, Winnipeg</span>
            </div>
            <div class="flex items-center gap-2">
              <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" 
                  viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" 
                  d="M17 20h5v-2a8 8 0 00-16 0v2h5m0-2v2m6-2v2"/></svg>
              <span>25 attending</span>
            </div>
          </div>

          <!-- Button -->
          <a href="{{ route('front.event.event-details') }}" 
            class="mt-5 flex items-center justify-center gap-2 bg-gray-900 text-white text-sm font-medium px-4 py-2 rounded-full hover:bg-gray-800 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" 
                viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" 
                d="M9 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m-9 4h14a2 2 0 
                002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 
                002 2z"/></svg>
            Get Tickets
          </a>
        </div>
        </div>
    </div>
    <div class="border rounded-xl overflow-hidden shadow hover:shadow-lg transition">
        <div class="max-w-sm bg-white border rounded-2xl shadow hover:shadow-lg transition overflow-hidden">
        <!-- Image Section -->
        <div class="relative">
          <img src="{{ asset('events/healing.jpg') }}" 
              alt="Healing Circle Workshop" 
              class="w-full h-40 object-cover rounded-t-2xl">

          <!-- Category Badge -->
          <span class="absolute top-3 left-3 bg-gray-800 text-white text-xs font-medium px-3 py-1 rounded-full">
            Workshop
          </span>

          <!-- Price Badge -->
          <span class="absolute top-3 right-3 bg-white text-gray-900 text-xs font-bold px-3 py-1 rounded-full shadow">
            $25
          </span>
        </div>

            <!-- Card Body -->
        <div class="p-5">
          <h3 class="text-lg font-bold text-gray-900">Yoga & Wellness Retreat</h3>
          <p class="text-gray-600 text-sm mt-1">Join us for a transformative healing circle experience.</p>

          <!-- Details -->
          <div class="mt-4 space-y-2 text-sm text-gray-600">
            <div class="flex items-center gap-2">
              <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" 
                  viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" 
                  d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 
                  00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
              <span>March 18, 2024</span>
            </div>
            <div class="flex items-center gap-2">
              <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" 
                  viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" 
                  d="M12 11c.5304 0 1.0391-.2107 1.4142-.5858C13.7893 
                  10.0391 14 9.5304 14 9s-.2107-1.0391-.5858-1.4142C13.0391 
                  7.2107 12.5304 7 12 7s-1.0391.2107-1.4142.5858C10.2107 
                  7.9609 10 8.4696 10 9s.2107 1.0391.5858 1.4142C10.9609 
                  10.7893 11.4696 11 12 11zm0 0c-2.2091 0-4 1.7909-4 
                  4v1h8v-1c0-2.2091-1.7909-4-4-4z"/></svg>
              <span>Community Center, Winnipeg</span>
            </div>
            <div class="flex items-center gap-2">
              <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" 
                  viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" 
                  d="M17 20h5v-2a8 8 0 00-16 0v2h5m0-2v2m6-2v2"/></svg>
              <span>25 attending</span>
            </div>
          </div>

          <!-- Button -->
          <a href="{{ route('front.event.event-details') }}" 
            class="mt-5 flex items-center justify-center gap-2 bg-gray-900 text-white text-sm font-medium px-4 py-2 rounded-full hover:bg-gray-800 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" 
                viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" 
                d="M9 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m-9 4h14a2 2 0 
                002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 
                002 2z"/></svg>
            Get Tickets
          </a>
        </div>
        </div>
    </div> --}}

      

  </main>



</body>
</html>
@include('front.layout.footer')
