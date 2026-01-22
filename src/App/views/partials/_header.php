<!DOCTYPE html>
<html lang="en">
<head>
  <script src="https://cdn.tailwindcss.com"></script>
  <meta charset="UTF-8" />
  <title><?php echo e($title) ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body class="min-h-screen flex flex-col font-sans text-slate-900">

<?php if (empty($hideNavigation)): ?>
<nav class="hidden md:flex items-center justify-between px-6 py-4 bg-white border-b border-slate-200 sticky top-0 z-50">

  <div class="text-xl font-bold tracking-tight text-slate-900">
    <a href="/explored/">Explored</a>
  </div>

  <div class="flex items-center gap-6 text-sm font-medium text-slate-700">
    <a href="/explored/" class="hover:text-slate-900 transition">Home</a>
    <a href="/explored/explore" class="hover:text-slate-900 transition">Explore</a>

    <?php if (isLoggedIn()): ?>
      <a href="/explored/logs" class="hover:text-slate-900 transition">Logs</a>
      <a href="/explored/wishlist" class="hover:text-slate-900 transition">Wishlist</a>
      <a href="/explored/profile/settings" class="hover:text-slate-900 transition">Settings</a>
    <?php endif; ?>
  </div>

  <div>
    <?php if (isLoggedIn()): ?>
      <a href="/explored/logout"
         class="inline-flex items-center rounded-lg bg-red-600 px-4 py-2 text-sm font-semibold text-white hover:bg-red-700 transition shadow-sm">
        Logout
      </a>
    <?php else: ?>
      <a href="/explored/login"
         class="inline-flex items-center rounded-lg bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-800 transition shadow-sm">
        Login
      </a>
    <?php endif; ?>
  </div>

</nav>
<?php endif; ?>


<?php if (empty($hideNavigation)): ?>
<nav class="md:hidden bg-white border-b border-slate-200 sticky top-0 z-50">

  <div class="flex items-center justify-between px-6 py-4">
    <div class="text-lg font-bold tracking-tight text-slate-900">
      <a href="/explored/">Explored</a>
    </div>

    <button
      id="mobileMenuBtn"
      class="rounded-md border border-slate-300 px-3 py-2 text-sm font-medium text-slate-700"
      aria-expanded="false"
    >
      Menu
    </button>
  </div>

  <div
    id="mobileMenu"
    class="hidden px-6 pb-4 flex flex-col gap-3 text-sm font-medium text-slate-700"
  >
    <a href="/explored/" class="hover:text-slate-900">Home</a>
    <a href="/explored/explore" class="hover:text-slate-900">Explore</a>

    <?php if (isLoggedIn()): ?>
      <a href="/explored/logs" class="hover:text-slate-900">Logs</a>
      <a href="/explored/wishlist" class="hover:text-slate-900">Wishlist</a>
      <a href="/explored/profile/settings" class="hover:text-slate-900">Settings</a>
      <a href="/explored/logout" class="mt-2 text-red-600 font-semibold">Logout</a>
    <?php else: ?>
      <a href="/explored/login" class="mt-2 font-semibold">Login</a>
    <?php endif; ?>
  </div>

</nav>
<?php endif; ?>



  <?php $message = flash('message'); if ($message) { ?>
  <div id="message"
      class="fixed top-[60px  ] right-6 z-50 max-w-sm rounded-xl border border-blue-200
              bg-white px-5 py-4 text-sm text-blue-900 shadow-lg">
      <div class="flex items-start gap-3">
          <span class="mt-1 h-2 w-2 rounded-full bg-blue-500"></span>
          <p class="leading-relaxed"><?php echo e($message); ?></p>
      </div>
  </div>
  <?php } ?>

  <?php $error = flash('error'); if ($error) { ?>
  <div id="error"
      class="fixed top-[60px] right-6 z-50 max-w-sm rounded-xl border border-red-200
              bg-white px-5 py-4 text-sm text-red-900 shadow-lg">
      <div class="flex items-start gap-3">
          <span class="mt-1 h-2 w-2 rounded-full bg-red-500"></span>
          <p class="leading-relaxed"><?php echo e($error); ?></p>
      </div>
  </div>
  <?php } ?>

  <?php $success = flash('success'); if ($success) { ?>
  <div id="success"
      class="fixed top-[60px] right-6 z-50 max-w-sm rounded-xl border border-green-200
              bg-white px-5 py-4 text-sm text-green-900 shadow-lg">
      <div class="flex items-start gap-3">
          <span class="mt-1 h-2 w-2 rounded-full bg-green-500"></span>
          <p class="leading-relaxed"><?php echo e($success); ?></p>
      </div>
  </div>
  <?php } ?>

<script>
  const btn = document.getElementById('mobileMenuBtn');
  const menu = document.getElementById('mobileMenu');

  if (btn && menu) {
    btn.addEventListener('click', () => {
      const isOpen = !menu.classList.contains('hidden');
      menu.classList.toggle('hidden');
      btn.setAttribute('aria-expanded', String(!isOpen));
    });
  }
</script>
