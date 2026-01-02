<?php include $this -> resolve("/partials/_header.php") ?>
<main class="min-h-screen flex items-center justify-center p-6">
  <section class="w-full max-w-md bg-white border border-slate-200 rounded-2xl shadow-sm p-8">
    <h1 class="text-2xl font-bold">Create account</h1>
    <p class="mt-1 text-sm text-slate-600">Register with a username and password.</p>

    <form action="/explored/register" method="POST" class="mt-6 space-y-4">
      <div>
        <label for="username" class="block text-sm font-medium text-slate-700">Username</label>
        <input
          id="username"
          name="username"
          type="text"
          required
          minlength="3"
          maxlength="30"
          autocomplete="username"
          placeholder="e.g., jannatmim"
          class="mt-1 w-full rounded-xl border border-slate-300 bg-white px-3 py-2 text-sm outline-none focus:ring-4 focus:ring-slate-200 focus:border-slate-400"
        />
      </div>

      <div>
        <label for="password" class="block text-sm font-medium text-slate-700">Password</label>
        <input
          id="password"
          name="password"
          type="password"
          required
          minlength="8"
          autocomplete="new-password"
          placeholder="At least 8 characters"
          class="mt-1 w-full rounded-xl border border-slate-300 bg-white px-3 py-2 text-sm outline-none focus:ring-4 focus:ring-slate-200 focus:border-slate-400"
        />
      </div>

      <button
        type="submit"
        class="w-full rounded-xl bg-slate-900 px-4 py-2.5 text-sm font-semibold text-white hover:bg-slate-800 active:bg-slate-950"
      >
        Register
      </button>

      <p class="text-center text-sm text-slate-600">
        Already have an account?
        <a href="/login" class="font-semibold text-slate-900 underline underline-offset-4 hover:no-underline">
          Log in
        </a>
      </p>
    </form>
  </section>
</main>
<?php include $this -> resolve("partials/_footer.php") ?>