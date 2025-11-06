@include('front.layout.header')
<main class="min-h-screen bg-gray-50 text-gray-900">
  <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <!-- Back Button -->
    <a href="{{route('memberdashboard')}}" class="inline-flex items-center mb-6 text-gray-600 hover:text-gray-900">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
      </svg>
      Back to Dashboard
    </a>

    <!-- Header -->
    <div class="mb-8">
      <h1 class="text-4xl font-bold mb-2">Security & Settings</h1>
      <p class="text-gray-500">Manage your account security and privacy settings</p>
    </div>

    <!-- Password Settings Section -->
    <section class="bg-white border border-gray-200 rounded-lg p-6 mb-6 shadow-sm">
      <div class="flex items-start gap-3 mb-6">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-700 mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0-1.1-.9-2-2-2m0 0a2 2 0 012-2m-2 2a2 2 0 012 2m4-2a6 6 0 11-12 0 6 6 0 0112 0z" />
        </svg>
        <div>
          <h2 class="text-2xl font-bold mb-1">Password Settings</h2>
          <p class="text-gray-500">Update your password to keep your account secure</p>
        </div>
      </div>
      @if(session('status'))
          <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('status') }}</div>
      @endif

    <form action="{{ route('memberdashboard.update-password') }}" method="POST" class="space-y-4">
      @csrf
      <div class="space-y-4">
        <!-- Current Password -->
      <div>
        <label class="block text-sm font-semibold mb-2">Current Password</label>
        <input type="password" name="current_password" placeholder="Enter your current password"
               class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" />
        @error('current_password') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
      </div>

        <!-- New Password -->
        <div>
          <label class="block text-sm font-semibold mb-2">New Password</label>
          <input type="password" name="password" placeholder="Enter your new password"
                class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" />
          @error('password') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>
        <!-- Confirm Password -->
        <div>
          <label class="block text-sm font-semibold mb-2">Confirm New Password</label>
          <input type="password" name="password_confirmation" placeholder="Confirm your new password"
                class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" />
      </div>

        <!-- Password Requirements -->
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
          <h3 class="font-semibold text-blue-700 mb-2">Password Requirements:</h3>
          <ul class="space-y-1 text-sm text-blue-700">
            <li>• At least 8 characters long</li>
     
          </ul>
        </div>

        <!-- Update Password -->
        <button class="w-full bg-blue-600 text-white font-semibold py-3 px-6 rounded-lg hover:bg-blue-700 transition-colors">
          Update Password
        </button>
        </form>
      </div>
    </section>

    <!-- Two-Factor Authentication -->
    <!--<section class="bg-white border border-gray-200 rounded-lg p-6 mb-6 shadow-sm">-->
    <!--  <div class="flex items-start gap-3 mb-6">-->
    <!--    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-700 mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">-->
    <!--      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h10M7 12h10M7 17h10" />-->
    <!--    </svg>-->
    <!--    <div>-->
    <!--      <h2 class="text-2xl font-bold mb-1">Two-Factor Authentication</h2>-->
    <!--      <p class="text-gray-500">Add an extra layer of security to your account</p>-->
    <!--    </div>-->
    <!--  </div>-->

    <!--  <div class="bg-green-50 border border-green-200 rounded-lg p-4">-->
    <!--    <div class="flex items-start gap-2 mb-3">-->
    <!--      <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-600 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">-->
    <!--        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0-1.1-.9-2-2-2m0 0a2 2 0 012-2m-2 2a2 2 0 012 2m4-2a6 6 0 11-12 0 6 6 0 0112 0z" />-->
    <!--      </svg>-->
    <!--      <div>-->
    <!--        <h4 class="font-semibold text-green-700 mb-1">Two-Factor Authentication is Active</h4>-->
    <!--        <p class="text-sm text-green-600">Your account is protected with two-factor authentication</p>-->
    <!--      </div>-->
    <!--    </div>-->
    <!--    <div class="flex gap-3">-->
    <!--      <button class="border border-gray-300 text-gray-800 font-medium px-4 py-2 rounded-lg hover:bg-gray-100 transition-colors">-->
    <!--        View Recovery Codes-->
    <!--      </button>-->
    <!--      <button class="border border-gray-300 text-gray-800 font-medium px-4 py-2 rounded-lg hover:bg-gray-100 transition-colors">-->
    <!--        Reset Authenticator-->
    <!--      </button>-->
    <!--    </div>-->
    <!--  </div>-->
    <!--</section>-->

    <!-- Account Activity -->
    <!--<section class="bg-white border border-gray-200 rounded-lg p-6 mb-6 shadow-sm">-->
    <!--  <div class="flex items-start gap-3 mb-6">-->
    <!--    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-700 mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">-->
    <!--      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v16h16" />-->
    <!--    </svg>-->
    <!--    <div>-->
    <!--      <h2 class="text-2xl font-bold mb-1">Account Activity</h2>-->
    <!--      <p class="text-gray-500">Monitor recent activity on your account</p>-->
    <!--    </div>-->
    <!--  </div>-->
    <!--  @if(@$user)-->
    <!--  <div class="space-y-3">-->
    <!--    <div class="flex items-start justify-between p-4 bg-gray-50 border border-gray-200 rounded-lg">-->
    <!--      <div>-->
    <!--        <h3 class="font-semibold mb-1">Last login</h3>-->
          
    <!--      </div>-->
    <!--      <span class="bg-blue-600 text-white text-xs font-semibold px-3 py-1 rounded">Current session</span>-->
    <!--    </div>-->

    <!--    <div class="flex items-start justify-between p-4 bg-gray-50 border border-gray-200 rounded-lg">-->
    <!--      <div>-->
    <!--        <h3 class="font-semibold mb-1">Previous login</h3>-->
    <!--        @if(@$user->previous_login_at)-->
    <!--       <p class="text-sm text-gray-500">-->
    <!--            {{ optional($user->previous_login_at)->format('g:i A') ?? '' }} -->
    <!--            from {{ $user->previous_login_ip ?? '' }}-->
    <!--        </p>-->
    <!--        @else-->
    <!--       "NA"-->
    <!--        @endif-->
    <!--      </div>-->
    <!--      <span class="bg-green-600 text-white text-xs font-semibold px-3 py-1 rounded">Success</span>-->
    <!--    </div>-->

    <!--    <div class="flex items-start justify-between p-4 bg-gray-50 border border-gray-200 rounded-lg">-->
    <!--      <div>-->
    <!--        <h3 class="font-semibold mb-1">Password changed</h3>-->
    <!--        <p class="text-sm text-gray-500">-->
    <!--            {{ optional($user->password_changed_at)->format('g:i A') ?? '' }}-->
    <!--        </p>          -->
    <!--      </div>-->
    <!--      <span class="bg-gray-300 text-gray-800 text-xs font-semibold px-3 py-1 rounded">Completed</span>-->
    <!--    </div>-->
    <!--  </div>-->
    <!--  @else-->
    <!--  <p class="text-sm text-gray-500">No recent activity found</p>-->
    <!--  @endif-->
    <!--</section>-->

    <!-- Danger Zone -->
    <!--<section class="bg-white border-2 border-red-500 rounded-lg p-6 shadow-sm">-->
    <!--  <div class="flex items-start gap-3 mb-4">-->
    <!--    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-red-600 mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">-->
    <!--      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M12 4a8 8 0 108 8 8 8 0 00-8-8z" />-->
    <!--    </svg>-->
    <!--    <div>-->
    <!--      <h2 class="text-2xl font-bold text-red-600 mb-1">Danger Zone</h2>-->
    <!--      <p class="text-gray-500">Irreversible actions for your account</p>-->
    <!--    </div>-->
    <!--  </div>-->
      
    <!--  @if($user->dormant_until != null)-->
    <!--  <div class="bg-red-50 border border-red-200 rounded-lg p-5">-->
    <!--    <h3 class="font-bold text-red-600 mb-2">Delete Account</h3>-->
    <!--    <p class="text-sm text-red-500 mb-4">Once you delete your account, there is no going back. Please be certain.</p>-->
    <!--    <form action="{{ route('memberdashboard.delete-account') }}" method="POST" onsubmit="return confirm('Are you sure you want to delete your account? This action cannot be undone.');">-->
    <!--      @csrf-->
         
    <!--    <button id="deleteAccountBtn" type="submit" class="bg-red-600 text-white font-semibold py-2 px-6 rounded-lg hover:bg-red-700 transition-colors">-->
    <!--      Delete Account-->
    <!--    </button>-->
        
    <!--    </form>-->
    <!--  </div>-->
    <!--  @else-->
    <!--  Your account is scheduled for deletion on <strong>{{ \Carbon\Carbon::parse($user->dormant_until)->format('F j, Y') }}</strong>.-->

    <!--  @endif-->
    <!--</section>-->

</main>
@include('front.layout.footer')

<script>
$(document).ready(function() {
    $('#deleteAccountBtn').click(function(e) {
        e.preventDefault();

        // let password = $('#deletePassword').val();
        // if (!password) {
        //     $('#deleteMessage').text('Please enter your password.');
        //     return;
        // }

        $.ajax({
            url: "{{ route('memberdashboard.delete-account') }}", // Your route
            type: "POST",
            data: {
                // password: password,
                _token: "{{ csrf_token() }}"
            },
            beforeSend: function() {
                $('#deleteAccountBtn').attr('disabled', true).text('Processing...');
            },
            success: function(response) {
                $('#deleteMessage').text(response.message).addClass('text-green-600');
                $('#deleteAccountSection').hide();
                // Optional: redirect after a few seconds
                setTimeout(function() {
                    window.location.href = "/";
                }, 3000);
            },
            error: function(xhr) {
                let error = xhr.responseJSON?.errors?.password || 'Something went wrong.';
                $('#deleteMessage').text(error).addClass('text-red-600');
                $('#deleteAccountBtn').attr('disabled', false).text('Delete Account');
            }
        });
    });
});
</script>
