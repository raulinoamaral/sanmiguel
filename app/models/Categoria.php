<?php 
class Categoria extends  Eloquent 
{
	protected $table = 'categoria';

	public function subcategorias()
	{
		return $this->hasMany('Subcategoria');
	}

	public function articulos()
	{
		return $this->hasMany('Articulo');
	}

	public static $sluggable = array(
        'build_from' => 'name',
        'save_to'    => 'slug',
    );

	public function getLink()
	{
		return asset('articulos/'.$this->slug);
	}
}
?>