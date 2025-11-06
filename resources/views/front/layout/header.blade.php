<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Winnipeg Healing Connection</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="icon" href="{{ asset('favicon-96x96.png') }}" type="image/png">
    <!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-50 text-gray-800">

  <!-- Navbar -->
  <header class="bg-white shadow">
    <div class="container mx-auto flex justify-between items-center py-4 px-6">
      
      <!-- Logo -->
      <a href="{{ url('/') }}" class="flex items-center space-x-2">
        <img src="{{ asset('logo/logo-dk.png') }}" alt="Logo" class="block h-9 w-auto" />
      </a>

      <!-- Desktop Nav -->
      <nav class="hidden md:flex items-center space-x-6 font-medium">
      <a href="{{ url('/') }}" class="hover:text-purple-600">Home</a>

      <!-- Festivals Dropdown -->
      <div class="relative group">
        <!-- Main link -->
        <a href="" 
          class="hover:text-purple-600 px-3 py-2 font-semibold inline-flex items-center">
          Festivals
          <svg class="ml-1 w-4 h-4 transform group-hover:rotate-180 transition duration-200" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
          </svg>
        </a>

        <!-- Dropdown -->
        <div class="absolute left-0 top-full mt-[2px] hidden group-hover:block bg-white shadow-lg rounded-md w-56 z-50">
          <a href="{{ url('festival/overview') }}" 
            class="block px-4 py-2 rounded-md transition-colors duration-200 
                    text-gray-700 hover:bg-gray-100 
                    {{ request()->is('festival/overview') ? 'bg-purple-100 text-purple-700 font-semibold' : '' }}">
            Overview 2025
          </a>
          <a href="{{ url('festival/tickets') }}" 
            class="block px-4 py-2 rounded-md transition-colors duration-200 
                    text-gray-700 hover:bg-gray-100 
                    {{ request()->is('festival/tickets') ? 'bg-purple-100 text-purple-700 font-semibold' : '' }}">
            Tickets
          </a>
            <a href="{{ url('festival/presenters') }}" 
              class="block px-4 py-2 rounded-md transition-colors duration-200 
                      text-gray-700 hover:bg-gray-100 
                      {{ request()->is('festival/presenters') ? 'bg-purple-100 text-purple-700 font-semibold' : '' }}">
            Presenters 2025
          </a>
          <a href="{{ url('festival/exhibitors') }}" 
              class="block px-4 py-2 rounded-md transition-colors duration-200 
                      text-gray-700 hover:bg-gray-100 
                      {{ request()->is('festival/exhibitors') ? 'bg-purple-100 text-purple-700 font-semibold' : '' }}">
            Exhibitors 2025
          </a>
          <a href="{{ url('festival/exhibitor-tables') }}" 
              class="block px-4 py-2 rounded-md transition-colors duration-200 
                      text-gray-700 hover:bg-gray-100 
                      {{ request()->is('festival/exhibitor-tables') ? 'bg-purple-100 text-purple-700 font-semibold' : '' }}">
            Exhibitor Tables to Rent
          </a>

         
        </div>
      </div>

      <a href="{{ url('event') }}" class="hover:text-purple-600">Events</a>
      <a href="{{ url('business') }}" class="hover:text-purple-600">Businesses</a>
      <a href="{{ url('about') }}" class="hover:text-purple-600">About</a>
      <a href="{{ url('contact') }}" class="hover:text-purple-600">Contact</a>
    </nav>


      <!-- Desktop Buttons -->
      <div class="hidden md:flex space-x-4">
          @if(Auth::guard('member')->check())
          <div class="flex items-center space-x-4">
        
            <form action="{{ route('member.logout') }}" method="POST">
                @csrf
                <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700">Logout</button>
            </form>
        </div>
        @else
        <a href="{{ route('user.login') }}" class="border px-4 py-2 rounded-lg hover:bg-purple-50 text-purple-600">Member Login</a>
        @endif
        <a href="{{ url('join-community') }}" class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700">Join Community</a>
      </div>

      <!-- Mobile Menu Button -->
      <button id="menu-btn" class="md:hidden text-2xl focus:outline-none">
        <i class="fa-solid fa-bars"></i>
      </button>
    </div>

    <!-- Mobile Menu (hidden by default) -->
    <div id="mobile-menu" class="hidden md:hidden bg-white border-t">
      <nav class="flex flex-col space-y-3 px-6 py-4 font-medium">
        <a href="{{ url('/') }}" class="hover:text-purple-600">Home</a>
        <a href="{{ url('event') }}" class="hover:text-purple-600">Events</a>
        <a href="{{ url('business') }}" class="hover:text-purple-600">Businesses</a>
        <a href="{{ url('about') }}" class="hover:text-purple-600">About</a>
        <a href="{{ url('contact') }}" class="hover:text-purple-600">Contact</a>
        <a href="{{ route('user.login') }}" class="border px-4 py-2 rounded-lg hover:bg-purple-50 text-purple-600 text-center">Member Login</a>
        <a href="{{ url('join-community') }}" class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 text-center">Join Community</a>
      </nav>
    </div>
  </header>

  <!-- Script to toggle mobile menu -->
  <script>
    const menuBtn = document.getElementById("menu-btn");
    const mobileMenu = document.getElementById("mobile-menu");

    menuBtn.addEventListener("click", () => {
      mobileMenu.classList.toggle("hidden");
    });
  </script>

</body>
</html>
