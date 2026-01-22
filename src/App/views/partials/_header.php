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
  <nav class="flex items-center justify-between px-6 py-4 bg-white border-b border-slate-200 sticky top-0 z-50">
    <div class="text-xl font-bold tracking-tight text-slate-900">
      <a href="/explored/">Explored</a>
    </div>

    <div class="hidden md:flex items-center gap-6 text-sm font-medium text-slate-700">
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
            <a
              href="/explored/logout"
              class="inline-flex items-center rounded-lg bg-red-600 px-4 py-2 text-sm font-semibold text-white hover:bg-red-700 active:bg-red-800 transition shadow-sm"
            >
              Logout
            </a>
        <?php else: ?>
            <a
              href="/explored/login"
              class="inline-flex items-center rounded-lg bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-800 active:bg-slate-950 transition shadow-sm"
            >
              Login
            </a>
        <?php endif; ?>
    </div>
  </nav>
  <?php endif; ?>

    <?php $message = flash('message'); if ($message) { ?>
    <div id="message" class="mx-6 mt-4 flex items-center gap-3 rounded-lg border border-blue-200 bg-blue-50 px-4 py-3 text-sm text-blue-800">
      <span class="h-2 w-2 rounded-full bg-blue-500"></span>
      <?php echo e($message); ?>
    </div>
    <?php } ?>

    <?php $error = flash('error'); if ($error) { ?>
    <div id="error" class="mx-6 mt-3 flex items-center gap-3 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
      <span class="h-2 w-2 rounded-full bg-red-500"></span>
      <?php echo e($error); ?>
    </div>
    <?php } ?>

    <?php $success = flash('success'); if ($success) { ?>
    <div id="success" class="mx-6 mt-3 flex items-center gap-3 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800">
      <span class="h-2 w-2 rounded-full bg-green-500"></span>
      <?php echo e($success); ?>
    </div>
    <?php } ?>