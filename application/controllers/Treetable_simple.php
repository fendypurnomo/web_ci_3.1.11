<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Treetable_simple extends CI_Controller
{
	public function index()
	{
		$d['title'] = 'Dashboard - Treetable Simple';
		$this->template->load('dashboard', 'contents/treetable_simple', $d);
	}
}
