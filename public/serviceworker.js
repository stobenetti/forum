// // var staticCacheName = "pwa-v" + new Date().getTime();
const staticCacheName = "pwa-v" + new Date().getTime();
// const staticCacheName = "pwa-cache";
var filesToCache = [
    '/offline',
    '/assets/vendor/font-awesome/css/font-awesome.min.css',
    '/assets/vendor/nucleo/css/nucleo.css',
    '/assets/css/argon.css',
    '/assets/vendor/jquery/jquery.min.js',
    '/assets/vendor/popper/popper.min.js',
    '/assets/vendor/bootstrap/bootstrap.min.js',
    '/assets/js/argon.js',
];

self.addEventListener('install', function (event) {
    event.waitUntil(preLoad());
});

var preLoad = function () {
    console.log('[PWA Builder] Install Event processing');
    return caches.open('pwabuilder-offline').then(function (cache) {
        console.log('[PWA Builder] Cached index and offline page during Install');
        return cache.addAll(filesToCache);
    });
}

self.addEventListener('fetch', function (event) {
    console.log('[PWA Builder] The service worker is serving the asset.');
    event.respondWith(checkResponse(event.request).catch(function () {
            return returnFromCache(event.request)
        }
    ));
    event.waitUntil(addToCache(event.request));

    if (event.request.url.endsWith('sair')) {
        caches.delete('pwabuilder-offline');
    }

});

var checkResponse = function (request) {
    return new Promise(function (fulfill, reject) {
        fetch(request).then(function (response) {
            if (response.status !== 404) {
                fulfill(response)
            } else {
                reject()
            }
        }, reject)
    });
};

var addToCache = function (request) {
    return caches.open('pwabuilder-offline').then(function (cache) {
        return fetch(request).then(function (response) {
            console.log('[PWA Builder] add page to offline ' + response.url)
            if (!response.url.endsWith('/favorites/verify')) {
                return cache.put(request, response);
            }
        });
    });
};

var returnFromCache = function (request) {
    return caches.open('pwabuilder-offline').then(function (cache) {
        return cache.match(request).then(function (matching) {
            if (!matching || matching.status == 404) {
                return cache.match('/offline')
            } else {
                return matching
            }
        });
    });
};


//
// // Cache on install
// self.addEventListener("install", event => {
//     this.skipWaiting();
//     event.waitUntil(
//         caches.open(staticCacheName)
//             .then(cache => {
//                 return cache.addAll(filesToCache);
//             })
//     )
// });
//
// // Clear cache on activate
// // self.addEventListener('activate', event => {
// //     event.waitUntil(
// //         caches.keys().then(cacheNames => {
// //             return Promise.all(
// //                 cacheNames
// //                     .filter(cacheName => (cacheName.startsWith("pwa-")))
// //                     .filter(cacheName => (cacheName !== staticCacheName))
// //                     .map(cacheName => caches.delete(cacheName))
// //             );
// //         })
// //     );
// // });
//
// self.addEventListener('activate', event => {
//     console.log('Activating new service worker...');
//
//     const cacheWhitelist = [staticCacheName];
//
//     event.waitUntil(
//         caches.keys().then(cacheNames => {
//             return Promise.all(
//                 cacheNames.map(cacheName => {
//                     if (cacheWhitelist.indexOf(cacheName) === -1) {
//                         return caches.delete(cacheName);
//                     }
//                 })
//             );
//         })
//     );
// });
//
// // Serve from Cache
// self.addEventListener('fetch', event => {
//     event.respondWith(
//         caches.match(event.request)
//             .then(response => {
//                 if (response) {
//                     return response;
//                 }
//                 return fetch(event.request)
//                     .then(response => {
//                         return caches.open(staticCacheName).then(cache => {
//                             cache.put(event.request.url, response.clone());
//                             return response;
//                         });
//                     });
//
//             }).catch(error => {
//             return caches.match('offline');
//         })
//     );
// });
//
// //This is the service worker with the combined offline experience (Offline page + Offline copy of pages)
// //
// // //Install stage sets up the offline page in the cache and opens a new cache
// // self.addEventListener('install', function(event) {
// //     event.waitUntil(preLoad());
// //     this.skipWaiting();
// // });
// //
// // var preLoad = function(){
// //     console.log('[PWA Builder] Install Event processing');
// //     return caches.open('pwabuilder-offline').then(function(cache) {
// //         console.log('[PWA Builder] Cached index and offline page during Install');
// //         return cache.addAll(['/offline']);
// //     });
// // }
// //
// // self.addEventListener('fetch', function(event) {
// //     console.log('[PWA Builder] The service worker is serving the asset.');
// //     event.respondWith(checkResponse(event.request).catch(function() {
// //         return returnFromCache(event.request)}
// //     ));
// //     event.waitUntil(addToCache(event.request));
// // });
// //
// // var checkResponse = function(request){
// //     return new Promise(function(fulfill, reject) {
// //         fetch(request).then(function(response){
// //             if(response.status !== 404) {
// //                 fulfill(response)
// //             } else {
// //                 reject()
// //             }
// //         }, reject)
// //     });
// // };
// //
// // var addToCache = function(request){
// //     return caches.open('pwabuilder-offline').then(function (cache) {
// //         return fetch(request).then(function (response) {
// //             console.log('[PWA Builder] add page to offline'+response.url)
// //             return cache.put(request, response);
// //         });
// //     });
// // };
// //
// // var returnFromCache = function(request){
// //     return caches.open('pwabuilder-offline').then(function (cache) {
// //         return cache.match(request).then(function (matching) {
// //             if(!matching || matching.status == 404) {
// //                 return cache.match('offline')
// //             } else {
// //                 return matching
// //             }
// //         });
// //     });
// // };