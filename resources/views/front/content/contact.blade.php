@include('front.layout.header')

<div class="min-h-screen bg-gray-50">

  <!-- Main -->
  <main class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

    <!-- Title -->
    <div class="text-center mb-12">
      <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold text-gray-900 mb-4">
        Contact Us
      </h1>
      <p class="text-lg sm:text-xl text-gray-600 max-w-3xl mx-auto">
        We'd love to hear from you. Get in touch for questions, suggestions, or to join our healing community.
      </p>
    </div>

    <div class="grid lg:grid-cols-2 gap-8 lg:gap-12">

      <!-- Contact Form -->
      <div class="bg-white border rounded-xl shadow-lg overflow-hidden">
        <div class="p-6 border-b">
          <h2 class="text-2xl font-semibold text-gray-900">Send us a Message</h2>
        </div>
        <div class="p-6">
          <form class="space-y-6" action="{{ route('contact.store') }}" method="POST">
            @csrf
            <div class="grid md:grid-cols-2 gap-4">
              <div>
                <label for="firstName" class="block text-sm font-medium text-gray-700">First Name *</label>
                <input type="text" id="firstName" name="first_name" required class="mt-2 block w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-purple-500 focus:outline-none" />
              </div>
              <div>
                <label for="lastName" class="block text-sm font-medium text-gray-700">Last Name *</label>
                <input type="text" id="lastName" name="last_name" required class="mt-2 block w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-purple-500 focus:outline-none" />
              </div>
            </div>

            <div>
              <label for="email" class="block text-sm font-medium text-gray-700">Email Address *</label>
              <input type="email" id="email" name="email" required class="mt-2 block w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-purple-500 focus:outline-none" />
            </div>

            <div>
              <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
              <input type="tel" id="phone" name="phone" class="mt-2 block w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-purple-500 focus:outline-none" />
            </div>

            <div>
              <label for="subject" class="block text-sm font-medium text-gray-700">Subject *</label>
              <input type="text" id="subject" name="subject" required class="mt-2 block w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-purple-500 focus:outline-none" />
            </div>

            <div>
              <label for="message" class="block text-sm font-medium text-gray-700">Message *</label>
              <textarea id="message" name="message" required placeholder="Tell us how we can help you..." class="mt-2 block w-full border rounded-lg px-3 py-2 min-h-[120px] focus:ring-2 focus:ring-purple-500 focus:outline-none"></textarea>
            </div>

            <button type="submit" class="w-full bg-purple-600 hover:bg-purple-700 text-white py-3 rounded-lg font-semibold transition">
              Send Message
            </button>
          </form>
        </div>
      </div>

      <!-- Contact Information -->
      <div class="space-y-6">
        @php
          $contactItems = [
            ['icon'=>'📧','title'=>'Email','value'=>$data->email ?? 'info@winnipeghealingconnection.com'],
            ['icon'=>'📞','title'=>'Phone','value'=>$data->phone ?? '(204) 555-0123'],
            ['icon'=>'📍','title'=>'Location','value'=>$data->location ?? ''],
            ['icon'=>'⏰','title'=>'Office Hours','value'=>$data->office_hours ?? ''],
          ];
        @endphp

        @foreach($contactItems as $item)
        <div class="bg-white border rounded-xl shadow p-6 flex items-start space-x-4">
          <span class="text-purple-600 mt-1 text-xl">{{ $item['icon'] }}</span>
          <div>
            <h3 class="font-semibold text-gray-900 mb-2">{{ $item['title'] }}</h3>
            <p class="text-gray-600">{{ $item['value'] }}</p>
          </div>
        </div>
        @endforeach
      </div>
    </div>

    <!-- FAQ Section -->
    <div class="bg-white border rounded-xl shadow mt-12">
      <div class="p-6 border-b text-center">
        <h2 class="text-2xl font-semibold text-gray-900">Frequently Asked Questions</h2>
      </div>
      <div class="p-6 grid md:grid-cols-2 gap-8">
        @foreach($faqs as $faq)
        <div>
          <h4 class="font-semibold text-gray-900 mb-2">{{ $faq->question }}</h4>
          <p class="text-gray-600 text-sm">{{ $faq->answer }}</p>
        </div>
        @endforeach
      </div>
    </div>

  </main>

</div>

@include('front.layout.footer')
