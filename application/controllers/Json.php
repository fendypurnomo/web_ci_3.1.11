<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Json extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('json_model');
	}

	public function index()
	{
		$q = $this->json_model->data_villages()->result_array();

		$output = [];

		foreach ($q as $r) {
			$output[] = [
				'villages_id' => $r['villages_id'],
				'villages_name' => $r['villages_name']
			];
		}

		$json = json_encode($output);
		$arr = utf8_encode($json);

		/*
		$no = 1;
		foreach ($result as $value)
		{
		echo "<table><tr><td>" . $no . "</td><td>" . $value['nama'] . "</td></tr></table>";
		$no++;
		}
		*/

		$d = [
			'title' => 'Dashboard - Json',
			'result' => json_decode($arr, true)
		];
		$this->template->load('dashboard', 'contents/json', $d);
	}
}
