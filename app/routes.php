<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


Route::post('enviarConsultaGeneral', function()
{
    if(Request::ajax())
    {
        $nombre = Input::get('nombre-contacto');
        $mail = Input::get('mail-contacto');
        $ciudad = Input::get('ciudad-contacto');
  	   	$telefono = Input::get('telefono-contacto');
        $mensaje = Input::get('mensaje-contacto');
        $data = array('nombre' => $nombre, 'mail' => $mail, 'ciudad' => $ciudad, 'telefono' => $telefono, 'mensaje' => $mensaje);
        if(Input::get('suscripcion') === '1')
        {
            $validator = Cliente::validate(Input::only('mail-contacto'));
            if(!$validator->fails())
            {
                $cliente = new Cliente;
                $cliente->email = $mail;
                $cliente->save();
            }
        }
        	/*
            Mail::send('emails.consultaGeneral', $data, function($message)
            {
                $message->to('hola@balloon.com.uy', 'Veterinaria San Miguel')->subject('Consulta de '. Input::get('nombre-contacto') .' desde veterinariasanmiguel.com.uy')->replyTo(Input::get('mail-contacto'), Input::get('nombre-contacto'));
            });
            Mail::send('emails.consultaGeneralCC', $data, function($message)
            {
                $message->to(Input::get('mail-contacto'), Input::get('nombre-contacto'))->subject('Consulta enviada a Veterinaria San Miguel')->replyTo('info@veterinariasanmiguel.com.uy', 'Veterinaria San Miguel');
            }); 
            */   
        
        return Response::json(array(
                    'success' => true
        ));
    }
});

Route::get('/', function()
{
	$title = 'Veterinaria San Miguel en Rocha, Uruguay';
	$meta_description = 'Veterinaria en Rocha, Uruguay. Venta de porteras, embarcaderos, cepos, decks, pergolas y otros trabajos en madera. Tambi&eacute;n productos veterinarios, alambres y dem&aacute;s.';
	return View::make('home.index', array('title' => $title, 'meta_description' => $meta_description));
});

Route::get('servicios', function()
{
	$title = 'Servicios - Veterinaria San Miguel';
	$meta_description = 'COMPLETAR';
	return View::make('home.servicios', array('title' => $title, 'meta_description' => $meta_description));
});

Route::get('trabajos-realizados', function()
{
	$title = 'Trabajos realizados - Veterinaria San Miguel';
	$meta_description = 'COMPLETAR';
	return View::make('home.trabajos-realizados', array('title' => $title, 'meta_description' => $meta_description));
});

Route::get('quienes-somos', function()
{
	$title = 'Qui&eacute;nes somos - Veterinaria San Miguel';
	$meta_description = 'COMPLETAR';
	return View::make('home.quienes-somos', array('title' => $title, 'meta_description' => $meta_description));
});

Route::get('contacto', function()
{
	$title = 'Contacto - Veterinaria San Miguel en Rocha, Uruguay';
	$meta_description = 'Veterinaria en Rocha, Uruguay. Venta de porteras, embarcaderos, cepos, decks, pergolas y otros trabajos en madera. Tambi&eacute;n productos veterinarios, alambres y dem&aacute;s.';
	return View::make('home.contacto', array('title' => $title, 'meta_description' => $meta_description));
});

Route::post('buscador', function()
{
	$inputValue = Input::get('busqueda');
	$keywords = explode(' ', $inputValue);
	$articulos = Articulo::where('name', 'LIKE', '%'.$inputValue.'%');
	foreach ($keywords as $keyword)
	{
		$articulos = $articulos->orWhere('name', 'LIKE', '%'.$keyword.'%')->orWhere('long_description', 'LIKE', '%'.$keyword.'%')->orWhere('short_description', 'LIKE', '%'.$keyword.'%');
	}
	$title = 'Buscador de productos - Veterinaria San Miguel';
	$meta_description = 'Sustituir!!';
	return View::make('articulos.index', array('title' => $title, 'meta_description' => $meta_description, 'buscador'=>$inputValue, 'articulos' => $articulos->paginate(3)));
});


//Rutas GET para index de artículos y show de item
Route::get('articulos/{categoria}', 'ArticuloController@indexCategoria');
Route::get('articulos/{categoria}/{subcategoria}', 'ArticuloController@indexSubcategoria');
Route::get('articulos/{categoria}/{subcategoria}/{articulo}', 'ArticuloController@show');
Route::get('articulos', 'ArticuloController@index');

View::composer('layouts.nav', function($view){
    $view->with('categorias', Categoria::all());
    $view->with('subcategorias', Subcategoria::all());
});

Route::post('store', 'ClienteController@store');

//LOGUEO

Route::get('admin/login', array(
	'before' => 'guest',
	'uses' =>'AuthController@get_login'));

Route::post('autenticar', 'AuthController@post_login');
Route::get('cerrarSesion', 'AuthController@get_logout');


Route::group(array('before' => 'auth'), function()
{
	Route::get('admin', function()
    {
        return View::make('admin/index');
    });
    //Route::get('admin/articulos', 'ArticuloController');
    Route::get('admin/articulos', 'ArticuloController@listaArticulosAdmin');
    Route::get('admin/articulos/create', 'ArticuloController@create');
    Route::post('admin/articulos/{id}/listar', 'CategoriaController@listaSubcategorias');
    Route::post('admin/articulos/{id}/update', 'ArticuloController@update');
    Route::post('admin/articulos/{id}/addPhotos', 'ArticuloController@addPhotos');
    Route::post('admin/articulos/{id}/delete', 'ArticuloController@destroy');
   	Route::post('admin/articulos/listarSubcategorias', 'CategoriaController@listaSubcategorias');
	Route::post('admin/articulos/agregarCategoria', 'CategoriaController@agregarCategoria');
	Route::post('admin/articulos/agregarSubcategoria', 'SubcategoriaController@agregarSubcategoria');
	Route::post('admin/articulos/store', 'ArticuloController@store');
	Route::get('admin/articulos/{id}/editar', 'ArticuloController@edit');
	Route::get('admin/articulos/{id}/editarGaleria', 'ArticuloController@editGallery');
	Route::post('admin/articulos/{id}/updateGallery', 'ArticuloController@updateGallery');
	Route::post('admin/articulos/verificarCodigo', 'ArticuloController@verificarCodigo');

	Route::get('admin/categorias', 'CategoriaController@indexAdmin');

});






