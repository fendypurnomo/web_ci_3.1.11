<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Daerah extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('daerah_model');
	}

	public function index()
	{
		$d = [
			'title' => 'Dashboard - Peta Daerah',
			'provinsi' => $this->daerah_model->get_provinsi()
		];
		$this->template->load('dashboard', 'contents/daerah', $d);
	}

	public function getKabupaten($id)
	{
		$q = $this->daerah_model->get_kabupaten($id);
		echo "<option value=''>Pilih Kabupaten/Kota</option>";
		foreach($q as $v)
		{
			echo "<option value='{$v->wilayah_kabupaten_id}'>{$v->wilayah_kabupaten_nama}</option>";
		}
	}

	public function getKecamatan($id)
	{
		$q = $this->daerah_model->get_kecamatan($id);
		echo "<option value=''>Pilih Kecamatan</option>";
		foreach($q as $v)
		{
			echo "<option value='{$v->wilayah_kecamatan_id}'>{$v->wilayah_kecamatan_nama}</option>";
		}
	}

	public function getKelurahan($id)
	{
		$q = $this->daerah_model->get_kelurahan($id);
		echo "<option value=''>Pilih Kelurahan/Desa</option>";
		foreach($q as $v)
		{
			echo "<option value='{$v->wilayah_kelurahan_id}'>{$v->wilayah_kelurahan_nama}</option>";
		}
	}
}
