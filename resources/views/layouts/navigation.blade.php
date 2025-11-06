@php
    $festivalActive = request()->routeIs('admin.festival')
        || request()->routeIs('admin.presenter')
        || request()->routeIs('admin.exhibitor')
        || request()->routeIs('admin.festival-booked-ticket');
@endphp

<nav 
    x-data="{ festivalOpen: {{ $festivalActive ? 'true' : 'false' }} }"
    class="bg-white shadow-md border-r border-gray-200 fixed top-0 left-0 h-full w-[240px] flex flex-col z-50">

    <div class="flex items-center justify-center h-20 border-b">
        <a href="{{ route('dashboard') }}">
            <img src="{{ asset('logo/logo-dk.png') }}" alt="Logo" class="w-44">
        </a>
    </div>

    <div class="flex-1 overflow-y-auto">
        <ul class="py-4 space-y-1 text-gray-700 text-sm">
            <li><x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="block pl-6 py-2 hover:bg-gray-100">Dashboard</x-nav-link></li>
            <li><x-nav-link :href="url('events/index')" :active="request()->routeIs('events.index')" class="block pl-6 py-2 hover:bg-gray-100">Manage Events</x-nav-link></li>
            <li><x-nav-link :href="route('users.index')" :active="request()->routeIs('users.*')" class="block pl-6 py-2 hover:bg-gray-100">Manage Users</x-nav-link></li>
            <li><x-nav-link :href="route('user.spotlight')" :active="request()->routeIs('user.spotlight')" class="block pl-6 py-2 hover:bg-gray-100">Spotlight</x-nav-link></li>
            <li><x-nav-link :href="route('content.index')" :active="request()->routeIs('content.index')" class="block pl-6 py-2 hover:bg-gray-100">Manage Site Content</x-nav-link></li>
            <li><x-nav-link :href="route('business.index')" :active="request()->routeIs('business.index')" class="block pl-6 py-2 hover:bg-gray-100">Manage Businesses</x-nav-link></li>
            <li><x-nav-link :href="route('category')" :active="request()->routeIs('category')" class="block pl-6 py-2 hover:bg-gray-100">Business Categories</x-nav-link></li>
            <li><x-nav-link :href="route('leads')" :active="request()->routeIs('leads')" class="block pl-6 py-2 hover:bg-gray-100">Newsletter Signups</x-nav-link></li>

            {{-- Festival Dropdown --}}
            <li x-data="{ open: festivalOpen }">
                <button @click="open = !open" class="flex items-center justify-between w-full px-6 py-2 text-left hover:bg-gray-100">
                    <span>WHC Festival</span>
                    <svg :class="{ 'rotate-180': open }" class="w-4 h-4 transform transition-transform duration-200"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <ul x-show="open" x-transition x-cloak class="ml-8 mt-1 space-y-1 border-l border-gray-200 pl-3">
                    <li><x-nav-link :href="route('admin.festival')" class="block px-2 py-1 text-sm hover:bg-gray-50">Festival</x-nav-link></li>
                    <li><x-nav-link :href="route('admin.presenter')" class="block px-2 py-1 text-sm hover:bg-gray-50">Presenters</x-nav-link></li>
                    <li><x-nav-link :href="route('admin.exhibitor')" class="block px-2 py-1 text-sm hover:bg-gray-50">Exhibitors</x-nav-link></li>
                    <li><x-nav-link :href="route('admin.festival-booked-ticket')" class="block px-2 py-1 text-sm hover:bg-gray-50">Festival Tickets</x-nav-link></li>
                    <li><x-nav-link :href="route('admin.festival-transactions')" class="block px-2 py-1 text-sm hover:bg-gray-50">Festival Transactions</x-nav-link></li>
                </ul>
            </li>
        </ul>

        {{-- User Dropdown --}}
        <div class="border-t border-gray-200 p-4">
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button class="w-full flex items-center justify-between px-3 py-2 text-sm text-gray-700 bg-white hover:bg-gray-50 rounded-md">
                        <div>{{ Auth::user()->name }}</div>
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                </x-slot>

                <x-slot name="content">
                    <x-dropdown-link :href="route('profile.edit')">{{ __('Profile') }}</x-dropdown-link>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-dropdown-link>
                    </form>
                </x-slot>
            </x-dropdown>
        </div>
    </div>
</nav>

<style>
    [x-cloak] { display: none !important; }
    nav::-webkit-scrollbar { width: 6px; }
    nav::-webkit-scrollbar-thumb { background-color: #c5c5c5; border-radius: 4px; }
</style>