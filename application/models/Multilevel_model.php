<?php

defined('BASEPATH') or exit('No direct script access allowed!');

class Multilevel_model extends CI_Model
{
	function get_items()
	{
		$this->db->select('*');
		$this->db->from('tabel_treemenu');
		$query = $this->db->get();
		return $query->result_array();
	}

	function generateTree($items = [], $parent_id = 0)
	{
		$tree = '<ul>';

		for ($i = 0, $ni = count($items); $i < $ni; $i++) {
			if ($items[$i]['treemenu_parent_id'] == $parent_id) {
				$tree .= '<li>';
				$tree .= $items[$i]['treemenu_name'];
				$tree .= $this->generateTree($items, $items[$i]['treemenu_id']);
				$tree .= '</li>';
			}
		}

		$tree .= '</ul>';
		return $tree;
	}
}
