<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Hightchart extends CI_Controller
{
	public function index()
	{
		$d['title'] = 'Dashboard - Hightchart';
		$this->template->load('dashboard', 'contents/hightchart', $d);
	}
}
