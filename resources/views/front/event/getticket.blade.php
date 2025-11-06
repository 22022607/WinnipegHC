@include('front.layout.header')

<!-- Tickets Section -->
<div class="bg-white border rounded-2xl p-6 shadow-sm mb-10 mt-2 ml-2 mr-2">

    {{-- <h2 class="text-2xl font-bold flex items-center gap-2 mb-6">
        ðŸŽŸ Register at:
    </h2> --}}

    {{-- External Ticket Type --}}
    @if(@$event_details->tickets && $event_details->tickets->ticket_type == 'external')
        @if(!empty(@$event_details->tickets->registration_url))
            <!-- Centered Info Card for External Link -->
            <div class="flex justify-center">
                <div class="bg-purple-50 border border-purple-200 rounded-2xl p-8 shadow-md text-center max-w-xl">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">🎫 Register for this Event</h3>


                    {{-- <p class="text-gray-600 mb-6">
                        Click the button below to register through our external partner.
                    </p> --}}

                    {{-- <a href="{{ $event_details->tickets->registration_url }}" 
                       target="_blank" 
                       class="inline-block bg-purple-600 hover:bg-purple-700 text-white font-semibold px-6 py-3 rounded-xl shadow-md transition">
                       ðŸ”— Register on Eventbrite
                    </a> --}}

                    <p class="mt-4 text-sm text-gray-500 break-all">
                       
                        <a href="{{ $event_details->tickets->registration_url }}" 
                           target="_blank" 
                           class="text-purple-700 hover:underline">
                           {{ @$event_details->tickets->registration_url }}
                        </a>
                    </p>
                </div>
            </div>
        @else
         <div class="flex justify-center">
                <div class="bg-purple-50 border border-purple-200 rounded-2xl p-8 shadow-md text-center max-w-xl">
                    {{-- <h3 class="text-xl font-semibold text-gray-800 mb-4">ðŸŽ« Register for this Event</h3> --}}

                    
                    <p class="mt-4 text-sm text-gray-500 break-all">
                       
                         <p class="text-gray-500">No tickets available for this event right now.</p>
                    </p>
                </div>
            </div>
           
        @endif

    {{-- Internal Ticket Type --}}
    @elseif(@$event_details->eventtickets && $event_details->eventtickets->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($event_details->eventtickets as $ticket)
                <div class="border rounded-2xl p-6 shadow-sm flex flex-col justify-between">
                    
                    <!-- Ticket Info -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">{{ $event_details->title }}</h3>

                        <p class="mt-4 text-xl font-bold text-purple-600">
                            ${{ number_format($ticket->price, 2) }}
                        </p>
                    </div>

                    <!-- Buy Form -->
                    <form action="{{ route('payment.checkout', $event_details->id) }}" method="POST" class="mt-6">
                        @csrf
                        <input type="hidden" name="ticket_name" value="{{ $ticket->name }}">
                        <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">

                        <div class="flex items-center gap-3 mb-3">
                            <label for="quantity-{{ $ticket->id }}" class="text-sm font-medium">Qty</label>
                            <input 
                                type="number" 
                                name="quantity" 
                                id="quantity-{{ $ticket->id }}" 
                                value="1" 
                                min="1" 
                                max="{{ $ticket->quantity }}" 
                                class="w-20 border rounded-lg p-2 text-center" 
                                required>
                            <h4 class="font-semibold text-gray-900">
                                Qty Available: {{ $ticket->quantity }}
                            </h4>
                        </div>

                        <button type="submit"
                            class="block text-center w-full bg-purple-600 hover:bg-purple-700 text-white py-3 rounded-xl font-semibold shadow-md transition">
                             💳 Buy Now
                        </button>
                    </form>
                </div>
            @endforeach
        </div>

    {{-- No tickets available --}}
    @else
     <div class="flex justify-center">
                <div class="bg-purple-50 border border-purple-200 rounded-2xl p-8 shadow-md text-center max-w-xl">
                    {{-- <h3 class="text-xl font-semibold text-gray-800 mb-4">ðŸŽ« Register for this Event</h3> --}}

                    
                    <p class="mt-4 text-sm text-gray-500 break-all">
                       
                         <p class="text-gray-500">No tickets available for this event right now.</p>
                    </p>
                </div>
            </div>
    @endif
</div>

@include('front.layout.footer')
