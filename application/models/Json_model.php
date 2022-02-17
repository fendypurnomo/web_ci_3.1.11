<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Json_model extends CI_Model
{
	function data_villages()
	{
		return $this->db->query('SELECT district_id, villages_id, villages_name FROM ref_id_villages LIMIT 10');
	}
}
