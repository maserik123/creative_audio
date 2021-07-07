<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Kurir extends CI_Model
{
    function getData()
    {
        $this->db->select('*');
        $this->db->order_by('id', 'desc');
        return $this->db->get('tbl_kurir')->result();
    }

    function getById($id)
    {
        $this->db->select('*');
        $this->db->where('id', $id);
        return $this->db->get('tbl_kurir')->row();
    }

    function insert($data)
    {
        $this->db->insert('tbl_kurir', $data);
    }
    function update($kode, $data)
    {
        $this->db->where('id', $kode);
        $this->db->update('tbl_kurir', $data);
    }
    function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('tbl_kurir');
    }
}

/* End of file Kurir.php */
