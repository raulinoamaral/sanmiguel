<?php 
class Articulo extends  Eloquent 
{
	protected $table = 'articulo';

	public static $rules = array(
				'code' => 'required|min:3',
				'name' => 'required|max:150',
				'short_description' => 'required',
				'price' => 'numeric',
				'categoria_id' => 'required|exists:categoria,id',
				'subcategoria_id' => 'required|exists:subcategoria,id'
			);

	public static $messages = array(
	            'required' => 'Campo obligatorio.',
	            'numeric' => 'Este dato debe ser numérico.',
	            'max' => 'Supera el largo permitido.',
	            'categoria_id.exists' => 'Debe seleccionar una categoría.',
	            'subcategoria_id.exists' => 'Debe seleccionar una subcategoría.'
	        );

	public static function validate($data)
	{
		return Validator::make($data, static::$rules, static::$messages);
	}

	public function photos()
	{
		return $this->hasMany('Photo');
	}

	public function subcategoria()
	{
		return $this->belongsTo('Subcategoria');
	}

	public function categoria()
	{
		return $this->belongsTo('Categoria');
	}

	public function moneda()
	{
		return $this->belongsTo('Moneda');
	}

	public function listPhoto()
	{
		$pic = $this->photos()->where('position', '=', 1)->first();
		if($pic)
		return $pic->path.'list/'.$pic->filename;
	else
		return '';
	}

	public function getLink()
	{
		return asset('articulos/'.$this->categoria->slug.'/'.$this->subcategoria->slug.'/'.$this->slug);
	}

	public function getLinkEdit()
	{
		return asset('admin/articulos/'.$this->id.'/editar');
	}

	public function getLinkEditGallery()
	{
		return asset('admin/articulos/'.$this->id.'/editarGaleria');
	}

	public static $sluggable = array(
        'build_from' => 'name',
        'save_to'    => 'slug',
    );
		
}
?>