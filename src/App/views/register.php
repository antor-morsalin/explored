<?php include $this->resolve("/partials/_header.php") ?>

<main class="min-h-screen flex items-center justify-center p-6">
  <section class="w-full max-w-md bg-white border border-slate-200 rounded-2xl shadow-sm p-8">
    <div class="text-center">
        <h1 class="text-2xl font-bold">Create account</h1>
        <p class="mt-1 text-sm text-slate-600">Register with a username and password.</p>
    </div>

    <form action="/explored/register" method="POST" onsubmit="return validateRegisterForm()" class="mt-6 space-y-4" novalidate>
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
          class="mt-1 w-full rounded-xl border border-slate-300 bg-white px-3 py-2 text-sm outline-none transition-all focus:ring-4 focus:ring-slate-200 focus:border-slate-400"
        />
        <p id="username-error" class="mt-1 text-xs text-red-500 hidden"></p>
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
          class="mt-1 w-full rounded-xl border border-slate-300 bg-white px-3 py-2 text-sm outline-none transition-all focus:ring-4 focus:ring-slate-200 focus:border-slate-400"
        />
        <p id="password-error" class="mt-1 text-xs text-red-500 hidden"></p>
      </div>

      <div>
        <label for="confirm_password" class="block text-sm font-medium text-slate-700">Confirm Password</label>
        <input
          id="confirm_password"
          name="confirm_password"
          type="password"
          required
          autocomplete="new-password"
          placeholder="Re-enter your password"
          class="mt-1 w-full rounded-xl border border-slate-300 bg-white px-3 py-2 text-sm outline-none transition-all focus:ring-4 focus:ring-slate-200 focus:border-slate-400"
        />
        <p id="confirm-error" class="mt-1 text-xs text-red-500 hidden"></p>
      </div>

      <div class="flex items-center">
        <input 
            id="terms" 
            name="terms" 
            type="checkbox" 
            required
            class="h-4 w-4 rounded border-slate-300 text-slate-900 focus:ring-slate-200 transition-colors cursor-pointer"
        >
        <label for="terms" class="ml-2 text-sm text-slate-600 select-none">
            I agree to the 
            <a href="/explored/terms-and-conditions" class="font-medium text-slate-900 hover:underline underline-offset-2">
                terms and conditions
            </a>
        </label>
      </div>

      <button
        type="submit"
        class="w-full rounded-xl bg-slate-900 px-4 py-2.5 text-sm font-semibold text-white hover:bg-slate-800 active:bg-slate-950 transition-colors"
      >
        Register
      </button>

      <p class="text-center text-sm text-slate-600">
        Already have an account?
        <a href="/explored/login" class="font-semibold text-slate-900 underline underline-offset-4 hover:no-underline">
          Log in
        </a>
      </p>
    </form>
  </section>
</main>

<script>
  function validateRegisterForm() {
    // Get Inputs
    const usernameInput = document.getElementById('username');
    const passwordInput = document.getElementById('password');
    const confirmInput = document.getElementById('confirm_password');
    const termsInput = document.getElementById('terms');
    
    // Get Error placeholders
    const userError = document.getElementById('username-error');
    const passError = document.getElementById('password-error');
    const confirmError = document.getElementById('confirm-error');
    
    let isValid = true;

    // Reset styles and hide errors
    userError.classList.add('hidden');
    passError.classList.add('hidden');
    confirmError.classList.add('hidden');

    [usernameInput, passwordInput, confirmInput].forEach(input => {
        input.classList.remove('border-red-500', 'focus:ring-red-100');
        input.classList.add('border-slate-300', 'focus:ring-slate-200');
    });

    // 1. Username Validation
    if (usernameInput.value.trim().length < 3) {
      userError.textContent = 'Username must be at least 3 characters.';
      userError.classList.remove('hidden');
      usernameInput.classList.add('border-red-500', 'focus:ring-red-100');
      isValid = false;
    }

    // 2. Password Length Validation
    if (passwordInput.value.length < 8) {
      passError.textContent = 'Password must be at least 8 characters.';
      passError.classList.remove('hidden');
      passwordInput.classList.add('border-red-500', 'focus:ring-red-100');
      isValid = false;
    }

    // 3. Confirm Password Match Validation
    if (confirmInput.value !== passwordInput.value) {
      confirmError.textContent = 'Passwords do not match.';
      confirmError.classList.remove('hidden');
      confirmInput.classList.add('border-red-500', 'focus:ring-red-100');
      // Optionally highlight the main password field too so user sees both need attention
      passwordInput.classList.add('border-red-500', 'focus:ring-red-100'); 
      isValid = false;
    }

    // 4. Terms Validation
    if (!termsInput.checked) {
       isValid = false;
       alert("You must agree to the terms and conditions to register.");
    }

    return isValid;
  }
</script>

<?php include $this->resolve("partials/_footer.php") ?>