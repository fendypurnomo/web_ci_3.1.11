<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Treemenu extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('tree_menu');
		$this->load->model('treemenu_model');
	}

	function index()
	{
		$d = [
			'title' => 'Dashboard - Treemenu',
			'treemenu' => $this->treemenu_model->data()
		];
		$this->template->load('dashboard', 'contents/treemenu', $d);
	}
}
