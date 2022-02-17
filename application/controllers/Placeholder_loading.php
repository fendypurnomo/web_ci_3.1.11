<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Placeholder_loading extends CI_Controller
{
	function index()
	{
		$d['title'] = 'Dashboard - Placeholder Loading';
		$this->template->load('dashboard', 'contents/placeholder_loading', $d);
	}
}
