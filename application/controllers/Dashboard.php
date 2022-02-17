<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	public function index()
	{
		$d['title'] = 'Dashboard';
		$this->template->load('dashboard', 'contents/dashboard', $d);
	}
}
