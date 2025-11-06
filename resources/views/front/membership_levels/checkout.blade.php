

  @include('front.layout.header')

  <main class="container mx-auto px-4 py-12 max-w-4xl">

    <!-- Membership Level Section -->
    <section class="mb-12">
      <div class="flex items-baseline gap-3 mb-4">
        <h1 class="text-4xl font-bold text-gray-800">Membership Level</h1>
        <a href="{{ url('membership/membership-levels') }}" class="text-purple-600 hover:underline text-sm">change</a>
      </div>
      <p class="text-gray-800 mb-2">
        You have selected the <strong>{{ $membership->name }}</strong> membership level.
      </p>
      <p class="text-gray-800">
        The price for membership is <strong>${{ $membership->price }}</strong> now.
      </p>
    </section>

    <!-- Account Information Section -->
    <section class="mb-12">
       @guest
      <div class="flex items-baseline gap-3 mb-6">
        <h2 class="text-4xl font-bold text-gray-800">Account Information</h2>
        <span class="text-gray-600 text-sm italic">
          Already have an account? <a href="{{ url('login') }}" class="text-purple-600 hover:underline">Log in here</a>
        </span>
      </div>
      @endguest
      You are logged in as <strong>{{ Auth::user()->name }}</strong>. If you would like to use a different account for this membership, <a href="{{ url('logout') }}" class="text-purple-600 hover:underline">log out now.</a>
      <form class="space-y-6" method="POST" action="{{ route('membership.process') }}" id="membership-form">
        @csrf
        @guest
        <input type="hidden" name="membership_id" value="{{ $membership->id }}">
        <input type="hidden" name="membership_type" value="{{ $membership->duration_months }}">
        <input type="hidden" name="price" value="{{ $membership->price }}">
           <div id="card-element"></div>
    <div id="card-errors" class="text-red-600 mt-2"></div>
        <!-- Username -->
        <div>
          <label for="username" class="block text-gray-800 font-semibold mb-1">Username</label>
          <div class="flex gap-2 items-start">
            <input type="text" name="username" required id="username" placeholder="Enter username" 
                   class="max-w-md border border-gray-300 rounded px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent"/>
            <span class="text-red-600 text-xl">*</span>
          </div>
          <p class="text-red-600 text-sm mt-1">Username must be at least 3 characters</p>
        </div>

        <!-- Password -->
        <div>
          <label for="password" class="block text-gray-800 font-semibold mb-1">Password</label>
          <div class="flex gap-2 items-start">
            <input type="password" name="password" required id="password" placeholder="Enter password" 
                   class="max-w-md border border-gray-300 rounded px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent"/>
            <span class="text-red-600 text-xl">*</span>
          </div>
          <p class="text-red-600 text-sm mt-1">Password must be at least 8 characters</p>
        </div>

        <!-- Confirm Password -->
        <div>
          <label for="confirmPassword" class="block text-gray-800 font-semibold mb-1">Confirm Password</label>
          <div class="flex gap-2 items-start">
            <input type="password" name="password_confirmation" required  id="confirmPassword" placeholder="Confirm password" 
                   class="max-w-md border border-gray-300 rounded px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent"/>
            <span class="text-red-600 text-xl">*</span>
          </div>
          {{-- <p class="text-red-600 text-sm mt-1">Passwords don't match</p> --}}
        </div>

        <!-- Email -->
        <div>
          <label for="email" class="block text-gray-800 font-semibold mb-1">Email Address</label>
          <div class="flex gap-2 items-start">
            <input type="email" id="email" name="email" required placeholder="Enter email" 
                   class="max-w-md border border-gray-300 rounded px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent"/>
            <span class="text-red-600 text-xl">*</span>
          </div>
          {{-- <p class="text-red-600 text-sm mt-1">Invalid email address</p> --}}
        </div>

        <!-- Confirm Email -->
        <div>
          <label for="confirmEmail" class="block text-gray-800 font-semibold mb-1">Confirm Email Address</label>
          <div class="flex gap-2 items-start">
            <input type="email" id="confirmEmail" placeholder="Confirm email" 
                   class="max-w-md border border-gray-300 rounded px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent"/>
            <span class="text-red-600 text-xl">*</span>
          </div>
          {{-- <p class="text-red-600 text-sm mt-1">Emails don't match</p> --}}
        </div>
        @endguest
        <!-- Payment Information -->
       <!-- Payment Section -->
        <section class="pt-8">
          <div class="flex items-baseline gap-3 mb-6">
            <h2 class="text-4xl font-bold text-gray-800">Payment Information</h2>
            <span class="text-gray-600 text-sm italic">We accept all major credit cards</span>
          </div>

          <!-- Stripe Card Element -->
          <div id="card-element" class="border border-gray-300 rounded px-3 py-3 w-full"></div>
          <div id="card-errors" class="text-red-600 text-sm mt-2"></div>
        </section>
        <!-- Submit Button -->
        <div class="pt-6">
          <button type="submit" class="w-full bg-purple-600 hover:bg-purple-700 text-white font-semibold py-3 rounded-lg transition">
            Submit and Check Out
          </button>
        </div>

      </form>
    </section>
      

  </main>
    @include('front.layout.footer')
<script src="https://js.stripe.com/v3/"></script>
<script>
    const stripe = Stripe("{{ env('STRIPE_KEY') }}"); // Publishable key
</script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const stripe = Stripe("{{ env('STRIPE_KEY') }}");
    const elements = stripe.elements();
    const card = elements.create("card", {
        style: {
            base: {
                color: "#32325d",
                fontSize: "16px",
                fontFamily: "Arial, sans-serif",
                "::placeholder": {
                    color: "#aab7c4"
                }
            },
            invalid: {
                color: "#fa755a",
                iconColor: "#fa755a"
            }
        }
    });
    card.mount("#card-element");

    const form = document.getElementById("membership-form");

    form.addEventListener("submit", async function(e) {
        e.preventDefault();

        // Step 1: Create PaymentIntent
        let response = await fetch("{{ route('membership.process') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({
                membership_type: "{{ $membership->duration_months }}",
                price: parseFloat("{{ $membership->price }}"),
                membership_id: "{{ $membership->id }}"
            })
        });

        let data = await response.json();

        if (data.error) {
            Swal.fire("Error", data.error, "error");
            return;
        }

        // Step 2: Confirm card payment
        const { error, paymentIntent } = await stripe.confirmCardPayment(data.client_secret, {
            payment_method: {
                card: card,
                billing_details: {
                    email: "{{ auth()->check() ? auth()->user()->email : '' }}",
                },
            }
        });

        if (error) {
            document.getElementById("card-errors").textContent = error.message;

            // Optional: update status to "failed" in backend
            await fetch("{{ url('membership/update-payment-status') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    payment_intent_id: data.payment_intent_id,
                    status: "failed"
                })
            });

        } else {
            // Step 3: Update DB dynamically based on payment status
            let status = paymentIntent.status === "succeeded" ? "succeeded" : "pending";
            await fetch("{{ url('membership/update-payment-status') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    payment_intent_id: paymentIntent.id,
                    status: status
                })
            });

            if (status === "succeeded") {
                Swal.fire({
                    icon: 'success',
                    title: 'Payment Successful',
                    text: 'Your membership is now active!',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location.href = "{{ url('membership/membership-levels') }}";
                });
            } else {
                Swal.fire({
                    icon: 'info',
                    title: 'Payment Pending',
                    text: 'Your payment is pending. You will be notified once it succeeds.',
                    confirmButtonText: 'OK'
                });
            }
        }
    });
});

</script>

