const CACHE_NAME = 'my-cache-v1';
const urlsToCache = [
    '/public/assets/css/vendors.css',
    '/public/assets/css/bootstrap-rtl.min.css',
    '/public/assets/css/aiz-core.min.css',
    '/public/assets/css/custom-style.css',
    '/public/assets/css/owl.carousel.min.css',
    '/public/assets/js/vendors.js',
    '/public/assets/js/aiz-core.min.js',
    '/public/assets/js/owl.carousel.min.js',
    '/public/assets/js/moment.min.js',
    '/public/assets/js/whatsapp-chat-support.js',
    'https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800&display=swap',
    'https://fonts.googleapis.com/css2?family=Domine:wght@400;500;600;700&display=swap',
    'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css'
];

self.addEventListener('install', function(event) {
    console.log('Service Worker installing...');
    event.waitUntil(
        caches.open(CACHE_NAME)
            .then(function(cache) {
                console.log('Opened cache and caching assets');
                return cache.addAll(urlsToCache);
            })
            .catch(function(error) {
                console.error('Failed to cache:', error);
            })
    );
});

self.addEventListener('fetch', function(event) {
    console.log('Fetch event for:', event.request.url);
    event.respondWith(
        caches.match(event.request)
            .then(function(response) {
                if (response) {
                    console.log('Serving from cache:', event.request.url);
                    return response;
                }
                console.log('Fetching from network:', event.request.url);
                return fetch(event.request)
                    .then(function(networkResponse) {
                        // Only cache successful responses
                        if (networkResponse && networkResponse.status === 200) {
                            caches.open(CACHE_NAME).then(function(cache) {
                                cache.put(event.request, networkResponse.clone());
                            });
                        }
                        return networkResponse;
                    })
                    .catch(function(error) {
                        console.error('Fetch failed:', error);
                        throw error;  // Re-throw the error to be caught by the browser
                    });
            })
            .catch(function(error) {
                console.error('Error in fetch handler:', error);
                // Optionally, you can return a fallback response here
            })
    );
});
