@include('front.layout.header')

<div class="flex flex-col min-h-screen  bg-purple-50 ">

  <!-- Page Header -->
  <section class=" text-center py-12 px-4">
    <h1 class="text-3xl sm:text-4xl font-bold text-gray-800">Healing Events</h1>
    <p class="mt-2 text-gray-600 text-sm sm:text-base max-w-2xl mx-auto">
      Discover transformative workshops, meditation sessions, and healing experiences in Winnipeg
    </p>
  </section>

  
  <!-- Events Grid -->
  <main class="container mx-auto px-4 pb-12 max-w-6xl grid gap-8 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
    @foreach ($events as $event)
      @php
        $attendees_count = App\Models\Order::where('event_id', $event->id)->count();
      @endphp

      <div class="bg-white border rounded-xl shadow hover:shadow-lg transition overflow-hidden flex flex-col">
        
        <!-- Image Section -->
        <div class="relative">
          <img src="{{ asset($event->image ?? 'placeholder.jpg') }}" 
              alt="{{ $event->title }}" 
              class="w-full h-48 sm:h-40 object-cover">

          <!-- Category Badge -->
          <!--@if($event->category)-->
          <!--<span class="absolute top-3 left-3 bg-gray-800 text-white text-xs font-medium px-3 py-1 rounded-full">-->
          <!--  {{ @$event->category}}-->
          <!--</span>-->
          <!--@else-->
          <!--''-->
          <!--@endif-->

          <!-- Price Badge -->
          <!--<span class="absolute top-3 right-3 bg-white text-gray-900 text-xs font-bold px-3 py-1 rounded-full shadow">-->
          <!--  ${{ $event->admission_fee ?? '0' }}-->
          <!--</span>-->
        </div>

        <!-- Card Body -->
        <div class="p-5 flex flex-col flex-1">
        <a href="{{ url('event/'.$event->id) }}" class="hover:underline">
            <h3 class="text-lg font-bold text-gray-900">{{ $event->title }}</h3>
        </a>
          <p class="text-gray-600 text-sm mt-1">{{ Str::limit($event->description, 60) }}</p>

          <!-- Details -->
          <div class="mt-4 space-y-2 text-sm text-gray-600">
            <div class="flex items-center gap-2">
              <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
              </svg>
              <span>{{ date('F j, Y', strtotime($event->date)) }}</span>
            </div>

            <div class="flex items-center gap-2">
              <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 11c.5304 0 1.0391-.2107 1.4142-.5858C13.7893 10.0391 14 9.5304 14 9s-.2107-1.0391-.5858-1.4142C13.0391 7.2107 12.5304 7 12 7s-1.0391.2107-1.4142.5858C10.2107 7.9609 10 8.4696 10 9s.2107 1.0391.5858 1.4142C10.9609 10.7893 11.4696 11 12 11zm0 0c-2.2091 0-4 1.7909-4 4v1h8v-1c0-2.2091-1.7909-4-4-4z"/>
              </svg>
              <span>{{ $event->venue ?? '' }}, {{ $event->location ?? '' }}</span>
            </div>

            <!--<div class="flex items-center gap-2">-->
            <!--  <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">-->
            <!--    <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a8 8 0 00-16 0v2h5m0-2v2m6-2v2"/>-->
            <!--  </svg>-->
            <!--  <span>{{ $attendees_count }} attending</span>-->
            <!--</div>-->
          </div>

          <!-- Button -->
          <a href="{{ url('event/'.$event->id) }}" 
            class="mt-5 flex items-center justify-center gap-2 bg-purple-600 text-white text-sm font-medium px-4 py-2 rounded-full hover:bg-purple-600 transition">
            Get Tickets
          </a>
        </div>
      </div>
    @endforeach
</main>


</div>

@include('front.layout.footer')
