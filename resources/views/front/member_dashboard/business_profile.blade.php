@include('front.layout.header')

<style>
  .tab-content { display: none; }
  .tab-content.active { display: block; }
  .tab-button.active {
    background-color: #2563eb;
    color: white;
  }
</style>

<main class="flex-1 max-w-4xl mx-auto px-6 py-10">



  <!-- Back Button -->
  <a href="{{ route('memberdashboard') }}" class="inline-flex items-center mb-6 text-gray-600 hover:text-gray-900">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
    </svg>
    Back to Dashboard
  </a>

  <div class="mb-8 flex items-center justify-between flex-wrap gap-3">
      <div>
        <h2 class="text-3xl font-bold mb-1">Business Profile</h2>
        <p class="text-gray-500">Manage your business information and services</p>
      </div>

      <!-- ðŸ’¾ Save Changes Button -->
      <button type="submit" form="businessForm"
        class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 shadow-md transition transform hover:scale-[1.02]">
        ðŸ’¾ Save Changes
      </button>
    </div>

  <!-- ðŸ”¹ Show success or error messages -->
  @if (session('status'))
    <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
      {{ session('status') }}
    </div>
  @endif

  @if ($errors->any())
    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg">
      <ul class="list-disc pl-5">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <!-- ðŸ”¹ Start Single Form -->
  <form id="businessForm" action="{{ route('memberdashboard.business-profile.add') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="business_id" value="{{ @$data->id }}">

    <!-- Tabs -->
    <div class="space-y-6">
      <div class="grid grid-cols-3 border rounded-lg overflow-hidden text-center">
        <button type="button" class="tab-button py-4 active" data-tab="basic">Basic Info</button>
        <button type="button" class="tab-button py-4" data-tab="services">Social Media Links</button>
        <button type="button" class="tab-button py-4" data-tab="gallery">Gallery</button>
      </div>

      <!-- BASIC INFO TAB -->
      <div id="basic" class="tab-content active bg-white rounded-xl shadow p-6 space-y-6">
        <h3 class="text-xl font-semibold">Basic Information</h3>
        <p class="text-gray-500">Update your business details and contact information</p>

        <div class="grid md:grid-cols-2 gap-4">
          <div>
            <label class="block text-sm font-medium mb-1">Business Name *</label>
            <input type="text" name="business_name" 
              value="{{ old('business_name', $data->name ?? '') }}" 
              class="w-full border rounded-lg p-2 @error('business_name') border-red-500 @enderror" />
          </div>
          <div>
            <label class="block text-sm font-medium mb-1">Category</label>
            <input type="text" name="business_category" 
              value="{{ old('business_category', $data->category ?? '') }}" 
              class="w-full border rounded-lg p-2" />
          </div>
        </div>

        <div>
          <label class="block text-sm font-medium mb-1">Description *</label>
          <textarea rows="4" name="business_description" class="w-full border rounded-lg p-2 @error('business_description') border-red-500 @enderror">{{ old('business_description', $data->description ?? '') }}</textarea>
        </div>

        <hr class="my-4">

        <h4 class="text-lg font-semibold">Contact Information</h4>

        <div class="grid md:grid-cols-2 gap-4">
          <div>
            <label class="block text-sm font-medium mb-1">Phone Number *</label>
            <input type="text" name="business_phone" 
              value="{{ old('business_phone', $data->phone ?? '') }}" 
              class="w-full border rounded-lg p-2 @error('business_phone') border-red-500 @enderror" />
          </div>
          <div>
            <label class="block text-sm font-medium mb-1">Email *</label>
            <input type="email" name="business_email" 
              value="{{ old('business_email', $data->email ?? '') }}" 
              class="w-full border rounded-lg p-2 @error('business_email') border-red-500 @enderror" />
          </div>
        </div>

        <div>
          <label class="block text-sm font-medium mb-1">Website</label>
          <input type="text" name="business_website" 
            value="{{ old('business_website', $data->website ?? '') }}" 
            class="w-full border rounded-lg p-2" />
        </div>

        <div>
          <label class="block text-sm font-medium mb-1">Address *</label>
          <textarea rows="2" name="business_address" 
            class="w-full border rounded-lg p-2 @error('business_address') border-red-500 @enderror">{{ old('business_address', $data->location ?? '') }}</textarea>
        </div>
      </div>

      <!-- SOCIAL MEDIA TAB -->
      <div id="services" class="tab-content bg-white rounded-xl shadow p-6 space-y-6">
        <h3 class="text-xl font-semibold">Social Media Links</h3>
        <p class="text-gray-500">Save your social media links</p>

        <div class="space-y-4">
          <div>
            <label class="block text-sm font-medium mb-1">Twitter</label>
            <input type="text" name="business_twitter"
                  value="{{ old('business_twitter', $data->twitter ?? '') }}"
                  class="w-full border rounded-lg p-2" />
          </div>

          <div>
            <label class="block text-sm font-medium mb-1">LinkedIn</label>
            <input type="text" name="business_linkedin"
                  value="{{ old('business_linkedin', $data->linkedin ?? '') }}"
                  class="w-full border rounded-lg p-2" />
          </div>

          <div>
            <label class="block text-sm font-medium mb-1">Instagram</label>
            <input type="text" name="business_instagram"
                  value="{{ old('business_instagram', $data->instagram ?? '') }}"
                  class="w-full border rounded-lg p-2" />
          </div>

          <div>
            <label class="block text-sm font-medium mb-1">Facebook</label>
            <input type="text" name="business_facebook"
                  value="{{ old('business_facebook', $data->facebook ?? '') }}"
                  class="w-full border rounded-lg p-2" />
          </div>
      </div>

      </div>

      <!-- GALLERY TAB -->
      <div id="gallery" class="tab-content bg-white rounded-xl shadow p-6 space-y-6">
        <h3 class="text-xl font-semibold">Business Gallery</h3>
        <p class="text-gray-500">Upload photos of your business, services, and workspace</p>

        <!-- Featured Image -->
        <div>
          <label class="block mb-2 font-medium">Featured Image</label>
          <input type="file" name="featured_image" class="w-full border rounded-lg p-2">
          @if(isset($data->featured_image))
            <img src="{{ asset($data->featured_image) }}" alt="Featured" class="mt-2 w-48 h-48 object-cover rounded-lg">
          @endif
        </div>

        <!-- Additional Images -->
        <div>
          <label class="block mb-2 font-medium">Additional Images</label>
          <input type="file" name="additional_images" class="w-full border rounded-lg p-2">
          <div class="grid md:grid-cols-3 gap-4 mt-4">
            @if(isset($data->additional_images))
              <img src="{{ asset($data->additional_images) }}" alt="additional" class="mt-2 w-48 h-48 object-cover rounded-lg">
            @else
              <div class="aspect-square bg-gray-100 rounded-lg flex items-center justify-center text-gray-400">Upload photos</div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </form>
  <!-- ðŸ‘† End Single Form -->

</main>

<!-- Tabs Script -->
<script>
  const tabButtons = document.querySelectorAll('.tab-button');
  const tabContents = document.querySelectorAll('.tab-content');

  tabButtons.forEach(button => {
    button.addEventListener('click', () => {
      const tab = button.dataset.tab;
      tabButtons.forEach(btn => btn.classList.remove('active'));
      tabContents.forEach(content => content.classList.remove('active'));
      button.classList.add('active');
      document.getElementById(tab).classList.add('active');
    });
  });
</script>

@include('front.layout.footer')
