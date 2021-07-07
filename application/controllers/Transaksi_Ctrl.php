<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Transaksi_Ctrl extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        include_once APPPATH . '/third_party/fpdf/fpdf.php';
        $this->load->model('Transaksi');
        $this->load->model('Produk');
        $this->load->model('Pembayaran');
        $this->load->model('Wilayah');
        $this->load->model('User');
        $this->load->model('Kurir');

        $this->load->library('form_validation');
        $this->load->library('datatables');

        if (!$this->session->userdata('logined') || $this->session->userdata('logined') != true) {
            //redirect('/');
        }
    }

    public function index()
    {
        $data['transaksi'] = $this->Transaksi->get_all();
        $this->load->view('transaksi/transaksi_list', $data);
    }
    public function limit()
    {
        $data['transaksi'] = $this->Transaksi->get_all_limit();
        $this->load->view('transaksi/transaksi_list_limit', $data);
    }
    public function detail($kode)
    {
        $data['transaksi'] = $this->Transaksi->get_by_pembayaran($kode);
        $data['transaksi2'] = $this->Transaksi->get_by_pembayaranSingle($kode);
        $this->load->view('transaksi/transaksi_detail', $data);
    }
    public function detail_limit($kode)
    {
        $data['transaksi'] = $this->Transaksi->get_by_userlimit($kode);
        $this->load->view('transaksi/transaksi_detail_limit', $data);
    }

    public function checkout()
    {
        $pengiriman = $this->input->post('kurir_pengiriman', TRUE);
        $id = $this->session->userdata('kode');
        $data['produk'] = $this->Produk->get_keranjang($id);
        $data['user'] = $this->User->getDataById($id);
        $data['getProvinsi'] = $this->Wilayah->getDataProvinsi();
        $data['getKabupaten'] = $this->Wilayah->getDataKabupaten();
        $data['getKecamatan'] = $this->Wilayah->getDataKecamatan();
        $data['getByIdPembayaran'] = $this->Transaksi->getByIdPembayaran(1);
        $data['total'] = $this->Produk->get_total($id);
        $data['getKurir'] = $this->Kurir->getData();
        $data['pengiriman'] = $pengiriman;
        $this->load->view('produk/produk_checkout', $data);
    }

    public function getProvinsiByJson()
    {
        $id   = $this->input->post('id');
        $data = $this->Wilayah->getDataProvinsi($id);
        $csrf = array(
            'token' => $this->security->get_csrf_hash()
        );
        echo json_encode(array('result' => $data, 'csrf' => $csrf));
        die;
    }

    public function listKomentar()
    {
        $data['listComment'] = $this->Transaksi->listComment();
        $this->load->view('produk/produk_komentar', $data);
    }

    public function checkout_alamat()
    {
        $id = $this->session->userdata('kode');
        $getKecamatanById = $this->Wilayah->getKecamatanById($this->input->post('id_kecamatan'));
        $data = array(
            'id_user' => $id,
            'nama_user' => $this->input->post('nama_user', TRUE),
            'telp_user' => $this->input->post('telp_user', TRUE),
            'alamat_user' => $this->input->post('alamat_user', TRUE),
            'provinsi_user' => $this->input->post('provinsi_user', TRUE),
            'id_kecamatan' => $this->input->post('id_kecamatan', TRUE),
            'kecamatan_user' => $getKecamatanById[0]->nama,
            'kota_user' => $this->input->post('kota_user', TRUE),
            'kode_pos' => $this->input->post('kode_pos', TRUE),
        );
        $getUserById = $this->User->getById($this->session->userdata('kode'));
        if (!empty($getUserById->id_kecamatan)) {
        } else {
            $this->User->update($id, $data);
        }
        $total_belanja = $this->input->post('total_belanja');
        $pengiriman = $this->input->post('kurir_pengiriman', TRUE);

        $this->Transaksi->update1(1, $pengiriman);

        $getDataKurir = $this->Kurir->getById($pengiriman);
        $total = ($total_belanja + $getKecamatanById[0]->ongkir + $getDataKurir->harga);
        $data2['pengiriman'] = $pengiriman;
        $data2['totalBelanja'] = $total_belanja;
        $data2['ongkirDaerah'] = $getKecamatanById[0]->ongkir;
        $data2['kurir'] = $getDataKurir->nama;
        $data2['hargaKurir'] = ($getDataKurir->harga + $getKecamatanById[0]->ongkir);
        $data2['total'] = $total;
        $data2['user'] = $this->User->get_by_kode($id);
        $this->load->view('produk/produk_pembayaran', $data2);
    }
    public function pengiriman()
    {

        $data = array(
            'id_pembayaran' => $this->input->post('id_pembayaran', TRUE),
            'status_pembayaran' => 'Sudah Dikirim',
            'nomor_resi' => $this->input->post('nomor_resi', TRUE),
        );
        $this->Pembayaran->update($this->input->post('id_pembayaran', TRUE), $data);

        /*===================================EOQ & ROP==============================================*/
        $pembayaran = $this->Transaksi->get_by_pembayaran($this->input->post('id_pembayaran', TRUE));
        // print_r($pembayaran);
        foreach ($pembayaran as $u) {
            // $biayaPemesanan     = $u->harga_jual * 0.1;
            // $biayaPenyimpanan   = $u->harga_jual * 0.15;

            // Rumus EOQ   = Input Akar dari 2*TotalPenjualan*BiayaPemesanan/BiayaPenyimpanan
            // Rumus SS    = Input (PenjualanMax-PenjualanRata-rata)*LeadTime
            // Rumus ROP   = Input (LeadTime*PenjualanRata-rata)*SS

            $query=$this->db->query('SELECT CEILING(SQRT((2*SUM(a.qty_transaksi)*(b.harga_jual*0.1))/(b.harga_jual*0.15))) as eoq,  
            ((MAX(a.qty_transaksi))-(AVG(a.qty_transaksi)))*3 as ss,
            CEILING((3 *(AVG(a.qty_transaksi))) + (((MAX(a.qty_transaksi))-(AVG(a.qty_transaksi)))*3)) as rop 
            from tbl_transaksi a, tbl_produk b, tbl_pembayaran c 
            WHERE a.id_produk=b.id_produk AND a.id_pembayaran=c.id_pembayaran
            AND a.id_produk='.$u->id_produk)->row();

            $eoq = 0;
            $rop = 0;
            if ($query->eoq > 0) {
                $eoq = $query->eoq;
            }
            if ($query->rop > 0) {
                $rop = $query->rop;
            }
            $dataProduk = array(
                'eoq' => $eoq,
                'rop' => $rop,
            );
            $this->Produk->update($u->id_produk, $dataProduk);
        }
        /*===================================Selesai================================================*/

        $this->session->set_flashdata('message', '<script>alert("Berhasil Melakukan Pengiriman");</script>');
        redirect(site_url('Transaksi_Ctrl'));
    }
    public function checkout_action()
    {
        $id = $this->session->userdata('kode');
        $aktif = 0;

        $config['upload_path']          = './uploads/';
        $config['allowed_types']        = 'jpg|png';
        $config['max_size']             = 3048;
        $config['max_width']            = 5000;
        $config['max_height']           = 5000;
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('bukti_pembayaran')) {
        } else {
            $result = $this->upload->data();
            $data = array(
                'total_pembayaran' => $this->input->post('total_pembayaran'),
                'status_pembayaran' => 'Sudah Bayar',
                'tgl_pembayaran' => $this->input->post('tgl_pembayaran'),
                'kurir_pengiriman' => $this->input->post('kurir_pengiriman'),
                'bukti_pembayaran' => $result['file_name']
            );
        }
        $this->Pembayaran->insert($data);


        $query = $this->db->query('SELECT * FROM tbl_pembayaran ORDER BY id_pembayaran DESC')->row();
        $data2 = array(
            'id_pembayaran' => $query->id_pembayaran,
            'aktif' => 2
        );
        $this->Transaksi->updateCheckout($id, $aktif, $data2);

        $this->session->set_flashdata('message', '<script>alert("Berhasil Melakukan Pembayaran");</script>');
        redirect(site_url('Main_Ctrl'));
    }
    public function addBelanja()
    {
        $id = $this->session->userdata('kode');
        if ($id == '') {
            $this->session->set_flashdata('message', '<script>alert("Silahkan login terlebih dahulu");</script>');
            redirect(site_url('Main_Ctrl/login'));
        } else {

            $qty = $this->input->post('qty_transaksi');
            $id_produk = $this->input->post('id_produk');
            $kode = $this->Produk->get_by_kode($id_produk);
            $stok = $kode->stok_produk;

            if ($stok < $qty) {
                $this->session->set_flashdata('message', '<script>alert("Stok tidak mencukupi");</script>');
                redirect(site_url('Main_Ctrl'));
            } else {
                $sisaStok = $stok - $qty;
                $dataBarang = array(
                    'stok_produk' => $sisaStok,
                );
                $this->Produk->update($id_produk, $dataBarang);

                // $data = array(
                //     'id_produk' => $this->input->post('id_produk', TRUE),
                //     'id_user' => $id,
                //     'id_pembayaran' => 1,
                //     'tgl_transaksi' => date('Y-m-d'),
                //     'qty_transaksi' => $this->input->post('qty_transaksi', TRUE),
                //     'total_transaksi' => $this->input->post('qty_transaksi', TRUE) * $this->input->post('harga_produk', TRUE),
                // );

                $cekData = $this->Transaksi->getDataByIdProdukUser($this->input->post('id_produk'), $id);
                if (($cekData[0]->aktif == 0) && ($cekData[0]->id_user == $id)) {
                    $data['id_produk'] = $this->input->post('id_produk');
                    $data['id_user'] = $id;
                    $data['id_pembayaran'] = 1;
                    $data['tgl_transaksi'] = date('Y-m-d');
                    $data['qty_transaksi'] = $cekData[0]->qty_transaksi + $this->input->post('qty_transaksi');
                    $data['total_transaksi'] = $data['qty_transaksi'] * $this->input->post('harga_produk');
                    $this->Transaksi->update($cekData[0]->id_transaksi, $data);
                } else {
                    $data['id_produk'] = $this->input->post('id_produk');
                    $data['id_user'] = $id;
                    $data['id_pembayaran'] = 1;
                    $data['tgl_transaksi'] = date('Y-m-d');
                    $data['qty_transaksi'] = $this->input->post('qty_transaksi');
                    $data['total_transaksi'] = $this->input->post('qty_transaksi') * $this->input->post('harga_produk');
                    $this->Transaksi->insert($data);
                }

                $this->session->set_flashdata('message', '<script>alert("Berhasil menambahkan produk ke keranjang");</script>');
                redirect(site_url('Main_Ctrl/keranjang'));
            }
        }
    }
    public function delete($id)
    {
        $row = $this->Transaksi->get_by_kode($id);
        $produk = $this->Produk->get_by_kode($row->id_produk);

        $qty = $row->qty_transaksi;
        $stok = $produk->stok_produk;
        $aktif = 1;

        $data = array(
            'aktif' => $aktif,
        );

        $dataBarang = array(
            'stok_produk' => $qty + $stok,
        );

        $this->Produk->update($row->id_produk, $dataBarang);

        if ($row) {
            $this->Transaksi->update($id, $data);
            $this->session->set_flashdata('message', 'Berhasil Menghapus Transaksi!');
            redirect(site_url('Main_Ctrl/keranjang'));
        } else {
            $this->session->set_flashdata('message', 'Data Tidak Ditemukan!');
            redirect(site_url('Transaksi_Ctrl'));
        }
    }

    public function batal_pesanan()
    {
        $id = $this->input->post('id_user', TRUE);
        $query = $this->Transaksi->get_by_userlimit($id);

        foreach ($query as $row) {
            $produk = $this->Produk->get_by_kode($row->id_produk);

            $qty = $row->qty_transaksi;
            $stok = $produk->stok_produk;
            $aktif = 1;

            $data = array(
                'aktif' => $aktif,
            );

            $dataBarang = array(
                'stok_produk' => $qty + $stok,
            );

            $this->Produk->update($row->id_produk, $dataBarang);
            $this->Transaksi->update($row->id_transaksi, $data);
        }
        $this->session->set_flashdata('message', 'Berhasil Menghapus Transaksi Limit!');
        redirect(site_url('Transaksi_Ctrl/limit'));
    }

    public function _rules()
    {
        $this->form_validation->set_rules('id_transaksi', 'Id Transaksi', 'trim');
        $this->form_validation->set_rules('nama_transaksi', 'Nama Transaksi', 'trim|required');
        $this->form_validation->set_rules('alamat_transaksi', 'Alamat Transaksi', 'trim|required');
        $this->form_validation->set_rules('telp_transaksi', 'Telp Transaksi', 'trim|required');
        $this->form_validation->set_message('required', 'wajib diisi');
        $this->form_validation->set_error_delimiters('<span class="text-danger"> * ', '</span>');
    }
}
