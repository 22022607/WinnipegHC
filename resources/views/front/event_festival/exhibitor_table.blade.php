@include('front.layout.header')
<main class="bg-purple-50 text-gray-800 font-sans">

 

  <!-- Image Section -->
  <section class="flex justify-center py-6">
    <img src="{{ asset('festival_images/festival-banner.jpg') }}" alt="Healing Connections Festival" class="rounded-lg shadow-lg w-11/12 md:w-2/3" />
    
  </section>
  <h4 class="flex justify-center  font-bold" style="font-size: 28px;color: purple">{{ date('M d, Y', strtotime($event_festival->start_date)) }}</h4>
<h4 class="flex justify-center  font-bold" style="font-size: 28px;color: purple">Festival Exhibitors</h4>
<p class="flex justify-center mt-2 font-bold ">This is Winnipeg Healing Connection's 10th Annual Healing Connections Festival! </p>

<p class="flex justify-center mt-2 font-bold">Exhibitor Tables are now available to reserve. </p>

  <!-- Hosted by Section -->
  <section class="text-center py-4 bg-white shadow-md mx-auto max-w-3xl rounded-lg">

    <img src="{{ asset('festival_images/image2.jpg') }}" alt="Winnipeg Healing Connection Logo" class="mx-auto w-full h-full mt-2" />
        
  </section>
<section class="bg-white py-16">
  <div class="max-w-6xl mx-auto px-6 md:px-10 space-y-16">

    <!-- WHERE WE'LL MEET SECTION -->
    <div class="md:flex items-center gap-10">
      <!-- Left: Oval Image -->
      <div class="md:w-1/2 flex justify-center">
        <img
          src="{{ asset('festival_images/image3.jpg') }}"
          alt="Conference"
          class="rounded-full w-80 h-52 object-cover shadow-md"
        />
      </div>

      <!-- Right: Content -->
      <div class="md:w-1/2 mt-8 md:mt-0">
        <h2 class="text-3xl font-bold text-gray-900 mb-3">
          Where we'll meet
        </h2>

        <p class="text-gray-600 text-lg leading-relaxed">
         {{$event_festival->address}}<br />
          <span class="text-gray-700 font-medium">{{ date('h:i A', strtotime($event_festival->start_time)) }} - {{ date('h:i A', strtotime($event_festival->end_time)) }}</span>
        </p>

        {{-- <p class="text-red-600 font-semibold mt-2">
          Setup starts at 8:30am
        </p> --}}
      </div>
    </div>

    <!-- WHAT IS NEEDED SECTION -->
    <div class="md:flex items-start gap-10">
      <!-- Left: Image -->
      <div class="md:w-1/2">
        <img
          src="{{ asset('festival_images/giftbag.jpg') }}"
          alt="Gift Bags"
          class="rounded-lg shadow-md w-full object-cover"
        />
      </div>

      <!-- Right: Text Content -->
      <div class="md:w-1/2 mt-8 md:mt-0">
        <h2 class="text-3xl font-bold text-gray-900 mb-4">
          What is Needed
        </h2>

        <ul class="list-disc list-inside text-gray-700 leading-relaxed space-y-3">
          <li>
            <span class="font-semibold text-gray-900">
              A product or service gift
            </span>
            to add to 50 Gift Bags for first 50 guests at the festival.
            Send or drop off to WHC by {{ date('M d, Y', strtotime($event_festival->start_date)) }}.
          </li>

          <li>
            <span class="font-semibold text-gray-900">
              Your own table cover
            </span>
            dressing for 8' Table.
          </li>

          <li>
            <span class="font-semibold text-yellow-500 bg-yellow-100 px-1 rounded">
              An affordable "sample"
            </span>
            product, service or draw at your table. This festival is about experiences.
          </li>
          <li>
            <span class="font-semibold text-gray-900">
            Advise if you need anything special for your table, such as power.  Send an email to Donna@winnipeghc.com
            </span>
          </li>
        </ul>
      </div>
    </div>
  </div>
</section>
  <section class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-4 p-6">
    <img src="{{ asset('festival_images/image2.jpg') }}" alt="Festival" class="rounded-lg shadow-md w-full h-72 object-cover" />
    <img src="{{ asset('festival_images/image3.jpg') }}" alt="Festival" class="rounded-lg shadow-md w-full h-72 object-cover" />
    <img src="{{ asset('festival_images/image4.jpg') }}" alt="Festival" class="rounded-lg shadow-md w-full h-72 object-cover" />
    <img src="{{ asset('festival_images/image5.jpg') }}" alt="Festival" class="rounded-lg shadow-md w-full h-72 object-cover" />
  </section>
    <div class="text-center my-6 mb-6">
    @if(Auth::guard('member')->check())
      @if(!$exhibitor_member)
          <form action="{{ route('festival.book.table.member') }}" method="POST">
              @csrf
              <button type="submit"
                  class="bg-sky-500 hover:bg-sky-600 text-white font-semibold py-3 px-8 rounded-full shadow-md transition">
                  Register Your Member's Table – $79
              </button>
          </form>
      @else
          <p class="text-red-500 font-medium mt-2">
              You have already registered for a table.
          </p>
      @endif
  @else
      <a href="{{ route('user.login') }}"
        class="bg-sky-500 hover:bg-sky-600 text-white font-semibold py-3 px-8 rounded-full shadow-md transition">
          Login to Register Your Table – $79
      </a>
  @endif

  </div>
  
   <div class="text-center space-y-3 ">
    <a href="{{ route('festival.register.non.member') }}" class="bg-sky-500 text-white font-semibold py-2 px-6 rounded-full shadow-md hover:bg-sky-600 transition block md:inline-block text-center mb-6">
      Not a Member?  Register Table Here $144
    </a>
   </div>
    <div class="text-center space-y-3 mb-6">
      <a href="{{ route('join-community') }}" class="bg-purple-800 text-white font-semibold py-2 px-6 rounded-full shadow-md hover:bg-sky-600 transition block md:inline-block text-center mb-6">
        Become A WHC Member Today
      </a>
   </div>
  
  <div class="text-center mb-6 text-gray-700">
    <p>
     Questions?
    
    </p>
    <p>
         Please send an email to 
      <a href="mailto:Donna@WinnipegHC.com" class="text-sky-600 font-semibold underline">
        Donna@WinnipegHC.com
      </a>
    </p>
   
  </div>

</main>
@include('front.layout.footer')
