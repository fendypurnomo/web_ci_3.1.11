<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Daerah_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function get_provinsi()
	{
		$s = "SELECT * FROM wilayah_provinsi";
		$q = $this->db->query($s);
		return $q->result();
	}

	public function get_kabupaten($id)
	{
		$s = "SELECT * FROM wilayah_kabupaten WHERE wilayah_provinsi_id={$id} ORDER BY wilayah_kabupaten_nama";
		$q = $this->db->query($s);
		return $q->result();
	}

	public function get_kecamatan($id)
	{
		$s = "SELECT * FROM wilayah_kecamatan WHERE wilayah_kabupaten_id={$id} ORDER BY wilayah_kecamatan_nama";
		$q = $this->db->query($s);
		return $q->result();
	}

	public function get_kelurahan($id)
	{
		$s = "SELECT * FROM wilayah_kelurahan WHERE wilayah_kecamatan_id={$id} ORDER BY wilayah_kelurahan_nama";
		$q = $this->db->query($s);
		return $q->result();
	}
}
