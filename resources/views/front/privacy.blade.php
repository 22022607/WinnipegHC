  @include('front.layout.header')

  <!-- Privacy Policy Section -->
  <section class="py-16 bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <!-- Heading -->
      <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold text-gray-800 mb-8 text-center sm:text-left">
        Privacy Policy
      </h1>

      <!-- Content -->
      <div class="space-y-6 text-gray-700 text-sm sm:text-base leading-relaxed">
        {!! $privacy->content ?? '' !!}
      </div>

    </div>
  </section>



  @include('front.layout.footer')