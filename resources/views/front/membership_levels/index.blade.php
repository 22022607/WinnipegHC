@include('front.layout.header')
@if($userMembership && Auth::guard('member')->id)

   
<main class="min-h-screen flex flex-col items-center justify-center bg-gray-100 mt-5 mb-5">
  <div class="bg-white rounded-lg shadow-lg max-w-xl w-full p-8 text-center">
    <!-- Checkmark Icon -->
    <div class="text-green-500 text-5xl mb-4">
      &#10004;
    </div>

    <!-- Heading and subtext -->
    <h1 class="text-2xl font-bold text-gray-800 mb-2">Welcome to Our Community!</h1>
    <p class="text-gray-600 mb-6">Your membership has been successfully activated</p>

    <!-- What's Next section -->
    <div class="bg-green-50 rounded-md text-left p-5 mb-6">
      <h3 class="font-semibold text-gray-800 mb-3">What's Next?</h3>
      <ul class="space-y-3 text-gray-700 list-none">
        <li class="flex items-start">
          <span class="text-green-500 mr-2 mt-1">✔</span>
          <span>Complete your business profile to get discovered by the community</span>
        </li>
        <li class="flex items-start">
          <span class="text-green-500 mr-2 mt-1">✔</span>
          <span>Create and manage your events to engage with members</span>
        </li>
        <li class="flex items-start">
          <span class="text-green-500 mr-2 mt-1">✔</span>
          <span>Purchase spotlight to feature your business on the homepage</span>
        </li>
        <li class="flex items-start">
          <span class="text-green-500 mr-2 mt-1">✔</span>
          <span>Connect with other wellness professionals in your area</span>
        </li>
      </ul>
    </div>

    <!-- Confirmation message -->
    <div class="text-sm text-gray-600 bg-gray-100 p-3 rounded">
      A confirmation email has been sent to your registered email address with your membership details and receipt.
    </div>
    <div class="flex flex-col sm:flex-row justify-center mt-2 gap-4">
      <a href="{{ url('member-dashboard') }}" class="w-full sm:w-auto bg-gray-900 text-white font-medium py-2 px-5 rounded-md flex items-center justify-center hover:bg-gray-800 transition">
        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
          <path d="M10 3a1 1 0 00-.894.553L7.382 7H4a1 1 0 000 2h3a1 1 0 00.894-.553L10.618 5H16a1 1 0 000-2h-6zM4 11a1 1 0 000 2h2a1 1 0 000-2H4zm4 0a1 1 0 100 2h4a1 1 0 100-2H8z" />
        </svg>
        Go to Dashboard
      </a>
      <a href="/" class="w-full sm:w-auto border border-gray-300 text-gray-700 font-medium py-2 px-5 rounded-md hover:bg-gray-200 transition">
        Return Home
      </a>
    </div>
  </div>
  </div>

</main>
    @else
<!-- Banner -->
<section class="relative bg-cover bg-center text-white py-32" 
         style="background-image: url('{{ asset('images/hero-background.jpg') }}');">

  <!-- Dark overlay -->
  <div class="absolute inset-0 bg-black bg-opacity-50"></div>

  <!-- Content -->
  <div class="relative max-w-6xl mx-auto px-6 text-center">
      <h5 class="text-4xl md:text-6xl font-bold mb-4">
          WHC Annual Membership
      </h5>
      <p class="text-lg md:text-xl">
          Expand your audience now by joining a proven community!
      </p>
  </div>
</section>
<!-- Community Section -->
<section class="py-16 bg-gray-50">
  <div class="container mx-auto px-4">
    <!-- Heading -->
    <h2 class="text-4xl md:text-5xl font-bold text-center mb-12 text-blue-600 italic">
      WINNIPEG HEALING CONNECTION
    </h2>

    <!-- Image -->
    <div class="w-full flex justify-center">
      <img 
        src="{{ asset('images/community-membership.jpg') }}" 
        alt="Winnipeg Healing Connection community event" 
         class="w-full h-[500px] object-contain"
      />
    </div>
  </div>
</section>

<section class="py-16 bg-gray-100">
  <div class="container mx-auto px-4">
    <!-- Heading -->
    <h2 class="text-3xl md:text-4xl font-bold text-center mb-12">
      Here's what you get:
    </h2>

    <!-- Benefits List -->
    <ul class="max-w-4xl mx-auto space-y-4 list-none">
      <li class="flex gap-3 items-start">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600 flex-shrink-0 mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
        </svg>
        <span class="text-gray-800 leading-relaxed">
          Connecting with us provides great local exposure to share your wellness business in Manitoba.
        </span>
      </li>

      <li class="flex gap-3 items-start">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600 flex-shrink-0 mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
        </svg>
        <span class="text-gray-800 leading-relaxed">
          <strong>Directory Listing</strong> on the website expands your reach to a qualified audience. Visitors to WHC Directory are already interested in this topic! Now they will be linked to YOU.
        </span>
      </li>

      <li class="flex gap-3 items-start">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600 flex-shrink-0 mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
        </svg>
        <span class="text-gray-800 leading-relaxed">
          Web Traffic directed to your website or event link via guests of the directory, <strong>Facebook, Newsletter</strong> or Meetup.com events through <strong>Winnipeg Wellness Meetup.</strong>
        </span>
      </li>

      <li class="flex gap-3 items-start">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600 flex-shrink-0 mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
        </svg>
        <span class="text-gray-800 leading-relaxed">
          Discover how to expand your reach to your qualified audience. Members are available as part of being in an amazing professional network! Tools Shared as available!
        </span>
      </li>

      <li class="flex gap-3 items-start">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600 flex-shrink-0 mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
        </svg>
        <span class="text-gray-800 leading-relaxed">
          You are one of the first to be offered exhibitor tables at the annual <strong>Healing Connections Festival</strong> AND for special <strong>discounted pricing</strong>!
        </span>
      </li>

      <li class="flex gap-3 items-start">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600 flex-shrink-0 mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
        </svg>
        <span class="text-gray-800 leading-relaxed">
          Boost your workshop or events online with the added bonus of our <strong>newsletter emailed out every week!</strong> Association with Winnipeg's largest local community with partial access to <strong>*Wellness Winnipeg Meetup</strong> benefits. * Meetup is another means WHC can reach qualified guests to your event. <strong>Wellness Winnipeg currently has over 2500 members.</strong>
        </span>
      </li>

      <li class="flex gap-3 items-start">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600 flex-shrink-0 mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
        </svg>
        <span class="text-gray-800 leading-relaxed">
          Self-service <strong>Add Your Event</strong> with pictures and live contact links.
        </span>
      </li>

      <li class="flex gap-3 items-start">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600 flex-shrink-0 mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
        </svg>
        <span class="text-gray-800 leading-relaxed">
          Enjoy perks associated with a large local presence on social media with links right to you!
        </span>
      </li>

      <li class="flex gap-3 items-start">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600 flex-shrink-0 mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
        </svg>
        <span class="text-gray-800 leading-relaxed">
          Enjoy a chance to <strong>connect, share and collaborate with others</strong> in an amazing holistic community
        </span>
      </li>
    </ul>

    <!-- Links Section -->
    <div class="max-w-4xl mx-auto mt-12 space-y-4">
      <p class="text-gray-800">
        Our popular facebook page: 
        <a href="#" class="text-blue-600 hover:underline font-medium">Click Here</a>
      </p>
      <p class="text-gray-800">
        Winnipeg Wellness Meetup: 
        <a href="#" class="text-blue-600 hover:underline font-medium">Click Here</a>
      </p>
       <h3 class="text-xl md:text-xl font-bold mb-4">
        What would your profession look like with this kind of additional local support?
      </h3>
        <p class="text-lg font-semibold mb-2">Join us today!</p>
        <p>Annual WHC Directory Membership is $12.50/month, <span class=" font-semibold mb-2">auto-billed annually at $150.00 via credit card</span></p>
    </div>
</section>

<section class="py-16 bg-gray-50">
  <div class="container mx-auto px-4">
    <!-- Heading -->
   
   
    <div class="text-center mb-12">
      <h2 class="text-3xl md:text-4xl font-bold mb-4">
        If you live and work in Manitoba –
      </h2>
      <p class="text-4xl md:text-5xl font-bold text-blue-600">Join Us BELOW</p>
    </div>

    <!-- Pricing Cards -->
<div class="grid md:grid-cols-2 gap-6 max-w-4xl mx-auto mb-12 justify-center">

  {{-- @foreach ($membershipLevels as $level) --}}
    <div class="bg-white rounded-xl shadow-md p-8 flex flex-col justify-center hover:shadow-lg transition-shadow">
      <div class="">
        <h3 class="text-xl font-semibold mb-4">{{ $membershipLevels->name }}</h3>
        <div class="mb-6">
          <span class="text-4xl font-bold text-black">${{ $membershipLevels->price }}</span>
        </div>
      </div>

     

      
        <a href="{{ route('membership.checkout', $membershipLevels->id) }}" 
           class="block w-full text-center bg-[#7754b6] hover:bg-[#6644a8] text-white font-semibold py-2 text-sm rounded-lg transition">
            Select
        </a>
    

    </div>
  {{-- @endforeach --}}

</div>

  </div>
</section>
@endif




@include('front.layout.footer')
