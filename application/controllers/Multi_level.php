<?php

defined('BASEPATH') or exit('No direct script access allowed!');

class Multi_level extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('multilevel_model');
	}

	function index()
	{
		$items = $this->multilevel_model->get_items();
		$menu = $this->multilevel_model->generateTree($items);

		$data = [
			'title' => 'Multi Level',
			'menu' => $menu
		];

		$this->template->load('dashboard', 'contents/multi_level', $data);
	}
}
