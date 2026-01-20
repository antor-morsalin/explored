<?php include $this->resolve("partials/_header.php") ?>

<div class="min-h-screen bg-slate-100 font-sans">
    
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="max-w-3xl mx-auto">
            <div class="mb-8 text-center md:text-left">
                <h2 class="text-2xl font-bold text-slate-900">Account Settings</h2>
                <p class="text-slate-500 mt-2">Manage your password and security preferences.</p>
            </div>

            <div class="bg-white rounded-2xl border border-slate-200 p-8 shadow-sm">
                <h3 class="text-lg font-semibold leading-6 text-slate-900 mb-6 border-b border-slate-100 pb-4">Change Password</h3>
                
                <form action="/explored/profile/password" method="POST" id="passwordForm" class="space-y-6" onsubmit="return validatePasswordForm()">
                    <div>
                        <label for="current_password" class="block text-sm font-medium text-slate-700">Current Password</label>
                        <input type="password" name="current_password" id="current_password" class="mt-2 block w-full rounded-lg border border-slate-300 px-4 py-3 text-sm outline-none focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 transition-all shadow-sm">
                        
                        <p id="error-current" class="text-xs text-red-500 mt-2 hidden"></p>
                        
                        <?php $errCur = flash('error_current_password'); if($errCur): ?>
                            <p class="text-xs text-red-600 mt-2 font-medium flex items-center gap-1">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <?php echo e($errCur); ?>
                            </p>
                        <?php endif; ?>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="new_password" class="block text-sm font-medium text-slate-700">New Password</label>
                            <input type="password" name="new_password" id="new_password" class="mt-2 block w-full rounded-lg border border-slate-300 px-4 py-3 text-sm outline-none focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 transition-all shadow-sm">
                            
                            <p id="error-new" class="text-xs text-red-500 mt-2 hidden"></p>

                            <?php $errNew = flash('error_new_password'); if($errNew): ?>
                                <p class="text-xs text-red-600 mt-2 font-medium flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    <?php echo e($errNew); ?>
                                </p>
                            <?php endif; ?>
                        </div>

                        <div>
                            <label for="confirm_password" class="block text-sm font-medium text-slate-700">Confirm New Password</label>
                            <input type="password" name="confirm_password" id="confirm_password" class="mt-2 block w-full rounded-lg border border-slate-300 px-4 py-3 text-sm outline-none focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 transition-all shadow-sm">
                            <p id="error-confirm" class="text-xs text-red-500 mt-2 hidden"></p>
                            <?php $errConfirm = flash('error_confirm_password'); if($errConfirm): ?>
                                <p class="text-xs text-red-600 mt-2 font-medium flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    <?php echo e($errConfirm); ?>
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="pt-6 border-t border-slate-100 flex justify-end">
                        <button type="submit" class="bg-indigo-600 text-white px-6 py-2.5 rounded-lg text-sm font-semibold hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 transition shadow-sm">
                            Update Password
                        </button>
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