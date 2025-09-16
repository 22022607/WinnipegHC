@include('front.layout.header')

<div class="max-w-5xl mx-auto px-6 py-10">
     <div class="flex gap-4">
        <a href="{{ route('front.event.manage') }}" class="inline-flex items-center text-sm text-gray-600 hover:text-gray-900 mb-6">
      ← Back to Events
    </a>

      
    </div>
    <!-- Header -->
    <div class="mb-8 text-center">
        <h1 class="text-4xl font-bold text-gray-900">{{ $view_event->title }}</h1>
        <p class="text-lg text-indigo-600 font-medium mt-2">{{ $view_event->category }}</p>
    </div>

  
    <!-- Event Info Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
        <!-- Location -->
        <div class="bg-white border rounded-2xl p-6 shadow-sm">
            <h2 class="text-xl font-semibold flex items-center gap-2 mb-3">
                <span class="text-red-500">📍</span> Location
            </h2>
            <p class="text-gray-800 font-medium">{{ $view_event->location }}</p>
            <p class="text-gray-500">{{ $view_event->venue }}</p>
        </div>

        <!-- Date & Time -->
        <div class="bg-white border rounded-2xl p-6 shadow-sm">
            <h2 class="text-xl font-semibold flex items-center gap-2 mb-3">
                <span class="text-indigo-500">🗓</span> Date & Time
            </h2>
            <p class="text-gray-800 font-medium">
                {{ \Carbon\Carbon::parse($view_event->date)->format('d M Y') }}
            </p>
            <p class="text-gray-600">
                ⏰ {{ \Carbon\Carbon::parse($view_event->start_time)->format('h:i A') }} – 
                   {{ \Carbon\Carbon::parse($view_event->end_time)->format('h:i A') }}
            </p>
        </div>
    </div>

    <!-- Description -->
    <div class="bg-white border rounded-2xl p-6 shadow-sm mb-6">
        <h2 class="text-xl font-semibold flex items-center gap-2 mb-3">
            📝 Description
        </h2>
        <p class="text-gray-700 leading-relaxed">{{ $view_event->description }}</p>
    </div>

    <!-- What to Expect -->
    <div class="bg-white border rounded-2xl p-6 shadow-sm mb-6">
        <h2 class="text-xl font-semibold flex items-center gap-2 mb-3">
            ✨ What to Expect
        </h2>
        <p class="text-gray-700">{{ $view_event->what_to_expect }}</p>
    </div>

    <!-- Prerequisites -->
    <div class="bg-white border rounded-2xl p-6 shadow-sm mb-6">
        <h2 class="text-xl font-semibold flex items-center gap-2 mb-3">
            📌 Prerequisites
        </h2>
        <p class="text-gray-700">{{ $view_event->prerequisites }}</p>
    </div>

    <!-- Attendees & Tickets -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
        <div class="bg-white border rounded-2xl p-6 shadow-sm">
            <h2 class="text-xl font-semibold flex items-center gap-2 mb-3">
                👥 Max Attendees
            </h2>
            <p class="text-gray-700">{{ $view_event->max_attendees }}</p>
        </div>
        <div class="bg-white border rounded-2xl p-6 shadow-sm">
            <h2 class="text-xl font-semibold flex items-center gap-2 mb-3">
                🎟 Ticket Sales
            </h2>
            <p class="text-gray-700">
                {{ \Carbon\Carbon::parse($view_event->ticket_sales_start)->format('d M Y H:i') }}  
                – {{ \Carbon\Carbon::parse($view_event->ticket_sales_end)->format('d M Y H:i') }}
            </p>
        </div>
    </div>

    <!-- Contact -->
    <div class="bg-white border rounded-2xl p-6 shadow-sm mb-10">
        <h2 class="text-xl font-semibold flex items-center gap-2 mb-3">
            📞 Contact
        </h2>
        <p class="text-gray-700">📱 {{ $view_event->contact }}</p>
        <p class="text-gray-700">✉️ {{ $view_event->email }}</p>
    </div>

   
</div>

@include('front.layout.footer')

