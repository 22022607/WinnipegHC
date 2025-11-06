@include('front.layout.header')
<main class="bg-gray-100 flex justify-center items-center min-h-screen">
  <div class="bg-white p-8 rounded-2xl shadow-md w-full max-w-md">
    <h1 class="text-2xl font-bold text-center mb-6 text-purple-700">Buy Festival Ticket 🎟️</h1>

    <form action="{{ route('festival.ticket.checkout') }}" method="POST" class="space-y-4">
      @csrf

      <div>
        <label class="block font-semibold mb-1">Full Name</label>
        <input type="text" name="name" class="w-full border rounded-lg px-3 py-2" required>
      </div>

      <div>
        <label class="block font-semibold mb-1">Email Address</label>
        <input type="email" name="email" class="w-full border rounded-lg px-3 py-2" required>
      </div>

      <div>
        <label class="block font-semibold mb-1">Contact Number</label>
        <input type="text" name="contact" class="w-full border rounded-lg px-3 py-2" required>
      </div>

      <div>
        <label class="block font-semibold mb-1">Quantity</label>
        <div class="flex items-center gap-2">
          <button type="button" id="decreaseQty" class="bg-gray-200 text-gray-700 px-3 py-2 rounded-lg">−</button>
          <input type="number" id="quantity" name="quantity" value="1" min="1" max="{{ $festival_details->total_seats - $festival_details->booked_seats }}" readonly class="w-16 text-center border rounded-lg py-2">
          <button type="button" id="increaseQty" class="bg-gray-200 text-gray-700 px-3 py-2 rounded-lg">+</button>
         <p class="ml-4" id="remainingSeats"> Remaining Seats: {{ $festival_details->total_seats - $festival_details->booked_seats }}</p>

        </div>
        <p id="qtyMessage" class="text-sm text-red-500 mt-1 hidden">Max quantity is {{ $festival_details->total_seats - $festival_details->booked_seats }}"</p>
      </div>

      <button type="submit" class="w-full bg-purple-600 text-white font-semibold py-2 rounded-lg hover:bg-purple-700 transition">
        Submit
      </button>
    </form>
  </div>
</main>
@include('front.layout.footer')
  <script>
    const qtyInput = document.getElementById('quantity');
    const decrease = document.getElementById('decreaseQty');
    const increase = document.getElementById('increaseQty');
    const msg = document.getElementById('qtyMessage');
    const remainingSeats = document.getElementById('remainingSeats');
    decrease.addEventListener('click', () => {
      let val = parseInt(qtyInput.value);
      if (val > 1) {
        qtyInput.value = val - 1;
        msg.classList.add('hidden');
      }
    });
    increase.addEventListener('click', () => {
      let val = parseInt(qtyInput.value);
      if (val < remainingSeats.textContent.split(': ')[1]) {
        qtyInput.value = val + 1;
        msg.classList.add('hidden');
      } else {
        msg.classList.remove('hidden');
      }
    });
  </script>

