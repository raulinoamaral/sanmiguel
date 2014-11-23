
	<div class="navbar navbar-fixed-top">
  		<div class="container">
        	<div id="logo">
                <a href="{{ URL::to("/") }}" class="brand"><img src="{{ asset('img/veterinaria-san-miguel-logo.png') }}" alt="Veterinaria San Miguel"></a>
            </div>
            <a class="toggleMenu" href="#">Menu</a>
            <nav>
                <ul class="nav">
                    <li {{ Request::path() == '/' ? ' class="active"><a>' : '><a href="'.URL::to("/").'">' }}Inicio</a></li>
                    <li {{ Request::path() == 'servicios' ? ' class="active"><a>' : '><a href="'.URL::to("servicios").'">' }}Servicios</a></li>
                    <li {{ Request::path() == 'articulos' ? ' class="active"><a>' : '><a href="'.URL::to('articulos').'">' }}Art&iacute;culos <b class="caret"></b></a>
                    	<ul>  
                            @foreach($categorias as $categoria)
      						
                                @if($categoria->subcategorias->count() > 0)
                                
                                    <li><a href="{{ $categoria->getLink() }}">{{ $categoria->name }} <b class="right-caret"></b></a>
                                            <ul>
                                                @foreach($categoria->subcategorias as $subcategoria)
            									   <li><a href="{{ $subcategoria->getLink() }}">{{ $subcategoria->name }}</a></li>
                                                @endforeach
                							</ul>
                                        </li>
                                        @else
                                            <li><a href="{{ $categoria->getLink() }}">{{ $categoria->name }}</a></li>
                                @endif
                                    
                                
                             @endforeach
    					</ul>
                    </li>
                    <li{{ Request::path() == 'trabajos-realizados' ? ' class="active"><a>' : '><a href="'.URL::to("trabajos-realizados").'">' }}Trabajos realizados</a></li>
                    <li{{ Request::path() == 'quienes-somos' ? ' class="active"><a>' : '><a href="'.URL::to("quienes-somos").'">' }}Qui&eacute;nes somos</a></li>
                    <li{{ Request::path() == 'contacto' ? ' class="active"><a>' : '><a href="'.URL::to("contacto").'">' }}Contacto</a></li>
                    <li id="buscador"><span><img id="imagen" src="{{ asset('img/buscar.png') }}"></span></li>
                </ul>
            </nav>
  		</div>
        <div id="buscar">
            {{ Form::open(array('id'=>'buscarNav', 'class'=>'container', 'novalidate', 'url'=>'buscador')) }}
                <div class="row">
                    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">   
                        {{ Form::text('busqueda', null, array('id'=>'busqueda', 'placeholder'=>'Busca un art&iacute;culo', 'autocomplete'=>'off')) }}
                    </div>
                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                        {{ Form::submit('Buscar', array('id'=>'btnBuscar', 'name'=>'btnBuscar')) }}
                    </div>
                </div>
            {{ Form::close() }}
        </div>
	</div>
