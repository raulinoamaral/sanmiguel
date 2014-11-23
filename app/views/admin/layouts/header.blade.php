<header>
    <div id="logo">
        <a href="/" title="Ir a veterinariasanmiguel.com.uy" target="_blank"><img src="{{ asset('img/veterinaria-san-miguel-logo.png') }}" alt="Veterinaria San Miguel" /></a>
    </div>
    <nav>
    	<ul>
    		<li><span class="glyphicon glyphicon-arrow-up"></span></span><a href="{{ URL::to('admin/articulos/create') }}">Subir art&iacute;culo</a></li>
    		<li><span class="glyphicon glyphicon-list"></span><a href="{{ URL::to('admin/articulos') }}">Listado de art&iacute;culos</a></li>
    		<li><span class="glyphicon glyphicon-pencil"></span><a href="#">Gestionar categor&iacute;as</a></li>
    		<li class="cerrar-sesion"><span class="glyphicon glyphicon-remove"></span><a href="{{ URL::to('cerrarSesion') }}">Cerrar sesi&oacute;n</a></li>
    	</ul>
    </nav>
    <div class="clear"></div>
    @if(Session::get('message'))
    <div class="alert alert-{{ Session::get('messageType') }}" alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ Session::get('message') }}
    </div>
    @endif
</header>