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

    {{-- Search & Filters --}}
    <section class="py-8 bg-gray-100">
        <div class="max-w-6xl mx-auto px-6">
            <div class="bg-white rounded-lg p-6 shadow-lg">
                <form method="GET" action="{{ route('front.business.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">

                    {{-- Search --}}
                    <div class="relative">
                        <input 
                            type="text" 
                            name="search" 
                            placeholder="Search businesses..." 
                            value="{{ request('search') }}"
                            class="pl-10 pr-3 py-2 w-full border rounded-lg focus:ring focus:ring-indigo-300"
                        >
                        <svg class="absolute left-3 top-3 h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>

                    {{-- Category --}}
                    <select name="category" class="border rounded-lg px-3 py-2">
                        <option value="all">All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>
                                {{ $category }}
                            </option>
                        @endforeach
                    </select>

                    {{-- Location --}}
                    <select name="location" class="border rounded-lg px-3 py-2">
                        <option value="all">All Locations</option>
                        @foreach($locations as $location)
                            <option value="{{ $location }}" {{ request('location') == $location ? 'selected' : '' }}>
                                {{ $location }}
                            </option>
                        @endforeach
                    </select>

                    {{-- More Filters Button --}}
                    <button type="button" class="border rounded-lg py-2 px-4 flex items-center gap-2">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L14 14.414V20a1 1 0 
                            01-1.447.894l-4-2A1 1 0 018 18v-3.586L3.293 6.707A1 1 0 013 6V4z"/></svg>
                        More Filters
                    </button>
                </form>
            </div>
        </div>
    </section>

    {{-- Results --}}
    <section class="py-12">
        <div class="max-w-6xl mx-auto px-6">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-2xl font-bold text-gray-800">
                    {{ count($businesses) }} Businesses Found
                </h2>

                {{-- Sort Dropdown --}}
                <select name="sort" onchange="this.form.submit()" class="border rounded-lg px-3 py-2">
                    <option value="rating">Highest Rated</option>
                    <option value="reviews">Most Reviews</option>
                    <option value="name">Name A-Z</option>
                    <option value="location">Location</option>
                </select>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($businesses as $business)
                    <a href="{{ route('businesses.show', $business->id) }}">
                        <div class="bg-white rounded-xl overflow-hidden shadow hover:shadow-xl transition transform hover:scale-105">
                            {{-- Image --}}
                            <div class="relative h-48">
                                <img src="{{ $business->image }}" alt="{{ $business->name }}" class="w-full h-full object-cover">
                                @if($business->featured)
                                    <span class="absolute top-4 left-4 bg-indigo-600 text-white text-xs px-2 py-1 rounded">Featured</span>
                                @endif
                                <span class="absolute top-4 right-4 bg-white px-2 py-1 rounded-full flex items-center gap-1 text-sm">
                                    ⭐ {{ $business->rating }}
                                </span>
                            </div>

                            {{-- Content --}}
                            <div class="p-6">
                                <h3 class="text-xl font-bold mb-1">{{ $business->name }}</h3>
                                <span class="text-xs bg-gray-100 text-gray-700 px-2 py-1 rounded">{{ $business->category }}</span>
                                <p class="text-gray-600 text-sm mt-3 line-clamp-2">{{ $business->description }}</p>

                                <div class="mt-4 space-y-2 text-sm text-gray-500">
                                    <p>📍 {{ $business->location }}</p>
                                    <p>📞 {{ $business->phone }}</p>
                                    <p>🌐 {{ $business->website }}</p>
                                    <p>⏰ {{ $business->hours }}</p>
                                </div>

                                <div class="flex justify-between items-center mt-4 pt-4 border-t">
                                    <span class="text-sm text-gray-600">⭐ {{ $business->rating }} ({{ $business->reviews }} reviews)</span>
                                    <a href="{{ route('businesses.show', $business->id) }}" class="bg-indigo-600 text-white text-sm px-3 py-2 rounded">
                                        View Profile
                                    </a>
                                </div>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="text-center py-12 col-span-3">
                        <p class="text-gray-500 text-lg">No businesses found matching your criteria.</p>
                        <a href="{{ route('front.business.index') }}" class="mt-4 inline-block border px-4 py-2 rounded-lg">
                            Clear Filters
                        </a>
                    </div>
                @endforelse
            </div>
        </div>
    </section>



</body>
</html>
@include('front.layout.footer')
