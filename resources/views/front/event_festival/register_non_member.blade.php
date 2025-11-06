@include('front.layout.header')
<div class="min-h-screen bg-gradient-to-br from-purple-50 to-blue-50">
  <main class="max-w-6xl mx-auto px-6 py-16">

    <div class="text-center mb-6">
          <h2 class="text-2xl font-bold text-gray-900">Complete Your Exhibitor Registration at $144</h2>
          <p class="text-gray-600 mt-2 text-sm">Fill in your details below to join our Healing Community Festival.</p>
        </div>

    <section class="bg-purple-70 backdrop-blur-sm py-12 px-8 rounded-2xl shadow-lg">

      <!-- Flash Message -->
      @if(session('error'))
        <div class="bg-red-100 border border-red-300 text-red-800 px-4 py-3 rounded mb-6 text-center">
          {{ session('error') }}
        </div>
      @endif

      @if(session('success'))
        <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded mb-6 text-center">
          {{ session('success') }}
        </div>
      @endif

      @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
          <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <!-- Form -->
      <form id="joinForm" action="{{ route('festival.register.non.member.store') }}" method="POST" enctype="multipart/form-data" class="max-w-2xl mx-auto space-y-6">
        @csrf
       

        <div class="grid md:grid-cols-2 gap-4">
          <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
            <input id="name" name="name" value="{{ old('name') }}" class="mt-2 block w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-purple-500 focus:outline-none" required>
            @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
          </div>

          <div>
            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
            <input id="title" name="title" value="{{ old('title') }}" class="mt-2 block w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-purple-500 focus:outline-none" required>
            @error('title') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
          </div>
        </div>

        <div>
          <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
          <textarea id="description" name="description" rows="3" class="mt-2 block w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-purple-500 focus:outline-none" required>{{ old('description') }}</textarea>
          @error('description') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
          <label for="website" class="block text-sm font-medium text-gray-700">Website</label>
          <input id="website" name="website" value="{{ old('website') }}" class="mt-2 block w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-purple-500 focus:outline-none" required>
          @error('website') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="grid md:grid-cols-2 gap-4">
          <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" class="mt-2 block w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-purple-500 focus:outline-none" required>
            @error('email') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
          </div>

          <div>
            <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
            <input id="phone" type="tel" name="phone" value="{{ old('phone') }}" class="mt-2 block w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-purple-500 focus:outline-none" required>
            @error('phone') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
          </div>
        </div>

        <div>
          <label for="image" class="block text-sm font-medium text-gray-700">Profile Image</label>
          <input id="image" name="image" type="file" class="mt-2 block w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-purple-500 focus:outline-none" required>
          @error('image') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="text-center pt-6">
          <button type="submit" class="bg-purple-600 text-white px-8 py-3 rounded-full hover:bg-purple-700 font-semibold transition duration-200 shadow-md">
            Join Now
          </button>
        </div>
      </form>
    </section>
  </main>
</div>
@include('front.layout.footer')