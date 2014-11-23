<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
    <meta name="description" content="{{ $meta_description }}"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!--Verificación Google+-->
	<link href="https://plus.google.com/114770806423984298436" rel="publisher">
    <!--Fuente menu-->
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed' rel='stylesheet' type='text/css'>
    <!--Fuente p-->
    <link href='http://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet' type='text/css'>
    @section('css')
        {{ HTML::style('css/bootstrap.min.css') }}
        {{ HTML::style('css/flexnav.css') }}
        {{ HTML::style('css/estilo.css') }}
    @show
    @section('script')
        {{ HTML::script('js/jquery.js') }}
        {{ HTML::script('js/bootstrap.min.js') }}
        {{ HTML::script('js/ajax.js') }}
        {{ HTML::script('js/jquery.flexnav.js') }}
        {{ HTML::script('js/scripts.js') }}
    @show
	<script>
		$(document).ready(function()
		{
			$( "#imagen" ).click(function() {
				$( "#buscar" ).slideToggle("slow", function()
					{
						$('#busqueda').focus();
					});
			});
		});
		
	</script>
</head>
<body {{ Request::path() == 'contacto' ? ' onload="initializeMap()"' : '' }}>
	@include('layouts.nav')
	@yield('content')
    @include('layouts.footer')
</body>
</html>