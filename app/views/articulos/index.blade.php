@extends('layouts.master')

@section('script')
@parent
    {{ HTML::script('js/same-height.js') }}
    <script type="text/javascript">
              jQuery(function($) {
    $('.descripcion').responsiveEqualHeightGrid();  
});
</script>
@stop



@section('content')
	<div id="wrapper" class="titulo">
        <h1 class="container">Nuestros productos</h1>
    </div>
    <div class="container flecha-titulo"></div>
    
    <section class="container">
        <div class="breadcrumbProductos">
            <ul class="breadcrumb">
                <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb" {{ Request::path() == 'articulos' ? 'class="active">' : '><a itemprop="url" href="'.URL::to('articulos').'" title="Todos nuestros art&iacute;culos">' }}<span itemprop="title">Art&iacute;culos</span>{{ Request::path() == 'articulos' ? '' : '</a>' }}</li>
                @if(isset($categoria))
                <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb" {{ asset(Request::path()) == $categoria->getLink() ? 'class="active">' : '><a itemprop="url" href="'.$categoria->getLink().'" title="Todos nuestros art&iacute;culos en">' }}<span itemprop="title">{{ $categoria->name }}</span>{{ asset(Request::path()) == $categoria->getLink() ? '' : '</a>' }}</li>
                @endif
                @if(isset($subcategoria))
                <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb" {{ asset(Request::path()) == $subcategoria->getLink() ? 'class="active">' : '><a itemprop="url" href="'.$subcategoria->getLink().'" title="Todos nuestros art&iacute;culos en">' }}<span itemprop="title">{{ $subcategoria->name }}</span>{{ asset(Request::path()) == $categoria->getLink() ? '' : '</a>' }}</li>
                @endif
                @if(isset($buscador))
                <li>Resultados de su b&uacute;squeda para: '{{ $buscador }}'<li>
                @endif
            </ul>
        </div>
        <div id="articulos">
            <div class="row">
                @foreach($articulos as $articulo)
                <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                    <a href="{{ $articulo->getLink() }}" title="{{ $articulo->name }}"><img src="{{ asset($articulo->listPhoto()) }}" alt="{{ $articulo->name }}" class="img-responsive"></a>
                    <div class="descripcion">
                        <a href="{{ $articulo->getLink() }}" title="{{ $articulo->name }}"><h2 class="nombre">{{ $articulo->name }}</h2></a>
                        <p>{{ $articulo->short_description }}</p>
                    </div>
                        <a href="{{ $articulo->getLink() }}" class="mas-info">+ info</a>
                </div>
                @endforeach
            </div>
        </div>
        <div class="paginador">
            {{ $articulos->links() }} 
        </div>
    </section>


@stop