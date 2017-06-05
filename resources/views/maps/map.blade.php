@extends('layouts.master')
@section('title', 'Mapa de pedidos')

@section('css')
<!-- CSS -->
<style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 500px;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
</style>
@endsection

@section('content')
<div id="map">

</div>
@endsection

@section('script')
<script>
function initMap() {
    $(document).ready(function(){
        $.ajax({
            url: '{{ url("/api/mapa_latlgn") }}',
            type: 'GET',
            success: function(response){
                //var data = JSON.parse(response);
                var map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 4,
                    center: new google.maps.LatLng(-23.533773, -46.625290),
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                });
                var locations = [];
                for(var i = 0; i < response.locais.length; i++){
                    var json = JSON.parse(response.locais[i]);
                    if(json.status == "OK"){
                        var lat = parseFloat(json.results[0].geometry.location.lat);
                        var long = parseFloat(json.results[0].geometry.location.lng)
                        locations.push(new google.maps.LatLng(lat, long));
                    }
                }
                
                var marker = locations.map(function(location, i){
                    return new google.maps.Marker({
                        position: location,
                        map: map
                    }); // NEW MAPS.MARKER
                });
                //FIM SUCESSO
            },
            error: function(error){
                console.log("ERRO LAT: ", error);
            }
        });
    });      
    
}//INIT FUNCTION
</script>
<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAvWcoXd7hQ2ScSwx4JOzZ2YkZrFcYBWuY&callback=initMap">
</script>
@endsection