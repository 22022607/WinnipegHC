@include('front.layout.header')
<div class="min-h-screen bg-background">

    <main class="max-w-7xl mx-auto px-6 py-8">
        {{-- Welcome Section --}}
        <div class="mb-8">
            <div class="flex items-center gap-4 mb-4">
                <div class="h-16 w-16 rounded-full overflow-hidden">
                    <img src="{{ asset('images/profile-placeholder.svg') }}" alt="Avatar" class="h-full w-full object-cover">
                </div>
                <div>
                    <h1 class="text-3xl font-bold">Welcome back, {{ Auth::user()->name }}</h1>
                    <p class="text-muted-foreground">Member since {{ date('F Y',strtotime(Auth::user()->created_at)) }}</p>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-gray-100 text-gray-800 mt-1">
                        
                    </span>
                </div>
            </div>
        </div>

        {{-- Quick Stats --}}
        <div class="grid md:grid-cols-4 gap-6 mb-8">
            <div class="p-6 bg-white rounded-xl shadow">
                <div class="flex items-center gap-2">
                <!-- Eye Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7Z"/>
                        <circle cx="12" cy="12" r="3"/>
                    </svg>                    <div>
                        <p class="text-2xl font-bold">1,247</p>
                        <p class="text-sm text-muted-foreground">Profile Views</p>
                    </div>
                </div>
            </div>

            <div class="p-6 bg-white rounded-xl shadow">
                <div class="flex items-center gap-2">
                    <!-- Calendar Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <rect width="18" height="18" x="3" y="4" rx="2"/>
                    <line x1="16" x2="16" y1="2" y2="6"/>
                    <line x1="8" x2="8" y1="2" y2="6"/>
                    <line x1="3" x2="21" y1="10" y2="10"/>
                    </svg>                   
                     <div>
                        <p class="text-2xl font-bold">23</p>
                        <p class="text-sm text-muted-foreground">Appointments</p>
                    </div>
                </div>
            </div>

            <div class="p-6 bg-white rounded-xl shadow">
                <div class="flex items-center gap-2">
                    <!-- BarChart3 Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <line x1="3" x2="3" y1="12" y2="20"/>
                    <line x1="12" x2="12" y1="4" y2="20"/>
                    <line x1="21" x2="21" y1="8" y2="20"/>
                    </svg>
                    <div>
                        <p class="text-2xl font-bold">5</p>
                        <p class="text-sm text-muted-foreground">Active Events</p>
                    </div>
                </div>
            </div>

            <div class="p-6 bg-white rounded-xl shadow">
                <div class="flex items-center gap-2">
                <!-- Star Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <polygon points="12 2 15 9 22 9 17 14 19 21 12 17 5 21 7 14 2 9 9 9"/>
                        </svg>                    
                        <div>
                        <p class="text-2xl font-bold">12</p>
                        <p class="text-sm text-muted-foreground">Days Left Spotlight</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Business Profile --}}
        <div class="grid lg:grid-cols-2 gap-8">
            <div class="bg-white rounded-xl shadow p-6">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path d="M3 21h18V7H3v14Z"/>
                    <path d="M7 10h3v4H7v-4Zm7 0h3v4h-3v-4Z"/>
                    </svg>
                 <h3 class="font-semibold">Business Profile</h3>
                <p class="text-sm text-muted-foreground mb-4">Manage your business information and services</p>
                
                <div class="flex items-center justify-between p-4 border rounded-lg">
                    <div>
                        <h3 class="font-medium"></h3>
                        <p class="text-sm text-muted-foreground">Wellness & Healing</p>
                        <span class="px-2 py-1 text-xs rounded border bg-gray-50">Active</span>
                    </div>
                     <a href="#" class="px-3 py-1 border rounded text-sm hover:bg-gray-100 flex items-center gap-1">
                     <!-- Edit Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path d="M12 20h9"/>
                        <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4 12.5-12.5Z"/>
                    </svg>
                    Edit
                    </a>
                </div>
                
                <div class="grid grid-cols-2 gap-3 mt-4">
                    <a href="" class="px-3 py-1 border rounded text-sm text-center">View Profile</a>
                    <a href="" class="px-3 py-1 border rounded text-sm text-center">Add Services</a>
                </div>
            </div>

            {{-- Events --}}
            <div class="bg-white rounded-xl shadow p-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path d="M3 21h18V7H3v14Z"/>
                    <path d="M7 10h3v4H7v-4Zm7 0h3v4h-3v-4Z"/>
                    </svg>
                 <h3 class="font-semibold">  Events Management</h3>
                {{-- <h2 class="flex items-center gap-2 text-lg font-bold">
                    Events Management
                </h2> --}}
                <p class="text-sm text-muted-foreground mb-4">Create and manage your events</p>

                <div class="space-y-3">
                    <div class="flex items-center justify-between p-3 border rounded-lg">
                        <div>
                            <h4 class="font-medium">{{ $user_events->title }}</h4>
                            <p class="text-sm text-muted-foreground">{{ date('F j , Y',strtotime($user_events->date)) }}</p>
                        </div>
                        <span class="px-2 py-1 bg-gray-100 text-xs rounded">Active</span>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3 mt-4">
                    <a href="{{ route('front.event.create') }}" class="px-3 py-1 bg-purple-600 text-white rounded text-sm text-center">New Event</a>
                    <a href="{{ route('front.event.manage') }}" class="px-3 py-1 border rounded text-sm text-center">Manage All</a>
                </div>
            </div>
        </div>

        {{-- Membership & Security sections can follow same structure --}}
    </main>

    
</div>
@include('front.layout.footer')