<?php if (empty($hideFooter)): ?>
<footer class="bg-slate-900 border-t border-slate-800 mt-auto text-slate-300 font-sans">
  <div class="mx-auto max-w-7xl px-6 py-10">
    
    <div class="grid grid-cols-1 md:grid-cols-6 gap-8 mb-4">
      
      <div class="col-span-1 md:col-span-2">
        <h3 class="text-xl font-bold text-white tracking-tight">Explored</h3>
        <p class="mt-2 text-xs leading-relaxed text-slate-400 max-w-sm">
          Your personal travel companion. Capture memories, share costs, and inspire others to explore the world.
        </p>
      </div>

      <div class="hidden md:block md:col-span-1"></div>

      <div class="col-span-1">
        <h3 class="text-xs font-bold text-white tracking-wider uppercase mb-3">Discover</h3>
        <ul class="space-y-2">
          <li><a href="/explored" class="text-xs hover:text-indigo-400 transition-colors">Home</a></li>
          <li><a href="/explored/explore" class="text-xs hover:text-indigo-400 transition-colors">Explore</a></li>
        </ul>
      </div>

      <div class="col-span-1">
        <h3 class="text-xs font-bold text-white tracking-wider uppercase mb-3">Company</h3>
        <ul class="space-y-2">
          <li><a href="/explored/about" class="text-xs hover:text-indigo-400 transition-colors">About Us</a></li>
          <li><a href="/explored/contact" class="text-xs hover:text-indigo-400 transition-colors">Contact Support</a></li>
        </ul>
      </div>

      <div class="col-span-1">
        <h3 class="text-xs font-bold text-white tracking-wider uppercase mb-3">Legal</h3>
        <ul class="space-y-2">
          <li><a href="/explored/privacy-policy" class="text-xs hover:text-indigo-400 transition-colors">Privacy Policy</a></li>
          <li><a href="/explored/terms-and-conditions" class="text-xs hover:text-indigo-400 transition-colors">Terms of Service</a></li>
        </ul>
      </div>
      
    </div>

    <div class="border-t border-slate-800 pt-6 flex justify-center items-center">
      <p class="text-xs text-slate-400">
        &copy; <?php echo date('Y'); ?> Explored. All rights reserved.
      </p>
    </div>
  </div>
</footer>
<?php endif; ?>

<div id="page-loader" class="loader-overlay" style="display: none;">
    <div class="loader"></div>
</div>

<script>
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
  
  document.addEventListener("DOMContentLoaded", function() {
      const loader = document.getElementById('page-loader');

      function showLoader() {
          loader.style.display = 'flex';
      }

      function hideLoader() {
          loader.style.display = 'none';
      }
      
      document.addEventListener('click', function(event) {
          const link = event.target.closest('a');
          if (link) {
              const href = link.getAttribute('href');
              const target = link.getAttribute('target');
              
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
      
      document.addEventListener('submit', function(event) {
          if (event.defaultPrevented) { return; }
          showLoader();
      });
      
      window.addEventListener('pageshow', function(event) {
          if (event.persisted) { hideLoader(); }
      });
  });
</script>

</body>
</html>