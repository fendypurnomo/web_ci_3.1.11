<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Upload_model extends CI_Model
{
	function save_upload($a, $b)
	{
		$data = array(
			'galeri_judul' => $a,
			'galeri_gambar' => $b
		);

		return $r = $this->db->insert('tabel_galeri', $data);
	}
}
