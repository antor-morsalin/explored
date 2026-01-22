<?php include $this->resolve("partials/_header.php") ?>

<main class="max-w-4xl mx-auto p-6">

<div class="flex flex-col gap-10 lg:flex-row lg:gap-20 lg:justify-between">
    <div class="flex flex-col gap-6 lg:flex-1">
        
        <h1 class="text-4xl font-semibold">
            <?php echo $log['title']; ?>    
        </h1>

        <h3 class="text-xl font-semibold">Average cost per person ৳<?php echo $avgCost; ?></h3>
        <h3 class="text-xl font-semibold">Overall Rating: <?php echo $avgRating; ?>/5 </h3>

        <div class="flex flex-wrap items-center gap-4 text-sm text-gray-600">
            <span><?php echo $log['ownerName']; ?></span>
            <span class="hidden sm:inline">•</span>
            <span><?php echo $log['created_at']; ?></span>      
            <span class="hidden sm:inline">•</span>
            <span><?php echo $log['journey_type']; ?></span>
        </div>

        <p class="text-base leading-relaxed text-gray-800">
            <?php echo $log['description']; ?>
        </p>

        <?php if (!$log['published']){ ?>
            <a href=<?php echo "/explored/logs/{$log['id']}/new" ?>>
                <button class="mt-6 text-white w-full bg-black border border-black py-3 text-sm font-medium hover:bg-white hover:text-black transition">
                    Add a new section
                </button>
            </a>
        <?php } ?>
        <?php if (isLoggedIn() && getAuth('role')=='user'){ ?>
        <?php if (!$log['published']){ ?>
            <form action=<?php echo "/explored/logs/{$log['id']}/publish" ?> method="post" onsubmit="return confirm('Are you sure you want to publish this log? It will become visible to everyone.');">
                <button class="mt-6 text-black w-full bg-white border border-black py-3 text-sm font-medium hover:bg-black hover:text-white transition">
                    Publish 
                </button>
            </form>
        <?php } else if(!$onWishlist) { ?>
            <form action=<?php echo "/explored/wishlist/{$log['id']}" ?> method="post">
                <button class="w-full rounded-2xl bg-white border border-black py-4 text-sm font-medium text-black hover:bg-black hover:text-white transition">
                    Add to Wish List
                </button>
            </form>
        <?php } else { ?>
            <form action=<?php echo "/explored/wishlist/{$log['id']}/delete" ?> method="post">
                <button class="w-full rounded-2xl bg-white border border-black py-4 text-sm font-medium text-black hover:bg-black hover:text-white transition">
                    Remove from wishlist
                </button>
            </form>
        <?php } ?>
        <?php } ?>
        <div class="max-w-5xl">
            <h2 class="text-2xl font-semibold tracking-tight mb-6">
                Visited destinations
            </h2>

            <?php foreach ($logSections as $logSection) { ?>
                <div class="flex flex-col justify-between gap-10 rounded-2xl border border-gray-300 p-6 mb-4">

                    <div class="flex flex-col gap-3 flex-1">

                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 sm:gap-28">
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

                        <p class="text-sm text-gray-600">
                            Visited on <?php echo $logSection['created_at']; ?>
                        </p>

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

                </div>
            <?php } ?>
        </div>
        
    </div>


    <div class="flex flex-col gap-6 border-gray-300 lg:w-[360px] lg:shrink-0">

        <!-- Prompt -->
         <?php if (isLoggedIn() && getAuth('role')=='user'){ ?>
        <p class="text-base font-medium text-gray-800 text-xl">
            Leave your comment
        </p>

        <form id="commentForm" action=<?php echo "/explored/comment/{$log['id']}" ?> method="post" novalidate>
            <textarea
                id="commentText"
                name="comment"
                rows="5"
                class="w-full rounded-2xl border border-gray-300 p-5 text-sm text-gray-800 outline-none focus:border-black transition-colors"
                placeholder="Write your thoughts here..."
            ></textarea>
            <p id="comment-error" class="text-xs text-red-500 mt-1 mb-2 hidden"></p>
            
            <button
                type="submit"
                class="w-full rounded-2xl bg-black border border-black py-4 text-sm font-medium text-white hover:bg-white hover:text-black transition"
            >
                Comment
            </button>
        </form>
        <?php } ?>


        <!-- Comments section -->   
         <?php if(count($comments)){ ?>
        <div class="flex flex-col gap-4">
            <h2 class="text-xl font-semibold tracking-tight">
                Comments
            </h2>

            <div class="max-h-80 overflow-y-auto rounded-2xl border border-gray-300 p-6 flex flex-col gap-6">
                
                <?php foreach($comments as $comment){ ?>
                    <div class="flex flex-col gap-2 border-b border-gray-200 pb-4">
                        <div class="flex items-center justify-between text-sm">
                            <span class="font-medium"><?php echo $comment['ownerName']; ?></span>
                            <span class="text-gray-500"><?php echo $comment['created_at']; ?></span>
                        </div>
                        <div class="flex intems-center justify-between">
                            <p class="text-sm text-gray-700 leading-relaxed">
                                <?php echo $comment['comment']; ?>
                            </p>
                            <?php if (getAuth('userId') == $comment['owner_id']) { ?>
                                <form action=<?php echo "/explored/comment/{$comment['id']}/delete" ?> method="post" onsubmit="return confirm('Delete this comment?');">
                                    <button type="submit" class="inline-flex h-5 w-5 items-center justify-center rounded bg-red-50 hover:bg-red-100 border border-red-200 text-red-700 text-xs" aria-label="Delete" title="Delete">×</button>
                                </form>
                            <?php } ?>
                        </div>

                    </div>
                <?php } ?>


            </div>
        </div>
         <?php } ?>
         


    </div>

</div>

</main>


<?php include $this->resolve("partials/_footer.php"); ?>