<?php 
class Moneda extends  Eloquent 
{
	protected $table = 'moneda';

	public function articulos()
	{
		return $this->hasMany('Articulo');
	}
}
?>