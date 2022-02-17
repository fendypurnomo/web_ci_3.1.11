<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Geojson extends CI_Controller
{
	public function index()
	{
		$sql = "SELECT geojson_id AS id,wilayah_kabupaten_nama AS nama,geojson_koordinat AS koordinat,geojson_color AS color FROM tabel_koordinat LEFT JOIN wilayah_kabupaten ON wilayah_kabupaten_id=geojson_id";
		$query = $this->db->query($sql)->result();

		$geojson = array(
			"type" => "FeatureCollection",
			"features" => array()
		);

		foreach($query as $value) {
			$feature = array(
				"type" => "Feature",
				"geometry" => array(
					"type" => "MultiPolygon",
					"coordinates" => json_decode($value->koordinat)
				),
				"properties" => array(
					"name" => "<strong>" . $value->nama . "</strong><p>Kode Wilayah: " . $value->id . "</p>",
					"color" => $value->color
				)
			);
			array_push($geojson['features'], $feature);
		}
		header('Content-type: application/json');
		echo json_encode($geojson, JSON_PRETTY_PRINT);
	}
}
