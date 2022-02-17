<?php

defined('BASEPATH') or exit('No direct script access allowed!');

class Nested_array_model extends CI_model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function query()
	{
		$q = $this->db->query('SELECT
														prov.wilayah_provinsi_id prov_id,
														prov.wilayah_provinsi_nama prov_nama,
														kab.wilayah_kabupaten_id kab_id,
														kab.wilayah_kabupaten_nama kab_nama
													FROM
														wilayah_provinsi prov
													LEFT JOIN
														wilayah_kabupaten kab
													ON prov.wilayah_provinsi_id = kab.wilayah_provinsi_id')
									->result();
		return $q;
	}
}
