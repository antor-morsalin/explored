<footer class="border-t border-slate-200 bg-white mt-auto">
  <div class="mx-auto max-w-7xl px-6 py-10">
    <div class="flex flex-col gap-8 md:flex-row md:items-center md:justify-between">
      
      <div>
        <h3 class="text-lg font-bold text-slate-900">Explored</h3>
        <p class="mt-1 text-sm text-slate-600">
          Travel logs shared by real people.
        </p>
      </div>

      <div class="flex flex-wrap gap-6 text-sm font-medium text-slate-600">
        <a href="#" class="hover:text-slate-900 transition">About</a>
        <a href="#" class="hover:text-slate-900 transition">Contact</a>
        <a href="#" class="hover:text-slate-900 transition">Privacy</a>
        <a href="/explored/terms-and-conditions" class="hover:text-slate-900 transition">Terms</a>
      </div>

    </div>
  </div>

  <div class="border-t border-slate-200 py-4 text-center text-sm text-slate-500">
    © 2025 Explored. All rights reserved.
  </div>
</footer>

<div id="page-loader" class="loader-overlay" style="display: none;">
    <div class="loader"></div>
</div>

<script>
  // --- Flash Message Timeout Script ---
  const message = document.getElementById('message');
  const error = document.getElementById('error');
  const success = document.getElementById('success');
  
  if(message || error || success) {
      setTimeout(() => {
        if(message) message.remove();
        if(error) error.remove();
        if(success) success.remove();
      }, 10000);
  }

  // --- Page Loader Script ---
  document.addEventListener("DOMContentLoaded", function() {
      const loader = document.getElementById('page-loader');

      function showLoader() {
          loader.style.display = 'flex';
      }

      function hideLoader() {
          loader.style.display = 'none';
      }

      // Click listener for links
      document.addEventListener('click', function(event) {
          const link = event.target.closest('a');
          if (link) {
              const href = link.getAttribute('href');
              const target = link.getAttribute('target');
              
              // Logic: Only show loader for actual internal navigation
              if (
                  target !== '_blank' && 
                  href && 
                  !href.startsWith('#') && 
                  !href.startsWith('javascript') && 
                  !event.ctrlKey && 
                  !event.metaKey
              ) {
                  showLoader();
              }
          }
      });

      // Submit listener for forms
      document.addEventListener('submit', function(event) {
          // FIX: If client-side validation failed, event.defaultPrevented will be true.
          // In that case, we simply return and do NOT show the loader.
          if (event.defaultPrevented) {
              return;
          }
          showLoader();
      });

      // Fix for browser "Back" button
      window.addEventListener('pageshow', function(event) {
          if (event.persisted) {
              hideLoader();
          }
      });
  });
</script>

</body>
</html>