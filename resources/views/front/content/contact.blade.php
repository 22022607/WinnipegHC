@include('front.layout.header')

<div class="min-h-screen bg-gray-50">


      
  <!-- Main -->
  <main class="max-w-6xl mx-auto px-6 py-12">
    <!-- Title -->
    <div class="text-center mb-12">
      <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">Contact Us</h1>
      <p class="text-xl text-gray-600 max-w-3xl mx-auto">
        We'd love to hear from you. Get in touch with us for any questions,
        suggestions, or to learn more about joining our healing community.
      </p>
    </div>

    <div class="grid lg:grid-cols-2 gap-12">
      <!-- Contact Form -->
      <div class="border rounded-xl bg-white shadow">
        <div class="p-6 border-b">
          <h2 class="text-2xl text-gray-900 font-semibold">Send us a Message</h2>
        </div>
        <div class="p-6">
          <form class="space-y-6">
            <div class="grid md:grid-cols-2 gap-4">
              <div>
                <label for="firstName" class="block text-sm font-medium text-gray-700">First Name *</label>
                <input type="text" id="firstName" required class="mt-2 block w-full border rounded-lg px-3 py-2" />
              </div>
              <div>
                <label for="lastName" class="block text-sm font-medium text-gray-700">Last Name *</label>
                <input type="text" id="lastName" required class="mt-2 block w-full border rounded-lg px-3 py-2" />
              </div>
            </div>

            <div>
              <label for="email" class="block text-sm font-medium text-gray-700">Email Address *</label>
              <input type="email" id="email" required class="mt-2 block w-full border rounded-lg px-3 py-2" />
            </div>

            <div>
              <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
              <input type="tel" id="phone" class="mt-2 block w-full border rounded-lg px-3 py-2" />
            </div>

            <div>
              <label for="subject" class="block text-sm font-medium text-gray-700">Subject *</label>
              <input type="text" id="subject" required class="mt-2 block w-full border rounded-lg px-3 py-2" />
            </div>

            <div>
              <label for="message" class="block text-sm font-medium text-gray-700">Message *</label>
              <textarea id="message" required placeholder="Tell us how we can help you..." class="mt-2 block w-full border rounded-lg px-3 py-2 min-h-[120px]"></textarea>
            </div>

            <button type="submit" class="w-full bg-purple-600 hover:bg-purple-700 text-white py-3 rounded-lg font-semibold">
              Send Message
            </button>
          </form>
        </div>
      </div>

      <!-- Contact Information -->
      <div class="space-y-6">
        <div class="border rounded-xl bg-white shadow p-6 flex items-start space-x-4">
          <span class="text-purple-600 mt-1">📧</span>
          <div>
            <h3 class="font-semibold text-gray-900 mb-2">Email</h3>
            <p class="text-gray-600">info@winnipeghealingconnection.com</p>
            <p class="text-gray-600">support@winnipeghealingconnection.com</p>
          </div>
        </div>

        <div class="border rounded-xl bg-white shadow p-6 flex items-start space-x-4">
          <span class="text-purple-600 mt-1">📞</span>
          <div>
            <h3 class="font-semibold text-gray-900 mb-2">Phone</h3>
            <p class="text-gray-600">(204) 555-0123</p>
            <p class="text-sm text-gray-500">Monday - Friday, 9am - 5pm CST</p>
          </div>
        </div>

        <div class="border rounded-xl bg-white shadow p-6 flex items-start space-x-4">
          <span class="text-purple-600 mt-1">📍</span>
          <div>
            <h3 class="font-semibold text-gray-900 mb-2">Location</h3>
            <p class="text-gray-600">Serving Winnipeg & surrounding areas</p>
            <p class="text-gray-600">Manitoba, Canada</p>
          </div>
        </div>

        <div class="border rounded-xl bg-white shadow p-6 flex items-start space-x-4">
          <span class="text-purple-600 mt-1">⏰</span>
          <div>
            <h3 class="font-semibold text-gray-900 mb-2">Office Hours</h3>
            <p class="text-gray-600">Monday - Friday: 9:00 AM - 5:00 PM</p>
            <p class="text-gray-600">Saturday: 10:00 AM - 2:00 PM</p>
            <p class="text-gray-600">Sunday: Closed</p>
          </div>
        </div>
      </div>
    </div>

    <!-- FAQ Section -->
    <div class="border rounded-xl bg-white shadow mt-12">
      <div class="p-6 border-b">
        <h2 class="text-2xl text-gray-900 font-semibold text-center">Frequently Asked Questions</h2>
      </div>
      <div class="p-6 grid md:grid-cols-2 gap-8">
        <div>
          <h4 class="font-semibold text-gray-900 mb-2">How do I list my business?</h4>
          <p class="text-gray-600 text-sm">
            Contact us through this form or email us directly. We'll guide you through the process of joining our community directory.
          </p>
        </div>
        <div>
          <h4 class="font-semibold text-gray-900 mb-2">How can I promote my events?</h4>
          <p class="text-gray-600 text-sm">
            Once you're a member, you can submit events through your dashboard. We review all submissions to ensure quality and relevance.
          </p>
        </div>
        <div>
          <h4 class="font-semibold text-gray-900 mb-2">Is there a membership fee?</h4>
          <p class="text-gray-600 text-sm">
            We offer both free and premium membership options. Contact us to learn about the benefits of each tier.
          </p>
        </div>
        <div>
          <h4 class="font-semibold text-gray-900 mb-2">What types of healing practices do you support?</h4>
          <p class="text-gray-600 text-sm">
            We welcome all forms of holistic and alternative healing practices, from traditional therapies to modern wellness approaches.
          </p>
        </div>
      </div>
    </div>
  </main>

 
</div>
@include('front.layout.footer')