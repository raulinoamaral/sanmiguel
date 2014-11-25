@extends('layouts.master')

@section('css')
@parent
	{{ HTML::style('css/fotorama.min.css') }}
@stop
@section('script')
@parent
        {{ HTML::script('js/fotorama.min.js') }}
@stop
@section('content')
	<div id="wrapper" class="titulo">
        <h1 class="container">{{ $articulo->name }}</h1>
    </div>
    <div class="container flecha-titulo"></div>
	<section class="container">
		<div class="breadcrumbProductos">
            <ul class="breadcrumb">
                <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb" {{ Request::path() == 'articulos' ? 'class="active">' : '><a itemprop="url" href="'.URL::to('articulos').'" title="Todos nuestros art&iacute;culos">' }}<span itemprop="title">Art&iacute;culos{{ Request::path() == 'articulos' ? '' : '</a>' }}</spam></li>
                @if(isset($categoria))
                <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb" {{ asset(Request::path()) == $categoria->getLink() ? 'class="active">' : '><a itemprop="url" href="'.$categoria->getLink().'" title="Todos nuestros art&iacute;culos en">' }}<span itemprop="title">{{ $categoria->name }}</span>{{ asset(Request::path()) == $categoria->getLink() ? '' : '</a>' }}</li>
                @endif
                @if(isset($subcategoria))
                <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb" {{ asset(Request::path()) == $subcategoria->getLink() ? 'class="active">' : '><a itemprop="url" href="'.$subcategoria->getLink().'" title="Todos nuestros art&iacute;culos en">' }}<span itemprop="title">{{ $subcategoria->name }}</span>{{ asset(Request::path()) == $categoria->getLink() ? '' : '</a>' }}</li>
                @endif
                @if(isset($buscador))
                <li>Resultados de su b&uacute;squeda para: '{{ $buscador }}'<li>
                @endif
                <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb" class="active"><span itemprop="title">{{ $articulo->name }}</span></li>
            </ul>
        </div>
		<div class="row">
			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
				<article class="articulo">
					<h2>Descripci&oacute;n:</h2>
					<p>{{ $articulo->long_description }}</p>
          @if ($articulo->price != null)
					 <h2>Precio</h2>
					 <p>{{ $articulo->moneda->name }} {{ $articulo->price }}</p>
          @endif
					
				</article>
				<button class="btn btn-consultar" data-toggle="modal" data-target="#modalConsulta">Consultar</button>
				<span class="codigo">C&Oacute;DIGO: {{ $articulo->code }}</span>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
				<div class="fotorama" data-nav="thumbs" data-loop="true" data-allowfullscreen="true">
					@foreach ($articulo->photos()->OrderBy('position', 'asc')->get() as $photo)
						<a href="{{ $photo->getBigSrc() }}"><img src="{{ $photo->getMedSrc() }}" alt="{{ $articulo->name }}"/></a>
					@endforeach
				</div>
			</div>
		</div>
		<h2>Art&iacute;culos similares</h2>

	</section>

	<div class="modal fade" id="modalConsulta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  		<div class="modal-dialog">
    		<div class="modal-content">
      			<div class="modal-header">
        			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
        			<h4 class="modal-title">Consulta</h4>
        			<p>{{ $articulo->name }} - {{ $articulo->code }}</p>
      			</div>
      			{{ Form::open(array('id' => 'formilario-consulta')) }}
      			<div class="modal-body">
      				
        			<div class="row">
        				<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
	        				{{ Form::label(null, 'Nombre') }}
			    			{{ Form::text('nombre-contacto', null, array('id' => 'nombre-contacto')) }}
			    			{{ Form::label(null, 'E-mail') }}
			    			{{ Form::email('mail-contacto', null, array('id' => 'mail-contacto')) }}
        				</div>
        				<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
        					{{ Form::label(null, 'Tel&eacute;fono') }}
			    			{{ Form::text('telefono-contacto', null, array('id' => 'telefono-contacto')) }}
        				</div>
        			</div>
        			{{ Form::label(null, 'Consulta') }}
    				{{ Form::textarea('mensaje-contacto', null, array('id' => 'mensaje-contacto')) }}
        			
      			</div>
      			<div class="modal-footer">
        			{{ Form::submit('ENVIAR', array('id' => 'enviar-consulta')) }}
      			</div>
      			{{ Form::close() }}
    		</div><!-- /.modal-content -->
  		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
@stop