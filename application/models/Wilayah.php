<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Wilayah extends CI_Model
{
    public function getDataProvinsi()
    {
        $this->db->select('*');
        $this->db->from('wilayah_provinsi');
        $this->db->order_by('nama', 'asc');
        return $this->db->get()->result();
    }

    public function getDataKabupaten()
    {
        $this->db->select('*');
        $this->db->from('wilayah_kabupaten');
        $this->db->order_by('nama', 'asc');
        return $this->db->get()->result();
    }

    public function getDataKecamatan()
    {
        $this->db->select('*');
        $this->db->from('wilayah_kecamatan');
        $this->db->order_by('nama', 'asc');
        return $this->db->get()->result();
    }

    public function getProvinsiById($id)
    {
        $this->db->select('*');
        $this->db->from('wilayah_provinsi');
        $this->db->where('id', $id);
        return $this->db->get()->result();
    }

    public function getKabupatenById($id)
    {
        $this->db->select('*');
        $this->db->from('wilayah_kabupaten');
        $this->db->where('id', $id);
        return $this->db->get()->result();
    }

    public function getKecamatanById($id)
    {
        $this->db->select('*');
        $this->db->from('wilayah_kecamatan');
        $this->db->where('id', $id);
        return $this->db->get()->result();
    }
}


/* End of file Wilayah.php */
