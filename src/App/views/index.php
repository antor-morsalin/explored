<?php include $this->resolve("/partials/_header.php") ?>

<style>
    @keyframes slow-zoom-pan {
        0% {
            transform: scale(1) translate(0, 0);
        }
        50% {
            /* Zoom in slightly and move a little */
            transform: scale(1.15) translate(-1%, -1%);
        }
        100% {
            /* Return to start position */
            transform: scale(1) translate(0, 0);
        }
    }

    .animate-bg-image {
        /* Run the animation over 30 seconds, infinitely, moving back and forth smoothly */
        animation: slow-zoom-pan 30s ease-in-out infinite alternate;
        will-change: transform; /* Performance optimization for smooth movement */
    }
</style>

<main class="min-h-screen relative flex flex-col items-center justify-center overflow-hidden">
    
    <div class="absolute inset-0 z-0">
        <img 
            src="https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?q=80&w=2070&auto=format&fit=crop" 
            alt="Travel Background" 
            class="w-full h-full object-cover animate-bg-image"
        >
        <div class="absolute inset-0 bg-black/40"></div>
    </div>
    <div class="relative z-10 text-center text-white px-4">
        <h1 class="text-4xl md:text-6xl font-bold tracking-tight drop-shadow-lg">
            Welcome to Explored
        </h1>
        
        <p class="mt-4 text-lg md:text-xl text-slate-200 drop-shadow-md max-w-lg mx-auto">
            Your journey begins here. Discover and share travel logs from around the world.
        </p>

        <div class="mt-8">
            <a href="/explored" class="rounded-full bg-white/90 text-slate-900 px-8 py-3 font-semibold hover:bg-white transition-colors">
                Start Exploring
            </a>
         </div>
    </div>
    </main>

<?php include $this->resolve("partials/_footer.php") ;?>