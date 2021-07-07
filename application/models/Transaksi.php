<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Transaksi extends CI_Model
{
    public $table = 'tbl_transaksi';
    public $id_transaksi = 'id_transaksi';
    public $id_user = 'id_user';
    public $id_produk = 'id_produk';
    public $id_pembayaran = 'id_pembayaran';
    public $tgl_transaksi = 'tgl_transaksi';
    public $aktif = 'aktif';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    public function getDataById($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_transaksi');
        $this->db->where('id_transaksi', $id);
        return $this->db->get()->row();
    }

    function getByIdPembayaran($id_pembayaran)
    {
        $this->db->select('*');
        $this->db->where('id_pembayaran', $id_pembayaran);
        return $this->db->get('tbl_transaksi')->row();
    }

    public function getKomentarByIdProduk($id_produk)
    {
        $this->db->select('tt.komentar, tu.nama_user');
        $this->db->from('tbl_transaksi tt');
        $this->db->join('tbl_user tu', 'tu.id_user = tt.id_user', 'left');
        $this->db->where('id_produk', $id_produk);
        return $this->db->get()->result();
    }

    public function getDataByIdUser($id_user, $aktif)
    {
        $this->db->select('*');
        $this->db->from('tbl_transaksi');
        $this->db->where('id_user', $id_user);
        $this->db->where('aktif', $aktif);
        return $this->db->get()->row();
    }

    public function getCheckoutByIdPembayaran($id_pembayaran)
    {
        $this->db->select('tt.id_transaksi, tt.id_produk, tt.id_pembayaran, tt.id_user, tt.tgl_transaksi, tt.qty_transaksi, tt.total_transaksi, tt.komentar, tt.aktif, tp.id_pembayaran, tp.total_pembayaran, tp.bukti_pembayaran, tp.nomor_resi, tp.kurir_pengiriman, tp.tgl_pembayaran, tp.status_pembayaran');
        $this->db->from('tbl_transaksi tt');
        $this->db->join('tbl_pembayaran tp', 'tp.id_pembayaran = tt.id_pembayaran', 'left');
        $this->db->where('tt.id_pembayaran', $id_pembayaran);
        return $this->db->get()->result();
    }

    public function getDataByIdProdukUser($id_produk, $id_user)
    {
        $this->db->select('*');
        $this->db->from('tbl_transaksi');
        $this->db->where('id_produk', $id_produk);
        $this->db->where('id_user', $id_user);
        return $this->db->get()->result();
    }

    public function addComment($id, $comment)
    {
        $this->db->query('update tbl_transaksi set komentar = "' . $comment . '" where id_transaksi = "' . $id . '"');
    }

    function get_all()
    {
        return $this->db->query('select * from tbl_transaksi a, tbl_produk b, tbl_pembayaran c, tbl_user d WHERE
                                    a.id_produk=b.id_produk AND a.id_pembayaran=c.id_pembayaran AND 
                                    a.id_user=d.id_user AND c.aktif!=1 GROUP BY a.id_pembayaran ORDER BY c.status_pembayaran ASC')->result();
    }
    function get_all_limit()
    {
        return $this->db->query('select * from tbl_transaksi a, tbl_produk b, tbl_pembayaran c, tbl_user d WHERE
                                    a.id_produk=b.id_produk AND a.id_pembayaran=c.id_pembayaran AND 
                                    a.id_user=d.id_user AND a.aktif=0 GROUP BY a.id_user ORDER BY a.tgl_transaksi DESC')->result();
    }
    function get_by_userlimit($kode)
    {
        return $this->db->query('select * from tbl_transaksi a, tbl_produk b, tbl_pembayaran c, tbl_user d WHERE
                                    a.id_produk=b.id_produk AND a.id_pembayaran=c.id_pembayaran AND 
                                    a.id_user=d.id_user AND a.aktif=0 AND a.id_user="' . $kode . '" ORDER BY a.tgl_transaksi ASC')->result();
    }
    function get_by_pelanggan($kode)
    {
        return $this->db->query('select * from tbl_transaksi where id_user="' . $kode . '" order by tgl_transaksi DESC')->result();
    }
    function get_by_pembayaran($kode)
    {
        return $this->db->query('select * from tbl_transaksi a, tbl_produk b, tbl_pembayaran c, tbl_user d WHERE
                                    a.id_produk=b.id_produk AND a.id_pembayaran=c.id_pembayaran AND 
                                    a.id_user=d.id_user AND a.aktif!=1 AND a.id_pembayaran="' . $kode . '" order by a.id_transaksi DESC')->result();
    }
    function get_by_pembayaranSingle($kode)
    {
        return $this->db->query('select * from tbl_transaksi a, tbl_produk b, tbl_pembayaran c, tbl_user d WHERE
                                    a.id_produk=b.id_produk AND a.id_pembayaran=c.id_pembayaran AND 
                                    a.id_user=d.id_user AND a.aktif!=1 AND a.id_pembayaran="' . $kode . '" order by a.id_transaksi DESC')->row();
    }

    public function listComment()
    {
        $this->db->select('u.nama_user, p.nama_produk, t.komentar, p.foto_produk');
        $this->db->from('tbl_transaksi t');
        $this->db->join('tbl_user u', 'u.id_user = t.id_user', 'left');
        $this->db->join('tbl_produk p', 'p.id_produk = t.id_produk', 'left');
        $this->db->where('t.komentar != ""');
        return $this->db->get()->result();
    }


    function get_history($kode)
    {
        return $this->db->query('select * from tbl_transaksi a, tbl_pembayaran b, tbl_produk c, tbl_user d where 
        a.id_pembayaran=b.id_pembayaran AND a.id_produk=c.id_produk AND a.id_user=d.id_user AND
        a.id_user="' . $kode . '" AND a.aktif!=1 GROUP BY a.id_pembayaran order by a.id_pembayaran DESC')->result();
    }
    function get_by_kode($kode)
    {
        $this->db->where($this->id_transaksi, $kode);
        return $this->db->get($this->table)->row();
    }
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    function update($kode, $data)
    {
        $this->db->where($this->id_transaksi, $kode);
        $this->db->update($this->table, $data);
    }

    public function update1($id, $data)
    {
        $this->db->query('update tbl_transaksi set id_kurir = "' . $data . '" where id_pembayaran = "' . $id . '"');
    }


    function insert_keranjang($data)
    {
        $this->db->insert('tbl_keranjang', $data);
    }

    function update_keranjang($kode, $data)
    {
        $this->db->where('id_transaksi', $kode);
        $this->db->update('tbl_keranjang', $data);
    }

    function updateCheckout($kode, $aktif, $data)
    {
        $this->db->where($this->id_user, $kode);
        $this->db->where($this->aktif, $aktif);
        $this->db->update($this->table, $data);
        // $this->delete($kode);
    }

    function delete($id)
    {
        $this->db->where($this->id_transaksi, $id);
        $this->db->delete($this->table);
    }
}
