@include('front.layout.header')

<div class="max-w-2xl mx-auto p-6">
    <h3 class="text-2xl font-bold mb-6">Cart Summary:</h3>
    <h1 class="text-2xl font-bold mb-6 text-center">{{ $event->title }}</h1>
    <div class="border rounded-xl p-4 mb-6 shadow">
        <p class="font-semibold">🎟 Ticket Price: ${{ $ticket->price }}</p>
        <p class="font-semibold">🧾 Quantity: {{ $quantity }}</p>
        <p class="font-bold text-lg">💰 Total: ${{ $ticket->price * $quantity }}</p>
    </div>

    @if(session('success'))
        <p class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</p>
    @endif
    @if(session('error'))
        <p class="bg-red-100 text-red-700 p-3 rounded mb-4">{{ session('error') }}</p>
    @endif
 
    <form action="{{ route('front.payment.process', $event->id) }}" method="POST" id="payment-form">
        @csrf
        <input type="hidden" name="event_id" value="{{ $event->id }}">
        <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
        <input type="hidden" name="quantity" value="{{ $quantity }}">
        <input type="hidden" name="total_price" value="{{ $ticket->price * $quantity }}">
        <div id="card-element" class="p-3 border rounded mb-4"></div>
        <button type="submit"
            class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-3 rounded-lg font-semibold">
            💳 Pay with Card
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
