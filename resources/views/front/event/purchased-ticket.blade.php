
@include('front.layout.header')
<div class="max-w-2xl mx-auto p-6 border rounded-xl shadow-lg bg-white mt-3">
    <h1 class="text-2xl font-bold mb-4">🎟 Your Ticket</h1>

    {{-- Event Info --}}
    <div class="mb-6">
        <h2 class="text-xl font-semibold">{{ $order->event->title }}</h2>
        <p class="text-gray-600">📅 {{ $order->event->date ?? 'Date TBA' }}</p>
        <p class="text-gray-600">📍 {{ $order->event->location ?? 'Location TBA' }}</p>
    </div>

    {{-- Ticket Info --}}
    <div class="border-t pt-4">
        <p><strong>Ticket:</strong> {{ $order->ticket->name }}</p>
        <p><strong>Quantity:</strong> {{ $order->quantity }}</p>
        <p><strong>Status:</strong> 
            <span class="text-green-600">{{ ucfirst($order->status) }}</span>
        </p>
        <p><strong>Code:</strong> {{ $order->ticket_code }}</p>
    </div>

    {{-- QR Code --}}
    <div class="mt-6 text-center ">
        {{-- {{ $order->ticket->qr_code }} --}}
        {!! QrCode::size(250)->generate(route('ticket.show', $order->id)) !!}

      
    </div>

    {{-- Download PDF --}}
    <div class="mt-6 text-center">
        <a href="{{ route('front.ticket.download',$order->id) }}"
           class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg font-semibold shadow-md">
            ⬇️ Download Ticket (PDF)
        </a>
    </div>
</div>
@include('front.layout.footer')
