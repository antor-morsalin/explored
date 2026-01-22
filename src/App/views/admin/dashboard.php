<?php include $this->resolve("partials/_header.php") ?>

<div class="flex min-h-screen bg-slate-100 font-sans">
    
    <aside class="w-64 bg-slate-900 text-white flex flex-col flex-shrink-0 transition-all duration-300">
        <div class="flex flex-col justify-center items-center h-20 px-6 border-b border-slate-800">
            <a href="/explored/admin/dashboard" class="text-indigo-400 font-bold text-2xl tracking-tight leading-none hover:text-indigo-300 transition-colors">
                Explored
            </a>
            <span class="text-slate-400 text-xs uppercase tracking-wider font-bold mt-3">Admin Dashboard</span>
        </div>

        <nav class="flex-1 py-6 flex flex-col gap-1 px-3">
            <p class="px-3 text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Menu</p>
            
            <a href="/explored/admin/dashboard" class="flex items-center gap-3 px-3 py-2.5 rounded-lg bg-indigo-600 text-white shadow-md">
                <svg class="w-5 h-5 opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                <span class="font-medium">Overview</span>
            </a>

            <a href="/explored/admin/users" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-400 hover:text-white hover:bg-slate-800 transition-colors">
                <svg class="w-5 h-5 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                <span class="font-medium">Users</span>
            </a>

            <a href="/explored/admin/messages" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-400 hover:text-white hover:bg-slate-800 transition-colors">
                <svg class="w-5 h-5 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                <span class="font-medium">Messages</span>
            </a>

            <a href="/explored/admin/logs" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-400 hover:text-white hover:bg-slate-800 transition-colors">
                <svg class="w-5 h-5 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path></svg>
                <span class="font-medium">Travel Logs</span>
            </a>

            <p class="px-3 text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2 mt-6">System</p>
            
            <a href="/explored/logout" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-red-400 hover:text-white hover:bg-red-900/50 transition-colors w-full text-left mt-1">
                <svg class="w-5 h-5 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                <span class="font-medium">Sign Out</span>
            </a>
        </nav>
        <div class="p-4 border-t border-slate-800 text-xs text-slate-500 text-center">
            &copy; 2026 Explored Admin
        </div>
    </aside>

    <main class="flex-1 flex flex-col min-w-0 overflow-hidden">
        
        <header class="bg-white border-b border-slate-200 h-16 flex items-center justify-between px-8">
            <h2 class="text-2xl font-bold text-slate-800">Overview</h2>
            
            <div class="flex items-center gap-3">
                <div class="text-right hidden sm:block">
                    <p class="text-sm font-semibold text-slate-900">
                        <?php echo e($_SESSION['auth']['user'] ?? 'Admin'); ?>
                    </p>
                    <p class="text-xs text-slate-500">Administrator</p>
                </div>
                <div class="h-10 w-10 rounded-full bg-slate-900 text-white flex items-center justify-center font-bold uppercase">
                    <?php echo substr($_SESSION['auth']['user'] ?? 'A', 0, 1); ?>
                </div>
            </div>
        </header>

        <div class="flex-1 overflow-y-auto p-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-200 hover:shadow-md transition-shadow h-64 flex flex-col justify-between">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-slate-500">Total Users</p>
                            <p class="text-4xl font-bold text-slate-900 mt-2"><?php echo $stats['total_users']; ?></p>
                        </div>
                        <div class="h-12 w-12 bg-blue-50 rounded-full flex items-center justify-center text-blue-600">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-200 hover:shadow-md transition-shadow h-64 flex flex-col justify-between">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-slate-500">Messages</p>
                            <p class="text-4xl font-bold text-slate-900 mt-2"><?php echo $stats['total_messages']; ?></p>
                        </div>
                        <div class="h-12 w-12 bg-purple-50 rounded-full flex items-center justify-center text-purple-600">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-200 hover:shadow-md transition-shadow h-64 flex flex-col justify-between">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-slate-500">Travel Logs</p>
                            <p class="text-4xl font-bold text-slate-900 mt-2"><?php echo $stats['total_logs'] ?? 0; ?></p>
                        </div>
                        <div class="h-12 w-12 bg-emerald-50 rounded-full flex items-center justify-center text-emerald-600">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/></svg>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>
</div>

<?php include $this->resolve("partials/_footer.php") ?>