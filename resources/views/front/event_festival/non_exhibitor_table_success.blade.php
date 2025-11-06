@include('front.layout.header')

<div class="flex flex-col items-center justify-center min-h-screen bg-green-50">
    <div class="bg-white p-8 rounded-2xl shadow-md text-center max-w-md w-full">
        <h1 class="text-3xl font-bold text-green-600 mb-4">🎉 Payment Successful!</h1>
        <p class="text-gray-700 mb-4">Thank you, <strong>{{ $order->name }}</strong>! Your Exhibitor Table has been confirmed.</p>
        <p>Your Exhibitor Table details have been sent to your email.</p>

        <div class="border-t border-b py-4 mb-4">
  
            <p><strong>Amount:</strong> ${{ number_format($order->price, 2) }}</p>
            <p><strong>Transaction ID:</strong> {{ $order->transaction_id }}</p>
        </div>

        <div class="flex flex-col sm:flex-row gap-3 justify-center">
         
            <a href="{{ url('/') }}"
                class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-2 rounded-lg font-semibold shadow-md">
                🏠 Go Home
            </a>
        </div>
    </div>
</div>

@include('front.layout.footer')
