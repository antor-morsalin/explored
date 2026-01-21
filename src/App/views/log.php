<?php include $this->resolve("partials/_header.php") ?>

<main class="max-w-4xl mx-auto p-6">
    <div class="flex flex-col gap-6">
        
        <!-- Title -->
        <h1 class="text-4xl font-semibold">
            <?php echo $log['title']; ?>
        </h1>

        <!-- Meta info -->
        <div class="flex items-center gap-4 text-sm text-gray-600">
            <span><?php echo $log['ownerName']; ?></span>
            <span>•</span>
            <span><?php echo $log['created_at']; ?></span>
            <span>•</span>
            <span><?php echo $log['journey_type']; ?></span>
        </div>

        <!-- Description -->
        <p class="text-base leading-relaxed text-gray-800">
            <?php echo $log['description']; ?>
        </p>

        <!-- Action -->
         <a href=<?php echo "/explored/logs/{$log['id']}/new" ?>>
            <button class="mt-6 text-white w-full bg-black border border-black py-3 text-sm font-medium hover:bg-white hover:text-black transition">
                Add a new section
            </button>
         </a>
        
    </div>

    <form action=<?php echo "/explored/logs/{$log['id']}/publish" ?> method="post">
        <button class="mt-6 text-black w-full bg-white border border-black py-3 text-sm font-medium hover:bg-black hover:text-white transition">
                Publish 
        </button>
    </form>


    <div class="mt-10 max-w-5xl">
        <h2 class="text-2xl font-semibold tracking-tight mb-6">
            Visited destinations
        </h2>

        <?php foreach ($logSections as $logSection) { ?>
            <div class="flex flex-col justify-between gap-10 rounded-2xl border border-gray-300 p-6 mb-4">

                <div class="flex flex-col gap-3 flex-1">

                    <!-- First row: title + cost -->
                    <div class="flex items-center justify-between gap-20">
                        <h3 class="text-xl font-semibold tracking-tight">
                            <?php echo $logSection['place_name']; ?>
                        </h3>

                        <p class="text-sm">
                            Cost per person:
                            <span class="font-semibold">
                               ৳<?php echo $logSection['avg_cost']; ?> 
                            </span>
                        </p>
                    </div>

                    <!-- Second row -->
                    <p class="text-sm text-gray-600">
                        Visited on <?php echo $logSection['created_at']; ?>
                    </p>

                    <!-- Third row -->
                    <div class="text-sm text-gray-600">
                        Map link:
                        <?php if ($logSection['map_link']) { ?>
                            <a class="underline ml-1" href="<?php echo $logSection['map_link']; ?>">
                                View on Google Maps
                            </a>
                        <?php } else { ?>
                            <span class="text-slate-500 ml-1">Not given</span>
                        <?php } ?>
                    </div>
                    

                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-sm text-gray-600">Type</div>
                            <div class="text-sm font-medium"><?php echo $logSection['place_type']; ?></div>
                        </div>
                        <div>
                            <div class="mt-4 text-sm text-gray-600">Rating</div>
                            <div class="text-sm font-medium"><?php echo $logSection['rating']; ?>/5</div>
                        </div>
                    </div>

                    

                


                </div>

                <!-- Right column -->
                
                
              

            </div>
        <?php } ?>
    </div>


</main>



<?php include $this->resolve("partials/_footer.php") ?>