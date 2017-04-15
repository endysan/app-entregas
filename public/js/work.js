if ('serviceWorker' in navigator) {
    navigator.serviceWorker
        .register('./service-worker.js', {scope: './'})
        .then(function(registrarion){
            console.log("Service worker registrado. ");
        })
        .catch(function(error){
            console.log("Something went wrong: ", error);
        });
}