<?php 
class Subcategoria extends  Eloquent 
{
	protected $table = 'subcategoria';

	public function categoria()
	{
		return $this->belongsTo('Categoria');
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
		return asset('articulos/'.$this->categoria->slug.'/'.$this->slug);
	}
}
?>