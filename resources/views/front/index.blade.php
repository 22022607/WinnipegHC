@include('front.layout.header')
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Winnipeg Healing Connection</title>
</head>
<body class="flex flex-col min-h-screen">



<!-- Hero Section -->
<section class="bg-gradient-to-b from-purple-50 to-white py-20">
  <div class="container mx-auto text-center px-6">
    <h1 class="text-4xl md:text-5xl font-bold mb-4">
      <span class="text-gray-900">Winnipeg</span> 
      <span class="text-purple-600">Healing Connection</span>
    </h1>
    <p class="text-lg text-gray-600 mb-6">
      Connect with trusted mental health professionals, healing practitioners, <br>
      and community events. Your journey to wellness starts here in Winnipeg.
    </p>
    <div class="flex justify-center space-x-4 mb-12">
      <a href="{{ route('front.join-community.create') }}" 
         class="flex items-center space-x-2 bg-purple-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-purple-700">
        <i class="fa-solid fa-users"></i>
        <span>Join Our Community</span>
      </a>
      <a href="{{ route('front.event.index') }}" 
         class="flex items-center space-x-2 border border-purple-600 text-purple-600 px-6 py-3 rounded-lg font-medium hover:bg-purple-50">
        <i class="fa-solid fa-calendar-days"></i>
        <span>Browse Events</span>
      </a>
    </div>

    <!-- 3 Feature Cards -->
    <div class="grid md:grid-cols-3 gap-6 max-w-5xl mx-auto">
      <div class="bg-white shadow rounded-2xl p-6 text-center">
        <div class="w-12 h-12 rounded-full bg-purple-100 flex items-center justify-center mx-auto mb-4">
          <i class="fa-solid fa-user-group text-purple-600 text-xl"></i>
        </div>
        <h3 class="font-semibold text-lg">Connect</h3>
        <p class="text-sm text-gray-600 mt-2">
          Find trusted mental health professionals and healing practitioners in Winnipeg
        </p>
      </div>
      <div class="bg-white shadow rounded-2xl p-6 text-center">
        <div class="w-12 h-12 rounded-full bg-purple-100 flex items-center justify-center mx-auto mb-4">
          <i class="fa-solid fa-calendar-check text-purple-600 text-xl"></i>
        </div>
        <h3 class="font-semibold text-lg">Attend</h3>
        <p class="text-sm text-gray-600 mt-2">
          Join healing workshops, support groups, and wellness events in your city
        </p>
      </div>
      <div class="bg-white shadow rounded-2xl p-6 text-center">
        <div class="w-12 h-12 rounded-full bg-purple-100 flex items-center justify-center mx-auto mb-4">
          <i class="fa-solid fa-seedling text-purple-600 text-xl"></i>
        </div>
        <h3 class="font-semibold text-lg">Grow</h3>
        <p class="text-sm text-gray-600 mt-2">
          Build your practice with our community of like-minded professionals
        </p>
      </div>
    </div>
  </div>
</section>


<!-- Spotlight (This Month's) -->
<section id="spotlight" class="py-16">
  <div class="container mx-auto px-6">

    <!-- Section heading -->
    <h2 class="text-4xl md:text-5xl font-extrabold text-center">
      This Month's <span class="text-purple-600">Spotlight</span>
    </h2>
    <p class="mt-4 text-center text-gray-600 max-w-3xl mx-auto">
      Discover exceptional healing practitioners making a difference in our Winnipeg community
    </p>

    <!-- Spotlight content -->
    <div class="mt-10 grid grid-cols-1 lg:grid-cols-2 gap-8 max-w-6xl mx-auto items-stretch">

      <!-- Left: image with badge -->
      <div class="relative rounded-3xl shadow-2xl overflow-hidden">
        <img
          src="{{ asset('events/ShantiLotus.jpg') }}"
          alt="ShantiLotus Healing Services"
          class="w-full h-full object-cover md:min-h-[420px]"
        />
        <span class="absolute top-4 left-4 px-3 py-1 text-sm font-semibold bg-purple-600 text-white rounded-full shadow">
          Spotlight!
        </span>
      </div>

      <!-- Right: info card -->
      <div
        class="bg-gradient-to-b from-white to-purple-50 rounded-3xl shadow-xl ring-1 ring-purple-100/70"
      >
        <div class="p-8 md:p-10 h-full flex flex-col">

          <!-- Rating -->
          <div class="flex items-center gap-2 mb-4">
            <i class="fa-solid fa-star text-yellow-400"></i>
            <i class="fa-solid fa-star text-yellow-400"></i>
            <i class="fa-solid fa-star text-yellow-400"></i>
            <i class="fa-solid fa-star text-yellow-400"></i>
            <i class="fa-solid fa-star text-yellow-400"></i>
            <span class="text-gray-500 text-sm">(4.9/5)</span>
          </div>

          <!-- Title -->
          <h3 class="text-3xl md:text-4xl font-extrabold text-gray-900 leading-tight">
            ShantiLotus Healing<br class="hidden md:block" /> Services
          </h3>

          <!-- Location -->
          <div class="mt-3 flex items-center gap-2 text-gray-600">
            <i class="fa-solid fa-location-dot text-purple-600"></i>
            <span>Winnipeg, MB</span>
          </div>

          <!-- Description -->
          <p class="mt-6 text-gray-700 leading-relaxed">
            Offering holistic healing services including energy healing, crystal therapy,
            meditation workshops, and spiritual guidance. Specializing in trauma-informed care
            and mindfulness-based treatments for the Winnipeg community.
          </p>

          <!-- Next workshop -->
          <div class="mt-6 flex items-start gap-3 text-gray-700">
            <i class="fa-regular fa-calendar text-purple-600 mt-1"></i>
            <p class="text-sm">
              <span class="font-semibold">Next Workshop:</span> Crystal Healing – March 23rd
            </p>
          </div>

          <!-- Actions -->
          <div class="mt-8 flex flex-wrap gap-4">
            <a href="#" class="inline-flex items-center justify-center px-6 py-3 rounded-full bg-purple-600 text-white font-medium hover:bg-purple-700">
              View Profile
            </a>
            <a href="#" class="inline-flex items-center justify-center px-6 py-3 rounded-full border-2 border-purple-600 text-purple-700 font-medium hover:bg-purple-50">
              Book Session
            </a>
          </div>

        </div>
      </div>

    </div>
  </div>
</section>
<!-- Featured Event -->
<section id="featured-event" class="py-16 bg-purple-50/40">
  <div class="container mx-auto px-6">

    <!-- Heading -->
    <h2 class="text-4xl md:text-5xl font-extrabold text-center">
      Featured <span class="text-purple-600">Event</span>
    </h2>
    <p class="mt-4 text-center text-gray-600 max-w-3xl mx-auto">
      Don’t miss this month’s highlighted healing experience
    </p>

    <!-- Event card -->
    <div class="mt-10 grid grid-cols-1 lg:grid-cols-2 gap-8 max-w-6xl mx-auto items-stretch">

      <!-- Left: event image with badges -->
      <div class="relative rounded-3xl shadow-2xl overflow-hidden">
        <img
          src="{{ asset(@$events->image) }}"
          alt="Crystal Healing Workshop"
          class="w-full h-full object-cover md:min-h-[380px]"
        />
        <!-- Spotlight badge -->
        <span class="absolute top-4 left-4 px-3 py-1 text-sm font-semibold bg-purple-600 text-white rounded-full shadow">
          <i class="fa-regular fa-star mr-1"></i> Spotlight Event
        </span>
        <!-- Price badge -->
        <span class="absolute top-4 right-4 px-3 py-1 text-sm font-semibold bg-white text-gray-800 rounded-full shadow">
          $45
        </span>
      </div>

      <!-- Right: event details -->
      <div
        class="bg-gradient-to-b from-white to-purple-50 rounded-3xl shadow-xl ring-1 ring-purple-100/70"
      >
        <div class="p-8 md:p-10 h-full flex flex-col">

          <!-- Title -->
          <h3 class="text-2xl md:text-3xl font-extrabold text-gray-900 leading-snug">
           {{ @$events->title }}
          </h3>

          <!-- Date & Time -->
          <div class="mt-4 flex items-center gap-2 text-gray-600">
            <i class="fa-regular fa-calendar text-purple-600"></i>
            <span>{{ date('l , F j , Y' , strtotime(@$events->date)) }} • {{ @$events->start_time->format('h:i A') }} - {{ @$events->end_time->format('h:i A') }}</span>
          </div>

          <!-- Location -->
          <div class="mt-2 flex items-center gap-2 text-gray-600">
            <i class="fa-solid fa-location-dot text-purple-600"></i>
            <span>{{ @$events->venue }}</span>
          </div>

          <!-- Description -->
          <p class="mt-6 text-gray-700 leading-relaxed">
            {{ @$events->description }}
          </p>

          <!-- Actions -->
          <div class="mt-8 flex flex-wrap gap-4">
            <a
              href="{{ url('front/event/event-details/'.$events->id) }}"
              class="inline-flex items-center justify-center px-6 py-3 rounded-full bg-purple-600 text-white font-medium hover:bg-purple-700"
            >
              Get Tickets Now
            </a>
            <a
              href="#"
              class="inline-flex items-center justify-center px-6 py-3 rounded-full border-2 border-purple-600 text-purple-700 font-medium hover:bg-purple-50"
            >
              Learn More
            </a>
          </div>

        </div>
      </div>

    </div>
  </div>
</section>


<!-- Upcoming Events -->
<section id="upcoming-events" class="py-16 bg-purple-50/50">
  <div class="container mx-auto px-6">

    <!-- Heading -->
    <h2 class="text-4xl md:text-5xl font-extrabold text-center">
      Upcoming <span class="text-purple-600">Events</span>
    </h2>
    <p class="mt-4 text-center text-gray-600 max-w-3xl mx-auto">
      Join our Winnipeg community events designed to support your healing journey
    </p>

    <!-- Event Cards -->
    <div class="mt-12 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

      <!-- Card 1 -->
      @foreach ($upcoming_event as $key=>$value)
          
      <div class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-xl transition">
        <div class="relative">
          <img src="{{ asset($value->image) }}" alt="Healing Circle Workshop" class="w-full h-48 object-cover" />
          <span class="absolute top-3 right-3 bg-purple-600 text-white text-sm font-bold px-3 py-1 rounded-full">$35</span>
        </div>
        <div class="p-6">
          <h3 class="text-lg font-bold text-gray-900">{{ $value->title }}</h3>
          <div class="mt-3 flex items-center text-gray-600 text-sm space-x-2">
            <i class="fa-regular fa-calendar text-purple-600"></i>
            <span>{{ date('F j , y',strtotime($value->date)) }}</span>
          </div>
          <div class="mt-2 flex items-center text-gray-600 text-sm space-x-2">
            <i class="fa-solid fa-location-dot text-purple-600"></i>
            <span>{{ $value->venue }}</span>
          </div>
          <div class="mt-2 flex items-center text-gray-600 text-sm space-x-2">
            <i class="fa-solid fa-user-group text-purple-600"></i>
            <span>25 attending</span>
          </div>
          <a href="{{ url('front/event/event-details/'.$value->id) }}"  class="mt-6 block text-center bg-purple-600 text-white font-medium px-5 py-3 rounded-full hover:bg-purple-700">
            <i class="fa-solid fa-ticket mr-2"></i> Get Tickets
          </a>
        </div>
      </div>
      @endforeach

      {{-- <!-- Card 2 -->
      <div class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-xl transition">
        <div class="relative">
          <img src="{{ asset('events/mindfullness.jpg') }}" alt="Mindfulness Meditation" class="w-full h-48 object-cover" />
          <span class="absolute top-3 right-3 bg-purple-600 text-white text-sm font-bold px-3 py-1 rounded-full">$20</span>
        </div>
        <div class="p-6">
          <h3 class="text-lg font-bold text-gray-900">Mindfulness Meditation</h3>
          <div class="mt-3 flex items-center text-gray-600 text-sm space-x-2">
            <i class="fa-regular fa-calendar text-purple-600"></i>
            <span>March 22, 2024</span>
          </div>
          <div class="mt-2 flex items-center text-gray-600 text-sm space-x-2">
            <i class="fa-solid fa-location-dot text-purple-600"></i>
            <span>Zen Garden Studio, Winnipeg</span>
          </div>
          <div class="mt-2 flex items-center text-gray-600 text-sm space-x-2">
            <i class="fa-solid fa-user-group text-purple-600"></i>
            <span>15 attending</span>
          </div>
          <a href="#" class="mt-6 block text-center bg-purple-600 text-white font-medium px-5 py-3 rounded-full hover:bg-purple-700">
            <i class="fa-solid fa-ticket mr-2"></i> Get Tickets
          </a>
        </div>
      </div>

      <!-- Card 3 -->
      <div class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-xl transition">
        <div class="relative">
          <img src="{{ asset('events/crystal.therapy.jpg') }}" alt="Crystal Therapy Session" class="w-full h-48 object-cover" />
          <span class="absolute top-3 right-3 bg-purple-600 text-white text-sm font-bold px-3 py-1 rounded-full">$45</span>
        </div>
        <div class="p-6">
          <h3 class="text-lg font-bold text-gray-900">Crystal Therapy Session</h3>
          <div class="mt-3 flex items-center text-gray-600 text-sm space-x-2">
            <i class="fa-regular fa-calendar text-purple-600"></i>
            <span>March 25, 2024</span>
          </div>
          <div class="mt-2 flex items-center text-gray-600 text-sm space-x-2">
            <i class="fa-solid fa-location-dot text-purple-600"></i>
            <span>ShantiLotus Healing, Winnipeg</span>
          </div>
          <div class="mt-2 flex items-center text-gray-600 text-sm space-x-2">
            <i class="fa-solid fa-user-group text-purple-600"></i>
            <span>12 attending</span>
          </div>
          <a href="#" class="mt-6 block text-center bg-purple-600 text-white font-medium px-5 py-3 rounded-full hover:bg-purple-700">
            <i class="fa-solid fa-ticket mr-2"></i> Get Tickets
          </a>
        </div>
      </div> --}}

    </div>
  </div>
</section>

<!-- View All Events Button -->
<div class="flex justify-center mt-8">
  <a href="{{ route('front.event.index') }}"
     class="px-8 py-2 border-2 border-purple-600 text-purple-600 rounded-full font-medium hover:bg-purple-600 hover:text-white transition">
    View All Events
  </a>
</div>

   <!-- Section 2: Healing Connection Categories -->
  <section class="max-w-6xl mx-auto py-12 px-6">
    <h2 class="text-4xl font-bold text-center mb-2">
      Winnipeg Healing Connection <span class="text-purple-600">Categories</span>
    </h2>
    <p class="text-center text-gray-600 mb-8">
      Find the right type of support for your healing journey in Winnipeg
    </p>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
      <div class="bg-white rounded-2xl shadow overflow-hidden">
        <img src="{{ asset('categories/category1.jpg') }}" alt="Access Consciousness" class="h-40 w-full object-cover">
        <div class="p-4">
          <h3 class="font-bold">Access Consciousness</h3>
          <p class="text-sm text-gray-600">12 practitioners</p>
          <p class="text-sm text-gray-600 mt-2">Consciousness expansion techniques</p>
          <button class="mt-3 px-4 py-2 bg-purple-100 text-purple-600 rounded-lg">Browse Category</button>
        </div>
      </div>

      <div class="bg-white rounded-2xl shadow overflow-hidden">
        <img src="{{ asset('categories/category2.jpg') }}" alt="Acupuncture" class="h-40 w-full object-cover">
        <div class="p-4">
          <h3 class="font-bold">Acupuncture</h3>
          <p class="text-sm text-gray-600">18 practitioners</p>
          <p class="text-sm text-gray-600 mt-2">Traditional Chinese medicine</p>
          <button class="mt-3 px-4 py-2 bg-blue-100 text-blue-600 rounded-lg">Browse Category</button>
        </div>
      </div>

      <div class="bg-white rounded-2xl shadow overflow-hidden">
        <img src="{{ asset('categories/category3.jpg') }}" alt="Energy Healing and Reiki" class="h-40 w-full object-cover">
        <div class="p-4">
          <h3 class="font-bold">Energy Healing and Reiki</h3>
          <p class="text-sm text-gray-600">35 practitioners</p>
          <p class="text-sm text-gray-600 mt-2">Universal life force energy</p>
          <button class="mt-3 px-4 py-2 bg-pink-100 text-pink-600 rounded-lg">Browse Category</button>
        </div>
      </div>
    </div>
  </section>

  <!-- Section 3: All Available Categories -->
  <section class="max-w-6xl mx-auto py-12 px-6">
    <h2 class="text-3xl font-bold text-center mb-6">All Available Categories</h2>

    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 text-center">
      <a href="#" class="text-sm text-blue-800 hover:underline">Access Consciousness</a>
      <a href="#" class="text-sm text-blue-800 hover:underline">Acupuncture</a>
      <a href="#" class="text-sm text-blue-800 hover:underline">Akashic Soul Readings</a>
      <a href="#" class="text-sm text-blue-800 hover:underline">Alternative Therapy Practitioners</a>
      <a href="#" class="text-sm text-blue-800 hover:underline">Animal Health</a>
      <a href="#" class="text-sm text-blue-800 hover:underline">Aromatherapy</a>
      <a href="#" class="text-sm text-blue-800 hover:underline">Author &amp; Reset Coach</a>
      <a href="#" class="text-sm text-blue-800 hover:underline">Body Talk</a>
      <a href="#" class="text-sm text-blue-800 hover:underline">Business Coach</a>
      <a href="#" class="text-sm text-blue-800 hover:underline">Channeller</a>
      <a href="#" class="text-sm text-blue-800 hover:underline">Chiropractic Health</a>
      <a href="#" class="text-sm text-blue-800 hover:underline">Counselling / Coaching</a>
      <a href="#" class="text-sm text-blue-800 hover:underline">Crystal Therapy</a>
      <a href="#" class="text-sm text-blue-800 hover:underline">Crystals</a>
      <a href="#" class="text-sm text-blue-800 hover:underline">Doula - End of Life</a>
      <a href="#" class="text-sm text-blue-800 hover:underline">Drumming Experiences</a>
      <a href="#" class="text-sm text-blue-800 hover:underline">EFT Tapping</a>
      <a href="#" class="text-sm text-blue-800 hover:underline">Energy Healing and Reiki</a>
      <a href="#" class="text-sm text-blue-800 hover:underline">Fitness and Exercise</a>
      <a href="#" class="text-sm text-blue-800 hover:underline">Forest Bathing</a>
      <a href="#" class="text-sm text-blue-800 hover:underline">Gluten Free Living</a>
      <a href="#" class="text-sm text-blue-800 hover:underline">Gong Bath Meditations</a>
      <a href="#" class="text-sm text-blue-800 hover:underline">Grief Counseling</a>
      <a href="#" class="text-sm text-blue-800 hover:underline">Happiness</a>
      <a href="#" class="text-sm text-blue-800 hover:underline">Healing Touch</a>
      <a href="#" class="text-sm text-blue-800 hover:underline">Health Coach</a>
      <a href="#" class="text-sm text-blue-800 hover:underline">Herbalists - Botanicals</a>
      <a href="#" class="text-sm text-blue-800 hover:underline">Holistic Nurses</a>
      <a href="#" class="text-sm text-blue-800 hover:underline">Hypnotherapy</a>
      <a href="#" class="text-sm text-blue-800 hover:underline">Integrated Energy Therapy</a>
      <a href="#" class="text-sm text-blue-800 hover:underline">Life Coach</a>
      <a href="#" class="text-sm text-blue-800 hover:underline">Local Shopping</a>
      <a href="#" class="text-sm text-blue-800 hover:underline">Massage Therapy</a>
      <a href="#" class="text-sm text-blue-800 hover:underline">Meditation Facilitator</a>
      <a href="#" class="text-sm text-blue-800 hover:underline">Medium &amp; Portrait Art</a>
      <a href="#" class="text-sm text-blue-800 hover:underline">Mediums</a>
      <a href="#" class="text-sm text-blue-800 hover:underline">Mindfulness</a>
      <a href="#" class="text-sm text-blue-800 hover:underline">Mindset Coach</a>
      <a href="#" class="text-sm text-blue-800 hover:underline">Music and Sound Healing</a>
      <a href="#" class="text-sm text-blue-800 hover:underline">Natural Cleaning Products</a>
      <a href="#" class="text-sm text-blue-800 hover:underline">Natural Products</a>
      <a href="#" class="text-sm text-blue-800 hover:underline">Naturopathic Medicine</a>
      <a href="#" class="text-sm text-blue-800 hover:underline">NLP Neuro-Linguistic Programming</a>
      <a href="#" class="text-sm text-blue-800 hover:underline">Nutritional Support</a>
      <a href="#" class="text-sm text-blue-800 hover:underline">Organic and Healthy Snacks</a>
      <a href="#" class="text-sm text-blue-800 hover:underline">Organic Skin Care</a>
      <a href="#" class="text-sm text-blue-800 hover:underline">Past Life Regression</a>
      <a href="#" class="text-sm text-blue-800 hover:underline">Peacefulness</a>
      <a href="#" class="text-sm text-blue-800 hover:underline">Pets</a>
      <a href="#" class="text-sm text-blue-800 hover:underline">Physio Therapy</a>
      <a href="#" class="text-sm text-blue-800 hover:underline">Pranic Healing</a>
      <a href="#" class="text-sm text-blue-800 hover:underline">Psychic Guidance</a>
      <a href="#" class="text-sm text-blue-800 hover:underline">Qigong</a>
      <a href="#" class="text-sm text-blue-800 hover:underline">Reflexology</a>
      <a href="#" class="text-sm text-blue-800 hover:underline">Reiki</a>
      <a href="#" class="text-sm text-blue-800 hover:underline">Retreats</a>
      <a href="#" class="text-sm text-blue-800 hover:underline">Shaman</a>
      <a href="#" class="text-sm text-blue-800 hover:underline">Sound Healing Therapy</a>
      <a href="#" class="text-sm text-blue-800 hover:underline">Spiritual Art</a>
      <a href="#" class="text-sm text-blue-800 hover:underline">Super Patch</a>
      <a href="#" class="text-sm text-blue-800 hover:underline">Tantra</a>
      <a href="#" class="text-sm text-blue-800 hover:underline">Tantra / Sexologist</a>
      <a href="#" class="text-sm text-blue-800 hover:underline">Theta Healing</a>
      <a href="#" class="text-sm text-blue-800 hover:underline">Trauma Resolution</a>
      <a href="#" class="text-sm text-blue-800 hover:underline">Voxx Life</a>
      <a href="#" class="text-sm text-blue-800 hover:underline">Weight Loss</a>
      <a href="#" class="text-sm text-blue-800 hover:underline">Wellness Travel</a>
      <a href="#" class="text-sm text-blue-800 hover:underline">Women Empowerment</a>
      <a href="#" class="text-sm text-blue-800 hover:underline">Women's Health</a>
    </div>
  </section>




<!-- Newsletter Section -->
<section class="flex justify-center items-center py-16">
  <div class="bg-gradient-to-r from-purple-600 to-indigo-500 text-white rounded-2xl shadow-lg p-10 max-w-3xl w-full text-center">
    
    <!-- Icon -->
    <div class="flex justify-center mb-4">
      <div class="bg-white/20 p-4 rounded-full">
        <svg xmlns="http://www.w3.org/2000/svg" 
             fill="none" viewBox="0 0 24 24" 
             stroke-width="1.5" stroke="currentColor" 
             class="w-8 h-8 text-white">
          <path stroke-linecap="round" stroke-linejoin="round" 
                d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0l-7.5-4.615A2.25 2.25 0 013 6.993V6.75"/>
        </svg>
      </div>
    </div>

    <!-- Heading -->
    <h2 class="text-2xl md:text-3xl font-bold mb-3">
      Stay Connected to Your Healing Journey
    </h2>

    <!-- Subtext -->
    <p class="mb-6 text-white/90">
      Get weekly updates on new events, featured businesses, and healing 
      resources delivered straight to your inbox.
    </p>

    <!-- Form -->
    <form class="flex flex-col md:flex-row justify-center gap-3">
      <input type="email" 
             placeholder="Enter your email address" 
             class="px-5 py-3 rounded-full text-gray-800 w-full md:w-2/3 focus:outline-none" 
             required>
      <button type="submit" 
              class="px-6 py-3 bg-white text-purple-600 font-semibold rounded-full hover:bg-purple-100 transition flex items-center justify-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" 
             fill="none" viewBox="0 0 24 24" 
             stroke-width="1.5" stroke="currentColor" 
             class="w-5 h-5">
          <path stroke-linecap="round" stroke-linejoin="round" 
                d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0l-7.5-4.615A2.25 2.25 0 013 6.993V6.75"/>
        </svg>
        Subscribe
      </button>
    </form>

    <!-- Small text -->
    <p class="mt-4 text-sm text-white/70">
      No spam, ever. Unsubscribe anytime with one click.
    </p>
  </div>
</section>
<!-- Healing Journey Section -->
<section class="bg-gradient-to-r from-purple-600 to-indigo-600 py-16 text-white text-center">
  <div class="max-w-6xl mx-auto px-6">
    
    <!-- Heading -->
    <h2 class="text-3xl md:text-4xl font-bold mb-4">
      Ready to Start Your Healing Journey?
    </h2>
    <p class="text-lg text-white/80 mb-12">
      Join thousands of individuals and practitioners creating a supportive 
      community focused on mental health and healing in Winnipeg
    </p>

    <!-- Three Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
      
      <!-- Card 1 -->
      <div class="bg-purple-700/60 p-8 rounded-2xl shadow-lg">
        <div class="mb-4 flex justify-center">
          <svg xmlns="http://www.w3.org/2000/svg" 
               fill="none" viewBox="0 0 24 24" 
               stroke-width="1.5" stroke="currentColor" 
               class="w-10 h-10 text-white">
            <path stroke-linecap="round" stroke-linejoin="round" 
                  d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-5.682-1.163m1.941 1.642v.001c-.555.17-1.16.279-1.782.279A9.06 9.06 0 0112 18c-1.929 0-3.716-.607-5.16-1.639m10.56 2.361A8.962 8.962 0 0112 21a8.962 8.962 0 01-5.4-1.878M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
          </svg>
        </div>
        <h3 class="text-xl font-semibold mb-3">For Individuals</h3>
        <p class="mb-5 text-white/80">
          Find support, connect with professionals, and join healing events
        </p>
        <a href="#"
           class="inline-block bg-white text-purple-700 font-semibold px-6 py-2 rounded-full hover:bg-purple-100 transition">
          Sign Up for Events
        </a>
      </div>

      <!-- Card 2 -->
      <div class="bg-purple-700/60 p-8 rounded-2xl shadow-lg">
        <div class="mb-4 flex justify-center">
          <svg xmlns="http://www.w3.org/2000/svg" 
               fill="none" viewBox="0 0 24 24" 
               stroke-width="1.5" stroke="currentColor" 
               class="w-10 h-10 text-white">
            <path stroke-linecap="round" stroke-linejoin="round" 
                  d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
          </svg>
        </div>
        <h3 class="text-xl font-semibold mb-3">For Event Seekers</h3>
        <p class="mb-5 text-white/80">
          Discover workshops, healing circles, and wellness events
        </p>
        <a href="#"
           class="inline-block bg-white text-purple-700 font-semibold px-6 py-2 rounded-full hover:bg-purple-100 transition">
          Browse Events
        </a>
      </div>

      <!-- Card 3 -->
      <div class="bg-purple-700/60 p-8 rounded-2xl shadow-lg">
        <div class="mb-4 flex justify-center">
          <svg xmlns="http://www.w3.org/2000/svg" 
               fill="none" viewBox="0 0 24 24" 
               stroke-width="1.5" stroke="currentColor" 
               class="w-10 h-10 text-white">
            <path stroke-linecap="round" stroke-linejoin="round" 
                  d="M3 7.5c0-.621.504-1.125 1.125-1.125h15.75c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125H4.125A1.125 1.125 0 013 17.25V7.5zM12 12.75h6M6 12.75h.008v.008H6v-.008zM9 12.75h.008v.008H9v-.008z" />
          </svg>
        </div>
        <h3 class="text-xl font-semibold mb-3">For Businesses</h3>
        <p class="mb-5 text-white/80">
          Grow your practice, host events, and connect with your community
        </p>
        <a href="#"
           class="inline-block bg-white text-purple-700 font-semibold px-6 py-2 rounded-full hover:bg-purple-100 transition">
          Register Business
        </a>
      </div>

    </div>

    <!-- Bottom Buttons -->
    <div class="flex flex-col md:flex-row justify-center gap-4">
      <a href="#"
         class="inline-flex items-center justify-center bg-white text-purple-700 font-semibold px-6 py-3 rounded-full shadow hover:bg-purple-100 transition">
        <svg xmlns="http://www.w3.org/2000/svg" 
             fill="none" viewBox="0 0 24 24" 
             stroke-width="1.5" stroke="currentColor" 
             class="w-5 h-5 mr-2">
          <path stroke-linecap="round" stroke-linejoin="round" 
                d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952A9.369 9.369 0 0021 12a9.369 9.369 0 00-1.254-4.548A9.337 9.337 0 0015 6.128M9 19.128a9.38 9.38 0 01-2.625.372 9.337 9.337 0 01-4.121-.952A9.369 9.369 0 013 12c0-1.62.402-3.146 1.254-4.548A9.337 9.337 0 019 6.128M9 19.128V6.128M15 19.128V6.128" />
        </svg>
        Join Community
      </a>
      <a href="#"
         class="inline-flex items-center justify-center border border-white font-semibold px-6 py-3 rounded-full hover:bg-white hover:text-purple-700 transition">
        Business Membership
      </a>
    </div>

  </div>
</section>


  
</body>
</html>
@include('front.layout.footer')
