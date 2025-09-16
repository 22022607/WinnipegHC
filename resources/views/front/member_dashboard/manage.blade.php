<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Events Management</title>

  <!-- Tailwind CSS (CDN) -->
  <script src="https://cdn.tailwindcss.com"></script>

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
</head>
<body class="min-h-screen bg-[var(--bg)] text-gray-900">
  <!-- Header -->
  <header class="border-b bg-white">
    <div class="max-w-6xl mx-auto px-6 py-4 flex items-center justify-between">
      <a href="/" class="text-xl font-semibold">My App</a>
      <nav class="flex items-center gap-6">
        <a href="/dashboard" class="hover:underline">Dashboard</a>
        <a href="/dashboard/events" class="font-medium hover:underline">Events</a>
      </nav>
    </div>
  </header>

  <main class="max-w-6xl mx-auto px-6 py-8">
    <!-- Back Button -->
    <a href="{{ route('front.memberdashboard') }}" class="btn btn-ghost mb-6">
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
        <a href="{{ route('front.event.create') }}" class="btn btn-primary">
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
            <p class="text-2xl font-bold">4</p>
            <p class="text-sm muted">Total Events</p>
          </div>
        </div>
      </div>

      <div class="card">
        <div class="p-6 flex items-center gap-3">
          <i data-lucide="users" class="w-5 h-5 text-green-600"></i>
          <div>
            <p class="text-2xl font-bold">40</p>
            <p class="text-sm muted">Total Attendees</p>
          </div>
        </div>
      </div>

      <div class="card">
        <div class="p-6 flex items-center gap-3">
          <i data-lucide="dollar-sign" class="w-5 h-5 text-purple-600"></i>
          <div>
            <p class="text-2xl font-bold">$1,830</p>
            <p class="text-sm muted">Total Revenue</p>
          </div>
        </div>
      </div>

      <div class="card">
        <div class="p-6 flex items-center gap-3">
          <i data-lucide="calendar" class="w-5 h-5 text-orange-600"></i>
          <div>
            <p class="text-2xl font-bold">2</p>
            <p class="text-sm muted">Upcoming Events</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Search & Filters -->
    <div class="card mb-6">
      <div class="p-6 flex items-center gap-4">
        <div class="relative flex-1">
          <i data-lucide="search" class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400"></i>
          <input class="input pl-10" placeholder="Search events..." />
        </div>
        <button class="btn btn-outline">All Status</button>
        <button class="btn btn-outline">All Types</button>
      </div>
    </div>

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
                  <span class="badge">Internal</span>
                </div>
                <div class="grid md:grid-cols-4 gap-4 text-sm muted">
                  <div class="flex items-center gap-1">
                    <i data-lucide="calendar" class="w-4 h-4"></i>
                    {{ date('Y-m-d', strtotime($value->date)) }} at {{ $value->start_time->format('h:i A') }}
                  </div>
                  <div class="flex items-center gap-1">
                    <i data-lucide="map-pin" class="w-4 h-4"></i>
                    Studio A
                  </div>
                  <div class="flex items-center gap-1">
                    <i data-lucide="users" class="w-4 h-4"></i>
                    12/20 attendees
                  </div>
                  <div class="flex items-center gap-1">
                    <i data-lucide="dollar-sign" class="w-4 h-4"></i>
                    $35
                  </div>
                </div>
              </div>
              <div class="flex items-center gap-1">
                <a class="btn btn-ghost" href="{{ route('front.event.view',$value->id) }}" title="View"><i data-lucide="eye" class="w-4 h-4"></i></a>
                <a class="btn btn-ghost" href="{{ url('front/event/edit/'.$value->id) }}" title="Edit"><i data-lucide="edit" class="w-4 h-4"></i></a>
                <form action="{{ route('front.event.delete', $value->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                  <button class="btn btn-ghost" title="Delete"><i data-lucide="trash-2" class="w-4 h-4"></i></button>

                </form>
                <button class="btn btn-ghost" title="More"><i data-lucide="more-horizontal" class="w-4 h-4"></i></button>
              </div>
            </div>
          </div>
          @endforeach

          {{-- <!-- Event 2 -->
          <div class="p-4 border rounded-xl hover:bg-gray-50 transition-colors">
            <div class="flex items-center justify-between gap-4">
              <div class="flex-1">
                <div class="flex items-center gap-3 mb-2">
                  <h3 class="font-semibold">Healing Circle</h3>
                  <span class="badge badge-default">Active</span>
                  <span class="badge">Internal</span>
                </div>
                <div class="grid md:grid-cols-4 gap-4 text-sm muted">
                  <div class="flex items-center gap-1">
                    <i data-lucide="calendar" class="w-4 h-4"></i>
                    2024-12-22 at 7:00 PM
                  </div>
                  <div class="flex items-center gap-1">
                    <i data-lucide="map-pin" class="w-4 h-4"></i>
                    Main Hall
                  </div>
                  <div class="flex items-center gap-1">
                    <i data-lucide="users" class="w-4 h-4"></i>
                    8/15 attendees
                  </div>
                  <div class="flex items-center gap-1">
                    <i data-lucide="dollar-sign" class="w-4 h-4"></i>
                    $25
                  </div>
                </div>
              </div>
              <div class="flex items-center gap-1">
                <a class="btn btn-ghost" href="/dashboard/events/2" title="View"><i data-lucide="eye" class="w-4 h-4"></i></a>
                <a class="btn btn-ghost" href="/dashboard/events/2/edit" title="Edit"><i data-lucide="edit" class="w-4 h-4"></i></a>
                <button class="btn btn-ghost" title="Delete"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
                <button class="btn btn-ghost" title="More"><i data-lucide="more-horizontal" class="w-4 h-4"></i></button>
              </div>
            </div>
          </div>

          <!-- Event 3 -->
          <div class="p-4 border rounded-xl hover:bg-gray-50 transition-colors">
            <div class="flex items-center justify-between gap-4">
              <div class="flex-1">
                <div class="flex items-center gap-3 mb-2">
                  <h3 class="font-semibold">Reiki Level 1 Certification</h3>
                  <span class="badge badge-secondary">Draft</span>
                  <span class="badge">External</span>
                </div>
                <div class="grid md:grid-cols-4 gap-4 text-sm muted">
                  <div class="flex items-center gap-1">
                    <i data-lucide="calendar" class="w-4 h-4"></i>
                    2025-01-05 at 9:00 AM
                  </div>
                  <div class="flex items-center gap-1">
                    <i data-lucide="map-pin" class="w-4 h-4"></i>
                    Training Room
                  </div>
                  <div class="flex items-center gap-1">
                    <i data-lucide="users" class="w-4 h-4"></i>
                    5/10 attendees
                  </div>
                  <div class="flex items-center gap-1">
                    <i data-lucide="dollar-sign" class="w-4 h-4"></i>
                    $150
                  </div>
                </div>
              </div>
              <div class="flex items-center gap-1">
                <a class="btn btn-ghost" href="/dashboard/events/3" title="View"><i data-lucide="eye" class="w-4 h-4"></i></a>
                <a class="btn btn-ghost" href="/dashboard/events/3/edit" title="Edit"><i data-lucide="edit" class="w-4 h-4"></i></a>
                <button class="btn btn-ghost" title="Delete"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
                <button class="btn btn-ghost" title="More"><i data-lucide="more-horizontal" class="w-4 h-4"></i></button>
              </div>
            </div>
          </div>

          <!-- Event 4 -->
          <div class="p-4 border rounded-xl hover:bg-gray-50 transition-colors">
            <div class="flex items-center justify-between gap-4">
              <div class="flex-1">
                <div class="flex items-center gap-3 mb-2">
                  <h3 class="font-semibold">Sound Bath Experience</h3>
                  <span class="badge badge-destructive">Sold Out</span>
                  <span class="badge">Internal</span>
                </div>
                <div class="grid md:grid-cols-4 gap-4 text-sm muted">
                  <div class="flex items-center gap-1">
                    <i data-lucide="calendar" class="w-4 h-4"></i>
                    2024-12-10 at 6:30 PM
                  </div>
                  <div class="flex items-center gap-1">
                    <i data-lucide="map-pin" class="w-4 h-4"></i>
                    Studio B
                  </div>
                  <div class="flex items-center gap-1">
                    <i data-lucide="users" class="w-4 h-4"></i>
                    15/15 attendees
                  </div>
                  <div class="flex items-center gap-1">
                    <i data-lucide="dollar-sign" class="w-4 h-4"></i>
                    $20
                  </div>
                </div>
              </div>
              <div class="flex items-center gap-1">
                <a class="btn btn-ghost" href="/dashboard/events/4" title="View"><i data-lucide="eye" class="w-4 h-4"></i></a>
                <a class="btn btn-ghost" href="/dashboard/events/4/edit" title="Edit"><i data-lucide="edit" class="w-4 h-4"></i></a>
                <button class="btn btn-ghost" title="Delete"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
                <button class="btn btn-ghost" title="More"><i data-lucide="more-horizontal" class="w-4 h-4"></i></button>
              </div>
            </div>
          </div> --}}

        </div>
      </div>
    </div>
  </main>

  <!-- Footer -->
  <footer class="border-t bg-white">
    <div class="max-w-6xl mx-auto px-6 py-6 text-sm muted">
      © 2025 My App. All rights reserved.
    </div>
  </footer>

  <script>
    // Initialize Lucide icons
    lucide.createIcons();
  </script>
</body>
</html>
