<!DOCTYPE html>
<html lang="en">
<head>
  <script src="https://cdn.tailwindcss.com"></script>
  <meta charset="UTF-8" />
  <title><?php echo e($title) ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

<body class="min-h-screen flex flex-col">

  <nav class="flex items-center justify-between px-6 py-4 bg-white border-b border-slate-200">
  <div class="text-xl font-bold tracking-tight text-slate-900">
    Explored
  </div>

  <div class="hidden md:flex items-center gap-6 text-sm font-medium text-slate-700">
    <a href="#" class="hover:text-slate-900 transition">Home</a>
    <a href="#" class="hover:text-slate-900 transition">Logs</a>
    <a href="#" class="hover:text-slate-900 transition">Explore</a>
  </div>

  <a
    href="#"
    class="inline-flex items-center rounded-lg bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-800 active:bg-slate-950 transition"
  >
    Login
  </a>
</nav>
