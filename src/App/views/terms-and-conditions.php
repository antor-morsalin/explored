<?php include $this->resolve("/partials/_header.php") ?>

<main class="min-h-screen bg-slate-50 py-12 px-4 sm:px-6 lg:px-8">
  <div
    class="max-w-3xl mx-auto bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden"
  >
    <div class="bg-slate-900 px-8 py-6 text-center">
      <h1 class="text-2xl font-bold text-white">Terms and Conditions</h1>
      <p class="text-slate-400 text-sm mt-1">Last updated: January 2026</p>
    </div>

    <div class="p-8 space-y-8 text-slate-700 leading-relaxed">
      <section>
        <h2 class="text-xl font-bold text-slate-900 mb-3">1. Introduction</h2>
        <p>
          Welcome to <span class="font-semibold">Explored</span>. By accessing
          our website and using our services to plan your trips and share your
          journeys, you agree to comply with these terms. If you do not agree,
          please discontinue use of the platform.
        </p>
      </section>

      <section>
        <h2 class="text-xl font-bold text-slate-900 mb-3">2. User Accounts</h2>
        <ul class="list-disc pl-5 space-y-2">
          <li>
            To create travel logs and leave reviews, you must register for an
            account.
          </li>
          <li>
            You are responsible for maintaining the security of your login
            credentials.
          </li>
          <li>
            We reserve the right to terminate accounts that violate our
            policies.
          </li>
        </ul>
      </section>

      <section>
        <h2 class="text-xl font-bold text-slate-900 mb-3">
          3. User-Generated Content
        </h2>
        <p class="mb-2">
          When you upload travel logs, photos, or cost estimates:
        </p>
        <ul class="list-disc pl-5 space-y-2">
          <li>
            You retain ownership of your content but grant us a license to
            display it.
          </li>
          <li>You must own the copyright to any photos you upload.</li>
          <li>Content must not be illegal, offensive, or defamatory.</li>
        </ul>
      </section>

      <section>
        <h2 class="text-xl font-bold text-slate-900 mb-3">
          4. Travel Disclaimer
        </h2>
        <div
          class="bg-amber-50 border-l-4 border-amber-500 p-4 text-amber-800 text-sm rounded-r"
        >
          <p class="font-bold">Important Notice:</p>
          <p>
            Information on "Explored," including travel costs and location
            status, is user-generated. We do not guarantee the accuracy of
            pricing or safety. Please verify travel details independently.
          </p>
        </div>
      </section>

      <section>
        <h2 class="text-xl font-bold text-slate-900 mb-3">5. Admin Rights</h2>
        <p>Administrators of Explored reserve the right to:</p>
        <ul class="list-disc pl-5 space-y-2">
          <li>Delete logs or comments without prior notice.</li>
          <li>Ban users for misconduct.</li>
          <li>Moderate content to ensure the safety of the community.</li>
        </ul>
      </section>

      <div
        class="pt-6 border-t border-slate-200 flex flex-col sm:flex-row gap-4"
      >
        <a
          href="/explored/register"
          class="flex-1 bg-slate-900 text-white text-center py-3 rounded-xl font-semibold hover:bg-slate-800 transition-colors"
        >
          I Agree & Register
        </a>
        <a
          href="/explored"
          class="flex-1 bg-white border border-slate-300 text-slate-700 text-center py-3 rounded-xl font-semibold hover:bg-slate-50 transition-colors"
        >
          Back to Home
        </a>
      </div>
    </div>
  </div>
</main>

<?php include $this->resolve("partials/_footer.php") ?>
