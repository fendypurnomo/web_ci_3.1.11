<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Datatable_ignited extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('datatables');
		$this->load->model('datatable_ignited_model');
	}

	function index()
	{
		$d['title'] = 'Dashboard - World';
		$this->template->load('dashboard', 'contents/datatable_ignited', $d);
	}

	function json()
	{
		header('Content-Type: application/json');
		echo $this->datatable_ignited_model->json();
	}
}
