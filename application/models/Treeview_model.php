<?php

defined('BASEPATH') or exit('Tidak dapat mengakses langsung');

class Treeview_model extends CI_Model
{
  function pulauGetAll()
  {
    $q = "SELECT pulau_id,pulau_nama FROM ref_wilayah_pulau WHERE pulau_id > 0";
    return $this->db->query($q)->result_array();
  }

  function provinsiGetByPulau_id($a)
  {
    $q = "SELECT pulau_id,provinsi_id,provinsi_nama FROM ref_wilayah_provinsi WHERE pulau_id = ?";
    return $this->db->query($q, $a)->result_array();
  }

  function kabupatenKotaGetByProvinsi_id($a,$b)
  {
    $q = "SELECT pulau_id,provinsi_id,kabupaten_kota_id,kabupaten_kota_nama FROM ref_wilayah_kabupaten_kota WHERE pulau_id = ? AND provinsi_id = ?";
    return $this->db->query($q, array($a,$b))->result_array();
  }

  function kecamatanGetByKabupatenKota_id($a,$b,$c)
  {
    $q = "SELECT pulau_id,provinsi_id,kabupaten_kota_id,kecamatan_id,kecamatan_nama FROM ref_wilayah_kecamatan WHERE pulau_id = ? AND provinsi_id = ? AND kabupaten_kota_id = ?";
    return $this->db->query($q, array($a,$b,$c))->result_array();
  }

  function kelurahanDesaGetByKecamatan_id($a,$b,$c,$d)
  {
    $q = "SELECT pulau_id,provinsi_id,kabupaten_kota_id,kecamatan_id,kelurahan_desa_id,kelurahan_desa_nama FROM ref_wilayah_kelurahan_desa WHERE pulau_id = ? AND provinsi_id = ? AND kabupaten_kota_id = ? AND kecamatan_id = ?";
    return $this->db->query($q, array($a,$b,$c,$d))->result_array();
  }
}
