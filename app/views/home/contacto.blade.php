@extends('layouts.master')

@section('script')
@parent
	<script src="http://maps.google.com/maps/api/js?sensor=false"></script>
    {{ HTML::script('js/map.js') }}
@stop

@section('content')
	<div id="wrapper" class="titulo">
        <h1 class="container">Contacto</h1>
    </div>
    <div class="container flecha-titulo"></div>
    <section id="contacto" class="container">
    	<p>Por consultas particulares complete los siguientes campos del formulario y a la brevedad nos pondremos en contacto con usted. Tambi&eacute;n puede ponerse en contacto telef&oacute;nicamente al 4472 2922 o por correo electr&oacute;nico a <a href="mailto:ventas@veterinariasanmiguel.com.uy" title="Env&iacute;enos un e-mail">ventas@veterinariasanmiguel.com.uy</a>.</p>
    	<div class="row">
    		{{ Form::open(array('url' => 'enviarConsultaGeneral', 'id' => 'formulario-contacto', 'onSubmit' => 'return validarContacto()')) }}
    		<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
    			<div class="row">
    				<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
    					{{ Form::label(null, 'Nombre') }}
		    			{{ Form::text('nombre-contacto', null, array('id' => 'nombre-contacto')) }}
                        <div id="nombreError" class="alert alert-danger hidden">
                            Escriba su nombre.
                        </div>
		    			{{ Form::label(null, 'E-mail') }}
		    			{{ Form::email('mail-contacto', null, array('id' => 'mail-contacto')) }}
                        <div id="mailError" class="alert alert-danger hidden">
                            Escriba su e-mail.
                        </div>
    				</div>
    				<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
    					{{ Form::label(null, 'Ciudad / Departamento') }}
		    			{{ Form::text('ciudad-contacto', null, array('id' => 'ciudad-contacto')) }}
		    			{{ Form::label(null, 'Tel&eacute;fono') }}
		    			{{ Form::text('telefono-contacto', null, array('id' => 'telefono-contacto')) }}
    				</div>
    			</div>
	    	</div>
    		<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
    			{{ Form::label(null, 'Consulta') }}
    			{{ Form::textarea('mensaje-contacto', null, array('id' => 'mensaje-contacto')) }}
                <div id="mensajeError" class="alert alert-danger hidden">
                    Escriba su mensaje.
                </div>
                <p>{{ Form::checkbox('suscripcion', '1', 'checked', array('id' => 'suscripcion')) }}
                            Suscribirme al bolet&iacute;n de novedades y promociones</p>
    		</div>
    		<div class="container">
                <div id="progress" class="progress hidden">
                    <div id="progressBar" class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                    </div>
                </div>
        		{{ Form::submit('Enviar consulta', array('id' => 'enviar-contacto')) }}
        		{{ Form::close()}}
    		</div>
            <div id="enviadoOk"><p>Mensaje enviado correctamente, muy pronto recibir&aacute; nuestra respuesta.</p></div>
    	</div>
    </section>
	<div id="mapa"></div>
@stop