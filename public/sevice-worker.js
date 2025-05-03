self.addEventListener('install', function(event) {
    console.log('Service Worker installing.');
    // Faire quelque chose à l'installation
  });
  
  self.addEventListener('activate', function(event) {
    console.log('Service Worker activating.');
    // Faire quelque chose à l'activation
  });
  
  self.addEventListener('fetch', function(event) {
    event.respondWith(
      fetch(event.request).catch(function() {
        return caches.match(event.request);
      })
    );
  });
  