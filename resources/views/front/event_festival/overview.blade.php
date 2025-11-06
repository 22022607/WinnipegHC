

@include('front.layout.header')





  <main class="pt-6">



    <!-- Hero Section -->
    <div class="max-w-8xl" style="padding: 0px 28px 0px 28px">
    <section class="relative h-96 overflow-hidden">
      <img src="{{ asset($festival_details->image) }}" 
           alt="{{ $festival_details->name }}"
           class="w-full object-cover" style="height: 159%;">
      
    </section>
  </div>
    <div class="max-w-8xl  px-6 py-6">
      <div class="">

        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-8">
          
          <!-- About -->
          <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-2xl font-bold mb-4">About This Event</h2>
            <p class="">
                {{$festival_details->description}}<br>
             
             

              Where we'll meet
              <strong>{{ $festival_details->address }} at   {{ date('M d, Y', strtotime($festival_details->start_date)) }} {{ date('h:i A', strtotime($festival_details->start_time)) }} - {{ date('h:i A', strtotime($festival_details->end_time)) }}
</strong></p>
          </div>
        </div>
    
       
      </div>
    </div>
      <section class="max-w-8xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-4 p-6">
    <img src="{{ asset('festival_images/image2.jpg') }}" alt="Festival" class="rounded-lg shadow-md w-full h-72 object-cover" />
    <img src="{{ asset('festival_images/image3.jpg') }}" alt="Festival" class="rounded-lg shadow-md w-full h-72 object-cover" />
    <img src="{{ asset('festival_images/image4.jpg') }}" alt="Festival" class="rounded-lg shadow-md w-full h-72 object-cover" />
    <img src="{{ asset('festival_images/image5.jpg') }}" alt="Festival" class="rounded-lg shadow-md w-full h-72 object-cover" />
  </section>
   <div class="text-center my-6 mb-6">
    <a href="{{ route('festival.tickets') }}" class="bg-purple-500 hover:bg-purple-600 text-white font-semibold py-2 px-6 rounded-full shadow-md transition mr-2">
      Get Tickets - $5.00
    </a>
  
  
    @if($presenters->count() > 0)
    <a href="{{ route('festival.presenters') }}" class="bg-purple-500 text-white font-semibold py-2 px-6 rounded-full shadow-md hover:bg-purple-600 transition block md:inline-block text-center mr-2">
      2025 Presenters List
    </a>
    @else
    <a href="" class="bg-purple-500 text-white font-semibold py-2 px-6 rounded-full shadow-md hover:bg-purple-600 transition block md:inline-block text-center">
      2025 Presenters List coming soon!
    </a>
    @endif
  
   
    @if($exhibitors->count() > 0)
    <a href="{{ route('festival.exhibitors') }}" class="bg-purple-500 text-white font-semibold py-2 px-6 rounded-full shadow-md hover:bg-purple-600 transition block md:inline-block text-center mb-6">
      2025 Exhibitors List
    </a>
    @else
    <a href="" class="bg-purple-500 text-white font-semibold py-2 px-6 rounded-full shadow-md hover:bg-purple-600 transition block md:inline-block text-center mb-6">
      2025 Exhibitors List coming soon!
    </a>
    @endif
  </div>
  <div class="text-center mb-6 text-gray-700">
    <p>
      Direct any questions to 
      <a href="mailto:Festival@WinnipegHC.com" class="text-purple-600 font-semibold underline">
        Festival@WinnipegHC.com
      </a>
    </p>
    <p class="mt-2 text-sm">
      Free Parking at, and next to, the Viscount Gort Hotel. Wheelchair access and parking at the front of hotel.<br />
      ATM available onsite.
    </p>
  </div>

  </main>

@include('front.layout.footer')
