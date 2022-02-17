<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Table_to_excel extends CI_Controller
{
	public function index()
	{
		$d['title'] = 'Dashboard - Table to Excel';
		$this->template->load('dashboard', 'contents/table_to_excel', $d);
	}
}
