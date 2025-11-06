@include('front.layout.header')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Winnipeg Healing Connection</title>
</head>
<body class="flex flex-col min-h-screen bg-gradient-to-b from-purple-50 to-white">
@if (session('status'))
    <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
        {{ session('status') }}
    </div>
@endif

@if ($errors->any())
    <div class="bg-red-100 text-red-800 px-4 py-2 rounded mb-4">
        <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <!-- Reset Password Form -->
    <main class="flex-grow flex items-center justify-center px-6 py-12">
        <div class="bg-white shadow rounded-xl p-8 max-w-md w-full">
            <h2 class="text-center text-2xl font-bold text-gray-800 mb-4">Reset Password</h2>
            <p class="text-center text-gray-500 mb-6">Enter your new password below to reset your account password.</p>

          <form method="POST" action="{{ url('reset-passwords') }}" class="space-y-4">
            @csrf

            <!-- New Password -->
            <div>
                <label for="newPassword" class="block text-gray-600 mb-1">New Password</label>
                <input type="password" id="newPassword" name="newPassword" required
                    class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500"
                    placeholder="Enter new password">
                @error('newPassword')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div>
                <label for="newPassword_confirmation" class="block text-gray-600 mb-1">Confirm Password</label>
                <input type="password" id="newPassword_confirmation" name="newPassword_confirmation" required
                    class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500"
                    placeholder="Confirm new password">
                @error('newPassword_confirmation')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Token -->
            <input type="hidden" name="token" value="{{ request()->token }}">
            <input type="hidden" name="email" value="{{ request()->email }}">
            @error('token')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror

            <button type="submit"
                    class="w-full bg-purple-600 text-white py-2 rounded-lg hover:bg-purple-700">
                Reset Password
            </button>
        </form>


            <p class="text-center text-sm text-gray-600 mt-4">
                Remembered your password? <a href="{{ url('login') }}" class="text-purple-600 hover:underline">Back to Login</a>
            </p>
        </div>
    </main>

</body>
</html>

@include('front.layout.footer')
