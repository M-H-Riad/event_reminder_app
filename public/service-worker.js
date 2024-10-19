// public/service-worker.js

const CACHE_NAME = 'event-reminder-cache-v1';
const DATA_CACHE_NAME = 'event-data-cache-v1';
const FILES_TO_CACHE = [
    '/',
    '/dashboard',
    'admin/events',
    'public/assets/js/app.js',
    'public/assets/css/app.css',
];

// Install the service worker
self.addEventListener('install', event => {
    event.waitUntil(
        caches.open(CACHE_NAME).then(cache => {
            return cache.addAll(FILES_TO_CACHE);
        })
    );
});

// Activate the service worker
self.addEventListener('activate', event => {
    event.waitUntil(
        caches.keys().then(cacheNames => {
            return Promise.all(
                cacheNames.map(cacheName => {
                    if (cacheName !== CACHE_NAME && cacheName !== DATA_CACHE_NAME) {
                        return caches.delete(cacheName);
                    }
                })
            );
        })
    );
});

// Fetch event
self.addEventListener('fetch', event => {
    if (event.request.url.includes('/api/')) {
        event.respondWith(
            caches.open(DATA_CACHE_NAME).then(cache => {
                return fetch(event.request)
                    .then(response => {
                        if (response.status === 200) {
                            cache.put(event.request, response.clone());
                        }
                        return response;
                    })
                    .catch(() => {
                        return cache.match(event.request);
                    });
            })
        );
    } else {
        event.respondWith(caches.match(event.request).then(response => {
            return response || fetch(event.request);
        }));
    }
});
