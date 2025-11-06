@include('front.layout.header')

<div class="max-w-lg mx-auto p-6 bg-white rounded-lg shadow mt-4">
 <a href="{{ url('member-dashboard') }}" class="inline-flex items-center text-sm text-gray-600 hover:text-black mb-6">
      <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
      </svg>
      Back to Dashboard
    </a>
    <form id="joinForm">
        @csrf
          <div class="mb-4 text-center">
            <label class="block text-sm font-medium text-gray-700">Spotlight Event</label>
            <p class="mt-1 text-lg font-semibold">$79.00</p>
        </div>
        
 <div class="mb-4">
            <label for="event_spotlight_month" class="block text-sm font-medium text-gray-700">Choose Spotlight Month</label>
            <select name="event_spotlight_month" id="event_spotlight_month" class="w-full mt-2 p-2 border rounded-lg">
                <option value="">Select Month</option>
               
                    <option value="January">January</option>
                    <option value="February">February</option>
                    <option value="March">March</option>
                    <option value="April">April</option>
                    <option value="May">May</option>
                    <option value="June">June</option>
                    <option value="July">July</option>
                    <option value="August">August</option>
                    <option value="September">September</option>
                    <option value="October">October</option>
                    <option value="November">November</option>
                    <option value="December">December</option>
            </select>
        </div>
        <!-- Card Details -->
        <div class="mb-4">
            <label for="card-element" class="block text-sm font-medium text-gray-700">Card Details</label>
            <div id="card-element" class="mt-2 p-3 border rounded-lg"></div>
            <div id="card-errors" class="text-red-500 text-sm mt-2"></div>
        </div>

        <!-- Submit Button -->
        <button type="submit"
                class="w-full bg-purple-600 text-white py-2 px-4 rounded hover:bg-purple-700 transition">
            Pay $79.00
        </button>
    </form>
</div>

@include('front.layout.footer')

<!-- Stripe.js -->
<script src="https://js.stripe.com/v3/"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("joinForm");

    const stripe = Stripe("{{ env('STRIPE_KEY') }}");
    const elements = stripe.elements();
    const card = elements.create("card", {
        style: {
            base: {
                color: "#32325d",
                fontSize: "16px",
                fontFamily: "Arial, sans-serif",
                "::placeholder": { color: "#aab7c4" }
            },
            invalid: {
                color: "#fa755a",
                iconColor: "#fa755a"
            }
        }
    });
    card.mount("#card-element");

    // form.addEventListener("submit", async function(e) {
    //     e.preventDefault();

    //     const formData = new FormData(form);
    //     const plainData = Object.fromEntries(formData.entries());

    //     // Step 1: Create PaymentIntent
    //     let intentRes = await fetch("{{ route('memberdashboard.checkout-spotlight-event') }}", {
    //         method: "POST",
    //         headers: { "X-CSRF-TOKEN": "{{ csrf_token() }}" },
    //         body: formData
    //     });

    //     let intentData = await intentRes.json();

    //     if (intentData.error) {
    //         Swal.fire("Error", intentData.error, "error");
    //         return;
    //     }

    //     // Step 2: Confirm payment on frontend
    //     const { error, paymentIntent } = await stripe.confirmCardPayment(intentData.client_secret, {
    //         payment_method: {
    //             card: card,
    //             billing_details: {
    //                 name: plainData.firstName + " " + plainData.lastName,
    //                 email: plainData.email
    //             }
    //         }
    //     });

    //     if (error) {
    //         document.getElementById("card-errors").textContent = error.message;
    //         return;
    //     }

    //     // Step 3: Register user ONLY IF payment succeeded
    //     if (paymentIntent.status === 'succeeded') {
    //         let registerRes = await fetch("{{ route('membership.update-payment-status') }}", {
    //             method: "POST",
    //             headers: {
    //                 "Content-Type": "application/json",
    //                 "X-CSRF-TOKEN": "{{ csrf_token() }}"
    //             },
    //             body: JSON.stringify({
    //                 payment_intent_id: paymentIntent.id,
    //                 status: paymentIntent.status
    //             })
    //         });

    //         let registerData = await registerRes.json();

    //         if (registerData.success) {
    //             Swal.fire("Success", "Your Spotlight Event is now active!", "success").then(() => {
    //                 window.location.href = "{{ url('member-dashboard') }}";
    //             });
    //         } else {
    //             Swal.fire("Error", registerData.error, "error");
    //         }
    //     }
    // });
    form.addEventListener("submit", async function (e) {
        e.preventDefault();

        const formData = new FormData(form);
        const plainData = Object.fromEntries(formData.entries());

        // ✅ Check if user selected a month
        if (!plainData.event_spotlight_month) {
            Swal.fire("Error", "Please select a spotlight month.", "error");
            return;
        }

        // Step 1: Create PaymentIntent
        let intentRes = await fetch("{{ route('memberdashboard.checkout-spotlight-event') }}", {
            method: "POST",
            headers: { "X-CSRF-TOKEN": "{{ csrf_token() }}" },
            body: formData
        });

        let intentData = await intentRes.json();

        // ✅ Handle "month already booked" or other backend errors
        if (intentData.error) {
            Swal.fire({
                icon: "error",
                title: "Spotlight Unavailable",
                text: intentData.error.includes("already taken")
                    ? "This month's spotlight is already booked. Please choose another month."
                    : intentData.error
            });
            return;
        }

        // Step 2: Confirm payment on frontend
        const { error, paymentIntent } = await stripe.confirmCardPayment(intentData.client_secret, {
            payment_method: {
                card: card,
                billing_details: {
                    name: (plainData.firstName ?? '') + " " + (plainData.lastName ?? ''),
                    email: plainData.email ?? ''
                }
            }
        });

        if (error) {
            document.getElementById("card-errors").textContent = error.message;
            return;
        }

        // Step 3: Register user ONLY IF payment succeeded
        if (paymentIntent.status === "succeeded") {
            let registerRes = await fetch("{{ route('membership.update-payment-status') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    payment_intent_id: paymentIntent.id,
                    status: paymentIntent.status
                })
            });

            let registerData = await registerRes.json();

            if (registerData.success) {
                Swal.fire("Success", "Your Event Spotlight is now active!", "success").then(() => {
                    window.location.href = "{{ url('member-dashboard') }}";
                });
            } else {
                Swal.fire("Error", registerData.error, "error");
            }
        }
    });
});
</script>
