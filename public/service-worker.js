/* |-----------------------------------------------------
   | Service Worker
   |-----------------------------------------------------
   | É uma API presente nos navegadores, sua função é  
   |  executar em segundo plano algumas tarefas. No
   |  nosso caso, estou fazendo com que ele guarde
   |  no cache do navegador os arquivos mais 
   |  importantes, como css e fontes.
   | ----------------------------------------------------
*/

// cacheName é para dizer a versão do cache, quando tiver novo conteúdo voce 
//   vai querer que seja atualizado.
var cacheName = 'v10';

// Todos os arquivos que desejamos que o serviceWorker guarde para nós.
var cacheFiles = [
    //'./css/app.css',
    //'./css/main.css',
    'https://fonts.googleapis.com/css?family=Raleway:300,400,600',
    'https://fonts.gstatic.com/s/raleway/v11/0dTEPzkLWceF7z0koJaX1A.woff2',
    'https://fonts.gstatic.com/s/raleway/v11/xkvoNo9fC8O2RDydKj12b_k_vArhqVIZ0nv9q090hN8.woff2',
    './js/work.js'
];

// Faz o cache armazenar os arquivos
self.addEventListener("install", function(e){
    console.log("{service-worker} installed");

    e.waitUntil(
        caches.open(cacheName).then(function(cache){
            console.log("{service-worker} Caching cacheFiles");
            return cache.addAll(cacheFiles);
        })    
    )
});


self.addEventListener("activate", function(e){
    console.log("{service-worker} installed");

    e.waitUntil(
        caches.keys().then(function(cacheNames){
            return Promise.all(cacheNames.map(function(thisCacheName){
                if (thisCacheName !== cacheName) {
                    console.log("{service-worker} Removing cache files from: ", thisCacheName);
                    return caches.delete(thisCacheName);
                }
            }))
        })
    )

});