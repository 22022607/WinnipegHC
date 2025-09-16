 @include('front.layout.header')
  <style>
    .tab-content { display: none; }
    .tab-content.active { display: block; }
  </style>
<div class="min-h-screen bg-gray-50">


  <main class="max-w-4xl mx-auto px-6 py-8">
    <!-- Back Button -->
    <a href="{{ route('front.memberdashboard') }}" class="inline-flex items-center text-sm text-gray-600 hover:text-gray-900 mb-6">
      ← Back to Events
    </a>

    <!-- Page Title -->
    <div class="mb-8">
      <h1 class="text-3xl font-bold mb-2">Edit Event</h1>
      <p class="text-gray-500">Set up your event or workshop with ticketing options</p>
    </div>

    <!-- Tabs -->
    <div>
      <div class="grid grid-cols-4 border-b mb-6 text-center">
        <button data-tab="basic" class="tab-btn py-2 font-medium border-b-2 border-blue-500 text-blue-600">Basic Info</button>
        <button data-tab="tickets" class="tab-btn py-2 font-medium text-gray-600 hover:text-gray-900">Tickets</button>
        <button data-tab="settings" class="tab-btn py-2 font-medium text-gray-600 hover:text-gray-900">Settings</button>
        <button data-tab="preview" class="tab-btn py-2 font-medium text-gray-600 hover:text-gray-900">Preview</button>
      </div>

      <!-- Basic Info -->
      <div id="basic" class="tab-content active space-y-6">
        <div class="bg-white shadow rounded-lg p-6">
        <form action="{{ route('front.event.update',$event->id) }}" method="post">
            @csrf
          <h2 class="text-lg font-semibold mb-1">Event Details</h2>
          <p class="text-sm text-gray-500 mb-4">Basic information about your event</p>

          <!-- Event Title -->
          <div class="mb-4">
            <label class="block mb-1 text-sm font-medium">Event Title</label>
            <input type="text" name="title" value="{{ old('title', $event->title ?? '') }}" class="w-full border rounded-lg p-2" placeholder="e.g., Meditation Workshop" />
          </div>

          <!-- Event Description -->
          <div class="mb-4">
            <label class="block mb-1 text-sm font-medium">Description</label>
            <textarea class="w-full border rounded-lg p-2"  name="description" rows="4" placeholder="Describe your event...">{{ old('description', $event->description ?? '') }}</textarea>
          </div>

          <!-- Category & Duration -->
          <div class="grid md:grid-cols-2 gap-4 mb-4">
            <div>
              <label class="block mb-1 text-sm font-medium">Category</label>
              <input type="text" name="category" value="{{ old('category', $event->category ?? '') }}" class="w-full border rounded-lg p-2" placeholder="Workshop, Certification" />
            </div>
            <div>
              <label class="block mb-1 text-sm font-medium">Duration</label>
              <input type="text" name="duration" value="{{ old('duration', $event->duration ?? '') }}" class="w-full border rounded-lg p-2" placeholder="2 hours, 1 day" />
            </div>
          </div>

          <hr class="my-4" />

          <!-- Date & Time -->
          <h3 class="text-lg font-semibold mb-2">Date & Time</h3>
          <div class="grid md:grid-cols-3 gap-4 mb-4">
            <div>
              <label class="block mb-1 text-sm font-medium">Date</label>
              <input type="date" name="date" value="{{ old('date', isset($event) ? $event->date->format('Y-m-d') : '') }}" class="w-full border rounded-lg p-2" />
            </div>
            <div>
              <label class="block mb-1 text-sm font-medium">Start Time</label>
              <input type="time" name="start_time" value="{{ old('start_time', isset($event) ? $event->start_time->format('H:i') : '') }}" class="w-full border rounded-lg p-2" />
            </div>
            <div>
              <label class="block mb-1 text-sm font-medium">End Time</label>
              <input type="time" name="end_time" value="{{ old('end_time', isset($event) ? $event->end_time->format('H:i') : '') }}" class="w-full border rounded-lg p-2" />
            </div>
          </div>

          <hr class="my-4" />

          <!-- Location -->
          <h3 class="text-lg font-semibold mb-2">Location</h3>
          <div class="mb-4">
            <label class="block mb-1 text-sm font-medium">Venue/Location</label>
            <input type="text" name="location" value="{{ old('location', $event->location ?? '') }}" class="w-full border rounded-lg p-2" placeholder="Studio A, Main Hall, Zoom" />
          </div>
          <div>
            <label class="block mb-1 text-sm font-medium">Full Address</label>
            <textarea name="address"  class="w-full border rounded-lg p-2" rows="2" placeholder="123 Wellness Street, City, ZIP">{{ old('venue', $event->venue ?? '') }}</textarea>
          </div>
           
        </div>
      </div>

      <!-- Tickets -->
<div id="tickets" class="tab-content space-y-6">
        <div class="bg-white shadow rounded-lg p-6">
        <h2 class="text-lg font-semibold mb-1">Ticketing Options</h2>
        <p class="text-sm text-gray-500 mb-4">Configure how attendees can register and pay</p>

        <!-- Ticketing Option Selector -->
        <div class="grid md:grid-cols-2 gap-4">
        <label class="border rounded-lg p-4 cursor-pointer flex items-start space-x-2">
            <input type="radio" name="ticket_type" value="internal" class="mt-1" checked
                onclick="toggleTicketing('internal')" />
            <div>
            <h3 class="font-medium">Internal Ticketing</h3>
            <p class="text-sm text-gray-500">Sell tickets directly through our platform. We'll handle payments and registrations.</p>
            </div>
        </label>

        <label class="border rounded-lg p-4 cursor-pointer flex items-start space-x-2">
            <input type="radio" name="ticket_type" value="external" class="mt-1"
                onclick="toggleTicketing('external')" />
            <div>
            <h3 class="font-medium">External Ticketing</h3>
            <p class="text-sm text-gray-500">Link to Eventbrite, Facebook Events, or your own system.</p>
            </div>
        </label>
        </div>

        <!-- Internal Ticket Configuration -->
        <div id="internal-fields" class="mt-6 space-y-4">
        <h3 class="font-semibold text-gray-700">Internal Ticket Configuration</h3>
        <label class="block text-sm font-medium">Ticket Price</label>
        <input type="number" name="ticket_price" value="{{ $event->tickets->price }}" class="w-full border rounded-lg p-2" placeholder="0.00" />

        <label class="block text-sm font-medium">Max Attendees</label>
        <input type="number" name="max_attendees" value="{{ @$event->tickets->attendees }}" class="w-full border rounded-lg p-2" placeholder="20" />

        <label class="block text-sm font-medium">Early Bird Price (Optional)</label>
        <input type="number" name="early_price" value="{{ @$event->tickets->early_bird_price }}" class="w-full border rounded-lg p-2" placeholder="0.00" />

        <label class="block text-sm font-medium">Ticket Sales Start</label>
        <input type="datetime-local" 
        value="{{ $event->tickets && $event->tickets->ticket_sale_start ? $event->tickets->ticket_sale_start->format('Y-m-d\TH:i') : '' }}" 
        name="sales_start" 
        class="w-full border rounded-lg p-2" />

        <label class="block text-sm font-medium">Ticket Sales End</label>
        <input type="datetime-local" 
        value="{{ $event->tickets && $event->tickets->ticket_sale_end ? $event->tickets->ticket_sale_end->format('Y-m-d\TH:i') : '' }}" 
        name="sales_end" 
        class="w-full border rounded-lg p-2" />

        <div class="flex items-center space-x-2">
            <input type="checkbox" name="manual_approval" class="h-4 w-4" />
            <span class="text-sm text-gray-600">Require Manual Approval</span>
        </div>
        </div>

        <!-- External Ticket Configuration -->
        <div id="external-fields" class="mt-6 space-y-4 hidden">
        <h3 class="font-semibold text-gray-700">External Ticket Link</h3>
        <label class="block text-sm font-medium">Ticket/Registration URL</label>
        <input type="url" name="ticket_url" class="w-full border rounded-lg p-2" placeholder="https://eventbrite.com/your-event" />

        <label class="block text-sm font-medium">Platform Name</label>
        <input type="text" name="platform_name" class="w-full border rounded-lg p-2" placeholder="Eventbrite, Facebook Events, etc." />
        </div>
  </div>
</div>




      <!-- Settings -->
      <div id="settings" class="tab-content space-y-6">
        <div class="bg-white shadow rounded-lg p-6">
          <h2 class="text-lg font-semibold mb-1">Event Settings</h2>
          <p class="text-sm text-gray-500 mb-4">Additional configuration</p>

          <!-- Prerequisites -->
          <label class="block mb-1 text-sm font-medium">Prerequisites</label>
          <textarea class="w-full border rounded-lg p-2 mb-4"  name="prerequisites" rows="3" placeholder="Any requirements?">{{ old('venue', $event->prerequisites ?? '') }}</textarea>

          <!-- What to Expect -->
          <label class="block mb-1 text-sm font-medium">What to Expect</label>
          <textarea class="w-full border rounded-lg p-2 mb-4"  name="what_to_expect" rows="3" placeholder="Describe attendee experience">{{ old('venue', $event->what_to_expect ?? '') }}</textarea>

          <hr class="my-4" />

          <!-- Contact Info -->
          <h3 class="text-lg font-semibold mb-2">Contact & Support</h3>
          <div class="grid md:grid-cols-2 gap-4">
            <div>
              <label class="block mb-1 text-sm font-medium">Contact Email</label>
              <input type="email" name="email" value="{{ old('venue', $event->email ?? '') }}" class="w-full border rounded-lg p-2" placeholder="event@yourbusiness.com" />
            </div>
            <div>
              <label class="block mb-1 text-sm font-medium">Contact Phone</label>
              <input type="tel" name="phone_number" value="{{ old('venue', $event->contact ?? '') }}" class="w-full border rounded-lg p-2" placeholder="(555) 123-4567" />
            </div>
          </div>
        </div>
      </div>

      <!-- Preview -->
      <div id="preview" class="tab-content space-y-6">
        <div class="bg-white shadow rounded-lg p-6">
          <h2 class="text-lg font-semibold mb-1">Event Preview</h2>
          <p class="text-sm text-gray-500 mb-4">How your event will appear</p>

          <div class="border rounded-lg p-6 bg-white">
            <h2 class="text-2xl font-bold mb-2">{{ $event->title }}</h2>
            <p class="text-gray-600 mb-4">
              {{ $event->description }}
            </p>
            <div class="flex items-center justify-between">
              <span class="text-2xl font-bold">${{ $event->tickets->price }}</span>
              <button class="px-4 py-2 bg-blue-600 text-white rounded-lg">Register Now</button>
            </div>
          </div>
        </div>

        <div class="flex gap-4">
          <button type="submit" class="flex-1 px-4 py-2 border rounded-lg">Save as Draft</button>
          <button type="submit" class="flex-1 px-4 py-2 bg-blue-600 text-white rounded-lg">Publish Event</button>
        </div>
         </form>
      </div>
    </div>
  </main>
</div>

 @include('front.layout.footer')

<script>
    // Tab switching logic
    const tabButtons = document.querySelectorAll('.tab-btn');
    const tabContents = document.querySelectorAll('.tab-content');

    tabButtons.forEach(button => {
      button.addEventListener('click', () => {
        // Remove active state from all buttons
        tabButtons.forEach(btn => btn.classList.remove('border-blue-500', 'text-blue-600'));
        tabButtons.forEach(btn => btn.classList.add('text-gray-600'));

        // Add active state to clicked button
        button.classList.add('border-blue-500', 'text-blue-600');
        button.classList.remove('text-gray-600');

        // Hide all tab contents
        tabContents.forEach(tab => tab.classList.remove('active'));

        // Show selected tab
        const tabId = button.getAttribute('data-tab');
        document.getElementById(tabId).classList.add('active');
      });
    });

  function toggleTicketing(type) {
    document.getElementById("internal-fields").classList.toggle("hidden", type !== "internal");
    document.getElementById("external-fields").classList.toggle("hidden", type !== "external");
  }

  </script>
