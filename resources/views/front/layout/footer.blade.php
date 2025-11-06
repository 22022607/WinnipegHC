<!-- Footer -->
<footer class="bg-purple-700 text-white mt-12">
  <div class="container mx-auto py-10 px-6 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
    
    <!-- About -->
    <div>
         <a href="{{ url('/') }}" class="flex items-center space-x-2">
        <img src="{{ asset('logo/logo-dk.png') }}" alt="Logo" class="block h-9 w-auto" />
      </a>
      <!--<h3 class="font-bold text-lg flex items-center gap-2">-->
      <!--  <i class="fa-regular fa-heart"></i> Winnipeg Healing Connection-->
      <!--</h3>-->
      <p class="mt-2 mb-4 text-sm">
        Building a supportive community where mental health professionals and individuals connect for healing, growth, and wellness in Winnipeg.
      </p>
      <div class="flex space-x-4 text-xl">
        <a href="https://www.facebook.com/WinnipegHealingConnection/" class="hover:text-gray-300"><i class="fab fa-facebook"></i></a>
       
      </div>
    </div>

    <!-- Useful Links -->
    <div>
      <h4 class="font-semibold">Useful Links</h4>
      <ul class="mt-2 space-y-2 text-sm">
        <li><a href="{{route('event')}}" class="hover:underline">Events</a></li>
        <li><a href="{{route('business')}}" class="hover:underline">Business List</a></li>
        <li><a href="#" class="hover:underline">Festival</a></li>
        <li><a href="{{route('business-category')}}" class="hover:underline">Business Category</a></li>
      </ul>
    </div>

    <!-- For Member -->
    <div>
      <h4 class="font-semibold">Member</h4>
      <ul class="mt-2 space-y-2 text-sm">
        @if(Auth::guard('member')->check())
        <li>
          <form action="{{ route('member.logout') }}" method="POST">
            @csrf
            <button type="submit" class="hover:underline">
                Logout
            </button>
        </form>
      </li>
        @else
        <li><a href="{{route('user.login')}}" class="hover:underline">Login</a></li>
        @endif
        <li><a href="{{ route('membership.levels') }}" class="hover:underline">Get Membership</a></li>
     @guest
     <li><a href="{{ url('join-community') }}" class="hover:underline">Dashboard</a></li>
    @endguest

    @auth
    <li><a href="{{ url('front/member-dashboard') }}" class="hover:underline">Dashboard</a></li>
    @endauth


       
      </ul>
    </div>
  </div>

  <!-- Bottom Bar -->
  <div class="bg-purple-800 text-white text-sm py-4">
    <div class="container mx-auto px-6 flex flex-col md:flex-row justify-between items-center space-y-3 md:space-y-0">
      <p class="text-center md:text-left">&copy; 2025 Winnipeg Healing Connection. All rights reserved.</p>
      <div class="flex flex-wrap justify-center md:justify-end space-x-4">
        <a href="{{ url('privacy') }}" class="hover:underline">Privacy Policy</a>
        <a href="{{ url('terms') }}" class="hover:underline">Terms of Service</a>
        <a href="{{ url('contact') }}" class="hover:underline">Contact</a>
      </div>
    </div>
  </div>
</footer>

<script src="https://cdn.tailwindcss.com"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    @if(session('success'))
        const toast = document.getElementById('toast');
        toast.textContent = "{{ session('success') }}";
        toast.classList.remove('opacity-0');
        toast.classList.add('opacity-100');

        // Hide after 3 seconds
        setTimeout(() => {
            toast.classList.remove('opacity-100');
            toast.classList.add('opacity-0');
        }, 5000);
    @endif
</script>