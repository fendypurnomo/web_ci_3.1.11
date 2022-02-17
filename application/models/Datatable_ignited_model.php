<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Datatable_ignited_model extends CI_Model
{
	function json()
	{
		$this->datatables->select('city.city_id, city.city_name, city.city_population, country.country_name')
										 ->from('city')
										 ->join('country', 'city.city_country_code = country.country_code')
										 ->add_column('action', '<a class="btn btn-outline-warning btn-sm" href="datatable_ignited/edit/$1" role="button">Edit</a>&nbsp;<a class="btn btn-outline-danger btn-sm" href="datatable_ignited/delete/$1" role="button">Delete</a>', 'city_id');
		return $this->datatables->generate();
	}
}
