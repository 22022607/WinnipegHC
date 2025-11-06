
@include('front.layout.header')

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Event Details</title>
</head>
<body class="min-h-screen bg-gray-50">



  <main class="pt-6">

    <!-- Back Button -->
    <div class="max-w-8xl  px-6 mb-6">
      <a href="{{route('event')}}" class="flex items-center gap-2 text-gray-600 hover:text-black">
        ← Back to Events
      </a>
    </div>

    <!-- Hero Section -->
  <div style="
    padding: 0px 20px 0px 20px;
"> 
  <section class="relative h-96 overflow-hidden">
      <img src="{{ asset(@$event_details->image) }}" 
           alt="Healing Circle Workshop"
           class="w-full h-full object-cover max-w-8xl">
      <div class="absolute inset-0 bg-black/40"></div>
      <div class="absolute bottom-6 left-6 text-white">
    
        <h1 class="text-4xl font-bold mb-2">{{ $event_details->category }}</h1>
        <div class="flex items-center gap-4 flex-wrap text-sm">
          <div class="flex items-center gap-1">📅 {{ date('F j, Y', strtotime($event_details->date)) }}</div>
          <div class="flex items-center gap-1">⏰ {{ $event_details->start_time->format('h:i A') }} - {{ $event_details->end_time->format('h:i A') }}</div>
          <div class="flex items-center gap-1">📍 {{ $event_details->venue}}</div>
        </div>
      </div>
    </section>
    </div>

    <div class="max-w-8xl mx-auto px-6 py-8">
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-8">
          
          <!-- About -->
          <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-2xl font-bold mb-4">About This Event</h2>
            <p class="text-gray-600 mb-4">{{ $event_details->title }}</p>
            <p class="text-gray-600">{{ $event_details->description }}</p>
          </div>

          <!-- Facilitator -->
          <!--<div class="bg-white p-6 rounded-lg shadow">-->
          <!--  <h2 class="text-2xl font-bold mb-4">Meet Your Facilitator</h2>-->
          <!--  <div class="flex items-start gap-4">-->
          <!--    {{-- <img src="https://images.unsplash.com/photo-1494790108755-2616b612b412?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80" -->
          <!--         alt="Facilitator"-->
          <!--         class="w-16 h-16 rounded-full object-cover"> --}}-->
          <!--    <div>-->
          <!--      <h3 class="font-bold text-lg">{{ $event_details->host }}</h3>-->
          <!--      {{-- <p class="text-indigo-600 font-medium">Energy Healing Practitioner & Spiritual Guide</p>-->
          <!--      <p class="text-sm text-gray-500 mb-2">15+ years experience</p>-->
          <!--      <p class="text-gray-600">Dr. Santos is a renowned energy healer who has facilitated healing circles around the world.</p> --}}-->
          <!--    </div>-->
          <!--  </div>-->
          <!--</div>-->

          <!-- Agenda -->
          <!--<div class="bg-white p-6 rounded-lg shadow">-->
          <!--  <h2 class="text-2xl font-bold mb-4">Event Agenda</h2>-->
          <!--  <div class="space-y-4">-->
          <!--    <div class="flex gap-4 p-4 bg-gray-100 rounded-lg">-->
          <!--      <div class="w-20 font-semibold text-indigo-600">6:00 PM</div>-->
          <!--      <div>Welcome & Opening Circle</div>-->
          <!--    </div>-->
          <!--    <div class="flex gap-4 p-4 bg-gray-100 rounded-lg">-->
          <!--      <div class="w-20 font-semibold text-indigo-600">6:15 PM</div>-->
          <!--      <div>Grounding Meditation</div>-->
          <!--    </div>-->
          <!--    <div class="flex gap-4 p-4 bg-gray-100 rounded-lg">-->
          <!--      <div class="w-20 font-semibold text-indigo-600">6:45 PM</div>-->
          <!--      <div>Energy Clearing Techniques</div>-->
          <!--    </div>-->
          <!--  </div>-->
          <!--</div>-->

         

          <!-- Related Events -->
          <!--<div class="bg-white p-6 rounded-lg shadow">-->
          <!--  <h2 class="text-2xl font-bold mb-4">Related Events</h2>-->
          <!--  <div class="grid grid-cols-1 md:grid-cols-2 gap-4">-->
          <!--    <div class="flex gap-4 p-4 border rounded-lg hover:bg-gray-50">-->
          <!--      <img src="https://images.unsplash.com/photo-1518495973542-4542c06a5843?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80" -->
          <!--           alt="Mindfulness Meditation"-->
          <!--           class="w-16 h-16 rounded-lg object-cover">-->
          <!--      <div>-->
          <!--        <h4 class="font-semibold">Mindfulness Meditation</h4>-->
          <!--        <p class="text-sm text-gray-500">March 22, 2024</p>-->
          <!--        <p class="text-indigo-600 font-medium">$20</p>-->
          <!--      </div>-->
          <!--    </div>-->
          <!--    <div class="flex gap-4 p-4 border rounded-lg hover:bg-gray-50">-->
          <!--      <img src="https://images.unsplash.com/photo-1470071459604-3b5ec3a7fe05?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80" -->
          <!--           alt="Crystal Therapy"-->
          <!--           class="w-16 h-16 rounded-lg object-cover">-->
          <!--      <div>-->
          <!--        <h4 class="font-semibold">Crystal Therapy Session</h4>-->
          <!--        <p class="text-sm text-gray-500">March 25, 2024</p>-->
          <!--        <p class="text-indigo-600 font-medium">$45</p>-->
          <!--      </div>-->
          <!--    </div>-->
          <!--  </div>-->
          <!--</div>-->
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
          
          <!-- Booking Card -->
          <div class="bg-white p-6 rounded-lg shadow">
              <div class="font-bold text-lg">Register Here For Event</div>
            <!--<div class="text-center mb-4">-->
            <!--  <div class="text-3xl font-bold text-bold-600">$35</div>-->
            <!--  <p class="text-sm text-gray-500">per person</p>-->
            <!--</div>-->
            <!--<div class="space-y-3 mb-6">-->
            <!--  <div class="flex justify-between text-sm">-->
            <!--    <span>Available Spots</span>-->
            <!--    <span>5 of 30</span>-->
            <!--  </div>-->
            <!--  <div class="w-full bg-gray-800 rounded-full h-2">-->
            <!--    <div class="bg-bold-800 h-2 rounded-full" style="width:75%"></div>-->
            <!--  </div>-->
            <!--</div>-->
            <a href="{{ route('event.getticket', $event_details->id) }}" 
              class="block text-center w-full bg-gray-800 hover:bg-gray-900 text-white py-2 rounded-lg mt-5">
              🎟 Register Now
            </a>
            <!--<div class="flex gap-2 mt-3">-->
            <!--  <button class="flex-1 border py-2 rounded-lg">♡ Save</button>-->
            <!--  <button class="flex-1 border py-2 rounded-lg">↗ Share</button>-->
            <!--</div>-->
          </div>

          <!-- Event Details -->
          <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="font-bold text-lg mb-4">Event Details</h3>
            <p class="text-sm mt-2">📅 {{ date('F j, Y', strtotime($event_details->date)) }} — {{ $event_details->start_time->format('h:i A') }} - {{ $event_details->end_time->format('h:i A') }}</p>
            <p class="text-sm mt-2">📍 {{ $event_details->venue }}</p>
            
            <p class="text-sm mt-2">💲 Price: ${{ $event_details->admission_fee }}</p>
          </div>

          <!-- Organizer -->
          <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="font-bold text-lg mb-4">Event Organizer</h3>
            <p class="font-medium mb-2">{{$event_details->host ?? '' }} 
            </p>
            <p class="text-sm text-gray-600 mb-2">Phone: {{ $event_details->contact}}</p>
            <p class="text-sm text-gray-600">Email: {{ $event_details->email}}</p>
            <!--<button class="w-full mt-3 border py-2 rounded-lg">Contact Organizer</button>-->
          </div>
        </div>
      </div>
    </div>
  </main>





</body>
</html>
@include('front.layout.footer')
<script>
  function updateTotal() {
    const count = document.getElementById('ticketCount').value || 1;
    const pricePerTicket = 35; // Dynamic from DB
    document.getElementById('totalAmount').textContent = count * pricePerTicket;
  }
</script>