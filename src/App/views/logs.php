<?php include $this->resolve("partials/_header.php") ?>

<main class="mx-auto max-w-6xl px-6 py-14">

  <section class="border-b pb-10">
    <div class="flex flex-col gap-8 sm:flex-row sm:items-end sm:justify-between">
      <div class="max-w-2xl">
        <h1 class="text-4xl font-semibold tracking-tight">
          Your travel logs
        </h1>
        <p class="mt-3 text-base text-slate-600">
          Write while you travel. Keep everything in one place.
        </p>
      </div>

      <div class="flex gap-3">
        <a
          href="/explored/createlog"
          class="rounded-lg bg-black px-5 py-3 text-sm font-medium text-white hover:bg-slate-900"
        >
          Create new log
        </a>

        <a
          href="/explored/explore"
          class="rounded-lg border px-5 py-3 text-sm font-medium hover:bg-slate-50"
        >
          Explore others
        </a>
      </div>
    </div>

    <div class="mt-6 text-sm text-slate-600">
      Total logs <span class="ml-1 font-medium text-slate-900"><?php echo $totalLogs; ?></span>
    </div>
  </section>

  <section class="pt-10">
    <div class="flex items-center justify-between">
      <h2 class="text-lg font-medium">My logs</h2>
    </div>
  
    <div class="mt-6 max-h-[560px] overflow-y-auto space-y-4">
    
       <?php foreach($logs as $log){ ?>
        <a href= <?php echo "/explored/logs/{$log['id']}"; ?> class="block rounded-lg border p-5 hover:bg-slate-50">
          <div class="flex w-full justify-between">
            <div class="text-base font-medium"><?php echo $log['title'];?></div>
            <?php if ($log['published']) { ?>
              <div class="bg-green-100 rounded p-[5px] text-sm">Published</div>
            <?php } else { ?>
              <div class="bg-red-100 rounded p-[5px] text-sm">Not Published</div>
            <?php } ?>
          </div>
          
          <div class="mt-2 text-sm text-slate-600">
            <?php echo $log['description']?>;
          </div>
        </a>
       <?php } ?>
      
    </div>
  </section>

</main>


<?php include $this->resolve("partials/_footer.php") ?>