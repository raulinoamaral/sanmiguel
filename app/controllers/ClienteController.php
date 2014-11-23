<?php

class ClienteController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
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
		if(Request::ajax())
		{
			$email = Input::get('email');
	        $rules = array(
	            'email' => 'required|email|unique:cliente'
	        );
	            
	        $messages = array(
	            'required' => 'Ingrese su e-mail aquí.',
	            'email' => 'Verifique su correo y vuelva a intentarlo.',
	            'unique' => 'Usted ya estaba registrado en nuestro sistema.'
	        );
	        $validation = Validator::make(Input::all(), $rules, $messages);

	        if($validation->fails())
	        {
	            return Response::json(array(
	                'success' => false,
	                'errors' => $validation->getMessageBag()->toArray()
	            ));
	        }
	        else
	        {
	           	$cliente = new Cliente;
				$cliente->email = Input::get('email');
				$cliente->save();
	            if ($cliente)
				{
					return Response::json(array(
						'success' => true,
						'mensaje' => 'Gracias, usted ha sido suscrito correctamente a nuestro boletín.'
						));
				}
			}
		}
		
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

}