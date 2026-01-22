<?php include $this->resolve("partials/_header.php") ?>

<main class="mx-auto max-w-5xl px-6 py-12">

  <header class="mb-8">
    <h1 class="text-4xl font-semibold tracking-tight">
      Create a travel log
    </h1>
    <p class="mt-2 text-base text-slate-600">
      Keep it short. You can add more details later.
    </p>
  </header>

  <form id="createLogForm" action="/explored/logs" method="post" class="space-y-6" novalidate>

    <div>
      <label for="title" class="block text-sm font-medium">
        Title
      </label>
      <input
        id="title"
        name="title"
        type="text"
        class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-3 text-base outline-none focus:border-black focus:ring-1 focus:ring-black transition-colors"
        placeholder="e.g. Weekend in Cox’s Bazar"
      />
      <p id="title-error" class="mt-1 text-xs text-red-500 hidden"></p>
    </div>

    <div>
      <label for="description" class="block text-sm font-medium">
        Short description
      </label>
      <textarea
        id="description"
        name="description"
        rows="3"
        class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-3 text-base outline-none focus:border-black focus:ring-1 focus:ring-black transition-colors"
        placeholder="A quick summary of what this log is about…"
      ></textarea>
      <p id="desc-error" class="mt-1 text-xs text-red-500 hidden"></p>
    </div>

    <div>
      <label for="journey_type" class="block text-sm font-medium">
        Journey type
      </label>
      <div class="relative">
        <select id="journey_type" name="journey_type"
          class="mt-2 w-full appearance-none rounded-lg border border-slate-300 px-4 py-3 text-base outline-none focus:border-black focus:ring-1 focus:ring-black bg-white transition-colors"
        >
          <option value="" disabled selected>Select one</option>
          <option value="solo">Solo</option>
          <option value="small_group">Small group</option>
          <option value="family_travel">Family travel</option>
          <option value="picnic">Picnic</option>
        </select>
      </div>
      <p id="type-error" class="mt-1 text-xs text-red-500 hidden"></p>
      <p class="mt-2 text-sm text-slate-600">
        Helps organize logs later.
      </p>
    </div>

    <div class="pt-4 flex items-center gap-3">
      <button type="submit" class="rounded-lg bg-black px-6 py-3 text-sm font-medium text-white hover:bg-slate-900 transition-colors">
        Get started
      </button>

      <a href="/explored/logs" class="rounded-lg border border-slate-300 px-6 py-3 text-sm font-medium hover:bg-slate-50 transition-colors">
        Cancel
      </a>
    </div>

  </form>

</main>

<script>
    const form = document.getElementById('createLogForm');
    const title = document.getElementById('title');
    const desc = document.getElementById('description');
    const type = document.getElementById('journey_type');

    const titleErr = document.getElementById('title-error');
    const descErr = document.getElementById('desc-error');
    const typeErr = document.getElementById('type-error');

    form.addEventListener('submit', function(e) {
        let isValid = true;
        
        // Reset errors
        [titleErr, descErr, typeErr].forEach(el => el.classList.add('hidden'));
        [title, desc, type].forEach(el => {
            el.classList.remove('border-red-500', 'focus:border-red-500', 'focus:ring-red-200');
            el.classList.add('border-slate-300');
        });

        // Validate Title
        if (!title.value.trim()) {
            showError(title, titleErr, 'Please enter a title for your log.');
            isValid = false;
        } else if (title.value.length > 150) {
            showError(title, titleErr, 'Title is too long (max 150 characters).');
            isValid = false;
        }

        // Validate Description
        if (!desc.value.trim()) {
            showError(desc, descErr, 'Please provide a short description.');
            isValid = false;
        }

        // Validate Journey Type
        if (!type.value) {
            showError(type, typeErr, 'Please select a journey type.');
            isValid = false;
        }

        if (!isValid) {
            e.preventDefault();
        }
    });

    function showError(input, errorEl, msg) {
        errorEl.textContent = msg;
        errorEl.classList.remove('hidden');
        input.classList.remove('border-slate-300');
        input.classList.add('border-red-500', 'focus:border-red-500', 'focus:ring-red-200');
    }
</script>

<?php include $this->resolve("partials/_footer.php") ?>