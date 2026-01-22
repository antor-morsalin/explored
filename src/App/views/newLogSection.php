<?php include $this->resolve("partials/_header.php") ?>

<main class="mx-auto max-w-3xl px-6 py-10">
    <header class="mb-10">
        <h1 class="text-3xl font-semibold tracking-tight">Add a New Section</h1>
        <p class="mt-2 text-sm text-gray-600">
            Add a place you visited during this journey. You can update it later.
        </p>
    </header>

    <form id="sectionForm" method="post" action="<?php echo "/explored/logs/{$logId}/new" ?>" class="space-y-7" novalidate>
        <div>
            <label class="block text-sm font-medium">Place name</label>
            <input
                id="place_name"
                name="place_name"
                type="text"
                class="mt-2 w-full rounded-xl border border-gray-300 px-4 py-2 focus:border-black focus:outline-none transition-colors"
                placeholder="e.g. Marina Bay Sands"
            />
            <p id="place-error" class="mt-1 text-xs text-red-500 hidden"></p>
        </div>

        <div>
            <label class="block text-sm font-medium">Type of place</label>
            <div class="relative">
                <select id="place_type" name="place_type" class="mt-2 w-full appearance-none rounded-xl border border-gray-300 px-4 py-2 focus:border-black focus:outline-none bg-white transition-colors">
                    <option value="">Select type</option>
                    <option>Restaurant</option>
                    <option>Hotel</option>
                    <option>Resort</option>
                    <option>Cafeteria</option>
                    <option>Café</option>
                    <option>Tourist Spot</option>
                    <option>Museum</option>
                    <option>Park</option>
                    <option>Shopping Mall</option>
                    <option>Landmark</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-500 mt-2">
                    <svg class="h-4 w-4 fill-current" viewBox="0 0 20 20"><path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"/></svg>
                </div>
            </div>
            <p id="type-error" class="mt-1 text-xs text-red-500 hidden"></p>
        </div>

        <div>
            <div class="flex items-baseline justify-between">
                <label class="block text-sm font-medium">Google Maps link</label>
                <span class="text-xs text-gray-500">Optional</span>
            </div>
            <input
                name="map_link"
                type="url"
                class="mt-2 w-full rounded-xl border border-gray-300 px-4 py-2 focus:border-black focus:outline-none transition-colors"
                placeholder="https://maps.google.com/..."
            />
        </div>

        <div>
            <label class="block text-sm font-medium">Avg cost per person</label>
            <input
                id="avg_cost"
                name="avg_cost"
                type="number"
                step="0.01"
                min="0"
                class="mt-2 w-40 rounded-xl border border-gray-300 px-4 py-2 focus:border-black focus:outline-none transition-colors"
                placeholder="e.g. 25.00"
            />
            <p id="cost-error" class="mt-1 text-xs text-red-500 hidden"></p>
        </div>

        <div>
            <label class="block text-sm font-medium">Rating (out of 5)</label>
            <input
                id="rating"
                name="rating"
                type="number"
                min="1"
                max="5"
                class="mt-2 w-28 rounded-xl border border-gray-300 px-4 py-2 focus:border-black focus:outline-none transition-colors"
                placeholder="1–5"
            />
            <p id="rating-error" class="mt-1 text-xs text-red-500 hidden"></p>
        </div>

        <button class="w-full rounded-xl border border-black bg-black text-white py-3 font-medium hover:bg-slate-900 transition-colors">
            Add Section
        </button>
    </form>
</main>

<script>
    const form = document.getElementById('sectionForm');
    const place = document.getElementById('place_name');
    const type = document.getElementById('place_type');
    const cost = document.getElementById('avg_cost');
    const rating = document.getElementById('rating');

    const placeErr = document.getElementById('place-error');
    const typeErr = document.getElementById('type-error');
    const costErr = document.getElementById('cost-error');
    const ratingErr = document.getElementById('rating-error');

    form.addEventListener('submit', function(e) {
        let isValid = true;
        
        [placeErr, typeErr, costErr, ratingErr].forEach(el => el.classList.add('hidden'));
        [place, type, cost, rating].forEach(el => {
            el.classList.remove('border-red-500', 'focus:border-red-500');
            el.classList.add('border-gray-300');
        });

        if(!place.value.trim()) {
            showError(place, placeErr, 'Place name is required.');
            isValid = false;
        }

        if(!type.value) {
            showError(type, typeErr, 'Please select a place type.');
            isValid = false;
        }

        if(!cost.value || cost.value < 0) {
            showError(cost, costErr, 'Please enter a valid cost (0 or more).');
            isValid = false;
        }

        if(!rating.value || rating.value < 1 || rating.value > 5) {
            showError(rating, ratingErr, 'Rating must be between 1 and 5.');
            isValid = false;
        }

        if(!isValid) e.preventDefault();
    });

    function showError(input, errorEl, msg) {
        errorEl.textContent = msg;
        errorEl.classList.remove('hidden');
        input.classList.remove('border-gray-300');
        input.classList.add('border-red-500', 'focus:border-red-500');
    }
</script>

<?php include $this->resolve("partials/_footer.php") ?>