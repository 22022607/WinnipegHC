@include('front.layout.header')

  <!-- Hero Section -->
  <section class="relative bg-purple-900 text-center text-white">
    <img src="{{ asset($festival_details->image) }}" alt="{{ $festival_details->title }}" class="w-full h-80 object-cover opacity-60">
    <div class="absolute inset-0 flex flex-col justify-center items-center">
      <h2 class="text-4xl font-bold mb-4">{{ $festival_details->title }}</h2>
      @if($festival_details->booked_seats < $festival_details->total_seats)
      <a href="{{ route('festival.buy.tickets') }}" class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-2 rounded-lg font-semibold shadow-md">Register</a>
      @else
      <span class="bg-red-600 text-white px-6 py-2 rounded-lg font-semibold shadow-md">Sold Out</span>
      @endif
    </div>
  </section>

  <!-- Event Info Section -->
  <section class="max-w-5xl mx-auto mt-12 px-6 md:px-0">
    <div class="grid md:grid-cols-3 gap-10">
      <!-- Left Content -->
      <div class="md:col-span-2">
       
      <h3 class="text-xl md:text-2xl mt-3 mb-3 text-gray-800">About the Event:</h3>
        <h3 class="text-3xl font-bold mb-3 mt-3">10th Annual Healing Connections Festival</h3>
        <div class="text-gray-700 leading-relaxed space-y-4">
          {!! nl2br(e($festival_details->description)) !!}
        </div>
      </div>

      <!-- Right Column -->
      <div class="text-center">
        {{-- <img src="{{ asset('festival_images/event-poster.jpg') }}" alt="Festival Poster" class="rounded-lg shadow-lg mb-4 mx-auto"> --}}
        <div class="bg-white p-4 rounded-lg shadow-md text-left">
          <h4 class="font-bold text-lg mb-2">When</h4>
          <p>{{ date('M d, Y', strtotime($festival_details->start_date)) }}<br>{{ date('h:i A', strtotime($festival_details->start_time)) }} - {{ date('h:i A', strtotime($festival_details->end_time)) }}</p>
          {{-- <a href="#" class="block mt-2 text-purple-700 underline">Add To Calendar</a>
          <ul class="mt-3 text-sm text-gray-700 space-y-1">
            <li><a href="#" class="hover:text-purple-600">Google Calendar</a></li>
            <li><a href="#" class="hover:text-purple-600">Outlook</a></li>
          </ul> --}}
          <h4 class="font-bold text-lg mb-2">Booked Seats : {{ $festival_details->booked_seats }} / {{ $festival_details->total_seats }}</h4>
          {{-- <p class="text-xl font-bold text-purple-700"></p> --}}
        </div>
      </div>
    </div>
  </section>

  <!-- Location Section -->
  <section class="max-w-5xl mx-auto mt-16 px-6 md:px-0">
    <h3 class="text-2xl font-bold mb-3">Where We'll Meet</h3>
    <p class="text-purple-700 font-semibold mb-2">{{ $festival_details->address }}</p>

    <div class="grid md:grid-cols-2 gap-6">
      {{-- <img src="{{ asset('festival_images/event-poster.jpg') }}" alt="Festival Poster" class="rounded-lg shadow-lg"> --}}
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2818.743544!2d-97.1909!3d49.8849!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x52ea7158a5b812c7%3A0xa6e25d18c0dcb6cb!2sViscount%20Gort%20Hotel!5e0!3m2!1sen!2sca!4v1669999999999"
        width="100%" height="300" allowfullscreen="" loading="lazy" class="rounded-lg border"></iframe>
    </div>
  </section>

  <!-- Contact Section -->
  <section class="max-w-5xl mx-auto mt-16 px-6 md:px-0">
    <h3 class="text-2xl font-bold mb-4">Event Contact Info</h3>
    <div class="bg-white p-6 rounded-lg shadow-md">
      <p class="mb-2"><strong>Host:</strong> {{ $festival_details->host ?? ''}}</p>
      <p class="mb-2"><strong>Contact:</strong> {{ $festival_details->contact ?? '' }}</p>
      <p class="mb-2"><strong>Email:</strong> <a href="{{ $festival_details->email ?? ''}}" class="text-purple-700 underline">{{ $festival_details->email ?? '' }}</a></p>
      <p class="mb-2"><strong>Facebook:</strong> <a href="{{ $festival_details->facebook ?? ''}}" class="text-purple-700 underline">{{ $festival_details->facebook ?? '' }}</a></p>
    </div>
  </section>
@include('front.layout.footer')
