<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Map extends CI_Controller
{
	public function index()
	{
		$d['title'] = 'Dashboard - Peta';
		$this->template->load('dashboard', 'contents/map', $d);
	}
}
