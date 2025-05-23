<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
	protected $m_pengunjung;
	protected $session;

	public function __construct()
	{
		$this->session = \Config\Services::session();
		$this->session->start();
	}
	public function index()
	{
		if (session()->get('username') == '') {
			session()->setFlashdata('error', '.');
			return redirect()->to(base_url('/admin'));
		}
		$data = ['title' => 'dashboard', 'active' => 'dashboard',];
		return view('admin/dashboard/index', $data);
	}
}
