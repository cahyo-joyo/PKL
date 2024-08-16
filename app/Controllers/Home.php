<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		$data = [
			'title' => 'Seventhsoft | Magang'
		];
		return view('/pages/home', $data);
	}

	//--------------------------------------------------------------------

}
