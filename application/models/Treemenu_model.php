<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Treemenu_model extends CI_Model
{
	function data()
	{
		$q = $this->db->query('SELECT treemenu_id, treemenu_name, IFNULL(treemenu_parent_id, 100) AS parent FROM tabel_treemenu ORDER BY treemenu_id ASC')
			->result_array();
		return $q;
	}
}
