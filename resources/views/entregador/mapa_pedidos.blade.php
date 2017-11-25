@extends('template.master')
@section('title', 'Mapa de Pedidos')

@section('css')
<link rel="stylesheet" href="{{ url('css/animation.css') }}"/>
@endsection

@section('content')
  <div class="mx-auto">
      
      <h3 class="text-center mt-4 mb-4">
        <i class="fa fa-map fa-fw"></i>Veja todos os pedidos
      </h3>

        <div class="sk-folding-cube" id="loading-cube">
          <div class="sk-cube1 sk-cube"></div>
          <div class="sk-cube2 sk-cube"></div>
          <div class="sk-cube4 sk-cube"></div>
          <div class="sk-cube3 sk-cube"></div>
        </div>
    </div>
<div id="map" class="mx-auto" style="width: 100%; height: 500px;"></div>

</div>
@endsection

@section('script')
<script>
  
function initMap() {
    $(document).ready(function(){
        $.ajax({
            url: '{{ url("entregador/pedido-latlng") }}',
            type: 'GET',
            success: function(response){
                //var data = JSON.parse(response);
                var locations = [];
                var infos = [];
                var marker, infowindow = new google.maps.InfoWindow();

                var map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 4,
                    center: new google.maps.LatLng(-23.533773, -46.625290),
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                });
                var json;
                for(var i = 0; i < response.locais.length; i++){
                     json = JSON.parse(response.locais[i]);
                    if(json.status == "OK"){
                        var lat = parseFloat(json.results[0].geometry.location.lat);
                        var long = parseFloat(json.results[0].geometry.location.lng);

                        var content = [];
                        // COLOCA janelas de informações com o título do pedido
                        //  endereço e um link para acessar rapidamente
                            @foreach($pedidos as $pedido)
                                content.push("<div class='info-window'>"+
                            "<strong class='info-window_title'>Pedido:</strong>"+
                                "<p class='info-window_content'>{{$pedido->titulo}}</p>"+
                            "<strong class='info-window_title'>Endereço origem: </strong>"+
                                "<p>{{$pedido->bairro_origem . ', '. $pedido->cidade_origem . ', ' . $pedido->estado_origem }}</p>"+
                            "<strong class='info-window_title'>Endereço destino: </strong>"+
                            "<p>{{$pedido->bairro_destino . ', '. $pedido->cidade_destino . ', ' . $pedido->estado_destino }}</p>"+
                            "<a href='{{ url('entregador/pedido/id=' . $pedido->id }}'>Abrir pedido</a>"+
                            "</div>");
                            @endforeach
                        var info = content[i];
                        locations.push([new google.maps.LatLng(lat, long), info]);

                        google.maps.event.addListenerOnce(map, 'idle', function(){
                          document.getElementById("loading-cube").style.display = "none";
                        });
                    }
                }

                for (i = 0; i < locations.length; i++){
                    marker = new google.maps.Marker({
                        position: locations[i][0],
                        map: map,
                        title: locations[i][1]
                    });

                    google.maps.event.addListener(marker, 'click', (function(marker, i) {
                        return function() {
                            infowindow.setContent(locations[i][1]);
                            infowindow.open(map, marker);
                        }
                    })(marker, i));
                } //FIM FOR

            }, // FIM SUCESSO
            error: function(error){
                console.log("ERRO LAT: ", error);
            }
        });
    });      
    
}//function initMap
</script>
<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAvWcoXd7hQ2ScSwx4JOzZ2YkZrFcYBWuY&callback=initMap">
</script>
@endsection
