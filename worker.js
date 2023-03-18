const CACHE_NAME='HLR';
const toCache = [
    '/',
    'manifest.json',
    'register.js',
    'assets/img/favicon.png',
];
self.addEventListener('install', function(event) {
    event.waitUntil(
        caches.open(CACHE_NAME).then(function(cache) {
            return cache.addAll(toCache)
        }).then(self.skipWaiting())
    )
})
self.addEventListener('fetch', function(event) {
    event.respondWith(
        fetch(event.request).catch(() => {
            return caches.open(CACHE_NAME).then((cache) => {
                return cache.match(event.request)
            })
        })
    )
});
self.addEventListener('activate', function(event) {
    event.waitUntil(
        caches.keys().then((keyList) => {
            return Promise.all(keyList.map((key) => {
                if (key !== CACHE_NAME) {
                    console.log('cache deleted.', key)
                    return caches.delete(key)
                }
            }))
        }).then(() => self.clients.claim())
    )
});