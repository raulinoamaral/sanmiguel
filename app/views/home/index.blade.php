@extends('layouts.master')

@section('css')
@parent
    {{ HTML::style('css/owl.carousel.css') }}
    {{ HTML::style('css/owl.theme.css') }}
@stop

@section('script')
@parent
	{{ HTML::script('js/owl-carousel.js') }}
    {{ HTML::script('js/slider.js') }}
@stop

@section('content')
	<header>
        <div id="owl-demo" class="owl-carousel owl-theme">
            <div class="item"><img src="img/venta-de-porteras.jpg" alt="Porteras de madera"></div>
            <div class="item"><img src="img/veterinaria-san-miguel-rocha.jpg" alt="Carpinter&iacute;a rural"></div>
            <div class="item"><img src="img/venta-raciones-y-granos.jpg" alt="Raciones y granos"></div>
            <div class="item"><img src="img/departamento-veterianrio-rocha.jpg" alt="Departamento veterinario"></div>
        </div>    
    </header>
	<div class="titulo">
    	<h1 class="container">Veterinaria San Miguel</h1>
    </div>
    <div class="container flecha-titulo"></div>
    <article class="container">
    	<p>Ubicada en el departamento de Rocha, Veterinaria San Miguel, con m&aacute;s de 25 años al servicio del productor. Como principal
rubro, se destaca la carpinter&iacute;a rural que a trav&eacute;s de los a&ntilde;os, ha ganado un buen prestigio en el mercado. Adem&aacute;s ofrecemos
productos veterinarios, art&iacute;culos para el campo, semillas, ferreter&iacute;a entre otros.</p>
		<p>Nuestro departamento veterinario est&aacute; a cargo del Dr. Juan Jos&eacute; Quadrelli, quien brinda servicios como reproducci&oacute;n animal, 
inseminaci&oacute;n artificial, extracci&oacute;n y congelaci&oacute;n de semen, ecograf&iacute;a, trazabilidad y dem&aacute;s.</p>
		<div class="row img-circulares">
        	<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
            	<img src="img/carpinteria-rural-uruguay.jpg" class="img-circle img-responsive" alt="Carpinter&iacute;a rural" title="Venta de art&iacute;culos para el campo"/>
            </div>
            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
    			<img src="img/departamento-veterinario-rocha.jpg" class="img-circle img-responsive" alt="Departamento veterinario" title="Venta de art&iacute;culos para el campo"/>
            </div>
            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
            	<img src="img/productos-veterinarios.jpg" class="img-circle img-responsive" alt="Productos veterinarios" title="Venta de art&iacute;culos para el campo"/>
        	</div>
        	<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
	            <img src="img/articulos-para-el-campo.jpg" class="img-circle img-responsive" alt="Art&iacute;culos para el campo" title="Venta de art&iacute;culos para el campo"/>
            </div>        
        </div>
    </article>
@stop