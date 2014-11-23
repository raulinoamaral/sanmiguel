@extends('admin/layouts.master')

@section('content')

<section id="wrapper" class="container">
	@include('admin.layouts.header')

    <!--
    <div class="boton"><a href="admin/articulos/create"><img src="img/icons/subir-articulo.jpg"></a></div>
    <div class="boton"><a href="admin/articulos"><img src="img/icons/listado.jpg"></a></div>
    <div class="boton boton-salir"><a href="{{ URL::to('cerrarSesion') }}"><img src="img/icons/salir.jpg"></a></div>
    <div class="clear"></div>-->
</section>
@stop