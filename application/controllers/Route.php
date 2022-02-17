<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Route extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->view('template_route/template_route');
	}

	public function login()
	{
		$this->load->view('login_route');
	}

	public function dashboard()
	{
		$this->load->view('dashboard_route');
	}
}