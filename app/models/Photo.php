<?php 
class Photo extends  Eloquent 
{
	protected $table = 'photo';
	
	public function articulo()
	{
		return $this->belongsTo('Articulo', 'articulo_id');
	}

	public function getBigSrc()
	{
		return asset($this->path.'big/'.$this->filename);
	}
	public function getListSrc()
	{
		return asset($this->path.'list/'.$this->filename);
	}
	public function getMedSrc()
	{
		return asset($this->path.'med/'.$this->filename);
	}
	public function getMinSrc()
	{
		return asset($this->path.'min/'.$this->filename);
	}
}
?>