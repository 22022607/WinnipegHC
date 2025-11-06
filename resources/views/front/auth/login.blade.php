@include('front.layout.header')

<div class="flex flex-col min-h-screen bg-gradient-to-b from-purple-50 to-white">

  <!-- Login Form -->
  <main class="flex-grow flex items-center justify-center px-6 py-12">
    <div class="bg-white shadow rounded-xl p-8 max-w-md w-full">
      <h2 class="text-center text-2xl font-bold text-gray-800">Welcome Back</h2>
      <p class="text-center text-gray-500 mb-6">Sign in to your Winnipeg Healing Connection account</p>

      <!-- Flash / Error Messages -->
      @if(session('error'))
        <div class="bg-red-100 border border-red-300 text-red-800 px-4 py-2 rounded mb-4 text-center">
          {{ session('error') }}
        </div>
      @endif
      @if($errors->any())
        <div class="bg-red-100 border border-red-300 text-red-800 px-4 py-2 rounded mb-4 text-center">
          {{ $errors->first() }}
        </div>
      @endif

      <form action="{{ route('user.login') }}" method="POST" class="space-y-4">
        @csrf
        <div>
          <label class="block text-gray-600 mb-1">Email Address</label>
          <input type="email" name="email" value="{{ old('email') }}" required
                 class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2"
                 placeholder="Enter your email">
        </div>

        <div>
          <label class="block text-gray-600 mb-1">Password</label>
          <input type="password" name="password" required
                 class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2"
                 placeholder="Enter your password">
          <div class="flex justify-between items-center mt-2 text-sm">
            <label class="flex items-center space-x-2">
              <input type="checkbox" name="remember" class="rounded text-purple-600">
              <span>Remember me</span>
            </label>
          </div>
        </div>

        <button type="submit" class="w-full bg-purple-600 text-white py-2 rounded-lg hover:bg-purple-700 transition">
          Sign In
        </button>
      </form>

      <div class="mt-4 text-center space-y-2">
        <a href="{{ url('forget-password') }}" class="text-purple-600 hover:underline block">Forgot password?</a>
        <p class="text-gray-600 text-sm">
          Don’t have an account? <a href="{{ url('join-community') }}" class="text-purple-600 hover:underline">Join our community</a>
        </p>
      </div>

    </div>
  </main>

</div>

@include('front.layout.footer')
