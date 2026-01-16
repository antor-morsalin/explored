<?php include $this->resolve("partials/_header.php") ?>

<div class="flex min-h-screen bg-slate-100 font-sans">
    
    <aside class="w-64 bg-slate-900 text-white flex flex-col flex-shrink-0 transition-all duration-300 hidden md:flex">
        <div class="h-16 flex items-center px-6 border-b border-slate-800">
            <div class="flex items-center gap-2 font-bold text-xl tracking-tight">
                <span class="text-indigo-400">Explored</span>
            </div>
        </div>

        <nav class="flex-1 py-6 flex flex-col gap-1 px-3">
            <a href="/explored" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-400 hover:text-white hover:bg-slate-800 transition-colors">
                <svg class="w-5 h-5 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                <span class="font-medium">Home</span>
            </a>

            <a href="/explored/profile" class="flex items-center gap-3 px-3 py-2.5 rounded-lg bg-indigo-600 text-white shadow-md">
                <svg class="w-5 h-5 opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                <span class="font-medium">My Profile</span>
            </a>

            <?php if(isset($user['role']) && $user['role'] === 'admin'): ?>
            <p class="px-3 text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2 mt-6">Admin</p>
            <a href="/explored/admin/dashboard" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-400 hover:text-white hover:bg-slate-800 transition-colors">
                <svg class="w-5 h-5 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                <span class="font-medium">Dashboard</span>
            </a>
            <?php endif; ?>

            <div class="mt-auto pt-6 border-t border-slate-800">
                <a href="/explored/logout" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-red-400 hover:text-white hover:bg-red-900/50 transition-colors">
                    <svg class="w-5 h-5 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    <span class="font-medium">Sign Out</span>
                </a>
            </div>
        </nav>
    </aside>

    <main class="flex-1 min-w-0 overflow-y-auto">
        <div class="bg-white pb-6 shadow-sm border-b border-slate-200">
            <div class="h-48 w-full bg-slate-800 relative overflow-hidden">
                <img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?q=80&w=2070&auto=format&fit=crop" class="w-full h-full object-cover opacity-60">
                <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 to-transparent"></div>
            </div>
            
            <div class="max-w-5xl mx-auto px-6 sm:px-8">
                <div class="-mt-16 relative flex flex-col md:flex-row items-end md:items-end gap-6">
                    <div class="h-32 w-32 rounded-full ring-4 ring-white bg-slate-900 flex items-center justify-center text-4xl font-bold text-white shadow-lg">
                        <?php echo substr($user['username'], 0, 1); ?>
                    </div>
                    
                    <div class="flex-1 mb-2">
                        <h1 class="text-3xl font-bold text-slate-900"><?php echo e($user['username']); ?></h1>
                        <p class="text-slate-500 font-medium capitalize"><?php echo e($user['role']); ?> • Member since 2026</p>
                    </div>
                </div>

                <div class="mt-8 border-b border-slate-200">
                    <nav class="-mb-px flex space-x-8">
                        <button onclick="switchTab('logs')" id="tab-logs" class="whitespace-nowrap pb-4 px-1 border-b-2 font-medium text-sm border-indigo-500 text-indigo-600 transition-colors">
                            My Travel Logs
                        </button>
                        <button onclick="switchTab('wishlist')" id="tab-wishlist" class="whitespace-nowrap pb-4 px-1 border-b-2 font-medium text-sm border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300 transition-colors">
                            Wishlist
                        </button>
                        <button onclick="switchTab('settings')" id="tab-settings" class="whitespace-nowrap pb-4 px-1 border-b-2 font-medium text-sm border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300 transition-colors">
                            Settings
                        </button>
                    </nav>
                </div>
            </div>
        </div>

        <div class="max-w-5xl mx-auto px-6 sm:px-8 py-8">
            
            <div id="content-logs" class="block animate-fade">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold text-slate-900">My Journeys</h2>
                    <button class="text-sm font-medium text-indigo-600 hover:text-indigo-800">+ Create New Log</button>
                </div>
                <div class="bg-white rounded-2xl border border-dashed border-slate-300 p-12 text-center">
                    <div class="mx-auto h-12 w-12 text-slate-400 mb-4">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    </div>
                    <h3 class="mt-2 text-sm font-semibold text-slate-900">No logs yet</h3>
                    <p class="mt-1 text-sm text-slate-500">Get started by creating your first travel log.</p>
                </div>
            </div>

            <div id="content-wishlist" class="hidden animate-fade">
                <h2 class="text-xl font-bold text-slate-900 mb-6">Saved Places</h2>
                <div class="bg-white rounded-2xl border border-dashed border-slate-300 p-12 text-center">
                    <div class="mx-auto h-12 w-12 text-slate-400 mb-4">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                    </div>
                    <h3 class="mt-2 text-sm font-semibold text-slate-900">Your wishlist is empty</h3>
                    <p class="mt-1 text-sm text-slate-500">Save interesting places you want to visit later.</p>
                </div>
            </div>

            <div id="content-settings" class="hidden animate-fade">
                <div class="max-w-2xl">
                    <h2 class="text-xl font-bold text-slate-900 mb-6">Account Settings</h2>
                    
                    <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm">
                        <h3 class="text-base font-semibold leading-6 text-slate-900 mb-4">Change Password</h3>
                        
                        <form action="/explored/profile/password" method="POST" id="passwordForm" class="space-y-4" onsubmit="return validatePasswordForm()">
                            
                            <div>
                                <label for="current_password" class="block text-sm font-medium text-slate-700">Current Password</label>
                                <input type="password" name="current_password" id="current_password" class="mt-1 block w-full rounded-lg border border-slate-300 px-3 py-2 text-sm outline-none focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 transition-all">
                                
                                <p id="error-current" class="text-xs text-red-500 mt-1 hidden"></p>
                                
                                <?php $errCur = flash('error_current_password'); if($errCur): ?>
                                    <p class="text-xs text-red-600 mt-1 font-medium flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        <?php echo e($errCur); ?>
                                    </p>
                                    <script>document.addEventListener("DOMContentLoaded", () => switchTab('settings'));</script>
                                <?php endif; ?>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="new_password" class="block text-sm font-medium text-slate-700">New Password</label>
                                    <input type="password" name="new_password" id="new_password" class="mt-1 block w-full rounded-lg border border-slate-300 px-3 py-2 text-sm outline-none focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 transition-all">
                                    
                                    <p id="error-new" class="text-xs text-red-500 mt-1 hidden"></p>

                                    <?php $errNew = flash('error_new_password'); if($errNew): ?>
                                        <p class="text-xs text-red-600 mt-1 font-medium flex items-center gap-1">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            <?php echo e($errNew); ?>
                                        </p>
                                        <script>document.addEventListener("DOMContentLoaded", () => switchTab('settings'));</script>
                                    <?php endif; ?>
                                </div>

                                <div>
                                    <label for="confirm_password" class="block text-sm font-medium text-slate-700">Confirm New Password</label>
                                    <input type="password" name="confirm_password" id="confirm_password" class="mt-1 block w-full rounded-lg border border-slate-300 px-3 py-2 text-sm outline-none focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 transition-all">
                                    
                                    <p id="error-confirm" class="text-xs text-red-500 mt-1 hidden"></p>

                                    <?php $errConfirm = flash('error_confirm_password'); if($errConfirm): ?>
                                        <p class="text-xs text-red-600 mt-1 font-medium flex items-center gap-1">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            <?php echo e($errConfirm); ?>
                                        </p>
                                        <script>document.addEventListener("DOMContentLoaded", () => switchTab('settings'));</script>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="pt-4 flex justify-end">
                                <button type="submit" class="bg-slate-900 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-slate-800 transition shadow-sm">Update Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </main>
</div>

<script>
    function switchTab(tabName) {
        document.getElementById('content-logs').classList.add('hidden');
        document.getElementById('content-wishlist').classList.add('hidden');
        document.getElementById('content-settings').classList.add('hidden');

        const tabs = ['logs', 'wishlist', 'settings'];
        tabs.forEach(t => {
            const btn = document.getElementById(`tab-${t}`);
            btn.classList.remove('border-indigo-500', 'text-indigo-600');
            btn.classList.add('border-transparent', 'text-slate-500');
        });

        document.getElementById(`content-${tabName}`).classList.remove('hidden');

        const activeBtn = document.getElementById(`tab-${tabName}`);
        activeBtn.classList.remove('border-transparent', 'text-slate-500');
        activeBtn.classList.add('border-indigo-500', 'text-indigo-600');
    }

    function validatePasswordForm() {
        let isValid = true;
        const current = document.getElementById('current_password');
        const newPass = document.getElementById('new_password');
        const confirmPass = document.getElementById('confirm_password');

        const errCurrent = document.getElementById('error-current');
        const errNew = document.getElementById('error-new');
        const errConfirm = document.getElementById('error-confirm');

        // Reset
        [errCurrent, errNew, errConfirm].forEach(el => el.classList.add('hidden'));
        [current, newPass, confirmPass].forEach(el => el.classList.remove('border-red-500', 'focus:ring-red-100'));

        if(!current.value) {
            errCurrent.innerText = "Current password is required.";
            errCurrent.classList.remove('hidden');
            current.classList.add('border-red-500', 'focus:ring-red-100');
            isValid = false;
        }

        if(newPass.value.length < 8) {
            errNew.innerText = "Password must be at least 8 characters.";
            errNew.classList.remove('hidden');
            newPass.classList.add('border-red-500', 'focus:ring-red-100');
            isValid = false;
        }

        if(newPass.value !== confirmPass.value) {
            errConfirm.innerText = "Passwords do not match.";
            errConfirm.classList.remove('hidden');
            confirmPass.classList.add('border-red-500', 'focus:ring-red-100');
            isValid = false;
        }

        return isValid;
    }
</script>

<?php include $this->resolve("partials/_footer.php") ?>