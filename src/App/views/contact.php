<?php include $this->resolve("/partials/_header.php") ?>

<main class="min-h-screen bg-slate-50 py-12 px-4 sm:px-6 lg:px-8">
  <div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
    
    <div class="bg-slate-900 px-8 py-6 text-center">
      <h1 class="text-2xl font-bold text-white">Get in Touch</h1>
      <p class="text-slate-400 text-sm mt-1">We'd love to hear from you. Send us a message!</p>
    </div>

    <?php if(isset($_SESSION['flash']['success'])): ?>
      <div class="p-4 mx-auto max-w-4xl bg-green-100 border border-green-200 text-green-700 rounded-lg text-center" role="alert">
        <p class="font-bold">Success!</p>
        <p><?php echo $_SESSION['flash']['success']; unset($_SESSION['flash']['success']); ?></p>
      </div>
    <?php endif; ?>

    <div class="grid grid-cols-1 md:grid-cols-2">
        
        <div class="p-8 bg-slate-50 border-r border-slate-100">
            <h3 class="text-lg font-bold text-slate-900 mb-4">Contact Information</h3>
            
            <div class="text-slate-600 text-sm mb-8 space-y-3 leading-relaxed">
                <p>Have a question about "Explored"?</p>
                <ul class="space-y-1.5 list-disc pl-4 marker:text-slate-400">
                    <li class="font-medium text-slate-900">Found a bug?</li>
                    <li class="font-medium text-slate-900">Have a feature request?</li>
                    <li class="font-medium text-slate-900">Just want to say hi?</li>
                </ul>
                <p>Our team is ready to answer all your questions.</p>
            </div>

            <div class="space-y-6">
                <div class="flex items-start">
                    <svg class="h-6 w-6 text-slate-900 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-slate-900">Headquarters</p>
                        <p class="text-sm text-slate-600">Dhaka, Bangladesh</p>
                    </div>
                </div>

                <div class="flex items-start">
                    <svg class="h-6 w-6 text-slate-900 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-slate-900">Email</p>
                        <p class="text-sm text-slate-600">support@explored.com</p>
                    </div>
                </div>

                <div class="flex items-start">
                    <svg class="h-6 w-6 text-slate-900 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-slate-900">Phone</p>
                        <p class="text-sm text-slate-600">+8801851-330371</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="p-8">
            <form id="contactForm" action="/explored/contact" method="POST" class="space-y-4" novalidate>
                <div>
                    <label for="name" class="block text-sm font-medium text-slate-700">Name</label>
                    <input type="text" id="name" name="name" class="mt-1 w-full rounded-xl border border-slate-300 px-3 py-2 text-sm outline-none focus:ring-4 focus:ring-slate-200 focus:border-slate-400 transition-colors" placeholder="Your name">
                    <p id="name-error" class="text-red-500 text-xs mt-1 hidden"></p>
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-slate-700">Email</label>
                    <input type="email" id="email" name="email" class="mt-1 w-full rounded-xl border border-slate-300 px-3 py-2 text-sm outline-none focus:ring-4 focus:ring-slate-200 focus:border-slate-400 transition-colors" placeholder="you@example.com">
                    <p id="email-error" class="text-red-500 text-xs mt-1 hidden"></p>
                </div>

                <div>
                    <label for="subject" class="block text-sm font-medium text-slate-700">Subject</label>
                    <select id="subject" name="subject" class="mt-1 w-full rounded-xl border border-slate-300 px-3 py-2 text-sm outline-none focus:ring-4 focus:ring-slate-200 focus:border-slate-400 bg-white transition-colors">
                        <option value="">Select a Subject</option>
                        <option value="General Inquiry">General Inquiry</option>
                        <option value="Report a Bug">Report a Bug</option>
                        <option value="Feature Request">Feature Request</option>
                        <option value="Account Issue">Account Issue</option>
                    </select>
                    <p id="subject-error" class="text-red-500 text-xs mt-1 hidden"></p>
                </div>

                <div>
                    <label for="contact_message" class="block text-sm font-medium text-slate-700">Message</label>
                    <textarea 
                        id="contact_message" 
                        name="message" 
                        rows="4" 
                        class="mt-1 w-full rounded-xl border border-slate-300 px-3 py-2 text-sm outline-none focus:ring-4 focus:ring-slate-200 focus:border-slate-400 transition-colors" 
                        placeholder="How can we help you?"
                    ></textarea>
                    <p id="message-error" class="text-red-500 text-xs mt-1 hidden"></p>
                </div>

                <button type="submit" class="w-full bg-slate-900 text-white py-2.5 rounded-xl font-semibold hover:bg-slate-800 transition-colors">
                    Send Message
                </button>
            </form>
        </div>
    </div>
  </div>
</main>

<script>
    const form = document.getElementById('contactForm');
    
    
    const nameInput = document.getElementById('name');
    const emailInput = document.getElementById('email');
    const subjectInput = document.getElementById('subject');
    const messageInput = document.getElementById('contact_message');

    
    const nameError = document.getElementById('name-error');
    const emailError = document.getElementById('email-error');
    const subjectError = document.getElementById('subject-error');
    const messageError = document.getElementById('message-error');

    form.addEventListener('submit', function (event) {
        let isValid = true;
        
        [nameError, emailError, subjectError, messageError].forEach(el => el.classList.add('hidden'));
        [nameInput, emailInput, subjectInput, messageInput].forEach(el => {
            el.classList.remove('border-red-500', 'focus:ring-red-200', 'focus:border-red-500');
            el.classList.add('border-slate-300', 'focus:ring-slate-200');
        });
        
        if (nameInput.value.trim() === '') {
            showError(nameInput, nameError, 'Name is required.');
            isValid = false;
        }
        
        if (emailInput.value.trim() === '') {
            showError(emailInput, emailError, 'Email is required.');
            isValid = false;
        } else if (!isValidEmail(emailInput.value.trim())) {
            showError(emailInput, emailError, 'Please enter a valid email address.');
            isValid = false;
        }
        
        if (subjectInput.value === '') {
            showError(subjectInput, subjectError, 'Please select a subject.');
            isValid = false;
        }
        
        if (messageInput.value.trim() === '') {
            showError(messageInput, messageError, 'Message field cannot be empty.');
            isValid = false;
        }

        if (!isValid) {
            event.preventDefault();
        }
    });
    
    function showError(inputElement, errorElement, message) {
        errorElement.textContent = message;
        errorElement.classList.remove('hidden');
        
        
        inputElement.classList.remove('border-slate-300', 'focus:ring-slate-200');
        inputElement.classList.add('border-red-500', 'focus:ring-red-200', 'focus:border-red-500');
    }

    function isValidEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }
</script>

<?php include $this->resolve("partials/_footer.php") ?>