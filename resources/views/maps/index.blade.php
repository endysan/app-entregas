<!DOCTYPE html>
<html lang="pt-BR">
@include('layouts.header')
<body>
    <style>
        input {
            width: 400px;
        }
    </style>
    
    @include('layouts.nav')

    <div class="container">
       <h2>Saiba a distance entre você e seu destino</h2>
        <div id="app">
            
            
            <input class="form-item" type="text" v-model="origin">
            <input class="form-item" type="text" v-model="destination">

            <button class="btn" v-on:click="onClick">Calcular</button>
            
            <h3 v-if="calculated">Distância de @{{distance}}</h3>
        </div>
    
    </div>
    @include('layouts.footer')

    <script src="https://unpkg.com/vue"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyATYFqYqrW3zSJahxeWX02dKTqVMDRXuqw">
    </script>

    <script>
        
        var app = new Vue({
            el: '#app',
            data: {
                origin: '',
                destination: '',
                mode: 'driving',
                key: 'AIzaSyATYFqYqrW3zSJahxeWX02dKTqVMDRXuqw',
                distance: '',
                calculated: false,
            },
            methods: {
                onClick: function() {
                    axios.get('maps/distance/'+this.origin+'/'+this.destination)
                        .then(function (response){
                            app.calculated = true;
                            app.distance = response.data.rows[0].elements[0].distance.text;

                            console.log(response.data.rows[0].elements[0].distance.text);
                        }).catch(function (error){
                            app.calculated = false;
                            console.log(error);
                        });
                }
            }
    });
    </script>
</body>
</html>