<?php 
class AuthController Extends BaseController
{
	public function get_login()
	{
		$title = 'Veterinaria San Miguel en Rocha, Uruguay';
		$meta_description = 'Veterinaria en Rocha, Uruguay. Venta de porteras, embarcaderos, cepos, decks, pergolas y otros trabajos en madera. Tambi&eacute;n productos veterinarios, alambres y dem&aacute;s.';
		return View::make('admin.auth.login', array('title' => $title, 'meta_description' => $meta_description));
	}

	public function post_login()
	{
		$credentials = array(
				'username'=>Input::get('username'),
				'password'=>Input::get('password')
			);

		if(Auth::attempt($credentials))
		{
			return Redirect::to('admin');
		}
		else
		{
			return Redirect::back()->withInput();
		}
	}

	public function get_logout()
	{
		Auth::logout();
		return Redirect::to('admin');
	}
}