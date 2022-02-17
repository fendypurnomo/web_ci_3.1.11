<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Parent_child_model extends CI_Model
{
	function data()
	{
		$q = $this->db->query('SELECT
															c.wilayah_provinsi_id pvid,
															c.wilayah_provinsi_nama pvnama,
															b.wilayah_kabupaten_id kbid,
															b.wilayah_kabupaten_nama kbnama,
															a.wilayah_kecamatan_id kcid,
															a.wilayah_kecamatan_nama kcnama,
															IF(
															@bapakId = c.wilayah_provinsi_id,
															@bapak := @bapak + 1,
															@bapak := 1
															) AS bapak,
															IF(
															@bapakId != c.wilayah_provinsi_id,
															@bapakId := b.wilayah_kabupaten_id,
															@anakId := 2
															) AS anak,
															IF(
															@bapakId != b.wilayah_kabupaten_id,
															@bapakId := a.wilayah_kecamatan_id,
															@cucuId := 3
															) AS cucu
														FROM wilayah_kecamatan AS a
														LEFT JOIN wilayah_kabupaten AS b
														ON a.wilayah_kabupaten_id = b.wilayah_kabupaten_id
														LEFT JOIN wilayah_provinsi AS c
														ON b.wilayah_provinsi_id = c.wilayah_provinsi_id')
									->result();
		return $q;
	}
}
