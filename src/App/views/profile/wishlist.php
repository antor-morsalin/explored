<?php include $this->resolve("partials/_header.php") ?>

<div class="min-h-screen bg-slate-100 font-sans">
    
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="max-w-3xl mx-auto">
            
            <div class="mb-8 text-center md:text-left">
                <h2 class="text-2xl font-bold text-slate-900">My Wishlist</h2>
                <p class="text-slate-500 mt-2">Save interesting places you want to visit later.</p>
            </div>

            <div class="bg-white rounded-2xl border border-dashed border-slate-300 p-16 text-center shadow-sm">
                <div class="mx-auto h-16 w-16 text-slate-300 mb-4 bg-slate-50 rounded-full flex items-center justify-center">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                </div>
                <h3 class="mt-2 text-lg font-semibold text-slate-900">Your wishlist is empty</h3>
                <p class="mt-2 text-slate-500">Start exploring to find your next destination.</p>
                
                <div class="mt-6">
                    <a href="/explored" class="inline-flex items-center rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 transition-colors">
                        Start Exploring
                    </a>
                </div>
            </div>
        </div>
    </main>
</div>

<?php include $this->resolve("partials/_footer.php") ?>