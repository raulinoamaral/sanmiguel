@extends('admin/layouts.master')
@section('script')
@parent
    {{ HTML::script('js/admin.js')}}
@stop
@section('content')

<section id="wrapper" class="container">
    @include('admin.layouts.header')
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <h1>Listado de art&iacute;culos</h1>
            <p>Complete los campos con la informaci&oacute;n solicitada.</p>
        </div>

        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <h2>Buscar art&iacute;culo</h2>
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    {{ Form::label(null,'Por nombre o por c&oacute;digo', array('class' => 'label-buscador' )) }}
                    {{ Form::text('name-code', Input::old('code')); }}
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    {{ Form::submit('Buscar', array('id'=> 'btn-buscar','class' => 'btn btn-success')) }}
                </div>
            </div>
        </div>
    </div>
    <hr>
    @if($categorias)
        @foreach($categorias as $categoria)
        <section class="listado-articulo">
            <div class="row">
                <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
                    <a href="" title="{{ $categoria->name }}"><img src="" class="img-responsive"></a>
                </div>
                <div class="col-xs-12 col-sm-7 col-md-7 col-lg-7">
                    <h2 class="nombre"><a href="" title="{{ $categoria->name }}">{{ $categoria->name }}</a> <span></span></h2>
                    <p>{{ $categoria->description }}</p>
                </div>
                <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                    <ul class="opciones-articulo">
                        <li class="editar"><span class="glyphicon glyphicon-pencil"></span><a href="{{ asset('admin/categorias/'.$categoria->id.'/editar') }}" title="Editar informaci&oacute;n de la categor&iacute;a">Editar categor&iacute;a</a></li>
                        <li class="borrar"><span class="glyphicon glyphicon-remove"></span><a href="#" onClick="confirmDelete({{ $categoria->id }})" title="Borrar art&iacute;culo del sistem">Borrar</a></li>
                    </ul>
                </div>
            </div>
            <div class="alert alert-danger fade in hidden" id="alertDelete_{{ $categoria->id }}">
              <button type="button" class="close" onClick="confirmDelete({{ $categoria->id }})" aria-hidden="true">×</button>
              <h4>&iquest;Lo eliminamos?</h4>
              <p>Si haces clic en eliminar se borrar&aacute; el art&iacute;culo y sus fotos del sistema. &iquest;Est&aacute;s seguro?</p>
              <p>
                <button type="button" class="btn btn-danger" onClick="eliminarArticulo({{ $categoria->id }})">Eliminar</button>
                <button type="button" class="btn btn-default" onClick="confirmDelete({{ $categoria->id }})">Cancelar</button>
              </p>
        </div>
            <hr>
        </section>
        @endforeach
    @endif
</section>
@stop