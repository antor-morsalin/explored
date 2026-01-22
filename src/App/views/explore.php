<?php include $this->resolve("partials/_header.php") ?>

<main class="max-w-4xl mx-auto px-6 py-12">
    <form method="GET" action="" class="mb-12">
        <div class="max-w-4xl mx-auto flex flex-wrap items-center gap-4">

            <input type="text" name="search" placeholder="Search by title, description, or journey type..." class="flex-1 min-w-[220px] rounded-full border border-gray-300 px-6 py-3 text-base focus:outline-none focus:ring-2 focus:ring-black focus:border-black"
            />

            <select
                name="sort"
                class="w-48 rounded-full border border-gray-300 px-5 py-3 text-base bg-white
                    focus:outline-none focus:ring-2 focus:ring-black focus:border-black"
            >
                <option value="">Sort by</option>
                <option value="newest">Newest</option>
                <option value="oldest">Oldest</option>
            </select>

            <button
                type="submit"
                class="rounded-full border border-black px-6 py-3 text-base font-medium
                    hover:bg-black hover:text-white transition"
            >
                Apply
            </button>

        </div>
    </form>



    <section class="space-y-8">
        <?php foreach ($logs as $log) { ?>
            <a href="<?php echo "/explored/logs/{$log['id']}"; ?>"
               class="block border border-gray-300 rounded-2xl px-8 py-7 hover:bg-gray-50 transition">

                <div class="space-y-4">

                    <div class="flex items-start justify-between gap-8">
                        <h2 class="text-2xl font-semibold tracking-tight leading-snug">
                            <?php echo $log['title']; ?>
                        </h2>

                        <div class="text-base text-gray-800 whitespace-nowrap">
                            ৳<?php echo $log['avgCost']; ?> / person
                        </div>
                    </div>
                    <p class="text-sm text-slate-500">created by <span class="font-bold"> <?php echo $log['ownerName']; ?></span></p>

                    <p class="text-base text-gray-700 leading-relaxed max-w-prose">
                        Ratings: <?php echo $log['avgRating']; ?>/5
                    </p>

                    <p class="text-base text-gray-700 leading-relaxed max-w-prose">
                        <?php echo $log['description']; ?>
                    </p>

                    <div class="text-sm text-gray-500 flex flex-wrap gap-2">
                        <span><?php echo $log['journey_type']; ?></span>
                        <span>•</span>
                        <span><?php echo $log['created_at']; ?></span>
                    </div>

                </div>
            </a>
        <?php } ?>
    </section>

</main>

<?php include $this->resolve("partials/_footer.php");?>
