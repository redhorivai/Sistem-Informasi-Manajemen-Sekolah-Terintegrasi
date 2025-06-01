<?php

namespace App\Controllers;

use App\Controllers\BaseController;


class Home extends BaseController
{
	public function index()
	{
		$data = [
			'title' => 'data beranda', 'active' => 'beranda'
		];
		// print_r($data);
		return view('front/beranda/index', $data);
	}
}
