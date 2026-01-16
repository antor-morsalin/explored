<?php include $this->resolve("partials/_header.php") ?>

<div class="flex min-h-screen bg-slate-100 font-sans">
    
    <aside class="w-64 bg-slate-900 text-white flex flex-col flex-shrink-0 transition-all duration-300 hidden md:flex">
        <div class="h-16 flex items-center justify-center border-b border-slate-800">
            <div class="flex items-center gap-2 font-bold text-xl tracking-tight">
                <span class="text-indigo-400">Explored</span>
            </div>
        </div>

        <div class="flex flex-col items-center py-8 border-b border-slate-800 bg-slate-900/50">
            <div class="h-20 w-20 rounded-full bg-indigo-600 border-4 border-slate-800 flex items-center justify-center text-3xl font-bold text-white shadow-lg mb-3">
                <?php echo substr($user['username'], 0, 1); ?>
            </div>
            <h2 class="text-lg font-bold text-white tracking-wide"><?php echo e($user['username']); ?></h2>
            <p class="text-xs text-slate-400 uppercase tracking-wider font-semibold mt-1">
                <?php echo e($user['role']); ?>
            </p>
        </div>

        <nav class="flex-1 py-6 flex flex-col gap-1 px-3">
            <p class="px-3 text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Menu</p>
            <a href="/explored" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-400 hover:text-white hover:bg-slate-800 transition-colors">
                <svg class="w-5 h-5 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                <span class="font-medium">Home</span>
            </a>
            
            <a href="/explored/profile" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-400 hover:text-white hover:bg-slate-800 transition-colors">
                <svg class="w-5 h-5 opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                <span class="font-medium">Overview</span>
            </a>

            <a href="/explored/profile/logs" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-400 hover:text-white hover:bg-slate-800 transition-colors">
                <svg class="w-5 h-5 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                <span class="font-medium">Travel Logs</span>
            </a>

            <a href="/explored/profile/wishlist" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-400 hover:text-white hover:bg-slate-800 transition-colors">
                <svg class="w-5 h-5 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                <span class="font-medium">Wishlist</span>
            </a>

            <a href="/explored/profile/settings" class="flex items-center gap-3 px-3 py-2.5 rounded-lg bg-indigo-600 text-white shadow-md">
                <svg class="w-5 h-5 opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                <span class="font-medium">Settings</span>
            </a>

            <?php if(isset($user['role']) && $user['role'] === 'admin'): ?>
            <p class="px-3 text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2 mt-6">Admin</p>
            <a href="/explored/admin/dashboard" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-400 hover:text-white hover:bg-slate-800 transition-colors">
                <svg class="w-5 h-5 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>
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
        
        <div class="max-w-5xl mx-auto px-6 sm:px-8 py-10">
            <div class="mb-6">
                <h2 class="text-xl font-bold text-slate-900">Account Settings</h2>
                <p class="text-sm text-slate-500 mt-1">Manage your password and security preferences.</p>
            </div>

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
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="pt-4 flex justify-end">
                        <button type="submit" class="bg-slate-900 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-slate-800 transition shadow-sm">Update Password</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</div>

<script>
    function validatePasswordForm() {
        let isValid = true;
        const current = document.getElementById('current_password');
        const newPass = document.getElementById('new_password');
        const confirmPass = document.getElementById('confirm_password');

        const errCurrent = document.getElementById('error-current');
        const errNew = document.getElementById('error-new');
        const errConfirm = document.getElementById('error-confirm');

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