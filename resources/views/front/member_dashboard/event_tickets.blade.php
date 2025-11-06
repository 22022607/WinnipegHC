@include('front.layout.header')

<div class="container mx-auto px-6 py-10">
    <h2 class="text-2xl font-bold mb-6 text-purple-700">Ticket Information</h2>

    <!-- Back Button -->
    <a href="{{ route('memberdashboard') }}" class="inline-flex items-center mb-6 text-gray-600 hover:text-gray-900">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
        Back to Dashboard
    </a>

    @if($event->tickets)
        @if($event->tickets->ticket_type === 'internal')
            @php
                $ticket = $event->tickets;
                $totalTickets = $ticket->quantity ?? 0;
                $soldTickets = $ticket->purchases->sum('quantity') ?? 0;
                $remainingTickets = $totalTickets - $soldTickets;
            @endphp

            <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-sm">
                <thead class="bg-purple-600 text-white">
                    <tr>
                        <th class="py-3 px-4 text-left text-sm font-semibold">Event Name</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold">Price</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold">Total Quantity</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold">Purchased Quantity</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold">Left Quantity</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold">Ticket Code</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold">Transaction ID</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($ticket->purchases as $purchase)
                        <tr class="hover:bg-gray-50">
                            <td class="py-3 px-4 text-sm text-gray-700">{{ $event->title }}</td>
                            <td class="py-3 px-4 text-sm text-gray-700">{{ $ticket->price ?? '0' }}</td>
                            <td class="py-3 px-4 text-sm text-gray-700">{{ $totalTickets }}</td>
                            <td class="py-3 px-4 text-sm text-gray-700">{{ $purchase->quantity ?? 0 }}</td>
                            <td class="py-3 px-4 text-sm text-gray-700">{{ $totalTickets - $soldTickets }}</td>
                            <td class="py-3 px-4 text-sm text-gray-700">{{ $purchase->ticket_code ?? 'N/A' }}</td>
                            <td class="py-3 px-4 text-sm text-gray-700">{{ $purchase->transaction_id ?? 'N/A' }}</td>
                            <td class="py-3 px-4 text-sm text-gray-700">{{ ucfirst($purchase->status ?? 'N/A') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="py-4 text-center text-gray-500">
                                No tickets found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        @elseif($event->tickets->ticket_type === 'external')
            <div class="border border-gray-200 p-6 rounded-lg shadow-sm mt-6">
                <h4 class="text-lg font-semibold mb-2">External Ticket Registration</h4>
                <p><strong>Platform:</strong> {{ $event->tickets->platform_name ?? 'N/A' }}</p>
                <p>
                    <strong>Registration Link:</strong>
                    <a href="{{ $event->tickets->registration_url ?? '#' }}" target="_blank" class="text-purple-600 hover:underline">
                        {{ $event->tickets->registration_url ?? 'N/A' }}
                    </a>
                </p>
            </div>
        @else
            <p class="text-gray-500 mt-4">No ticket information available.</p>
        @endif
    @else
        <p class="text-gray-500 mt-4">No tickets configured for this event.</p>
    @endif
</div>

@include('front.layout.footer')
