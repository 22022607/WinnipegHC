@include('front.layout.header')
 <section class="bg-gradient-to-r from-indigo-600 to-indigo-500 text-white py-16">
        <div class="max-w-6xl mx-auto px-6">
            <div class="text-center">
                <h1 class="text-4xl md:text-6xl font-bold mb-4">
                    Business Category
                </h1>
               
            </div>
        </div>
    </section>
<section class="max-w-6xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
  <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3">
    @foreach ($categories as $category)
      <div class="bg-white rounded-lg px-3 py-2 text-sm text-gray-700 hover:bg-purple-100 hover:text-purple-700 transition-colors cursor-pointer shadow-sm text-center">
        <a href="#" class="text-xs sm:text-sm text-blue-800 hover:underline truncate block">
          {{ $category->name }}
        </a>
      </div>
    @endforeach
  </div>
</section>
@include('front.layout.footer')