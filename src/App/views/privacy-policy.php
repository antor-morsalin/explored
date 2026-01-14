<?php include $this->resolve("/partials/_header.php") ?>

<main class="min-h-screen bg-slate-50 py-12 px-4 sm:px-6 lg:px-8">
  <div class="max-w-3xl mx-auto bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
    
    <div class="bg-slate-900 px-8 py-6 text-center">
      <h1 class="text-2xl font-bold text-white">Privacy Policy</h1>
      <p class="text-slate-400 text-sm mt-1">Last updated: January 2026</p>
    </div>

    <div class="p-8 space-y-8 text-slate-700 leading-relaxed">
      
      <section>
        <h2 class="text-xl font-bold text-slate-900 mb-3">1. Introduction</h2>
        <p>
          At <span class="font-semibold">Explored</span>, we respect your privacy. This policy explains how we handle the information you share when you use our platform to create travel logs, upload photos, and plan your trips.
        </p>
      </section>

      <section>
        <h2 class="text-xl font-bold text-slate-900 mb-3">2. Information We Collect</h2>
        <ul class="list-disc pl-5 space-y-2">
          <li><strong>Account Information:</strong> When you register, we collect your username and password to secure your account and session.</li>
          <li><strong>Travel Logs & Content:</strong> We store the destinations, cost estimates, descriptions, and itineraries you upload.</li>
          <li><strong>Media:</strong> Any photos you upload to your travel logs are stored and displayed publicly.</li>
          <li><strong>Interactions:</strong> We collect your reviews, comments, and wish-list activity to enhance the community experience.</li>
        </ul>
      </section>

      <section>
        <h2 class="text-xl font-bold text-slate-900 mb-3">3. How We Use Your Data</h2>
        <p class="mb-2">We use your information to:</p>
        <ul class="list-disc pl-5 space-y-2">
          <li>Display your travel logs and reviews to other users for trip planning.</li>
          <li>Facilitate search functionality based on location and costs.</li>
          <li>Manage user authentication and secure login sessions.</li>
          <li>Enforce community guidelines (Admins may review or remove content).</li>
        </ul>
      </section>

      <section>
        <h2 class="text-xl font-bold text-slate-900 mb-3">4. Public Visibility</h2>
        <div class="bg-blue-50 border-l-4 border-blue-500 p-4 text-blue-800 text-sm rounded-r">
          <p class="font-bold">Please Note:</p>
          <p>
            "Explored" is a public sharing platform. Any travel logs, photos, or comments you post are visible to all visitors. Please avoid sharing sensitive personal information (like home addresses or private phone numbers) in your public logs.
          </p>
        </div>
      </section>

      <section>
        <h2 class="text-xl font-bold text-slate-900 mb-3">5. Data Security & Cookies</h2>
        <p>
            We use cookies to maintain your active session (so you stay logged in). While we implement security measures to protect your account, you are responsible for keeping your password confidential.
        </p>
      </section>

      <div class="pt-6 border-t border-slate-200 flex flex-col sm:flex-row gap-4">
        <a href="/explored/register" class="flex-1 bg-slate-900 text-white text-center py-3 rounded-xl font-semibold hover:bg-slate-800 transition-colors">
          Create Account
        </a>
        <a href="/explored" class="flex-1 bg-white border border-slate-300 text-slate-700 text-center py-3 rounded-xl font-semibold hover:bg-slate-50 transition-colors">
          Back to Home
        </a>
      </div>

    </div>
  </div>
</main>

<?php include $this->resolve("partials/_footer.php") ?>