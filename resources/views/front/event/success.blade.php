@include('front.layout.header')

<div class="flex flex-col items-center justify-center min-h-screen bg-green-50">
    <div class="bg-white p-8 rounded-2xl shadow-md text-center max-w-md w-full">
        <h1 class="text-3xl font-bold text-green-600 mb-4">🎉 Payment Successful!</h1>
        <p class="text-gray-700 mb-4">Thank you, <strong>{{ $order->name }}</strong>! Your ticket has been confirmed.</p>
        <p>Your Ticket Details has been sent to your email.</p>

        <div class="border-t border-b py-4 mb-4">
            <p><strong>Event:</strong> {{ $order->event->title }}</p>
            <p><strong>Ticket Code:</strong> {{ 'TCK-' . str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</p>
            <p><strong>Quantity:</strong> {{ $order->quantity }}</p>
            <p><strong>Amount:</strong> ${{ number_format($order->price, 2) }}</p>
        </div>

        <div class="flex flex-col sm:flex-row gap-3 justify-center">
            <a href="{{ route('ticket.download', ['id' => $order->id]) }}"
                class="bg-pink-600 hover:bg-pink-700 text-white px-6 py-2 rounded-lg font-semibold shadow-md">
                📄 Download Ticket PDF
            </a>

            <a href="{{ url('/') }}"
                class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-2 rounded-lg font-semibold shadow-md">
                🏠 Go Home
            </a>
        </div>
    </div>
</div>

@include('front.layout.footer')
