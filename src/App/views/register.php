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
        <div class="relative">
            <input
              id="username"
              name="username"
              type="text"
              required
              minlength="3"
              maxlength="30"
              placeholder="e.g., Kazi Irfan"
              class="mt-1 w-full rounded-xl border border-slate-300 bg-white px-3 py-2 text-sm outline-none transition-all focus:ring-4 focus:ring-slate-200 focus:border-slate-400"
            />
            <div id="username-spinner" class="absolute right-3 top-3.5 hidden">
                <svg class="animate-spin h-4 w-4 text-slate-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </div>
        </div>
        <p id="username-error" class="mt-1 text-xs text-red-500 hidden"></p>
        <p id="username-success" class="mt-1 text-xs text-green-600 hidden">Username is available!</p>
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
        id="submit-btn"
        class="w-full rounded-xl bg-slate-900 px-4 py-2.5 text-sm font-semibold text-white hover:bg-slate-800 active:bg-slate-950 transition-colors disabled:opacity-50 disabled:cursor-not-allowed"
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
  let isUsernameAvailable = false;
  let debounceTimer; // debouncing

  const usernameInput = document.getElementById('username');
  const usernameError = document.getElementById('username-error');
  const usernameSuccess = document.getElementById('username-success');
  const spinner = document.getElementById('username-spinner');
  const submitBtn = document.getElementById('submit-btn');
  
  usernameInput.addEventListener('input', function() {
      const username = this.value.trim();

      // 1. Clear previous timer
      clearTimeout(debounceTimer);

      // 2. Clear UI states immediately while typing
      usernameError.classList.add('hidden');
      usernameSuccess.classList.add('hidden');
      this.classList.remove('border-red-500', 'focus:ring-red-100', 'border-green-500', 'focus:ring-green-100');
      
      
      if (username.length < 3) {
          isUsernameAvailable = false;
          return; 
      }
      
      spinner.classList.remove('hidden');

      // 3. Set a new timer to fetch data after 500ms of inactivity
      debounceTimer = setTimeout(async () => {
          try {
              const response = await fetch(`/explored/api/check-username?username=${encodeURIComponent(username)}`);
              const data = await response.json();

              spinner.classList.add('hidden'); // Hide spinner

              if (data.available) {
                  isUsernameAvailable = true;
                  usernameSuccess.classList.remove('hidden');
                  this.classList.add('border-green-500', 'focus:ring-green-100');
                  submitBtn.disabled = false;
              } else {
                  isUsernameAvailable = false;
                  usernameError.textContent = 'This username is already taken.';
                  usernameError.classList.remove('hidden');
                  this.classList.add('border-red-500', 'focus:ring-red-100');
                  submitBtn.disabled = true;
              }

          } catch (error) {
              console.error('Error checking username:', error);
              spinner.classList.add('hidden');
          }
      }, 500); 
  });

  function validateRegisterForm() {
    const passwordInput = document.getElementById('password');
    const confirmInput = document.getElementById('confirm_password');
    const termsInput = document.getElementById('terms');
    
    const passError = document.getElementById('password-error');
    const confirmError = document.getElementById('confirm-error');
    
    let isValid = true;

    passError.classList.add('hidden');
    confirmError.classList.add('hidden');

    [passwordInput, confirmInput].forEach(input => {
        input.classList.remove('border-red-500', 'focus:ring-red-100');
        input.classList.add('border-slate-300', 'focus:ring-slate-200');
    });
    
    if (passwordInput.value.length < 8) {
      passError.textContent = 'Password must be at least 8 characters.';
      passError.classList.remove('hidden');
      passwordInput.classList.add('border-red-500', 'focus:ring-red-100');
      isValid = false;
    }

    if (confirmInput.value !== passwordInput.value) {
      confirmError.textContent = 'Passwords do not match.';
      confirmError.classList.remove('hidden');
      confirmInput.classList.add('border-red-500', 'focus:ring-red-100');
      passwordInput.classList.add('border-red-500', 'focus:ring-red-100'); 
      isValid = false;
    }

    if (!termsInput.checked) {
       isValid = false;
       alert("You must agree to the terms and conditions to register.");
    }

    return isValid;
  }
</script>

<?php include $this->resolve("partials/_footer.php") ?>