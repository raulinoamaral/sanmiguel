@extends('admin/layouts.master')
@section('script')
@parent
    {{ HTML::script('js/admin.js')}}
@stop
@section('content')

<section id="wrapper" class="container">
    @include('admin.layouts.header')
    <h1>Editar art&iacute;culo: {{ $articulo->name }}</h1>
    <p>Complete los campos con la informaci&oacute;n solicitada.</p>
    <hr>
    {{ Form::open(array('id' => 'formEditArticulo', 'method' => 'POST', 'url' => 'admin/articulos/'.$articulo->id.'/update', 'novalidate'))}}
    <div class="row">
        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
            {{ Form::label('Nombre') }}
            {{ Form::text('name', $articulo->name); }}
            @if($errors->has('name'))
                <p>{{ $errors->first('name') }}</p>
            @endif
        </div>
        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
            {{ Form::label('C&oacute;digo') }}
            {{ Form::text('code', $articulo->code, Input::old('code')); }}
            @if($errors->has('code'))
                <p>{{ $errors->first('code') }}</p>
            @endif
        </div>
        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
            {{ Form::label('Categor&iacute;a') }}
            {{ Form::select('categoria_id',
            array('0' => 'Elija una categoría')
                + Categoria::lists('name', 'id')
                + array('-1' => 'Agregar categoría nueva'),
            $articulo->categoria_id,
            array('id' => 'categoria_id', 'onChange' => 'actualizarSelectSubcategorias(this.options[this.selectedIndex].value)')) }}
            @if($errors->has('categoria_id'))
                <p>{{ $errors->first('categoria_id') }}</p>
            @endif 
            <div class="oculto" id="nuevaCategoria">
                {{ Form::label('Nueva categor&iacute;a') }}
                {{ Form::text('nombreNuevaCategoria', '', array('id' => 'nombreNuevaCategoria', 'placeholder' => 'Ingrese nueva categor&iacute;a')) }}
                {{ Form::button('Agregar categor&iacute;a', array('id' => 'botonNuevaCategoria', 'onClick' => 'agregarCategoria(nombreNuevaCategoria.value)')) }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
            {{ Form::label('Subcategor&iacute;a') }}
            {{ Form::select('subcategoria_id',
            array('0' => 'Elija una subcategoría')
                + $articulo->categoria->subcategorias->lists('name', 'id')
                + array('-1' => 'Agregar subcategoría nueva'),
            $articulo->subcategoria_id,
            array('id' => 'subcategoria_id',
            'onChange' => 'evaluarListaSubcategorias(this.options[this.selectedIndex].value)'))}}
            @if($errors->has('subcategoria_id'))
                <p>{{ $errors->first('subcategoria_id') }}</p>
            @endif   
            <div class="oculto" id="nuevaSubcategoria">
                {{ Form::label('Nueva subcategor&iacute;a') }}
                {{ Form::text('nuevaSubcategoria', '', array('placeholder' => 'Ingrese nueva subcategor&iacute;a')) }}
                {{ Form::button('Agregar subcategor&iacute;a', array('id' => 'botonNuevaSubcategoria', 'onClick' => 'agregarSubcategoria(nuevaSubcategoria.value, categoria_id.options[categoria_id.selectedIndex].value)')) }}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            {{ Form::label('Descripci&oacute;n breve') }}
            {{ Form::textarea('short_description', $articulo->short_description); }}
            @if($errors->has('short_description'))
                <p>{{ $errors->first('short_description') }}</p>
            @endif
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            {{ Form::label('Descripci&oacute;n') }}
            {{ Form::textarea('long_description', $articulo->long_description); }}
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
            {{ Form::label('Moneda') }}
            {{ Form::select('moneda', array('0' => 'U$S', '1' => '$'), '0') }}
        </div>
        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
            {{ Form::label('Precio') }}
            {{ Form::text('price', $articulo->price); }}
        </div>
        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
        </div>
        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                    {{ Session::flash('message', '<strong>S&oacute;lo un aviso:</strong> No se han guardado cambios en el art&iacute;culo.'); Session::flash('messageType', 'info');   }}
                    <button type="button" class="btn btn-warning" onClick="location.href='{{ URL::to('admin/articulos') }}'">Cancelar</button>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                    {{ Form::submit('Guardar', array('class' => 'btn btn-success')) }}
                </div>
            </div>
        </div>
    </div>
    {{ Form::close(); }}
</section>
@stop