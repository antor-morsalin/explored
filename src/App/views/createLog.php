<?php include $this->resolve("/partials/_header.php") ?>

<main class="mx-auto max-w-5xl px-6 py-12">

  <header class="mb-8">
    <h1 class="text-4xl font-semibold tracking-tight">
      Create a travel log
    </h1>
    <p class="mt-2 text-base text-slate-600">
      Keep it short. You can add more details later.
    </p>
  </header>

  <form action="/explored/logs" method="post" class="space-y-6">

    <!-- title -->
    <div>
      <label for="title" class="block text-sm font-medium">
        Title
      </label>
      <input
        id="title"
        name="title"
        type="text"
        required
        class="mt-2 w-full rounded-lg border px-4 py-3 text-base outline-none focus:border-black"
        placeholder="e.g. Weekend in Cox’s Bazar"
      />
    </div>

    <!-- short description -->
    <div>
      <label for="description" class="block text-sm font-medium">
        Short description
      </label>
      <textarea
        id="description"
        name="description"
        rows="3"
        required
        class="mt-2 w-full rounded-lg border px-4 py-3 text-base outline-none focus:border-black"
        placeholder="A quick summary of what this log is about…"
      ></textarea>
    </div>

    <!-- journey type -->
    <div>
      <label for="journey_type" class="block text-sm font-medium">
        Journey type
      </label>
      <select
        id="journey_type"
        name="journey_type"
        required
        class="mt-2 w-full rounded-lg border px-4 py-3 text-base outline-none focus:border-black"
      >
        <option value="" disabled selected>Select one</option>
        <option value="solo">Solo</option>
        <option value="small_group">Small group</option>
        <option value="family_travel">Family travel</option>
        <option value="picnic">Picnic</option>
      </select>
      <p class="mt-1 text-sm text-slate-600">
        Helps organize logs later.
      </p>
    </div>

    <!-- actions -->
    <div class="pt-4 flex items-center gap-3">
      <button
        type="submit"
        class="rounded-lg bg-black px-6 py-3 text-sm font-medium text-white hover:bg-slate-900"
      >
        Get started
      </button>

      <a
        href="/explored/logs"
        class="rounded-lg border px-6 py-3 text-sm font-medium hover:bg-slate-50"
      >
        Cancel
      </a>
    </div>

  </form>

</main>

<?php include $this->resolve("partials/_footer.php") ?>
