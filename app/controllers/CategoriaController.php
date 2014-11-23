<?php

class CategoriaController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		
	}

	public function indexAdmin()
	{
		return View::make('admin/categorias.index')->with('categorias', Categoria::all());
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	public function listaSubcategorias()
	{
		if(Request::ajax())
		{
			$idCategoria = Input::get('categoria');
	       	$categoria = Categoria::find($idCategoria); 
	       	$subcategorias = $categoria->subcategorias();
	       	return Response::json(Categoria::with('subcategorias')->find($idCategoria));
		}
	}

	public function agregarCategoria()
	{
		if(Request::ajax())
		{
			$nombreNuevaCategoria = Input::get('nombreNuevaCategoria');
			$categoriaNueva = new Categoria();
			$categoriaNueva->name = $nombreNuevaCategoria;
			$categoriaNueva->description = '';
			//$categoriaNueva->slug = slug($nombreNuevaCategoria);
			$categoriaNueva->save();
			return Response::json($categoriaNueva);
		}
	}
}