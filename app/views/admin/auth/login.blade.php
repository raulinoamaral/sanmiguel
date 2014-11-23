@extends('admin/layouts.master')

@section('content')

<section class="container">
    <div id="wrapper-login">
        <div id="logo-login">
            <a href="/" title="Ir a veterinariasanmiguel.com.uy" target="_blank"><img src="{{ asset('img/veterinaria-san-miguel-logo.png') }}" alt="Veterinaria San Miguel" /></a>
        </div>
        {{ Form::open( array('id'=>'formLogin', 'class'=>'formulario', 'method' => 'POST', 'url' => 'autenticar')) }}
            {{ Form::label('Usuario'); }}
            {{ Form::text('username', Input::old('username')) }}
            {{ Form::label('Contrase&ntilde;a:'); }}
            {{ Form::password('password') }}
            {{ Form::submit('Ingresar', array('id'=>'botonIngresar')) }}
        {{ Form::close() }}
        <span>Sistema desarrollado por <a href="http://balloon.com.uy" title="Ir a balloon.com.uy" target="_blank"> balloon</a></span>
    </div>
</section>
@stop