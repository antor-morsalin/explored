<?php include $this->resolve("partials/_header.php") ?>

<div class="flex min-h-screen bg-slate-100 font-sans">
    
    <aside class="w-64 bg-slate-900 text-white flex flex-col flex-shrink-0 transition-all duration-300">
        <div class="h-16 flex items-center px-6 border-b border-slate-800">
            <div class="flex items-center gap-2 font-bold text-xl tracking-tight">
                <span class="text-indigo-400">Explored</span>
                <span class="text-white">Admin</span>
            </div>
        </div>

        <nav class="flex-1 py-6 flex flex-col gap-1 px-3">
            <p class="px-3 text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Menu</p>
            
            <a href="/explored/admin/dashboard" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-400 hover:text-white hover:bg-slate-800 transition-colors">
                <svg class="w-5 h-5 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                <span class="font-medium">Overview</span>
            </a>

            <a href="/explored/admin/users" class="flex items-center gap-3 px-3 py-2.5 rounded-lg bg-indigo-600 text-white shadow-md">
                <svg class="w-5 h-5 opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                <span class="font-medium">Users</span>
            </a>

            <a href="/explored/admin/messages" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-400 hover:text-white hover:bg-slate-800 transition-colors">
                <svg class="w-5 h-5 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                <span class="font-medium">Messages</span>
            </a>

            <p class="px-3 text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2 mt-6">System</p>
            <a href="/explored" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-400 hover:text-white hover:bg-slate-800 transition-colors group">
                <svg class="w-5 h-5 opacity-70 group-hover:text-emerald-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                <span class="font-medium">Back to Site</span>
            </a>
        </nav>
        <div class="p-4 border-t border-slate-800 text-xs text-slate-500 text-center">
            &copy; 2026 Explored Admin
        </div>
    </aside>

    <main class="flex-1 flex flex-col min-w-0 overflow-hidden">
        <header class="bg-white border-b border-slate-200 h-16 flex items-center justify-between px-8">
            <h2 class="text-2xl font-bold text-slate-800">User Management</h2>
            <div class="flex items-center gap-3">
                <div class="text-right hidden sm:block">
                    <p class="text-sm font-semibold text-slate-900"><?php echo e($_SESSION['auth']['user'] ?? 'Admin'); ?></p>
                    <p class="text-xs text-slate-500">Administrator</p>
                </div>
                <div class="h-10 w-10 rounded-full bg-slate-900 text-white flex items-center justify-center font-bold uppercase">
                    <?php echo substr($_SESSION['auth']['user'] ?? 'A', 0, 1); ?>
                </div>
            </div>
        </header>

        <div class="flex-1 overflow-y-auto p-8">
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200 text-xs uppercase text-slate-500 font-semibold tracking-wider">
                            <th class="px-6 py-4">ID</th>
                            <th class="px-6 py-4">Username</th>
                            <th class="px-6 py-4">Role</th>
                            <th class="px-6 py-4 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <?php foreach($users as $user): ?>
                        <tr class="hover:bg-slate-50 transition-colors group">
                            <td class="px-6 py-4 text-slate-500 font-mono text-sm">
                                #<?php echo e($user['id']); ?>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="h-8 w-8 rounded-full bg-slate-200 text-slate-600 flex items-center justify-center text-xs font-bold uppercase">
                                        <?php echo substr($user['username'], 0, 1); ?>
                                    </div>
                                    <span class="font-medium text-slate-900"><?php echo e($user['username']); ?></span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <?php if($user['role'] === 'admin'): ?>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-indigo-100 text-indigo-800">
                                        Admin
                                    </span>
                                <?php else: ?>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-600">
                                        User
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <?php if($user['username'] !== $_SESSION['auth']['user']): ?>
                                    <form action="/explored/admin/users" method="POST" onsubmit="return confirm('Are you sure you want to ban this user? This action cannot be undone.');" class="inline-block">
                                        <input type="hidden" name="id" value="<?php echo e($user['id']); ?>">
                                        <input type="hidden" name="username" value="<?php echo e($user['username']); ?>">
                                        <button type="submit" class="text-red-600 hover:text-red-900 text-sm font-medium px-3 py-1.5 rounded-lg hover:bg-red-50 transition-colors">
                                            Ban User
                                        </button>
                                    </form>
                                <?php else: ?>
                                    <span class="text-xs text-slate-400 italic mr-2">Current Session</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>