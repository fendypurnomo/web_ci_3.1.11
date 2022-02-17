<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Upload extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('upload_model');
	}

	function index()
	{
		$d['title'] = 'Dashboard - Upload';
		$this->template->load('dashboard', 'contents/upload', $d);
	}

	function do_upload()
	{
		$conf['upload_path']   = './assets/images/upload';
		$conf['allowed_types'] = 'gif|jpg|jpeg|png';
		$conf['encrypt_name']  = true;

		$this->upload->initialize($conf);

		if ($this->upload->do_upload('file'))
		{
			$data   = ['upload_data' => $this->upload->data()];
			$title  = $this->input->post('title');
			$image  = $data['upload_data']['file_name'];
			$result = $this->upload_model->save_upload($title, $image);
			echo json_decode($result);
		}
	}
}
