@extends('layouts.master')
@section('title', 'Mapa de pedidos')

@section('css')
<!-- CSS -->
<style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
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
    {!! Mapper::render() !!}
</div>
@endsection

@section('script')

@endsection