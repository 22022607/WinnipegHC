@include('front.layout.header')
<div class="min-h-screen bg-background">

    <main class="max-w-7xl mx-auto px-6 py-8">
        {{-- Welcome Section --}}
        <div class="mb-8">
            <div class="flex items-center gap-4 mb-4">
                <!--<div class="h-16 w-16 rounded-full overflow-hidden">-->
                <!--    <img src="{{ asset('images/profile-placeholder.svg') }}" alt="Avatar" class="h-full w-full object-cover">-->
                <!--</div>-->
                <div>

                    <h1 class="text-3xl font-bold">Welcome back, {{ Auth::guard('member')->user()->first_name . ' ' . Auth::guard('member')->user()->last_name }}</h1>
                    <p class="text-muted-foreground">Member since {{ date('F Y',strtotime(Auth::guard('member')->user()->created_at)) }}</p>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-gray-100 text-gray-800 mt-1">
                        
                    </span>
                </div>
               
            </div>
        </div>

        {{-- Quick Stats --}}
        <div class="grid md:grid-cols-4 gap-6 mb-8">
            {{-- <div class="p-6 bg-white rounded-xl shadow">
                <div class="flex items-center gap-2">
               
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7Z"/>
                        <circle cx="12" cy="12" r="3"/>
                    </svg>                    <div>
                        <!--<p class="text-2xl font-bold">1,247</p>-->
                        <!--<p class="text-sm text-muted-foreground">Profile Views</p>-->
                    </div>
                </div>
            </div> --}}

            <!--<div class="p-6 bg-white rounded-xl shadow">-->
            <!--    <div class="flex items-center gap-2">-->
                    <!-- Calendar Icon -->
            <!--        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">-->
            <!--        <rect width="18" height="18" x="3" y="4" rx="2"/>-->
            <!--        <line x1="16" x2="16" y1="2" y2="6"/>-->
            <!--        <line x1="8" x2="8" y1="2" y2="6"/>-->
            <!--        <line x1="3" x2="21" y1="10" y2="10"/>-->
            <!--        </svg>                   -->
            <!--          <div class="flex items-center justify-between">-->
            <!--            <div>-->
            <!--                <p class="text-2xl font-bold">{{ count($appointments) }}</p>-->
            <!--                <p class="text-sm text-muted-foreground">Appointments</p>-->
            <!--            </div>-->
            <!--            <a href="{{ route('memberdashboard.business.viewappointments') }}"-->
            <!--              class="px-4 py-2 text-sm font-medium text-white bg-purple-600 rounded-lg hover:bg-purple-700 transition ml-4">-->
            <!--                View-->
            <!--            </a>-->
            <!--        </div>-->
            <!--    </div>-->
            <!--</div>-->

            <div class="p-6 bg-white rounded-xl shadow">
                <div class="flex items-center gap-2">
                    <!-- BarChart3 Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <line x1="3" x2="3" y1="12" y2="20"/>
                    <line x1="12" x2="12" y1="4" y2="20"/>
                    <line x1="21" x2="21" y1="8" y2="20"/>
                    </svg>
                    <div>
                        <p class="text-2xl font-bold">{{$event_count}}</p>
                        <p class="text-sm text-muted-foreground">Active Events</p>
                    </div>
                </div>
            </div>

            <!--<div class="p-6 bg-white rounded-xl shadow">-->
            <!--    <div class="flex items-center gap-2">-->
                <!-- Star Icon -->
            <!--            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">-->
            <!--            <polygon points="12 2 15 9 22 9 17 14 19 21 12 17 5 21 7 14 2 9 9 9"/>-->
            <!--            </svg>                    -->
            <!--            <div>-->
            <!--            <p class="text-2xl font-bold">{{ @$business_spotlight->remaining_days ?? ''}}</p>-->
            <!--            <p class="text-sm text-muted-foreground">Days Left Spotlight</p>-->
            <!--        </div>-->
            <!--    </div>-->
            <!--</div>-->
        </div>

        {{-- Business Profile --}}
         
         <div class="grid lg:grid-cols-2 gap-8">
             @if($business_profile)
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
                        <p class="text-sm text-muted-foreground">{{ @$business_profile->name ?? '' }}</p>
                        <span class="px-2 py-1 text-xs rounded border bg-gray-50">Active</span>
                    </div>
                  
                    <!-- <a href="{{ route('memberdashboard.business-profile') }}" class="px-3 py-1 border rounded text-sm hover:bg-gray-100 flex items-center gap-1">-->
                     <!-- Edit Icon -->
                    <!--<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">-->
                    <!--    <path d="M12 20h9"/>-->
                    <!--    <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4 12.5-12.5Z"/>-->
                    <!--</svg>-->
                    <!--Edit-->
                    <!--</a>-->
                    
                </div>
                
                <!--<div class="grid grid-cols-2 gap-3 mt-4 items-center">-->
                 <a href="{{ route('memberdashboard.business-profile') }}"
                   class="block w-full mt-4 text-center text-sm font-medium border border-gray-300 text-gray-700 rounded-md py-2 hover:bg-gray-100">
                   View Profile
                </a>
    


                <!--</div>-->
            </div>
            @else
            <div class="bg-white rounded-xl shadow p-6">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path d="M3 21h18V7H3v14Z"/>
                    <path d="M7 10h3v4H7v-4Zm7 0h3v4h-3v-4Z"/>
                    </svg>
                 <h3 class="font-semibold">Business Profile</h3>
                <p class="text-sm text-muted-foreground mb-4">Manage your business information and services</p>
                 
              
                
                <!--<div class="grid grid-cols-2 gap-3 mt-4 items-center">-->
                 <a href="{{ route('memberdashboard.business-profile') }}"
                   class="block w-full mt-4 text-center text-sm font-medium border border-gray-300 text-gray-700 rounded-md py-2 hover:bg-gray-100 " style=" margin-top: 90px;">
                   View Profile
                </a>
    


                <!--</div>-->
            </div>
            @endif

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
               
                    @if(@$user_events)   
                <div class="space-y-3">
                    <div class="flex items-center justify-between p-3 border rounded-lg">
                        <div>
                            <h4 class="font-medium">{{@$user_events->title ?? ''}}</h4>
                         
                            <p class="text-sm text-muted-foreground">{{ date('F j , Y',strtotime(@$user_events->date))  ?? ''}}</p>

                        </div>
                        <span class="px-2 py-1 bg-gray-100 text-xs rounded">Active</span>
                    </div>
                </div>
                @endif
                <div class="grid grid-cols-2 gap-3 mt-4">
                    <a href="{{ route('memberdashboard.events') }}" class="px-3 py-1 bg-purple-600 text-white rounded text-sm text-center">New Event</a>
                    <a href="{{ route('memberdashboard.events.manage') }}" class="px-3 py-1 border rounded text-sm text-center">Manage All</a>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-8">
  <!-- Membership & Payments -->
  <div class="bg-white shadow rounded-lg p-6 space-y-4">
    <div class="mb-4">
      <h2 class="text-lg font-semibold flex items-center gap-2">
        <svg class="h-5 w-5 text-gray-600" fill="none" stroke="currentColor" stroke-width="2"
             viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M20 7H4m16 0v10a2 2 0 01-2 2H6a2 2 0 01-2-2V7m16 0L12 13 4 7"/>
        </svg>
        Membership & Payments
      </h2>
      <p class="text-sm text-gray-500">Manage your subscription and payment methods</p>
    </div>

    <div class="p-4 border rounded-lg bg-green-50">
      <div class="flex items-center justify-between">
        <div>
          <h3 class="font-medium text-green-800">{{ @$userMembership->membership->name ?? ''}}</h3>
          <p class="text-sm text-green-600">
            Active since {{ \Carbon\Carbon::parse(@$userMembership->start_date)->format('F Y') }}
          </p>
        </div>
        <span class="text-sm bg-green-100 text-green-800 px-2 py-1 rounded">Active</span>
      </div>
    </div>

    <div class="space-y-2">
      <p class="text-sm font-medium">Payment Method</p>
      <div class="flex items-center gap-2 text-sm text-gray-500">
        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" 
             viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M3 6h18M3 14h18M3 18h18"/>
        </svg>
        **** **** **** 4242
      </div>
    </div>

    <a href="{{ url('member-dashboard/subscription') }}" class="block w-full mt-4 text-center text-sm font-medium border border-gray-300 text-gray-700 rounded-md py-2 hover:bg-gray-100">
      Manage Subscription
    </a>
  </div>

  <!-- Security & Settings -->
  <div class="bg-white shadow rounded-lg p-6 space-y-4">
    <div class="mb-4">
      <h2 class="text-lg font-semibold flex items-center gap-2">
        <svg class="h-5 w-5 text-gray-600" fill="none" stroke="currentColor" stroke-width="2"
             viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M12 11c0-1.105.895-2 2-2s2 .895 2 2c0 1.105-.895 2-2 2s-2-.895-2-2zm0 0V8m0 3v3"/>
        </svg>
        Security & Settings
      </h2>
      <p class="text-sm text-gray-500">Password, privacy, and account settings</p>
    </div>

    <!--<div class="space-y-3">-->
    <!--  <div class="flex items-center justify-between text-sm">-->
    <!--    <span>Password</span>-->
    <!--    <span class="text-gray-500">Updated 30 days ago</span>-->
    <!--  </div>-->
    <!--  <div class="flex items-center justify-between text-sm">-->
    <!--    <span>Two-factor authentication</span>-->
    <!--    <span class="border border-gray-300 px-2 py-0.5 rounded text-gray-700 text-xs">Enabled</span>-->
    <!--  </div>-->
    <!--</div>-->

    <hr class="my-4 border-gray-200" />

    <a href="{{ url('member-dashboard/security') }}" style="
    margin-top: 156px;" class="block w-full text-center text-sm font-medium border border-gray-300 text-gray-700 rounded-md py-2 hover:bg-gray-100" >
      Security Settings
    </a>
  </div>
</div>



        {{-- Membership & Security sections can follow same structure --}}
    </main>

    
</div>
@include('front.layout.footer')