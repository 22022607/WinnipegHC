@include('front.layout.header')

<div class="max-w-lg sm:max-w-2xl mx-auto p-4 sm:p-6">
    <h3 class="text-xl sm:text-2xl font-bold mb-4 sm:mb-6">Cart Summary:</h3>
    <h1 class="text-xl sm:text-2xl font-bold mb-6 text-center">{{ $event->title }}</h1>

    <div class="border rounded-xl p-4 sm:p-6 mb-6 shadow">
        <p class="font-semibold text-sm sm:text-base">🎟 Ticket Price: ${{ $ticket->price }}</p>
        <p class="font-semibold text-sm sm:text-base">🧾 Quantity: {{ $quantity }}</p>
        <p class="font-bold text-base sm:text-lg">💰 Total: ${{ $ticket->price * $quantity }}</p>
    </div>

    @if(session('success'))
        <p class="bg-green-100 text-green-700 p-3 rounded mb-4 text-sm sm:text-base">{{ session('success') }}</p>
    @endif
    @if(session('error'))
        <p class="bg-red-100 text-red-700 p-3 rounded mb-4 text-sm sm:text-base">{{ session('error') }}</p>
    @endif

    <form action="{{ route('payment.process', $event->id) }}" method="POST" id="payment-form">
        @csrf
        <input type="hidden" name="event_id" value="{{ $event->id }}">
        <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
        <input type="hidden" name="quantity" value="{{ $quantity }}">
        <input type="hidden" name="total_price" value="{{ $ticket->price * $quantity }}">

        <!-- 🧍 User Details -->
        <div class="border rounded-xl p-4 sm:p-6 mb-6 shadow-sm">
            <h4 class="font-semibold text-base sm:text-lg mb-4">Your Details</h4>

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                <input type="text" id="name" name="name" required
                    class="w-full border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500 p-2 sm:p-3">
            </div>

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" id="email" name="email" required
                    class="w-full border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500 p-2 sm:p-3">
            </div>

            <div class="mb-4">
                <label for="contact" class="block text-sm font-medium text-gray-700 mb-1">Contact Number</label>
                <input type="tel" id="contact" name="contact" required
                    class="w-full border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500 p-2 sm:p-3">
            </div>
        </div>

        <!-- 💳 Card Details -->
        {{-- <div id="card-element" class="p-3 sm:p-4 border rounded mb-4"></div> --}}

        <button type="submit"
            class="w-full bg-purple-600 hover:bg-purple-700 text-white py-3 sm:py-3.5 rounded-lg font-semibold text-sm sm:text-base">
            💳Submit
        </button>
    </form>
</div>

<script src="https://js.stripe.com/v3/"></script>
<script>
    const stripe = Stripe("{{ env('STRIPE_KEY') }}");
    const elements = stripe.elements();
    const card = elements.create('card');
    card.mount('#card-element');

    const form = document.getElementById('payment-form');
    form.addEventListener('submit', async (event) => {
        event.preventDefault();

        const {token, error} = await stripe.createToken(card);

        if (error) {
            alert(error.message);
        } else {
            let hidden = document.createElement('input');
            hidden.setAttribute('type', 'hidden');
            hidden.setAttribute('name', 'stripeToken');
            hidden.setAttribute('value', token.id);
            form.appendChild(hidden);

            form.submit();
        }
    });
</script>

@include('front.layout.footer')
