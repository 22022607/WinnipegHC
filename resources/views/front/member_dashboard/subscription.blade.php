@include('front.layout.header')

 

  <main class="max-w-4xl mx-auto px-6 py-8">
    <a href="{{ url('member-dashboard') }}" class="inline-flex items-center text-sm text-gray-600 hover:text-black mb-6">
      <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
      </svg>
      Back to Dashboard
    </a>

    <div class="mb-8">
      <h2 class="text-3xl font-bold mb-2">Subscription & Payments</h2>
      <p class="text-gray-600">Manage your membership and payment information</p>
    </div>

    <!-- Tabs -->
    <div class="space-y-6">
      <div class="grid grid-cols-3 gap-2 mb-4">
        <button data-tab="subscription" class="py-2 text-sm bg-gray-100 font-semibold rounded">Subscription</button>
        <button data-tab="payments" class="py-2 text-sm rounded hover:bg-gray-100">Payment Methods</button>
        <button data-tab="billing" class="py-2 text-sm rounded hover:bg-gray-100">Billing History</button>
      </div>

      <!-- Subscription Tab -->
      <div data-content="subscription">
        <!-- Current Membership -->
        <div class="bg-white shadow rounded-lg p-6 mb-6">
          <h3 class="text-xl font-semibold mb-2">Current Membership</h3>
          <p class="text-gray-500 mb-4">Your Winnipeg Healing Connection membership details</p>
          <div class="bg-green-50 border border-green-200 rounded-lg p-4 space-y-4">
            <div class="flex justify-between items-center">
              <div>
                <h4 class="text-lg font-bold text-green-800">{{ @$userMembership->membership->name }}</h4>
                <p class="text-green-700">Winnipeg Healing Connection</p>
              </div>
              <span class="text-green-800 bg-green-100 px-3 py-1 rounded text-sm">Active</span>
            </div>
            <div class="grid md:grid-cols-2 gap-4">
              <div>
                <p class="text-sm font-medium text-green-800">Purchase Date</p>
                <p class="text-green-700">{{ \Carbon\Carbon::parse(@$userMembership->start_date)->format('F j, Y') }}</p>
              </div>
               <div>
                <p class="text-sm font-medium text-green-800">Renewal Date</p>
                <p class="text-green-700">{{ \Carbon\Carbon::parse(@$userMembership->next_payment_date)->format('F j, Y') }}</p>
              </div>
              <div>
                <p class="text-sm font-medium text-green-800">Amount Paid</p>
                <p class="text-green-700">${{ number_format(@$userMembership->amount, 2) }}</p>
              </div>
            </div>
            <div>
              <h5 class="font-medium text-green-800 mb-2">WHC Annual Membership Benefits Include:</h5>
              <ul class="grid md:grid-cols-2 gap-2 text-sm text-green-700 list-disc pl-5">
                <li>Event creation & management</li>
                <li>Priority customer support</li>
                <li>Community networking access</li>
              </ul>
            </div>
            {{-- <p class="text-sm text-green-600">No recurring charges. Your membership is active for life!</p> --}}
          </div>
        </div>

        <!-- Additional Services -->
        <div class="bg-white shadow rounded-lg p-6">
          <h3 class="text-xl font-semibold mb-2">Additional Services</h3>
          <p class="text-gray-500 mb-4">Optional add-ons and features you can purchase</p>

          <div class="space-y-4">
            <div class="p-4 border rounded-lg flex justify-between items-start">
              <div>
                <h4 class="font-medium">Business Spotlight</h4>
                <p class="text-sm text-gray-500">Feature your business on the homepage</p>
                @if($business_spotlight)
                
                @else
                <span class="inline-block bg-gray-100 text-gray-800 px-2 py-0.5 mt-1 text-xs rounded">$79/month</span>
                @endif
              </div>
              
              @if($business_spotlight)
               <div>
                <p class="text-sm font-medium text-green-800">Purchase Date</p>
                <p class="text-green-700">{{ date('d-m-Y',strtotime($business_spotlight->created_at)) }}</p>
              </div>
              <div>
                <p class="text-sm font-medium text-green-800">Amount Paid</p>
                <p class="text-green-700">$79.00</p>
              </div>
              <span class="inline-block bg-green-100 text-green-800 px-2 py-0.5 mt-1 text-s rounded">Active</span>

              @else
              <a href="{{ url('member-dashboard/purchase-spotlight') }}" class="text-sm border border-gray-300 px-3 py-1 rounded hover:bg-gray-100">Purchase Spotlight</a>
              @endif
            </div>

          <div class="p-4 border rounded-lg bg-gray-50 flex justify-between items-start">
              <div>
                <h4 class="font-medium">Spotlight Event</h4>
                <p class="text-sm text-gray-500">Enhanced event listings</p>
              </div>
              @if($spotlight_event)
                 <div>
                <p class="text-sm font-medium text-green-800">Purchase Date</p>
                <p class="text-green-700">{{ date('d-m-Y',strtotime($spotlight_event->created_at)) }}</p>
              </div>
              <div>
                <p class="text-sm font-medium text-green-800">Amount Paid</p>
                <p class="text-green-700">$79.00</p>
              </div>
                <div>
              @if ($spotlight_event->event_id)

                <div>
                  <p class="text-sm font-medium text-green-800">Spotlight Event</p>
                  <p class="text-green-700">{{ $spotlight_event->events->title }}</p>
              </div>
              @else
            <label for="add_spotlight_event" class="block text-sm font-medium text-gray-700 mt-2">Add Event To Spotlight</label>
     
            <select id="add_spotlight_event"
                data-spotlight-id="{{ $spotlight_event->id }}"
                class="mt-1 block w-full p-2 border rounded-lg text-sm">
                <option value="">Select Event</option>
                @foreach($userEvents as $event)
                    <option value="{{ $event->id }}"
                        {{ $spotlight_event->event_id == $event->id ? 'selected' : '' }}>
                        {{ $event->title }}
                    </option>
                @endforeach
            </select>
              @endif

              <p id="spotlight-msg" class="text-sm mt-1 text-green-600 hidden">Updated successfully!</p>
            
              </div>
              <span class="inline-block bg-green-100 text-green-800 px-2 py-0.5 mt-1 text-s rounded">Active</span>

              @else
                <a href="{{ url('member-dashboard/purchase-spotlight-event') }}" class="text-sm border border-gray-300 px-3 py-1 rounded hover:bg-gray-100">Purchase Spotlight Event</a>
                @endif
            </div>
          </div>
        </div>
      </div>

      <!-- Payment Methods Tab -->
      <div data-content="payments" class="hidden">
        <div class="bg-white shadow rounded-lg p-6">
          <div class="flex justify-between items-center mb-4">
            <div>
              <h3 class="text-xl font-semibold">Saved Payment Methods</h3>
              <p class="text-gray-500">Manage your saved cards</p>
            </div>
            <button class="bg-gray-100 px-3 py-1 rounded text-sm">+ Add Payment Method</button>
          </div>

          <div class="space-y-4">
            <div class="flex justify-between items-center border p-4 rounded-lg">
              <div>
                <h4 class="font-medium">Visa •••• 4242</h4>
                <p class="text-sm text-gray-500">Expires 12/26</p>
                <span class="bg-gray-200 text-xs text-gray-700 px-2 py-0.5 rounded">Default</span>
              </div>
              <div class="space-x-2">
                <button class="text-sm text-blue-600">Edit</button>
                <button class="text-sm text-red-600">Delete</button>
              </div>
            </div>

            <div class="flex justify-between items-center border p-4 rounded-lg">
              <div>
                <h4 class="font-medium">Mastercard •••• 8888</h4>
                <p class="text-sm text-gray-500">Expires 08/25</p>
              </div>
              <div class="space-x-2">
                <button class="text-sm text-blue-600">Edit</button>
                <button class="text-sm text-red-600">Delete</button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Billing History Tab -->
      <div data-content="billing" class="hidden">
        <div class="bg-white shadow rounded-lg p-6">
          <h3 class="text-xl font-semibold mb-2">Billing History</h3>
          <p class="text-gray-500 mb-4">View your previous payments</p>

          <div class="space-y-4">
          @foreach ($billing_history as $payment)
          @if($payment->membership_plan)
            <div class="flex justify-between items-center border p-4 rounded-lg">
              <div>
                  <h4 class="font-medium">{{ $payment->membership_plan->name }}</h4>
                  <p class="text-sm text-gray-500">
                      {{ $payment->created_at->format('Y-m-d') }}
                  </p>
              </div>
              <div class="text-right">
                  <p class="font-medium">${{ $payment->amount ?? '0.00' }}</p>
                  <span class="bg-gray-200 text-xs px-2 py-0.5 rounded">Paid</span>
              </div>
          </div>
         @endif
        @endforeach
          </div>

          <!--<div class="border-t pt-6 mt-6 flex justify-between items-center">-->
          <!--  <p class="text-sm text-gray-500">Need help with billing?</p>-->
          <!--  <a href="{{ url('contact') }}" class="text-sm border border-gray-300 px-3 py-1 rounded hover:bg-gray-100">Contact Support</a>-->
          <!--</div>-->
        </div>
      </div>
    </div>
  </main>
@include('front.layout.footer')
  
  <script>
    // Basic tab switching logic
    document.addEventListener("DOMContentLoaded", () => {
      const tabs = document.querySelectorAll("[data-tab]");
      const contents = document.querySelectorAll("[data-content]");

      tabs.forEach(tab => {
        tab.addEventListener("click", () => {
          const target = tab.getAttribute("data-tab");

          tabs.forEach(t => t.classList.remove("bg-gray-100", "font-semibold"));
          tab.classList.add("bg-gray-100", "font-semibold");

          contents.forEach(c => c.classList.add("hidden"));
          document.querySelector(`[data-content="${target}"]`).classList.remove("hidden");
        });
      });
    });
    document.addEventListener('DOMContentLoaded', function() {
    const select = document.getElementById('add_spotlight_event');
    const msg = document.getElementById('spotlight-msg');

    select.addEventListener('change', function() {
        const eventId = this.value;
        const spotlightId = this.dataset.spotlightId;

        if (!eventId || !spotlightId) return;

        fetch(`/member-dashboard/spotlight-event/update/${spotlightId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ event_id: eventId })
        })

        .then(response => response.json())
        .then(data => {
            if (data.success) {
                msg.textContent = data.success;
                msg.classList.remove('hidden');
                setTimeout(() => msg.classList.add('hidden'), 3000);
            } else if (data.error) {
                alert(data.error);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Something went wrong while updating Spotlight.');
        });
    });
});
  </script>


