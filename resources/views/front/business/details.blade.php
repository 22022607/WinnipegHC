@include('front.layout.header')

<body class="min-h-screen bg-gray-50">
  

  <main class="pt-6">
    <!-- Back Button -->
    <div class="max-w-8xl mx-auto px-6 mb-6">
      <a class="flex items-center gap-2 text-gray-600 hover:text-primary" href="{{ route('business') }}">
        ← Back to Businesses
      </a>
    </div>

    <!-- Hero Section -->
    <div style="
    padding: 0px 20px 0px 20px;">
    <section class="relative h-96 overflow-hidden">
       <img src="{{asset( $business->image) }}"
           alt="ShantiLotus Healing Services"
           class="w-full h-full object-cover" />
      <div class="absolute inset-0 bg-black/40"></div>
      <div class="absolute bottom-6 left-6 text-white">
        <span class="inline-block mb-2 bg-indigo-600 text-white text-xs px-2 py-1 rounded">{{ $business->category }}</span>
        <h1 class="text-4xl font-bold mb-2">{{ $business->name }}</h1>
        <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-4">
         
          <div class="flex items-center gap-1">
            📍 <span>{{ $business->location }}</span>
          </div>
        </div>
      </div>
    </section>
</div>
    <!-- Content -->
    <div class="max-w-8xl mx-auto px-6 py-8 " >
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-8">
          <!-- About -->
          <div class="bg-white rounded-xl shadow p-6">
            <h2 class="text-2xl font-bold mb-4">About</h2>
            <p class="text-gray-600 mb-4">{{ $business->description }}</p>
            {{-- <p class="text-gray-600">At ShantiLotus, we believe in the power of energy healing to transform lives...</p> --}}
          </div>

         

          <!-- Practitioner -->
          
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
          <!-- Contact -->
          <div class="bg-white rounded-xl shadow p-6">
            <h3 class="font-bold text-lg mb-4">Contact Information</h3>
            <div class="space-y-3 text-sm">
              <p>📞 {{ $business->phone }}</p>
              <p>🌐 {{ $business->website }}</p>
              <p>📍 {{ $business->location  }}</p>
              <p>⏰ {{ $business->hours }}</p>
            </div>
            {{-- <hr class="my-4" /> --}}
            {{-- <div class="space-y-3">
                <button id="openModal" class="w-full bg-purple-600 text-white py-2 rounded">
                    Book Appointment
                </button>
              <button class="w-full border py-2 rounded">💬 Send Message</button>
            </div> --}}
          </div>

        </div>
      </div>
    </div>
  </main>
 <!-- Booking Modal -->


  <!-- Modal -->
  <div id="bookingModal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">
    <div class="bg-white rounded-2xl shadow-lg w-full max-w-5xl max-h-[90vh] overflow-y-auto p-6">
      <!-- Header -->
      <div class="flex justify-between items-center border-b pb-3 mb-4">
        <h2 class="text-2xl font-bold">Book Your Appointment!</h2>
        <button id="closeModal" class="text-gray-500 hover:text-gray-700 text-2xl">&times;</button>
      </div>

      <form id="bookingForm" action="{{ route('business.bookAppointment', $business->id) }}" method="POST" class="space-y-6">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

          <!-- Left Column -->
          <div class="space-y-6">
      

            <!-- Date -->
            <div class="border rounded-lg p-4">
              <h3 class="font-semibold mb-3">Select Date</h3>
              <input type="date" name="date" class="w-full border rounded-lg px-3 py-2" required>
            </div>

            <!-- Time -->
            <div class="border rounded-lg p-4">
              <h3 class="font-semibold mb-3">Select Time</h3>
              <select name="appointment_time" class="w-full border rounded-lg px-3 py-2" required>
                <option value="">-- Select Time --</option>
                <option>9:00 AM</option>
                <option>9:30 AM</option>
                <option>10:00 AM</option>
                <option>10:30 AM</option>
                <option>11:00 AM</option>
                <option>11:30 AM</option>
                <option>12:00 PM</option>
                <option>12:30 PM</option>
                <option>1:00 PM</option>
                <option>1:30 PM</option>
                <option>2:00 PM</option>
                <option>2:30 PM</option>
                <option>3:00 PM</option>
                <option>4:00 PM</option>
                <option>4:30 PM</option>
                <option>5:00 PM</option>
                <option>5:30 PM</option>
              </select>
            </div>
          </div>

          <!-- Right Column -->
          <div class="space-y-6">
            <!-- User Info -->
            <div class="border rounded-lg p-4">
              <h3 class="font-semibold mb-3">Your Information</h3>
              <div class="grid grid-cols-2 gap-3">
                <input type="text" name="firstName" placeholder="First Name" class="border rounded-lg px-3 py-2" required>
                <input type="text" name="lastName" placeholder="Last Name" class="border rounded-lg px-3 py-2" required>
              </div>
              <input type="email" name="email" placeholder="Email" class="border rounded-lg px-3 py-2 w-full mt-3" required>
              <input type="tel" name="phone" placeholder="Phone Number" class="border rounded-lg px-3 py-2 w-full mt-3" required>
              <textarea name="notes" rows="3" placeholder="Additional notes (optional)" class="border rounded-lg px-3 py-2 w-full mt-3"></textarea>
            </div>

            <!-- Summary -->
            <div class="border rounded-lg p-4 bg-gray-50">
              <h3 class="font-semibold mb-3">Booking Summary</h3>
              <p><strong>Date:</strong> <span id="summaryDate">-</span></p>
              <p><strong>Time:</strong> <span id="summaryTime">-</span></p>
            </div>
          </div>
        </div>

        <!-- Buttons -->
        <div class="flex gap-4 pt-6">
          <button type="button" id="cancelBtn" class="flex-1 border rounded-lg py-2 hover:bg-gray-100">Cancel</button>
          <button type="submit" class="flex-1 bg-blue-600 text-white rounded-lg py-2 hover:bg-blue-700">Request Appointment</button>
        </div>
      </form>
    </div>
  </div>

  <!-- JS -->
<script>
const modal = document.getElementById("bookingModal");
const openModal = document.getElementById("openModal");
const closeModal = document.getElementById("closeModal");
const cancelBtn = document.getElementById("cancelBtn");
const form = document.getElementById("bookingForm");
const summaryDate = document.getElementById("summaryDate");
const summaryTime = document.getElementById("summaryTime");

openModal.onclick = () => modal.classList.remove("hidden");
closeModal.onclick = () => modal.classList.add("hidden");
cancelBtn.onclick = () => modal.classList.add("hidden");

form.addEventListener("input", () => {
  summaryDate.textContent = form.date.value || "-";
  summaryTime.textContent = form.time.value || "-";
});

form.addEventListener("submit", async (e) => {
  e.preventDefault(); // stop normal submit
  const formData = new FormData(form);

  try {
    const response = await fetch(form.action, {
      method: "POST",
      headers: {
        "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value,
      },
      body: formData,
    });

    if (response.ok) {
      alert("Appointment booked successfully!");
      form.reset();
      summaryDate.textContent = summaryTime.textContent = "-";
      modal.classList.add("hidden");
    } else {
      alert("Something went wrong. Please try again.");
    }
  } catch (error) {
    console.error("Booking error:", error);
    alert("An error occurred. Please try again.");
  }
});
</script>




@include('front.layout.footer')
