<?php 
class Cliente extends  Eloquent 
{
	protected $table = 'cliente';

	public static $rules = array(
				'mail-contacto' => 'required|unique:cliente,email'
			);

	public static $messages = array(
	            'mail-contacto' => 'Ya existe un cliente registrado con este e-mail.'
	        );

	public static function validate($data)
	{
		return Validator::make($data, static::$rules, static::$messages);
	}
}
?>