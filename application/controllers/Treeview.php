<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Treeview extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('treeview_model');
	}

	public function index()
	{
		$d['title'] = 'Dashboard - Treeview dynamic with Bootstrap-treeview.js';
		$this->template->load('dashboard', 'contents/treeview', $d);
	}
}
