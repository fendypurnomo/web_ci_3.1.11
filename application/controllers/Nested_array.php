<?php

defined('BASEPATH') or exit('No direct script access allowed!');

class Nested_array extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('nested_array_model');
	}

	public function index()
	{
		$d = [
			'title' => 'Nested Array',
			'query' => $this->nested_array_model->query()
		];
		$this->template->load('dashboard', 'contents/nested_array', $d);
	}

	public function header_json()
	{
		$q = $this->nested_array_model->query();

		foreach ($q as $r) {
			if (!isset($i[$r->prov_id])) {
				$i[$r->prov_id] = [
					'prov_id' => $r->prov_id,
					'prov_nama' => $r->prov_nama,
					'kab' => []
				];
			}

			$i[$r->prov_id]['kab'][] = [
				'kab_id' => $r->kab_id,
				'kab_nama' => $r->kab_nama
			];
		}

		$d = array_values($i);
		header("Content-Type: application/json");
		echo json_encode($d);
	}
}
