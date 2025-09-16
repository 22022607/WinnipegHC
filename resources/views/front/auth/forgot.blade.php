@include('front.layout.header')

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Forgot Password - Winnipeg Healing Connection</title>

</head>
<body class="flex flex-col min-h-screen bg-gradient-to-b from-purple-50 to-white">


  <!-- Forgot Password Form -->
  <main class="flex-grow flex items-center justify-center px-6 py-12">
    <div class="bg-white shadow rounded-xl p-8 max-w-md w-full">
      <h2 class="text-center text-2xl font-bold text-gray-800">Forgot Password?</h2>
      <p class="text-center text-gray-500 mb-6">Enter your email address and we’ll send you a link to reset your password.</p>

      <form action="#" method="POST" class="space-y-4">
        <div>
          <label class="block text-gray-600 mb-1">Email Address</label>
          <input type="email" class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500" placeholder="Enter your email" required>
        </div>
        <button type="submit" class="w-full bg-purple-600 text-white py-2 rounded-lg hover:bg-purple-700">Send Reset Link</button>
      </form>

      <p class="text-center text-sm text-gray-600 mt-4">
        Remembered your password? <a href="{{ route('front.login') }}" class="text-purple-600 hover:underline">Back to Login</a>
      </p>
    </div>
  </main>



</body>
</html>
@include('front.layout.footer')
