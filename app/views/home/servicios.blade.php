@extends('layouts.master')

@section('script')
@parent
	<script src="http://maps.google.com/maps/api/js?sensor=false"></script>
    {{ HTML::script('js/map.js') }}
@stop

@section('content')
	<div id="wrapper" class="titulo">
        <h1 class="container">Servicios</h1>
    </div>
    <div class="container flecha-titulo"></div>
    <section id="contacto" class="container">
    	<p>Contenido de la secci&oacute;n servicios.</p>
    </section>
	<div id="mapa"></div>
@stop