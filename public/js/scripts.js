function validarContacto()
{
	$('#enviadoOk').addClass('hidden');
	form = $('#formulario-contacto');
	validarInputString('nombre-contacto', 'nombreError');
	validarInputString('mensaje-contacto', 'mensajeError');
	esMail('mail-contacto', 'mailError');
	if(validarInputString('nombre-contacto', 'nombreError') && validarInputString('mensaje-contacto', 'mensajeError') && esMail('mail-contacto', 'mailError'))
	{
		$.ajax(
		{	
			beforeSend: function()
			{
				$('#enviar-contacto').attr("disabled", "disabled");
				$('#progress').removeClass('hidden');
				$('#progressBar').width('100%');
			},
			type: form.attr('method'),
		    url: form.attr('action'),
		    data: form.serialize(),
		    success: function(retorno)
		    {
		    	$('#progress').addClass('hidden');
		    	$('#progressBar').width('0%');
		    	$('#nombre-contacto').val('');
		    	$('#mail-contacto').val('');
		    	$('#ciudad-contacto').val('');
		    	$('#telefono-contacto').val('');
		    	$('#mensaje-contacto').val('');
		    	if(retorno.success)
		    	{
		    		$('#enviadoOk').removeClass('hidden');
		    	}
		    	$('#enviar-contacto').removeAttr("disabled");
			}
		});
		return false;
	}
	return false;
}

function validarInputString(idInput, idError)
{
	if($('#'+idInput).val() == '')
	{
		$('#'+idError).removeClass('hidden');
		return false;
	}
	else
	{
		$('#'+idError).addClass('hidden');
		return true;
	}
}

function esMail(email, idError)
{
	var regex = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
	input = $('#'+email);
	correo = input.val();

	if(regex.test(correo))
	{
		$('#'+idError).addClass('hidden');
		return true;
	}
	else
	{
		$('#'+idError).removeClass('hidden');
		return false;
	}
}