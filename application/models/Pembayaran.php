<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Pembayaran extends CI_Model
{
    public $table = 'tbl_pembayaran';
    public $id_pembayaran = 'id_pembayaran';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }
    function get_all()
    {
        return $this->db->query('select * from tbl_pembayaran where aktif!=1 order by id_pembayaran DESC')->result();
    }

    public function getKecamatan()
    {
        $this->db->select('*');
        $this->db->from('wilayah_kecamatan');
        $this->db->order_by('nama', 'asc');
        return $this->db->get()->result();
    }

    function get_by_kode($kode)
    {
        $this->db->where($this->id_pembayaran, $kode);
        return $this->db->get($this->table)->row();
    }
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }
    function update($kode, $data)
    {
        $this->db->where($this->id_pembayaran, $kode);
        $this->db->update($this->table, $data);
    }

    function delete($id)
    {
        $this->db->where($this->id_pembayaran, $id);
        $this->db->delete($this->table);
    }
}
