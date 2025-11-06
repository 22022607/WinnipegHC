
@include('front.layout.header')


  <!-- Lucide Icons (CDN) -->
  <script src="https://unpkg.com/lucide@latest"></script>

  <style>
    /* Light shadcn-like tokens */
    :root {
      --card: #ffffff;
      --border: #e5e7eb;
      --muted: #6b7280;
      --bg: #f9fafb;
    }
    .card { background: var(--card); border: 1px solid var(--border); border-radius: 1rem; }
    .btn { display: inline-flex; align-items: center; gap:.5rem; padding:.5rem .875rem; border-radius: .75rem; border:1px solid var(--border); }
    .btn-primary { background:#111827; color:#fff; border-color:#111827; }
    .btn-ghost { background:transparent; }
    .btn-outline { background:#fff; }
    .badge { display:inline-flex; align-items:center; padding:.15rem .5rem; border-radius:.5rem; font-size:.75rem; border:1px solid var(--border); }
    .badge-default { background:#111827; color:#fff; border-color:#111827; }
    .badge-secondary { background:#f3f4f6; color:#111827; }
    .badge-destructive { background:#fee2e2; color:#991b1b; border-color:#fecaca; }
    .input { width:100%; border:1px solid var(--border); border-radius:.5rem; padding:.5rem .75rem; }
    .muted { color: var(--muted); }
  </style>



  <main class="max-w-6xl mx-auto px-6 py-8">
    <!-- Back Button -->
    <a href="{{ route('memberdashboard') }}" class="btn btn-ghost mb-6">
      <i data-lucide="arrow-left" class="w-4 h-4"></i>
      Back to Dashboard
    </a>

    <!-- Title + CTA -->
    <div class="mb-8">
      <div class="flex items-center justify-between">
        <div>
          <h1 class="text-3xl font-bold mb-2">Events Management</h1>
          <p class="muted">Create and manage your events and workshops</p>
        </div>
        <a href="{{ route('memberdashboard.events') }}" class="btn btn-primary">
          <i data-lucide="plus" class="w-4 h-4"></i>
          Create Event
        </a>
      </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid md:grid-cols-4 gap-6 mb-8">
      <div class="card">
        <div class="p-6 flex items-center gap-3">
          <i data-lucide="calendar" class="w-5 h-5 text-blue-600"></i>
          <div>
            <p class="text-2xl font-bold">{{ count($user_events) }}</p>
            <p class="text-sm muted">Total Events</p>
          </div>
        </div>
      </div>

      <!--<div class="card">-->
      <!--  <div class="p-6 flex items-center gap-3">-->
      <!--    <i data-lucide="users" class="w-5 h-5 text-green-600"></i>-->
      <!--    <div>-->
      <!--      <p class="text-2xl font-bold">40</p>-->
      <!--      <p class="text-sm muted">Total Attendees</p>-->
      <!--    </div>-->
      <!--  </div>-->
      <!--</div>-->

      <!--<div class="card">-->
      <!--  <div class="p-6 flex items-center gap-3">-->
      <!--    <i data-lucide="dollar-sign" class="w-5 h-5 text-purple-600"></i>-->
      <!--    <div>-->
      <!--      <p class="text-2xl font-bold">$1,830</p>-->
      <!--      <p class="text-sm muted">Total Revenue</p>-->
      <!--    </div>-->
      <!--  </div>-->
      <!--</div>-->

      <div class="card">
        <div class="p-6 flex items-center gap-3">
          <i data-lucide="calendar" class="w-5 h-5 text-orange-600"></i>
          <div>
            <p class="text-2xl font-bold">{{ count($user_events) }}</p>
            <p class="text-sm muted">Upcoming Events</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Search & Filters -->
    <!--<div class="card mb-6">-->
    <!--  <div class="p-6 flex items-center gap-4">-->
    <!--    <div class="relative flex-1">-->
    <!--      <i data-lucide="search" class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400"></i>-->
    <!--      <input class="input pl-10" placeholder="Search events..." />-->
    <!--    </div>-->
    <!--    <button class="btn btn-outline">All Status</button>-->
    <!--    <button class="btn btn-outline">All Types</button>-->
    <!--  </div>-->
    <!--</div>-->

    <!-- Events List -->
    <div class="card">
      <div class="px-6 pt-6">
        <h2 class="text-lg font-semibold">Your Events</h2>
        <p class="muted">Manage all your events and workshops</p>
      </div>
      <div class="p-6">
        <div class="space-y-4">

          <!-- Event 1 -->
          @foreach ($user_events as $key=>$value)
              
          <div class="p-4 border rounded-xl hover:bg-gray-50 transition-colors">
            <div class="flex items-center justify-between gap-4">
              <div class="flex-1">
                <div class="flex items-center gap-3 mb-2">
                  <h3 class="font-semibold">{{ $value->title }}</h3>
                  <span class="badge badge-default">Active</span>
                   @if($value->tickets)
                  <span class="badge">{{ ucfirst($value->tickets->ticket_type) }}</span>
                  @else

                  @endif
                </div>
                <div class="grid md:grid-cols-4 gap-4 text-sm muted">
                  <div class="flex items-center gap-1">
                    <i data-lucide="calendar" class="w-4 h-4"></i>
                    {{ date('Y-m-d', strtotime($value->date)) }} at {{ $value->start_time->format('h:i A') }}
                  </div>
                  <div class="flex items-center gap-1">
                    <i data-lucide="map-pin" class="w-4 h-4"></i>
                    {{ $value->location ?? $value->venue}}
                  </div>
                  {{-- <div class="flex items-center gap-1">
                    <i data-lucide="users" class="w-4 h-4"></i>
                    12/20 attendees
                  </div> --}}
                  <div class="flex items-center gap-1">
                    <i data-lucide="dollar-sign" class="w-4 h-4"></i>
                    {{ $value->admission_fee }}
                  </div>
                </div>
              </div>
              <div class="flex items-center gap-1">
                <a class="btn btn-ghost" href="{{ route('memberdashboard.events.view',$value->id) }}" title="View"><i data-lucide="eye" class="w-4 h-4"></i></a>
                <a class="btn btn-ghost" href="{{ route('memberdashboard.events.edit',$value->id) }}" title="Edit"><i data-lucide="edit" class="w-4 h-4"></i></a>
                <form action="{{ route('memberdashboard.events.delete', $value->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                  <button class="btn btn-ghost" title="Delete"><i data-lucide="trash-2" class="w-4 h-4"></i></button>

                </form>
            <a href="{{ route('memberdashboard.events.tickets', $value->id) }}" class="btn btn-ghost" title="Ticket Information"><i data-lucide="ticket" class="w-4 h-4"></i></a>

              </div>
            </div>
          </div>
          @endforeach

         

        </div>
      </div>
    </div>
  </main>


  <script>
    // Initialize Lucide icons
    lucide.createIcons();
  </script>

@include('front.layout.footer')
