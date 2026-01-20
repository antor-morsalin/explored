<!DOCTYPE html>
<html lang="en">
<head>
  <script src="https://cdn.tailwindcss.com"></script>
  <meta charset="UTF-8" />
  <title><?php echo e($title) ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <style>
    /* LOADER ANIMATION */
    .loader {
      width: 45px;
      aspect-ratio: 1;
      --c: no-repeat linear-gradient(#000 0 0);
      background: 
        var(--c) 0%   50%,
        var(--c) 50%  50%,
        var(--c) 100% 50%;
      background-size: 20% 100%;
      animation: l1 1s infinite linear; /* Changed to 1s for smoother animation */
    }
    
    @keyframes l1 {
      0%  {background-size: 20% 100%,20% 100%,20% 100%}
      33% {background-size: 20% 10% ,20% 100%,20% 100%}
      50% {background-size: 20% 100%,20% 10% ,20% 100%}
      66% {background-size: 20% 100%,20% 100%,20% 10% }
      100%{background-size: 20% 100%,20% 100%,20% 100%}
    }

    /* OVERLAY CSS */
    .loader-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(2px);
        z-index: 9999;
        display: flex;
        justify-content: center;
        align-items: center;
    }
  </style>
</head>

<body class="min-h-screen flex flex-col font-sans text-slate-900">

  <?php if (empty($hideNavigation)): ?>
  <nav class="flex items-center justify-between px-6 py-4 bg-white border-b border-slate-200 sticky top-0 z-50">
    <div class="text-xl font-bold tracking-tight text-slate-900">
      <a href="/explored/">Explored</a>
    </div>

    <div class="hidden md:flex items-center gap-6 text-sm font-medium text-slate-700">
      <a href="/explored/" class="hover:text-slate-900 transition">Home</a>
      <a href="#" class="hover:text-slate-900 transition">Logs</a>
      <a href="#" class="hover:text-slate-900 transition">Explore</a>
    </div>

    <a
      href="/explored/login"
      class="inline-flex items-center rounded-lg bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-800 active:bg-slate-950 transition"
    >
      Login
    </a>
  </nav>
  <?php endif; ?>

  <div class="flex-1">
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
  </div>