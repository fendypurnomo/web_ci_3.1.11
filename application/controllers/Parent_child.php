<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Parent_child extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('parent_child_model');
	}

	public function index()
	{
		$d = [
			'title' => 'Dashboard - Parent Child',
			'q' => $this->parent_child_model->data()
		];
		$this->template->load('dashboard', 'contents/parent_child', $d);
	}
}
