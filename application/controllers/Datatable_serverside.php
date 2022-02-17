<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Datatable_serverside extends CI_Controller
{
	var $column_order = ['district_id', 'villages_id', 'villages_name'];

	public $req;

	public function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		$d['title'] = 'Dashboard - Datatable Serverside';
		$this->template->load('dashboard', 'contents/datatable_serverside', $d);
	}

	function query_data()
	{
		$draw   = $_REQUEST['draw'];
		$length = $_REQUEST['length'];
		$start  = $_REQUEST['start'];
		$search = $_REQUEST['search']['value'];
		$total  = $this->db->count_all_results('ref_id_villages');

		$output = [];
		$output['draw'] = $draw;
		$output['recordsTotal'] = $output['recordsFiltered'] = $total;
		$output['data'] = [];

		if ($search != "") {
			$this->db->like('villages_id', $search);
			$this->db->or_like('villages_name', $search);
		}

		$this->db->limit($length, $start);
		$this->db->order_by($this->column_order[$_REQUEST['order']['0']['column']], $_REQUEST['order']['0']['dir']);
		$q = $this->db->get('ref_id_villages')->result_array();

		if ($search != "") {
			$this->db->like('villages_id', $search);
			$this->db->or_like('villages_name', $search);
			$count = $this->db->get('ref_id_villages');
			$output['recordsTotal'] = $output['recordsFiltered'] = $count->num_rows();
		}

		$no = $start + 1;

		foreach ($q as $v) {
			$output['data'][] = [
				$no,
				$v['villages_id'],
				$v['villages_name']
			];
			$no++;
		}

		echo json_encode($output);
	}
}
