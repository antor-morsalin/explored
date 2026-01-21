<?php include $this->resolve("partials/_header.php") ?>

<main class="mx-auto max-w-3xl px-6 py-10">
    <header class="mb-10">
        <h1 class="text-3xl font-semibold tracking-tight">Add a New Section</h1>
        <p class="mt-2 text-sm text-gray-600">
            Add a place you visited during this journey. You can update it later.
        </p>
    </header>

    <form method="post" action=<?php echo "/explored/logs/{$logId}/new" ?> class="space-y-7">
        <div>
            <label class="block text-sm font-medium">Place name</label>
            <input
                name="place_name"
                type="text"
                class="mt-2 w-full rounded-xl border border-gray-300 px-4 py-2 focus:border-black focus:outline-none"
                placeholder="e.g. Marina Bay Sands"
            />
        </div>

        <div>
            <label class="block text-sm font-medium">Type of place</label>
            <select name="place_type" class="mt-2 w-full rounded-xl border border-gray-300 px-4 py-2 focus:border-black focus:outline-none">
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
        </div>

        <div>
            <div class="flex items-baseline justify-between">
                <label class="block text-sm font-medium">Google Maps link</label>
                <span class="text-xs text-gray-500">Optional</span>
            </div>
            <input
                name="map_link"
                type="url"
                class="mt-2 w-full rounded-xl border border-gray-300 px-4 py-2 focus:border-black focus:outline-none"
                placeholder="Add link to the place for ease of other users"
            />
        </div>

        <div>
            <label class="block text-sm font-medium">Avg cost per person</label>
            <input
                name="avg_cost"
                type="number"
                step="0.01"
                class="mt-2 w-40 rounded-xl border border-gray-300 px-4 py-2 focus:border-black focus:outline-none"
                placeholder="e.g. 25.00"
            />
        </div>

        <div>
            <label class="block text-sm font-medium">Rating (out of 5)</label>
            <input
                name="rating"
                type="number"
                min="1"
                max="5"
                class="mt-2 w-28 rounded-xl border border-gray-300 px-4 py-2 focus:border-black focus:outline-none"
                placeholder="1–5"
            />
        </div>

        <button class="w-full rounded-xl border border-black py-3 font-medium hover:bg-black hover:text-white transition">
            Add Section
        </button>
    </form>

</main>

<?php include $this->resolve("partials/_footer.php") ?>
