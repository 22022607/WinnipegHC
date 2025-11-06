
@include('front.layout.header')

<div class="container mx-auto px-6 py-10">
    <h2 class="text-2xl font-bold mb-6 text-purple-700">My Appointments</h2>
    <!-- Back Button -->
    <a href="{{route('memberdashboard')}}" class="inline-flex items-center mb-6 text-gray-600 hover:text-gray-900">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
      </svg>
      Back to Dashboard
    </a>
    <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-sm">
        <thead class="bg-purple-600 text-white">
            <tr>
                <th class="py-3 px-4 text-left text-sm font-semibold">#</th>
                <th class="py-3 px-4 text-left text-sm font-semibold">First Name</th>
                <th class="py-3 px-4 text-left text-sm font-semibold">Last Name</th>
                <th class="py-3 px-4 text-left text-sm font-semibold">Email</th>
                <th class="py-3 px-4 text-left text-sm font-semibold">Phone</th>
                <th class="py-3 px-4 text-left text-sm font-semibold">Date</th>
                <th class="py-3 px-4 text-left text-sm font-semibold">Time</th>
                <th class="py-3 px-4 text-left text-sm font-semibold">Notes</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @forelse ($appointments as $index => $appointment)
                <tr class="hover:bg-gray-50">
                    <td class="py-3 px-4 text-sm text-gray-700">{{ $index + 1 }}</td>
                    <td class="py-3 px-4 text-sm text-gray-700">{{ $appointment->first_name }}</td>
                    <td class="py-3 px-4 text-sm text-gray-700">{{ $appointment->last_name ?? '-' }}</td>
                    <td class="py-3 px-4 text-sm text-gray-700">{{ $appointment->email }}</td>
                    <td class="py-3 px-4 text-sm text-gray-700">{{ $appointment->phone }}</td>
                    <td class="py-3 px-4 text-sm text-gray-700">{{ \Carbon\Carbon::parse($appointment->date)->format('d M, Y') }}</td>
                    <td class="py-3 px-4 text-sm text-gray-700">{{ $appointment->appointment_time }}</td>
                    <td class="py-3 px-4 text-sm text-gray-700">{{ $appointment->notes ?? '-' }}</td>
                  
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="py-4 text-center text-gray-500">
                        No appointments found.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@include('front.layout.footer')
