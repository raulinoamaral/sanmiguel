<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Hola</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!--Fuente menu-->
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed' rel='stylesheet' type='text/css'>
    <!--Fuente p-->
    <link href='http://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet' type='text/css'>
    @section('css')
        {{ HTML::style('css/bootstrap.min.css') }}
        {{ HTML::style('css/admin.css') }}
    @show
    @section('script')
        {{ HTML::script('js/jquery.js') }}
        {{ HTML::script('js/bootstrap.min.js') }}
    @show
	
</head>
<body {{ Request::path() == 'admin/articulos/create' && isset($cargarSub) ? ' onload="actualizarSelectSubcategorias(idCategoria)"' : '' }}>
    @yield('content')
</body>
</html>