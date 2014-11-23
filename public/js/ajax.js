
function suscribirNewsletter(obj)
{
var form = $('#formNewsletter');	
	$.ajax(
	{	
		type: form.attr('method'),
	    url: form.attr('action'),
	    data: form.serialize(),
	    success: function(retorno)
	    {
	    	$('.mensajeNewsletter').html('');
	    	if(retorno.success)
	    	{
	    		$('#mailNewsletter').val('');
	    		mensaje = retorno.mensaje;
	    		$('.mensajeNewsletter').html(mensaje);
	    	}
	    	else
	    	{
	    		mensaje = retorno.errors.email[0];
	    		$('.mensajeNewsletter').html(mensaje);
	    	}
	    		
	    }
	});
	return false;
}