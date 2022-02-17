<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dropdown_scrollable extends CI_controller
{
	public function index()
	{
		$d['title'] = 'Dropwdown Scrollable';
		$this->template->load('dashboard', 'contents/dropdown_scrollable', $d);
	}
}
