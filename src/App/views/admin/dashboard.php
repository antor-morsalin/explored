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
                <?php if($stats['total_messages'] > 0): ?>
                    <span class="ml-auto bg-indigo-500 text-white text-xs font-bold px-2 py-0.5 rounded-full">
                        <?php echo $stats['total_messages']; ?>
                    </span>
                <?php endif; ?>
            </a>
            <p class="px-3 text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2 mt-6">System</p>
            <!-- <a href="/explored" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-400 hover:text-white hover:bg-slate-800 transition-colors group">
                <svg class="w-5 h-5 opacity-70 group-hover:text-emerald-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                <span class="font-medium">Back to Site</span>
            </a> -->
            
            <button onclick="openLogoutModal()" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-red-400 hover:text-white hover:bg-red-900/50 transition-colors w-full text-left mt-1">
                <svg class="w-5 h-5 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                <span class="font-medium">Sign Out</span>
            </button>
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
                
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-slate-500">Total Users</p>
                            <p class="text-3xl font-bold text-slate-900 mt-1"><?php echo $stats['total_users']; ?></p>
                        </div>
                        <div class="h-12 w-12 bg-blue-50 rounded-full flex items-center justify-center text-blue-600">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-slate-500">Messages</p>
                            <p class="text-3xl font-bold text-slate-900 mt-1"><?php echo $stats['total_messages']; ?></p>
                        </div>
                        <div class="h-12 w-12 bg-purple-50 rounded-full flex items-center justify-center text-purple-600">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center text-sm font-medium text-purple-600 hover:text-purple-700 cursor-pointer transition-colors">
                        <span>View Inbox</span>
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 opacity-60">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-slate-500">Travel Logs</p>
                            <p class="text-3xl font-bold text-slate-900 mt-1">0</p>
                        </div>
                        <div class="h-12 w-12 bg-emerald-50 rounded-full flex items-center justify-center text-emerald-600">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/></svg>
                        </div>
                    </div>
                    <p class="text-xs text-slate-400 mt-2">Coming soon</p>
                </div>

            </div>
        </div>
    </main>
</div>

<div id="logoutModal" class="fixed inset-0 z-50 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm transition-opacity opacity-0" id="logoutBackdrop"></div>

    <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-sm opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" id="logoutPanel">
                <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                            <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                            <h3 class="text-base font-semibold leading-6 text-slate-900" id="modal-title">Sign Out</h3>
                            <div class="mt-2">
                                <p class="text-sm text-slate-500">Are you sure you want to sign out, <span class="font-bold text-slate-900"><?php echo $_SESSION['auth']['user']; ?></span>?<br> You will be redirected to the home page.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                    <a href="/explored/logout" class="inline-flex w-full justify-center rounded-lg bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto">Yes, Sign Out</a>
                    <button type="button" onclick="closeLogoutModal()" class="mt-3 inline-flex w-full justify-center rounded-lg bg-white px-3 py-2 text-sm font-semibold text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 hover:bg-slate-50 sm:mt-0 sm:w-auto">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const logoutModal = document.getElementById('logoutModal');
    const logoutBackdrop = document.getElementById('logoutBackdrop');
    const logoutPanel = document.getElementById('logoutPanel');

    function openLogoutModal() {
        logoutModal.classList.remove('hidden');
        setTimeout(() => {
            logoutBackdrop.classList.remove('opacity-0');
            logoutPanel.classList.remove('opacity-0', 'translate-y-4', 'sm:scale-95');
            logoutPanel.classList.add('opacity-100', 'translate-y-0', 'sm:scale-100');
        }, 10);
    }

    function closeLogoutModal() {
        logoutBackdrop.classList.add('opacity-0');
        logoutPanel.classList.remove('opacity-100', 'translate-y-0', 'sm:scale-100');
        logoutPanel.classList.add('opacity-0', 'translate-y-4', 'sm:scale-95');
        setTimeout(() => {
            logoutModal.classList.add('hidden');
        }, 300);
    }
</script>

<?php include $this->resolve("partials/_footer.php") ?>