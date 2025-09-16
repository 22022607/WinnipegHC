<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Winnipeg Healing Connection</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="bg-gray-50 text-gray-800">

  <!-- Navbar -->
  <header class="bg-white shadow">
    <div class="container mx-auto flex justify-between items-center py-4 px-6">
      <a href="index.html" class="flex items-center space-x-2">
        <img src="{{ asset('logo/logo-dk.png') }}" alt="Logo" class="block h-9 w-auto" />
      </a>
      <nav class="space-x-6 font-medium">
        <a href="{{ route('front.index') }}" class="hover:text-purple-600">Home</a>
        <a href="{{ route('front.event.index') }}" class="hover:text-purple-600">Events</a>
        <a href="{{ route('front.business.index') }}" class="hover:text-purple-600">Businesses</a>
        <a href="{{ route('front.content.about') }}" class="hover:text-purple-600">About</a>
        <a href="{{ route('front.content.contact') }}" class="hover:text-purple-600">Contact</a>
      </nav>
      <div class="space-x-4">
        <a href="{{ route('front.login') }}" class="border px-4 py-2 text-purple rounded-lg hover:bg-purple-50">Member Login</a>
        <a href="{{ route('front.join-community.create') }}" class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700">Join Community</a>
      </div>
    </div>
  </header>

  



</body>
</html>
