<footer>
    	<div class="container">
        	<div class="row">
            	<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                	<h4>Suscribete!</h4>
                    <p>Ingresa tu e-mail aqu&iacute; para recibir ofertas y novedades</p>
                    
                    {{ Form::open(array('id'=>'formNewsletter', 'url' => 'store', 'onsubmit' => 'return suscribirNewsletter(this)', 'novalidate')) }}
                        
                        {{ Form::email('email', '', array('id'=>'mailNewsletter')) }}

                        {{ Form::submit('Enviar', array('id'=>'enviarNewsletter')) }}

                    {{ Form::close() }}
                    <div class="mensajeNewsletter"></div>
                
                </div>

                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                	<h4>Ponte en contacto</h4>
                    <ul id="contactoFooter">
                    	<li>T: 4472 2922</li>
                        <li>M: <a href="mailto:ventas@veterinariasanmiguel.com.uy" title="Env&iacute;anos un email">ventas@veterinariasanmiguel.com.uy</a></li>
                        <li>D: 18 de Julio 1874, Rocha, Uruguay</li>
                    </ul>
                </div>
            </div>
        </div>
        
    </footer>
    <div id="footerInferior">
    	<div class="container">
        	<div class="row">
                <aside id="balloon" class="col-xs-12 col-sm-6 col-md-6 col-lg-6">by <a href="http://balloon.com.uy" title="Desarrollo y dise&ntilde;o por balloon" target="_blank">balloon</a></aside>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <div id="envios" class="right">
                    </div>
               	</div>
         	</div>
      	</div>
    </div>