@include('front.layout.header')
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Healing Events - Winnipeg Healing Connection</title>
</head>
<body class="flex flex-col min-h-screen bg-white">


 {{-- Hero Section --}}
    <section class="bg-gradient-to-r from-indigo-600 to-indigo-500 text-white py-16">
        <div class="max-w-6xl mx-auto px-6">
            <div class="text-center">
                <h1 class="text-4xl md:text-6xl font-bold mb-4">
                    Find Your Healing Professional
                </h1>
                <p class="text-xl md:text-2xl mb-8 opacity-90">
                    Connect with trusted wellness practitioners in Winnipeg
                </p>
            </div>
        </div>
    </section>

   
    {{-- Results --}}
    <section class="py-12">
        <div class="max-w-6xl mx-auto px-6">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-2xl font-bold text-gray-800">
                    {{-- {{ count($businesses) }} Businesses Found --}}
                </h2>

                {{-- Sort Dropdown --}}
                <!--<select name="sort" onchange="this.form.submit()" class="border rounded-lg px-3 py-2">-->
                <!--    <option value="rating">Highest Rated</option>-->
                <!--    <option value="reviews">Most Reviews</option>-->
                <!--    <option value="name">Name A-Z</option>-->
                <!--    <option value="location">Location</option>-->
                <!--</select>-->
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($businesses as $business)
                    <div class="border rounded-xl shadow hover:shadow-xl transition-all duration-300 overflow-hidden">
                        <div class="relative h-48 overflow-hidden">
                    <img src="{{ asset($business->image) }}" alt="{{ $business->name }}" class="w-full h-full object-cover">
                     @if($business->featured)
                    <div class="absolute top-4 left-4 bg-purple-500 text-white px-2 py-1 rounded text-xs">Featured

                    </div>
                    @endif
                    <!--<div class="absolute top-4 right-4 bg-white/90 rounded-full px-2 py-1 flex items-center gap-1">-->
                    <!--<svg class="h-4 w-4 fill-yellow-400 text-yellow-400" viewBox="0 0 24 24">-->
                    <!--    <path d="M12 .587l3.668 7.431 8.2 1.192-5.934 5.782 1.401 8.17-7.335-3.854-7.335 3.854 1.401-8.17-5.934-5.782 8.2-1.192z"/>-->
                    <!--</svg>-->
                    <!--<span class="text-sm font-medium">{{ $business->rating }}</span>-->
                    <!--</div>-->
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold mb-1">{{ $business->name }}</h3>
                    <span class="text-xs bg-gray-200 px-2 py-1 rounded">{{ $business->category }}</span>
                    <p class="text-gray-600 text-sm mt-2 line-clamp-2">
                    {{ $business->description }}
                    </p>
                    <div class="space-y-2 text-sm text-gray-500 mt-4">
                    <div class="flex items-center gap-2">📍 {{ $business->location }}</div>
                    <div class="flex items-center gap-2">📞 {{ $business->phone }}</div>
                    @if($business->website)
                    <div class="flex items-center gap-2">🌐 {{ $business->website }}</div>
                    @endif
                    <div class="flex items-center gap-2">⏰ {{ $business->hours }}</div>
                    </div>
                    <div class="flex justify-between items-center mt-4 pt-4 border-t">
                    <!--<div class="flex items-center gap-1 text-sm text-gray-500">⭐ {{ $business->rating }} ({{ $business->reviews_count }} reviews)</div>-->
                    <a href="{{ url('business', $business->id) }}" class="bg-purple-500 text-white py-2 px-4 rounded text-sm">View Profile</a>
                    </div>
                </div>
                </div> 

                <!-- End Example Business Card -->
                @endforeach
            </div>
            
        </div>
    </section>



</body>
</html>
@include('front.layout.footer')
