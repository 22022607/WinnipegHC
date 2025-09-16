@include('front.layout.header')

<div class="min-h-screen bg-gray-50">


  <!-- Main -->
  <main class="max-w-6xl mx-auto px-6 py-12">
    <!-- Hero Section -->
    <div class="text-center mb-16">
      <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">
        About Winnipeg Healing Connection
      </h1>
      <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
        Building bridges between healing practitioners and the community, creating a supportive 
        ecosystem where wellness thrives and connections flourish.
      </p>
    </div>

    <!-- Mission Section -->
    <div class="mb-12 border border-purple-200 rounded-lg bg-white shadow-sm">
      <div class="p-8">
        <div class="flex items-center mb-6">
          <!-- Heart Icon -->
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-purple-600 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 
            20.364l7.682-7.682a4.5 4.5 
            0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 
            4.5 0 00-6.364 0z"/>
          </svg>
          <h2 class="text-3xl font-bold text-gray-900">Our Mission</h2>
        </div>
        <p class="text-lg text-gray-700 leading-relaxed">
          The Winnipeg Healing Connection serves as a vital hub for holistic health and wellness 
          practitioners in our community. We believe that healing happens through connection, 
          collaboration, and shared knowledge. Our platform brings together diverse healing 
          modalities and creates opportunities for both practitioners and community members to 
          discover, learn, and grow together.
        </p>
      </div>
    </div>

    <!-- Values Grid -->
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
      <div class="text-center p-6 bg-white border rounded-lg shadow-sm hover:shadow-lg transition-shadow">
        <!-- Users Icon -->
        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-purple-600 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-5-4M9 20H4v-2a4 4 
          0 015-4m4 6v-2a4 4 0 00-4-4h0a4 4 0 004-4V6a4 4 
          0 00-8 0v2a4 4 0 004 4h0a4 4 0 00-4 4v2h4m6-10v2a4 4 
          0 01-4 4"/>
        </svg>
        <h3 class="text-xl font-semibold text-gray-900 mb-3">Community</h3>
        <p class="text-gray-600">
          Fostering connections between practitioners and clients to build a stronger healing community.
        </p>
      </div>

      <div class="text-center p-6 bg-white border rounded-lg shadow-sm hover:shadow-lg transition-shadow">
        <!-- Heart Icon -->
        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-purple-600 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 
          20.364l7.682-7.682a4.5 4.5 
          0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 
          4.5 0 00-6.364 0z"/>
        </svg>
        <h3 class="text-xl font-semibold text-gray-900 mb-3">Holistic Wellness</h3>
        <p class="text-gray-600">
          Supporting diverse healing approaches that address mind, body, and spirit.
        </p>
      </div>

      <div class="text-center p-6 bg-white border rounded-lg shadow-sm hover:shadow-lg transition-shadow">
        <!-- Calendar Icon -->
        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-purple-600 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 
          0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
        </svg>
        <h3 class="text-xl font-semibold text-gray-900 mb-3">Education</h3>
        <p class="text-gray-600">
          Providing opportunities for learning and growth through workshops and events.
        </p>
      </div>
    </div>

    <!-- What We Offer -->
    <div class="mb-12 bg-white border rounded-lg shadow-sm">
      <div class="p-8">
        <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">What We Offer</h2>
        <div class="grid md:grid-cols-2 gap-8">
          <div>
            <h3 class="text-xl font-semibold text-gray-900 mb-4">For Practitioners</h3>
            <ul class="space-y-3">
              <li class="flex items-center">
                <span class="mr-3 text-purple-600">✓</span>
                Business directory listing
              </li>
              <li class="flex items-center">
                <span class="mr-3 text-purple-600">✓</span>
                Event promotion platform
              </li>
              <li class="flex items-center">
                <span class="mr-3 text-purple-600">✓</span>
                Networking opportunities
              </li>
              <li class="flex items-center">
                <span class="mr-3 text-purple-600">✓</span>
                Educational workshops
              </li>
            </ul>
          </div>
          
          <div>
            <h3 class="text-xl font-semibold text-gray-900 mb-4">For Community</h3>
            <ul class="space-y-3">
              <li class="flex items-center">
                <span class="mr-3 text-purple-600">✓</span>
                Discover local healing services
              </li>
              <li class="flex items-center">
                <span class="mr-3 text-purple-600">✓</span>
                Access to wellness events
              </li>
              <li class="flex items-center">
                <span class="mr-3 text-purple-600">✓</span>
                Educational resources
              </li>
              <li class="flex items-center">
                <span class="mr-3 text-purple-600">✓</span>
                Community support network
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <!-- Location -->
    <div class="text-center bg-white border rounded-lg shadow-sm">
      <div class="p-8">
        <div class="flex items-center justify-center mb-6">
          <!-- MapPin Icon -->
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-purple-600 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" 
              d="M12 11c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 
              1.343-3 3 1.343 3 3 3z"/>
            <path stroke-linecap="round" stroke-linejoin="round" 
              d="M12 22s8-4.5 8-11a8 8 0 10-16 0c0 
              6.5 8 11 8 11z"/>
          </svg>
          <h2 class="text-3xl font-bold text-gray-900">Based in Winnipeg</h2>
        </div>
        <p class="text-lg text-gray-700 max-w-2xl mx-auto">
          Proudly serving the Winnipeg community and surrounding areas. We're committed to 
          supporting local healers and connecting them with those seeking wellness and healing.
        </p>
      </div>
    </div>
  </main>
</div>

  
@include('front.layout.footer')