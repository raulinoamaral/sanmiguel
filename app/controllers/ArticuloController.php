<?php

class ArticuloController extends \BaseController {

	/**
	 * Muestra un listado total de artículos.
	 *
	 * @return Response
	 */
	public function index()
	{
		$title = 'Todos nuestros productos - Veterinaria San Miguel, Rocha';
		$meta_description = 'Todos nuestros art&iacute;culos';
		return View::make('articulos.index', array('title' => $title, 'meta_description' => $meta_description, 'articulos' => Articulo::paginate(3)));
	}

	/**
	 * Muestra un listado de artículos que pertenecen a esta categoría.
	 *
	 * @return Response
	 */
	public function indexCategoria($categoria)
	{
		$cat = Categoria::where('slug', '=', $categoria)->first();
		if($cat)
		{
			$title = 'Art&iacute;culos de ' . $cat->name;
			$meta_description = 'Art&iacute;culos';
			return View::make('articulos.index', array('title' => $title, 'meta_description' => $meta_description, 'categoria' => $cat, 'articulos' => Categoria::find($cat->id)->articulos()->paginate(3)));
		}
	}
	

	/**
	 * Muestra un listado de artículos que pertenecen a esta subcategoría.
	 *
	 * @return Response
	 */
	public function indexSubcategoria($categoria, $subcategoria)
	{
		$cat = Categoria::where('slug', '=', $categoria)->first();
		$subcategoria = Subcategoria::where('slug', '=', $subcategoria)->first();
		if($cat && $subcategoria && $cat->subcategorias->find($subcategoria->id))
		{
			$title = 'Art&iacute;culos de ' . $subcategoria->name;
			$meta_description = 'Art&iacute;culos';
			return View::make('articulos.index', array('title' => $title, 'meta_description' => $meta_description, 'categoria' => $cat, 'subcategoria' =>$subcategoria, 'articulos' => Subcategoria::find($subcategoria->id)->articulos()->paginate(3)));
		}
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('admin/articulos.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Articulo::validate(Input::only('code', 'name', 'short_description', 'categoria_id', 'subcategoria_id'));
		if($validator->fails())
		{
			if(Categoria::find(Input::get('categoria_id')))
				return Redirect::to('admin/articulos/create')->withErrors($validator)->withInput()->with('cargarSub', Input::get('categoria_id'));
			else
				return Redirect::to('admin/articulos/create')->withErrors($validator)->withInput()->with('cargarSub', Input::get('categoria_id'));
		}
		else
		{
			$articulo = new Articulo();
			$articulo->code = Input::get('code');
			$articulo->name = Input::get('name');
			$articulo->short_description = Input::get('short_description');
			$articulo->long_description = Input::get('long_description');
			$articulo->categoria_id = Input::get('categoria_id');
			$articulo->subcategoria_id = Input::get('subcategoria_id');
			$articulo->moneda_id = Input::get('moneda');
			$articulo->price = Input::get('price');
			$articulo->save();
			$folder = public_path(). '/img/articulos/' . $articulo->id . '/';
			mkdir($folder . 'big/', 0777, true);
			mkdir($folder . 'list/', 0777, true);
			mkdir($folder . 'med/', 0777, true);
			mkdir($folder . 'min/', 0777, true);
			//if(Input::hasFile('images'))
			//{
			/*	$contador = 1;
				foreach($images->files as $image)
				{
					$extension = 'jpg';
	        		$fileName = $articulo->slug . '-' . $contador . '.' . $extension;
	        		$archivo = Image::make($image->url);
	        		$archivo->save($folder . 'big/' . $fileName, 70);
					$big = Image::make($image->url);
					$big->grab(1024, 768)->insert(public_path() .'/img/veterinaria-san-miguel-logo.png', 20, 20, 'bottom-left');
					$big->save($folder . 'big/' . $fileName, 70);

					$big = Image::make($image->url);
					$big->grab(270, 180);
					$big->save($folder . 'list/' . $fileName, 70);

					$big = Image::make($image->url);
					$big->grab(500, 300);
					$big->save($folder . 'med/' . $fileName, 70);

					$big = Image::make($image->url);
					$big->grab(200, 200);
					$big->save($folder . 'min/' . $fileName, 70);

					$registro = new Photo();
					$registro->path =  'img/articulos/' . $articulo->id . '/';
					$registro->position = $contador;
					$registro->filename = $fileName;
					$registro->articulo_id = $articulo->id;
					$registro->save();
					$contador = $contador + 1;
				}
			//}*/
			if ($articulo)
			{
				return Redirect::to('admin/articulos/'.$articulo->id.'/editarGaleria')->with('message', '<strong>&iexcl;Bien&excl;</strong> El art&iacute;culo se cre&oacute; correctamente. Ahora puedes cargar sus im&aacute;genes.')->with('messageType', 'success');
			}
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($categoria, $subcategoria, $articulo)
	{
		$cat = Categoria::where('slug', '=', $categoria)->first();
		$subcategoria = Subcategoria::where('slug', '=', $subcategoria)->first();
		$articulo = Articulo::where('slug', '=', $articulo)->first();
		if($cat && $subcategoria && $cat->subcategorias->find($subcategoria->id))
		{
			$title = $articulo->name.', Veterinaria San Miguel, Rocha';
			$meta_description = $articulo->short_description;
			return View::make('articulos.articulo', array('title' => $title, 'meta_description' => $meta_description, 'articulo'=>$articulo, 'categoria'=>$cat, 'subcategoria'=>$subcategoria));
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		return View::make('admin/articulos.edit')->with('articulo', Articulo::find($id));
	}

	public function editGallery($id)
	{
		return View::make('admin/articulos.gallery')->with('articulo', Articulo::find($id));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$validator = Articulo::validate(Input::only('code', 'name', 'short_description', 'price', 'categoria_id', 'subcategoria_id'));
		if($validator->fails())
		{
			if(Categoria::find(Input::get('categoria_id')) && !Subcategoria::find(Input::get('subcategoria_id')))
				return Redirect::to('admin/articulos/create')->withErrors($validator)->withInput()->with('cargarSub', Input::get('categoria_id'));
			else
				return Redirect::to('admin/articulos/create')->withErrors($validator)->withInput();
		}
		else
		{
			$articulo = Articulo::find($id);
			$articulo->code = Input::get('code');
			$articulo->name = Input::get('name');
			$articulo->short_description = Input::get('short_description');
			$articulo->long_description = Input::get('long_description');
			$articulo->price = Input::get('price');
			$articulo->categoria_id = Input::get('categoria_id');
			$articulo->subcategoria_id = Input::get('subcategoria_id');
			$articulo->save();
		}
		return Redirect::to('admin/articulos')->with('message', '<strong>&iexcl;Bien&excl;</strong> El art&iacute;culo se actualiz&oacute; correctamente.')->with('messageType', 'success');
	}

	public function updateGallery($id)
	{
		$articulo = Articulo::find($id);
		$ordenGaleria = Input::get('ordenGaleria');
		$descripcionGaleria = Input::get('descripcionGaleria');
		$ordenGaleria = str_replace('orden=', '', $ordenGaleria);
		$vectorOrdenGaleria = explode('&', $ordenGaleria);
		$vectorDescripciones = explode('&&', $descripcionGaleria);
		for($i = 0; $i < count($vectorOrdenGaleria); $i++)
		{
			$photo = $articulo->photos()->find($vectorOrdenGaleria[$i]);
			$photo->position = $i + 1;
			$photo->description = $vectorDescripciones[$i];
			$photo->save();
		}
		return Redirect::to('admin/articulos')->with('message', '<strong>&iexcl;Bien&excl;</strong> La galer&iacute;a se actualiz&oacute; correctamente.')->with('messageType', 'success');
	}

	public function addPhotos($id)
	{
		$articulo = Articulo::find($id);
		$contador = $articulo->photos()->count();
		$contar = $contador + 1;
		$images = json_decode(file_get_contents('http://veterinariasanmiguel.com.uy/img/uploads/'));
		$folder = 'img/articulos/' . $articulo->id . '/';

		foreach($images->files as $image)
			{
				$extension = 'jpg';
        		$fileName = $articulo->slug . '-' . $contador . '.' . $extension;
				$big = Image::make($image->url);
				$big->grab(1024, 768)->insert(public_path() .'/img/veterinaria-san-miguel-logo.png', 20, 20, 'bottom-left');
				$big->save($folder . 'big/' . $fileName, 70);

				$big = Image::make($image->url);
				$big->grab(270, 180);
				$big->save($folder . 'list/' . $fileName, 70);

				$big = Image::make($image->url);
				$big->grab(500, 300);
				$big->save($folder . 'med/' . $fileName, 70);

				$big = Image::make($image->url);
				$big->grab(200, 200);
				$big->save($folder . 'min/' . $fileName, 70);

				$registro = new Photo();
				$registro->path = $folder;
				$registro->position = $contador;
				$registro->filename = $fileName;
				$registro->articulo_id = $articulo->id;
				$registro->save();
				$contador = $contador + 1;
			}
			File::cleanDirectory(public_path() . '/img/uploads/files');
			return Redirect::to('admin/articulos/'.$articulo->id.'/editarGaleria')->with('message', 'Im&aacute;genes agregadas correctamente.')->with('messageType', 'success');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		if(Request::ajax())
		{
			if(Articulo::find($id)->delete())
			{
				return 'deleted';
			}
			else
			{
				return 'error';
			}
		}
	}

	public function listaArticulosAdmin()
	{
		return View::make('admin/articulos.index')->with('articulos', Articulo::all());
	}

	public function verificarCodigo()
	{
		if(Request::ajax())
		{
			$codigo = Input::get('codigo');
			if($codigo == '')
			{
				return Response::json(array(
					'success' => false,
					'message' => 'Debe ingresar un c&oacute;digo.'
				));
			}
			if(!Articulo::where('code', '=', $codigo)->first())
			{
				return Response::json(array(
	                'success' => true,
	                'message' => 'C&oacute;digo disponible.'
	            ));
			}
			else
			{
				return Response::json(array(
					'success' => false,
					'message' => 'C&oacute;digo no disponible.'
				));
			}
		}
	}

}