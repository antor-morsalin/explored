<?php include $this->resolve("/partials/_header.php") ?>

<main class="min-h-screen flex items-center justify-center p-6">
  <section class="w-full max-w-md bg-white border border-slate-200 rounded-2xl shadow-sm p-8">
    
    <div class="text-center">
        <h1 class="text-2xl font-bold">Welcome back</h1>
        <p class="mt-1 text-sm text-slate-600">Log in with your username and password.</p>
    </div>

    <form action="/explored/login" method="POST" onsubmit="return validateForm()" class="mt-6 space-y-4" novalidate>
      <div>
        <label for="username" class="block text-sm font-medium text-slate-700">Username</label>
        <input id="username" name="username" type="text" required autocomplete="username"
          placeholder="e.g., antor" class="mt-1 w-full rounded-xl border border-slate-300 bg-white px-3 py-2 text-sm outline-none transition-all focus:ring-4 focus:ring-slate-200 focus:border-slate-400"/>
        <p id="username-error" class="mt-1 text-xs text-red-500 hidden"></p>
      </div>

      <div>
        <label for="password" class="block text-sm font-medium text-slate-700">Password</label>
        <input id="password" name="password" type="password" required autocomplete="current-password" placeholder="Your password" class="mt-1 w-full rounded-xl border border-slate-300 bg-white px-3 py-2 text-sm outline-none transition-all focus:ring-4 focus:ring-slate-200 focus:border-slate-400"/>
        <p id="password-error" class="mt-1 text-xs text-red-500 hidden"></p>
        

      <button type="submit" class="mt-6 w-full rounded-xl bg-slate-900 px-4 py-2.5 text-sm font-semibold text-white hover:bg-slate-800 active:bg-slate-950 transition-colors">
        Log in
      </button>

      <p class="text-center text-sm text-slate-600">
        Don’t have an account?
        <a href="/explored/register" class="font-semibold text-slate-900 underline underline-offset-4 hover:no-underline">
          Create one
        </a>
      </p>
    </form>
  </section>
</main>

<script>
  function validateForm() {
    const usernameInput = document.getElementById('username');
    const passwordInput = document.getElementById('password');
    const termsInput = document.getElementById('terms');
    
    const userError = document.getElementById('username-error');
    const passError = document.getElementById('password-error');
    
    let isValid = true;

    // Reset styles
    userError.classList.add('hidden');
    passError.classList.add('hidden');
    [usernameInput, passwordInput].forEach(input => {
        input.classList.remove('border-red-500', 'focus:ring-red-100');
        input.classList.add('border-slate-300', 'focus:ring-slate-200');
    });

    // Username validation
    if (usernameInput.value.trim().length < 3) {
      userError.textContent = 'Username must be at least 3 characters.';
      userError.classList.remove('hidden');
      usernameInput.classList.add('border-red-500', 'focus:ring-red-100');
      isValid = false;
    }

    // Password validation
    if (passwordInput.value.length < 2) {
      passError.textContent = 'Password must be at least 6 characters.';
      passError.classList.remove('hidden');
      passwordInput.classList.add('border-red-500', 'focus:ring-red-100');
      isValid = false;
    }

    // Terms validation
    if (!termsInput.checked) {
       isValid = false;
       alert("You must accept the terms and conditions.");
    }

    return isValid;
  }
</script>

<?php include $this->resolve("partials/_footer.php") ?>