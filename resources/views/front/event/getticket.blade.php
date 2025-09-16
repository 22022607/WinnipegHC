@include('front.layout.header')
<!-- Tickets Section -->
<div class="bg-white border rounded-2xl p-6 shadow-sm mb-10">
    <h2 class="text-2xl font-bold flex items-center gap-2 mb-6">
        🎟 Available Tickets
    </h2>

  @if($event_details->eventtickets && $event_details->eventtickets->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($event_details->eventtickets as $ticket)
            <div class="border rounded-2xl p-6 shadow-sm flex flex-col justify-between">
                <!-- Ticket Info -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-900" >{{ $event_details->title }}</h3>

                    {{-- <p class="text-gray-600 text-sm mt-1">{{ $tick et->description }}</p> --}}

                    <p class="mt-4 text-xl font-bold text-indigo-600">
                        ₹{{ number_format($ticket->price, 2) }}
                    </p>
                    {{-- <p class="text-sm text-gray-500">
                        Sales: {{ \Carbon\Carbon::parse($ticket->ticket_sale_start)->format('d M Y H:i') }} - 
                               {{ \Carbon\Carbon::parse($ticket->ticket_sale_end)->format('d M Y H:i') }}
                    </p> --}}
                </div>

                <!-- Buy Form -->
            <form action="{{ route('front.payment.checkout', $event_details->id) }}" method="POST" class="mt-6">
                @csrf
                <input type="hidden" name="ticket_name" value="{{ $ticket->name }}">

                <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">

                <div class="flex items-center gap-3 mb-3">
                    <label for="quantity-{{ $ticket->id }}" class="text-sm font-medium">Qty</label>
                    
                    <input type="number" name="quantity" id="quantity-{{ $ticket->id }}" 
                        value="1" min="1" max="{{ $ticket->quantity }}" 
                        class="w-20 border rounded-lg p-2 text-center" required>
                    <h4 class="font-semibold text-gray-900">Qty Available: {{ $ticket->quantity }}</h4>
                </div>

                <button type="submit"
                    class="block text-center w-full bg-indigo-600 hover:bg-indigo-700 text-white py-3 rounded-xl font-semibold shadow-md transition">
                    💳 Buy Now
                </button>
            </form>

            </div>
        @endforeach
    </div>
@else
    <p class="text-gray-600">No tickets available for this event right now.</p>
@endif

</div>
@include('front.layout.footer')
