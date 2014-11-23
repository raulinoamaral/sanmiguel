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
    @if($articulos)
        @foreach($articulos as $articulo)
        <section class="listado-articulo">
            <div class="row">
                <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
                    <a href="{{ $articulo->getLink() }}" title="{{ $articulo->name }}"><img src="{{ asset($articulo->listPhoto()) }}" class="img-responsive"></a>
                </div>
                <div class="col-xs-12 col-sm-7 col-md-7 col-lg-7">
                    <h2 class="nombre"><a href="{{ $articulo->getLink() }}" title="{{ $articulo->name }}">{{ $articulo->name }}</a> <span>cod. {{ $articulo->code }}</span></h2>
                    <p>{{ $articulo->short_description }}</p>
                </div>
                <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                    <ul class="opciones-articulo">
                        <li class="ver"><span class="glyphicon glyphicon-search"></span><a href="{{ $articulo->getLink() }}" target="_blank" title="Ver art&iacute;culo en la web">Ver art&iacute;culo</a></li>
                        <li class="editar"><span class="glyphicon glyphicon-pencil"></span><a href="{{ $articulo->getLinkEdit() }}" title="Editar informaci&oacute;n del art&iacute;culo">Editar art&iacute;culo</a></li>
                        <li class="editar-galeria"><span class="glyphicon glyphicon-picture"></span><a href="{{ $articulo->getLinkEditGallery() }}" title="Editar galer&iacute;a del art&iacute;culo">Editar su galer&iacute;a</a></li>
                        <li class="borrar"><span class="glyphicon glyphicon-remove"></span><a href="#" onClick="confirmDelete({{ $articulo->id }})" title="Borrar art&iacute;culo del sistem">Borrar</a></li>
                    </ul>
                </div>
            </div>
            <div class="alert alert-danger fade in hidden" id="alertDelete_{{ $articulo->id }}">
              <button type="button" class="close" onClick="confirmDelete({{ $articulo->id }})" aria-hidden="true">×</button>
              <h4>&iquest;Lo eliminamos?</h4>
              <p>Si haces clic en eliminar se borrar&aacute; el art&iacute;culo y sus fotos del sistema. &iquest;Est&aacute;s seguro?</p>
              <p>
                <button type="button" class="btn btn-danger" onClick="eliminarArticulo({{ $articulo->id }})">Eliminar</button>
                <button type="button" class="btn btn-default" onClick="confirmDelete({{ $articulo->id }})">Cancelar</button>
              </p>
        </div>
            <hr>
        </section>
        @endforeach
    @endif
</section>
@stop