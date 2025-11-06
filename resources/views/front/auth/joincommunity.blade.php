@include('front.layout.header')
@if(Auth::guard('member')->check())

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
<div class="min-h-screen bg-gradient-to-br from-purple-50 to-blue-50">
  <main class="max-w-6xl mx-auto px-6 py-16">

    <!-- Hero -->
    <h1 class="text-4xl font-bold text-gray-900 text-center mb-8">
      Join Our Healing Community
    </h1>

    <section class="bg-purple-50 py-16 px-6 rounded-lg">
      <div class="max-w-6xl mx-auto text-center mb-12">
        <p class="text-xl text-gray-600 max-w-2xl mx-auto">
          Connect with like-minded individuals on your wellness journey and access exclusive resources for healing and growth.
        </p>
      </div>

      <!-- Flash Message -->
      @if(session('success'))
        <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded mb-6 text-center">
          {{ session('success') }}
        </div>
      @endif

      <form id="joinForm" action="{{ route('join-community.store') }}" method="POST" class="space-y-8">
        @csrf

        <!-- Membership Options -->
        <div id="membership-options" class="grid md:grid-cols-2 gap-8 max-w-4xl mx-auto w-50% h-50%" style="margin: auto;display: block;">

          <!-- Yearly -->
          <label class="block cursor-pointer">
            <input type="radio" name="membership_type" value="yearly" class="sr-only peer" checked>
            <div class="membership-card bg-white rounded-xl shadow-md p-6 border border-purple-200 hover:shadow-lg transition
                        peer-checked:border-purple-600 peer-checked:ring-2 peer-checked:ring-purple-300 mx-auto">
              <h2 class="text-lg font-bold text-gray-900 mb-2 text-center">WHC Annual Membership</h2>
              <p class="text-purple-600 font-semibold mb-4 text-sm text-center">Yearly</p>
              <div class="mt-4 mb-2 text-center">
                <span class="text-4xl font-bold text-gray-900">$150.00</span>
                <span class="text-gray-600 ml-2">per year</span>
              </div>
              <p class="text-gray-600 mb-4 text-sm text-center">
                Full access to our healing community with annual renewal
              </p>
              <ul class="space-y-2 text-left text-sm">
                <li class="flex items-center"><span class="text-green-600 mr-2">✓</span> Access to all healing events and workshops</li>
                <li class="flex items-center"><span class="text-green-600 mr-2">✓</span> Directory of local wellness businesses</li>
                <li class="flex items-center"><span class="text-green-600 mr-2">✓</span> Monthly community newsletter</li>
                <li class="flex items-center"><span class="text-green-600 mr-2">✓</span> Member-only discounts and offers</li>
                <li class="flex items-center"><span class="text-green-600 mr-2">✓</span> Priority event booking</li>
                <li class="flex items-center"><span class="text-green-600 mr-2">✓</span> Community support forums</li>
              </ul>
            </div>
          </label>

         

        </div>

        @error('membership_type')
          <p class="text-red-500 text-sm text-center">{{ $message }}</p>
        @enderror

        <!-- Signup Form -->
        <div class="max-w-2xl mx-auto bg-white/80 backdrop-blur-sm shadow-lg rounded-xl p-8 space-y-6">
          <div class="text-center mb-6">
            <h2 class="text-2xl font-bold text-gray-900">Complete Your Membership</h2>
          </div>

          <div class="grid md:grid-cols-2 gap-4">
            <div>
              <label for="firstName" class="block text-sm font-medium text-gray-700">First Name</label>
              <input id="firstName" name="firstName" value="{{ old('firstName') }}" class="mt-2 block w-full border rounded-lg px-3 py-2" />
              @error('firstName') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>
            <div>
              <label for="lastName" class="block text-sm font-medium text-gray-700">Last Name</label>
              <input id="lastName" name="lastName" value="{{ old('lastName') }}" class="mt-2 block w-full border rounded-lg px-3 py-2" />
              @error('lastName') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>
          </div>

          <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" class="mt-2 block w-full border rounded-lg px-3 py-2" />
            @error('email') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
          </div>

          <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input id="password" type="password" name="password" class="mt-2 block w-full border rounded-lg px-3 py-2" />
            @error('password') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
          </div>

          <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" class="mt-2 block w-full border rounded-lg px-3 py-2" />
            @error('password_confirmation') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
          </div>

          <div>
            <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
            <input id="phone" type="tel" name="phone" value="{{ old('phone') }}" class="mt-2 block w-full border rounded-lg px-3 py-2" />
            @error('phone') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
          </div>

          <div>
            <label for="interests" class="block text-sm font-medium text-gray-700">Healing Interests (Optional)</label>
            <textarea id="interests" name="interests" class="mt-2 block w-full border rounded-lg px-3 py-2 min-h-[100px]">{{ old('interests') }}</textarea>
          </div>

          
        <div>
          <label for="card-element" class="block text-sm font-medium text-gray-700">Card Details</label>
          <div id="card-element" class="mt-2 p-3 border rounded-lg"></div>
          <div id="card-errors" class="text-red-500 text-sm mt-2"></div>
        </div>
        <div class="flex items-start space-x-2">
            <input type="checkbox" id="terms" name="terms" class="mt-1" required />
            <label for="terms" class="text-sm text-gray-600">
              I agree to the <a href="{{url('terms')}}" class="text-purple-600 hover:underline">Terms of Service</a> and
              <a href="{{url('privacy')}}" class="text-purple-600 hover:underline">Privacy Policy</a>
            </label>
            @error('terms') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
          </div>
          <button type="submit" class="w-full bg-purple-600 hover:bg-purple-700 text-white py-3 text-lg rounded-lg">
            Complete Membership Registration
          </button>
        </div>
        
      </form>
    </section>

  </main>
</div>
@endif
@include('front.layout.footer')
<script src="https://js.stripe.com/v3/"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("joinForm");
    const submitBtn = form.querySelector("button[type='submit']");
    const stripe = Stripe("{{ env('STRIPE_KEY') }}");
    const elements = stripe.elements();

    // --- Stripe Card Element Setup ---
    const card = elements.create("card", {
        style: {
            base: {
                color: "#32325d",
                fontSize: "16px",
                fontFamily: "Arial, sans-serif",
                "::placeholder": { color: "#aab7c4" },
            },
            invalid: {
                color: "#fa755a",
                iconColor: "#fa755a",
            },
        },
    });
    card.mount("#card-element");

    // Helper: clear previous errors
    function clearErrors() {
        const errorEls = form.querySelectorAll(".field-error");
        errorEls.forEach(el => el.remove());
        const inputs = form.querySelectorAll("input, textarea");
        inputs.forEach(input => input.classList.remove("border-red-500"));
    }

    // Helper: show field-specific errors
    function showFieldErrors(messages) {
        Object.entries(messages).forEach(([field, msgs]) => {
            const input = form.querySelector(`[name="${field}"]`);
            if (input) {
                input.classList.add("border-red-500");
                const errorEl = document.createElement("p");
                errorEl.classList.add("text-red-500", "text-sm", "mt-1", "field-error");
                errorEl.innerHTML = msgs.join("<br>");
                input.parentNode.appendChild(errorEl);
            }
        });
    }

    // --- Form Submit Handler ---
    form.addEventListener("submit", async function (e) {
        e.preventDefault();
        clearErrors();

        submitBtn.disabled = true;
        submitBtn.textContent = "Processing...";
        document.getElementById("card-errors").textContent = "";

        try {
            const formData = new FormData(form);
            const plainData = Object.fromEntries(formData.entries());

            // Step 1: Create PaymentIntent
            const intentRes = await fetch("{{ route('join-community.store') }}", {
                method: "POST",
                headers: { "X-CSRF-TOKEN": "{{ csrf_token() }}" },
                body: formData,
            });

            const intentData = await intentRes.json();

            if (intentData.error) {
                if (intentData.messages) {
                    // Show both popup and field errors
                    showFieldErrors(intentData.messages);
                    const messageHtml = Object.values(intentData.messages)
                        .flat()
                        .join("<br>");
                    throw new Error(messageHtml);
                } else {
                    throw new Error(intentData.error);
                }
            }

            // Step 2: Confirm payment
            const { error, paymentIntent } = await stripe.confirmCardPayment(
                intentData.client_secret,
                {
                    payment_method: {
                        card: card,
                        billing_details: {
                            name: `${plainData.firstName} ${plainData.lastName}`,
                            email: plainData.email,
                        },
                    },
                }
            );

            if (error) throw new Error(error.message);

            if (
                paymentIntent.status === "requires_action" ||
                paymentIntent.status === "requires_confirmation"
            ) {
                Swal.fire("Action Required", "Please complete authentication.", "info");
                submitBtn.disabled = false;
                submitBtn.textContent = "Join Now";
                return;
            }

            if (paymentIntent.status !== "succeeded") {
                throw new Error("Payment not completed. Please try again.");
            }

            // Step 3: Finalize registration
            const registerRes = await fetch("{{ route('join-community.finalize') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                },
                body: JSON.stringify({
                    payment_intent_id: paymentIntent.id,
                }),
            });

            const registerData = await registerRes.json();

            if (registerData.success) {
                Swal.fire("Success", "Your membership is now active!", "success").then(() => {
                    window.location.href = registerData.redirect_url;
                });
            } else {
                throw new Error(registerData.error || "Failed to register user.");
            }
        } catch (err) {
            console.error("Join Form Error:", err);
            Swal.fire({
                title: "Error",
                html: err.message || "Something went wrong. Please try again.",
                icon: "error",
            });
        } finally {
            submitBtn.disabled = false;
            submitBtn.textContent = "Join Now";
        }
    });
});

</script>

