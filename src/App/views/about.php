<?php include $this->resolve("/partials/_header.php") ?>

<main class="min-h-screen bg-slate-50 py-12 px-4 sm:px-6 lg:px-8">
  <div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
    
    <div class="bg-slate-900 px-8 py-6 text-center">
      <h1 class="text-2xl font-bold text-white">About Us</h1>
      <p class="text-slate-400 text-sm mt-1">Connecting travelers, one log at a time.</p>
    </div>

    <div class="p-8 space-y-10 text-slate-700 leading-relaxed">
      
      <section>
        <h2 class="text-xl font-bold text-slate-900 mb-3">Our Mission</h2>
        <p class="mb-4">
          Travelling and hanging out is embedded in human culture, while making plans and arrangements is at the core of it. 
          At <span class="font-semibold">Explored</span>, we believe your journey shouldn't be a hassle.
        </p>
        <p>
          Our platform allows users to upload detailed travel logs of their journeys to various destinations. 
          By sharing small details, costs, and reviews, we help other users build the best possible trip plan right at their fingertips.
        </p>
      </section>

      <section class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-slate-50 p-6 rounded-xl border border-slate-100">
            <h3 class="font-bold text-slate-900 mb-2">For Travelers</h3>
            <ul class="list-disc pl-5 space-y-1 text-sm text-slate-600">
                <li>Create and share travel logs</li>
                <li>Upload photos of your journey</li>
                <li>Save logs to your wishlist</li>
                <li>Review locations and costs</li>
            </ul>
        </div>
        <div class="bg-slate-50 p-6 rounded-xl border border-slate-100">
            <h3 class="font-bold text-slate-900 mb-2">Community Driven</h3>
            <ul class="list-disc pl-5 space-y-1 text-sm text-slate-600">
                <li>Real reviews from real people</li>
                <li>Comment and discuss trip plans</li>
                <li>Search locations by standard filters</li>
                <li>Transparent cost estimates</li>
            </ul>
        </div>
      </section>

      <section>
        <h2 class="text-xl font-bold text-slate-900 mb-6 text-center">Meet the Team</h2>
        <div class="flex flex-col sm:flex-row justify-center gap-8">
            
            <div class="flex-1 bg-white border border-slate-200 rounded-xl p-6 text-center hover:shadow-md transition-shadow">
                <div class="w-16 h-16 bg-slate-900 rounded-full mx-auto flex items-center justify-center text-white font-bold text-xl mb-3">
                    A
                </div>
                <h3 class="font-bold text-slate-900">Mahmudul Morsalin Antor</h3>
                <p class="text-xs text-slate-500 uppercase tracking-wide mt-1">Developer</p>
                <p class="text-slate-600 text-sm mt-3">ID: 22-48388-3</p>
            </div>

            <div class="flex-1 bg-white border border-slate-200 rounded-xl p-6 text-center hover:shadow-md transition-shadow">
                <div class="w-16 h-16 bg-slate-900 rounded-full mx-auto flex items-center justify-center text-white font-bold text-xl mb-3">
                    I
                </div>
                <h3 class="font-bold text-slate-900">Kazi Irfanul Islam</h3>
                <p class="text-xs text-slate-500 uppercase tracking-wide mt-1">Developer</p>
                <p class="text-slate-600 text-sm mt-3">ID: 22-48400-3</p>
            </div>

        </div>
      </section>

    </div>
  </div>
</main>

<?php include $this->resolve("partials/_footer.php") ?>