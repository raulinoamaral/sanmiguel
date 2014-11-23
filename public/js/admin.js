function validarAltaArticulo()
{
	verificarCampo($('#name').val(), 'nameError');
	verificarCodigo($('#code').val());
	evaluarArchivos($('#fileupload'));
	if(verificarCampo($('#name').val(), 'nameError') && verificarCodigo($('#code').val()) && evaluarArchivos($('#fileupload')))
		$('#btn-todoOK').click();
}

function actualizarSelectSubcategorias(idCategoria)
{
	var subcategorias = $('#subcategoria_id');
	var nuevaCategoria = $('#nuevaCategoria');
	var nuevaSubcategoria = $('#nuevaSubcategoria');
	if(nuevaSubcategoria.is(':visible'))
	{
		nuevaSubcategoria.hide();
	}
	if(idCategoria == 0  && nuevaCategoria.is(':visible'))
			nuevaCategoria.hide();
	if(idCategoria > 0)
	{
		if(nuevaCategoria.is(':visible'))
			nuevaCategoria.hide();
		$.post("listarSubcategorias",
	{categoria: idCategoria},
	function(data)
	{
		subcategorias.empty();
		$('#subcategoria_id').append(new Option('Elija una subcategoría', 0, true, true));
		$.each(data.subcategorias, function(index, element)
	    	{
	    		$('#subcategoria_id').append(new Option(element.name, element.id));
	    	});
		$('#subcategoria_id').append(new Option('Agregar subcategoría nueva..', -1));
	});
	}
	else
	{
		subcategorias.empty();
		$('#subcategoria_id').append(new Option('Elija una subcategoría', 0, true, true));
		if(idCategoria == -1)
		{
			$('#nombreNuevaCategoria').val('');
			nuevaCategoria.show();
		}
	}
}



function agregarCategoria(nombreNuevaCategoria)
{
	$.post("agregarCategoria",
		{nombreNuevaCategoria: nombreNuevaCategoria},
		function(data)
		{
			$("#categoria_id option[value='-1']").remove();
			$("#categoria_id option[value='0']").remove();
			var nuevaCategoria = $('#nuevaCategoria');
			nuevaCategoria.hide();
			$('#categoria_id').append(new Option(data.name, data.id, true, true));
			$("#categoria_id option[value='-1']").remove();
			$('#categoria_id').prepend(new Option('Elija una categoría', 0));
			$('#categoria_id option:last').after(new Option('Agregar categoría nueva', -1));
			$('#nombreNuevaCategoria').val('');		
			actualizarSelectSubcategorias(data.id);	
		})
}

function agregarSubcategoria(nombreNuevaSubcategoria, idCategoria)
{
	$.post("agregarSubcategoria",
		{nombreNuevaSubcategoria: nombreNuevaSubcategoria, idCategoria: idCategoria},
		function(data)
		{
			$("#subcategoria_id option[value='-1']").remove();
			$("#subcategoria_id option[value='0']").remove();
			var nuevaSubcategoria = $('#nuevaSubcategoria');
			nuevaSubcategoria.hide();
			$('#subcategoria_id').append(new Option(data.name, data.id, true, true));
			$("#subcategoria_id option[value='-1']").remove();
			$('#subcategoria_id').prepend(new Option('Elija una subcategoría', 0));
			$('#subcategoria_id option:last').after(new Option('Agregar subcategoría nueva', -1));
			$('#nuevaSubcategoria').val('');				
		})
}





function evaluarListaSubcategorias(idSelect)
{
	var nuevaSubcategoria = $('#nuevaSubcategoria');
	if(idSelect == -1)
		nuevaSubcategoria.show();
	else
	{
		if(nuevaSubcategoria.is(':visible'))
			nuevaSubcategoria.hide();
	}
}


function actualizarOrdenGaleria()
{
	var sorted = $( ".selector" ).sortable("serialize", { key: "orden" });
	$('#ordenGaleria').val(sorted);
	var descripciones = '';
	$('.descripcion').each(function(i, obj)
	{
		descripciones += $(this).val()+'&&';
	});
	$('#descripcionGaleria').val(descripciones);
	return true;
}

function submitForm(idForm)
{
	$('#'+idForm).submit();
}

function confirmDelete(idArticulo)
{
	div = $('#alertDelete_'+idArticulo);
	if(div.hasClass('hidden'))
		div.removeClass('hidden');
	else
		div.addClass('hidden');	
}

function eliminarArticulo(idArticulo)
{
	$.post("articulos/"+idArticulo+"/delete",
	function(data)
	{
		alert(data);
	});
}

function verificarCodigo(valorInput)
{
	$.ajax({
	  type: 'POST',
	  url: 'verificarCodigo',
	  data: 'codigo='+valorInput,
	  beforeSend: function()
	  {
	  	$('#loaderVerificarCodigo').addClass('show');
	  },
	  success: function(data)
	  {
	  	$('#loaderVerificarCodigo').removeClass('show');
	  	if(!data.success)
	  		$('#codigoError').removeClass('hidden');
	  	else
	  		$('#codigoError').addClass('hidden');
	  	return data.success;
	  }
	});
}

function verificarCampo(valorCampo, idError)
{
	ok = true;
	if(!valorCampo)
	{
		$('#'+idError).removeClass('hidden');
		ok = false;
	}
	else
	{
		$('#'+idError).addClass('hidden');
	}
	return ok;
}

function evaluarArchivos(input)
{
	if(typeof input.files.length == 0)
	{
		$('#contadorArchivosSeleccionados').html('Debe seleccionar al menos una imagen.');
		$('#contadorArchivosSeleccionados').removeClass('alert-info');
		$('#contadorArchivosSeleccionados').addClass('alert-danger');	
		$('#contadorArchivosSeleccionados').removeClass('hidden');
		return false;
	}
	else
	{
		$('#contadorArchivosSeleccionados').html('Has seleccionado ' + input.files.length + ' im&aacute;genes.');
		$('#contadorArchivosSeleccionados').removeClass('alert-danger');
		$('#contadorArchivosSeleccionados').addClass('alert-info');
		$('#contadorArchivosSeleccionados').removeClass('hidden');
		return true;
	}
}





