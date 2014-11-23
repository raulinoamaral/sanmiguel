@extends('admin/layouts.master')
@section('script')
@parent
    {{ HTML::script('js/jquery-ui.js') }}
    {{ HTML::script('js/admin.js') }}

@stop
@section('content')

<section id="wrapper" class="container">
    @include('admin.layouts.header')
    <h1>Subir nuevo art&iacute;culo</h1>
    <p>Complete los campos con la informaci&oacute;n solicitada.</p>
    <hr>
    {{ Form::open(array('id' => 'formAltaArticulo', 'method' => 'POST', 'files' => 'true', 'url' => 'admin/articulos/store')) }}
    <div class="row">
        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
            {{ Form::label('Nombre') }}
            {{ Form::text('name', Input::old('name'), array('id' => 'name')) }}
            <div id="nameError" class="alert alert-danger @if(!$errors->has('name'))hidden @endif">
                Escriba un nombre para este art&iacute;culo.
            </div>
        </div>
        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
            {{ Form::label('C&oacute;digo') }}
            {{ Form::text('code', Input::old('code'), array('id' => 'code', 'onChange' => 'verificarCodigo(this.value)')) }}
                <div id="codigoError" class="alert alert-danger @if(!$errors->has('code'))hidden @endif">
                    C&oacute;digo no disponible.
                </div>
            <div id='codigoError'></div>
        </div>
        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
            {{ Form::label('Categor&iacute;a') }}
            {{ Form::select('categoria_id', array(
            '0' => 'Elija una categoría'
            ) + Categoria::lists('name', 'id')
            + array('-1' => 'Agregar categoría nueva'),
            '0', array('id' => 'categoria_id', 'onChange' => 'actualizarSelectSubcategorias(this.options[this.selectedIndex].value)')) }}
            <div class="alert alert-danger @if(!$errors->has('categoria_id'))hidden @endif">
                Debe seleccionar una categor&iacute;a.
            </div>
            <div class="oculto" id="nuevaCategoria">
                {{ Form::label('Nueva categor&iacute;a') }}
                {{ Form::text('nombreNuevaCategoria', '', array('id' => 'nombreNuevaCategoria', 'placeholder' => 'Ingrese nueva categor&iacute;a')) }}
                {{ Form::button('Agregar categor&iacute;a', array('id' => 'botonNuevaCategoria', 'class' => 'btn btn-primary', 'onClick' => 'agregarCategoria(nombreNuevaCategoria.value)')) }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
            {{ Form::label('Subcategor&iacute;a') }}
            {{ Form::select('subcategoria_id', array('0' => 'Elija una subcategoría'), '0', array('id' => 'subcategoria_id', 'onChange' => 'evaluarListaSubcategorias(this.options[this.selectedIndex].value)')) }}
            <div class="alert alert-danger @if(!$errors->has('subcategoria_id'))hidden @endif">
                Debe seleccionar una subcategor&iacute;a.
            </div>
            <div class="oculto" id="nuevaSubcategoria">
                {{ Form::label('Nueva subcategor&iacute;a') }}
                {{ Form::text('nuevaSubcategoria', '', array('placeholder' => 'Ingrese nueva subcategor&iacute;a')) }}
                {{ Form::button('Agregar subcategor&iacute;a', array('id' => 'botonNuevaSubcategoria', 'class' => 'btn btn-primary', 'onClick' => 'agregarSubcategoria(nuevaSubcategoria.value, categoria_id.options[categoria_id.selectedIndex].value)')) }}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            {{ Form::label('Descripci&oacute;n breve') }}
            {{ Form::textarea('short_description') }}
            <div class="alert alert-danger @if(!$errors->has('short_description'))hidden @endif">
                Debe ingesar una descripci&oacute;n breve.
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            {{ Form::label('Descripci&oacute;n') }}
            {{ Form::textarea('long_description') }}
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
            {{ Form::label('Moneda') }}
            {{ Form::select('moneda', Moneda::lists('name', 'id'), 1, array('id' => 'moneda')) }}
        </div>
        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
            {{ Form::label('Precio') }}
            {{ Form::text('price', null, array('id' => 'price')) }}
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                    <button type="button" class="btn btn-warning">Cancelar</button>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                    {{ Form::submit('Siguiente', array('id'=> 'btn-guardar','class' => 'btn btn-success')) }}
                </div>
            </div>
        </div> 
    </div>
    {{ Form::close() }}
</section>
@stop