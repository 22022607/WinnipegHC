@include('front.layout.header')


<div class="container mx-auto py-16 text-center">
    <h1 class="text-3xl font-bold text-red-600 mb-6">Payment Cancelled ❌</h1>
    <p class="text-gray-700 mb-4">
        Your Ticket payment has been cancelled. No payment has been processed.
    </p>
    <div>
     <div class="flex flex-col sm:flex-row gap-3 justify-center">
         {{-- @if(isset($order))
            <a href="{{ route('festival.exhibitor.table.success', ['order_id' => $order->id, 'session_id' => $order->session_id ?? '']) }}" 
            class="bg-blue-500 hover:bg-blue-600 text-white py-3 px-6 rounded-full shadow">
                Retry Payment
            </a>
        
           
        @endif --}}
         <a href="{{ url('/') }}" 
            class="bg-blue-500 hover:bg-blue-600 text-white py-3 px-6 rounded-full shadow">
                Home
            </a>
        </div>
    </div>
</div>

@include('front.layout.footer')
