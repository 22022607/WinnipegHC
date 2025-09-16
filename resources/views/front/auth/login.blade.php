@include('front.layout.header')
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Winnipeg Healing Connection</title>
</head>
<body class="flex flex-col min-h-screen bg-gradient-to-b from-purple-50 to-white">

 

  <!-- Login Form -->
  <main class="flex-grow flex items-center justify-center px-6 py-12">
    <div class="bg-white shadow rounded-xl p-8 max-w-md w-full">
      <h2 class="text-center text-2xl font-bold text-gray-800">Welcome Back</h2>
      <p class="text-center text-gray-500 mb-6">Sign in to your Winnipeg Healing Connection account</p>

      <form action="{{ route('front.login') }}" method="POST" class="space-y-4">
        @csrf
        <div>
          <label class="block text-gray-600 mb-1">Email Address</label>
          <input type="email" name="email" value="{{ old('email') }}"  class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500" placeholder="Enter your email" required>
        </div>
        <div>
          <label class="block text-gray-600 mb-1">Password</label>
          <input type="password" name="password" class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500" placeholder="Enter your password" required>
          <div class="flex justify-between items-center mt-2 text-sm">
            <label class="flex items-center space-x-2">
              <input type="checkbox"  name="remember" class="rounded text-purple-600">
              <span>Remember me</span>
            </label>
          </div>
        </div>
        <button type="submit" class="w-full bg-purple-600 text-white py-2 rounded-lg hover:bg-purple-700">Sign In</button>
      </form>
            <a href="{{ route('front.forgot') }}" class="text-purple-600 hover:underline">Forgot password?</a>

      <p class="text-center text-sm text-gray-600 mt-4">
        Don’t have an account? <a href="membership.html" class="text-purple-600 hover:underline">Join our community</a>
      </p>

      <div class="flex items-center my-6">
        <hr class="flex-grow border-gray-300">
        <span class="mx-4 text-gray-400 text-sm">or continue with</span>
        <hr class="flex-grow border-gray-300">
      </div>

      <div class="flex space-x-4">
         <button class="flex-1 flex items-center justify-center border py-2 rounded-lg hover:bg-gray-50 space-x-2">
            <i class="fab fa-google text-red-500"></i>
            <span>Google</span>
        </button>
         <button class="flex-1 flex items-center justify-center border py-2 rounded-lg hover:bg-gray-50 space-x-2">
            <i class="fab fa-facebook text-blue-600"></i>
            <span>Facebook</span>
        </button>
        
      </div>
    </div>
  </main>

 
</body>
</html>
@include('front.layout.footer')
