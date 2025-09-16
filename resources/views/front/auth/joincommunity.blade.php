@include('front.layout.header')

<div class="min-h-screen bg-gradient-to-br from-purple-50 to-blue-50">
  <main class="max-w-6xl mx-auto px-6 py-16">
    <!-- Hero --> 
    <h1 class="text-4xl font-bold text-gray-900 text-center">Join Our Healing Community
    </h1>

  <section class="bg-purple-50 py-16 px-6">
  <div class="max-w-6xl mx-auto text-center mb-12">
    <p class="text-xl text-gray-600 max-w-2xl mx-auto">
      Connect with like-minded individuals on your wellness journey and access
      exclusive resources for healing and growth.
    </p>
  </div>
 <!-- Flash Message -->
    @if(session('success'))
      <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded mb-6">
        {{ session('success') }}
      </div>
    @endif
<form id="joinForm" action="{{ route('front.join-community.store') }}" method="POST" class="space-y-8">
  @csrf

  <!-- Membership Options -->
  <div id="membership-options" class="grid md:grid-cols-2 gap-8 max-w-4xl mx-auto">
    
    <!-- Yearly Membership -->
    <label class="block cursor-pointer">
      <input
        type="radio"
        name="membership_type"
        value="yearly"
        class="sr-only peer"
        {{ old('membership_type') === 'yearly' ? 'checked' : '' }}
        required
      >
      <div class="bg-white rounded-xl shadow-md p-6 border border-purple-200 hover:shadow-lg transition 
                  peer-checked:border-purple-600 peer-checked:ring-2 peer-checked:ring-purple-300">
        <h2 class="text-lg font-bold text-gray-900 mb-2">Winnipeg Healing Connection Membership</h2>
        <p class="text-center text-purple-600 font-semibold mb-4 text-sm">Yearly</p>
        <div class="mt-4 mb-2 text-center">
          <span class="text-4xl font-bold text-gray-900">$97</span>
          <span class="text-gray-600 ml-2">per year</span>
        </div>
        <p class="text-gray-600 mb-4 text-sm text-center">
          Full access to our healing community with annual renewal
        </p>
        <ul class="space-y-2 text-left text-sm">
          <li class="flex items-center"><span class="text-green-600 mr-2">✓</span> Access to all healing events and workshops</li>
          <li class="flex items-center"><span class="text-green-600 mr-2">✓</span> Directory of local wellness businesses</li>
          <li class="flex items-center"><span class="text-green-600 mr-2">✓</span> Monthly community newsletter</li>
          <li class="flex items-center"><span class="text-green-600 mr-2">✓</span> Member-only discounts and offers</li>
          <li class="flex items-center"><span class="text-green-600 mr-2">✓</span> Priority event booking</li>
          <li class="flex items-center"><span class="text-green-600 mr-2">✓</span> Community support forums</li>
        </ul>
      </div>
    </label>

    <!-- Lifetime Membership -->
    <label class="block cursor-pointer relative">
      <input
        type="radio"
        name="membership_type"
        value="lifetime"
        class="sr-only peer"
        {{ old('membership_type') === 'lifetime' ? 'checked' : '' }}
      >
      <div class="bg-white rounded-xl shadow-md p-6 border border-purple-200 hover:shadow-lg transition 
                  peer-checked:border-purple-600 peer-checked:ring-2 peer-checked:ring-purple-300">
        <span class="absolute -top-3 left-1/2 transform -translate-x-1/2 bg-purple-600 text-white text-xs px-3 py-0.5 rounded-full shadow-md">
          ⭐ Most Popular
        </span>
        <h2 class="text-lg font-bold text-gray-900 mb-1">Winnipeg Healing Connection Membership</h2>
        <p class="text-purple-600 font-semibold mb-4 text-sm text-center">Lifetime</p>
        <div class="mt-4 mb-2 text-center">
          <span class="text-4xl font-bold text-gray-900">$497</span>
          <span class="text-gray-600 ml-2">one-time</span>
        </div>
        <p class="text-gray-600 mb-4 text-sm text-center">
          Lifetime access to our healing community with exclusive benefits
        </p>
        <ul class="space-y-2 text-left text-sm">
          <li class="flex items-center"><span class="text-green-600 mr-2">✓</span> Everything in Yearly membership</li>
          <li class="flex items-center"><span class="text-green-600 mr-2">✓</span> Lifetime access - never pay again</li>
          <li class="flex items-center"><span class="text-green-600 mr-2">✓</span> Exclusive lifetime member events</li>
          <li class="flex items-center"><span class="text-green-600 mr-2">✓</span> Free guest passes for events</li>
          <li class="flex items-center"><span class="text-green-600 mr-2">✓</span> Direct access to wellness experts</li>
          <li class="flex items-center"><span class="text-green-600 mr-2">✓</span> Legacy member recognition</li>
          <li class="flex items-center"><span class="text-green-600 mr-2">✓</span> Special anniversary celebrations</li>
        </ul>
      </div>
    </label>
  </div>

  @error('membership_type')
    <p class="text-red-500 text-sm text-center">{{ $message }}</p>
  @enderror

  <!-- Signup Form -->
  <div class="max-w-2xl mx-auto bg-white/80 backdrop-blur-sm shadow-lg rounded-xl p-8 space-y-6">
    <div class="text-center mb-6">
      <h2 class="text-2xl font-bold text-gray-900">Complete Your Membership</h2>
    </div>

    <div class="grid md:grid-cols-2 gap-4">
      <div>
        <label for="firstName" class="block text-sm font-medium text-gray-700">First Name</label>
        <input id="firstName" name="firstName" value="{{ old('firstName') }}" class="mt-2 block w-full border rounded-lg px-3 py-2" />
        @error('firstName') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
      </div>
      <div>
        <label for="lastName" class="block text-sm font-medium text-gray-700">Last Name</label>
        <input id="lastName" name="lastName" value="{{ old('lastName') }}" class="mt-2 block w-full border rounded-lg px-3 py-2" />
        @error('lastName') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
      </div>
    </div>

    <div>
      <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
      <input id="email" type="email" name="email" value="{{ old('email') }}" class="mt-2 block w-full border rounded-lg px-3 py-2" />
      @error('email') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
    </div>

    <div>
      <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
      <input id="password" type="password" name="password" class="mt-2 block w-full border rounded-lg px-3 py-2" />
      @error('password') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
    </div>

    <div>
      <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
      <input id="password_confirmation" type="password" name="password_confirmation" class="mt-2 block w-full border rounded-lg px-3 py-2" />
      @error('password_confirmation') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
    </div>

    <div>
      <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
      <input id="phone" type="tel" name="phone" value="{{ old('phone') }}" class="mt-2 block w-full border rounded-lg px-3 py-2" />
      @error('phone') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
    </div>

    <div>
      <label for="interests" class="block text-sm font-medium text-gray-700">Healing Interests (Optional)</label>
      <textarea id="interests" name="interests" class="mt-2 block w-full border rounded-lg px-3 py-2 min-h-[100px]">{{ old('interests') }}</textarea>
    </div>

    <div class="flex items-start space-x-2">
      <input type="checkbox" id="terms" name="terms" class="mt-1" required />
      <label for="terms" class="text-sm text-gray-600">
        I agree to the <a href="#" class="text-purple-600 hover:underline">Terms of Service</a> and
        <a href="#" class="text-purple-600 hover:underline">Privacy Policy</a>
      </label>
      @error('terms') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
    </div>

    <button type="submit" class="w-full bg-purple-600 hover:bg-purple-700 text-white py-3 text-lg rounded-lg">
      Complete Membership Registration
    </button>
  </div>
</form>

    </div>
  </main>
</div>

@include('front.layout.footer')

<script>
  // Default selection = lifetime
  document.getElementById("yearly").classList.add("ring-2", "ring-purple-600");

  // Add click functionality
  const cards = document.querySelectorAll(".membership-card");
  cards.forEach(card => {
    card.addEventListener("click", () => {
      cards.forEach(c => c.classList.remove("ring-2", "ring-purple-600", "shadow-lg", "scale-105"));
      card.classList.add("ring-2", "ring-purple-600", "shadow-lg", "scale-105");
    });
  });
</script>