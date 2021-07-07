<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Produk_Ctrl extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Produk');
        $this->load->library('form_validation');
        $this->load->library('datatables');

        if (!$this->session->userdata('logined') || $this->session->userdata('logined') != true) {
            redirect('/');
        }
    }

    public function index()
    {
        $data['produk'] = $this->Produk->get_all();
        $this->load->view('produk/produk_list', $data);
    }
    public function catalog($jenis)
    {
        //$data['produk'] = $this->Produk->get_all();
        $data['produk'] = $this->Produk->get_all_jenis($jenis);
        $data['keterangan'] = "";
        $this->load->view('produk/produk_catalog', $data);
    }
    public function read($id)
    {
        $row = $this->Produk->get_by_kode($id);
        if ($row) {
            $data = array(
                'id_produk' => $row->id_produk,
                'nama_produk' => $row->nama_produk,
                'harga_beli' => $row->harga_beli,
                'harga_jual' => $row->harga_jual,
                'stok_produk' => $row->stok_produk,
                'kategori_produk' => $row->kategori_produk,
                'foto_produk' => $row->foto_produk,
                'rop' => $row->rop,
                'eoq' => $row->eoq,
            );
            $this->load->view('produk/produk_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Data Tidak Ditemukan!');
            redirect(site_url('Produk_Ctrl'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'create',
            'action' => site_url('Produk/create_action'),
            'id_produk' => set_value('id_produk'),
            'nama_produk' => set_value('nama_produk'),
            'harga_beli' => set_value('harga_beli'),
            'harga_jual' => set_value('harga_jual'),
            'stok_produk' => set_value('stok_produk'),
            'kategori_produk' => set_value('kategori_produk'),
            'foto_produk' => set_value('foto_produk'),
            'deskripsi_produk' => set_value('deskripsi_produk')
        );
        $this->load->view('produk/produk_form', $data);
    }

    public function create_action()
    {
        $this->_rules();
        $this->form_validation->run();

        $config['upload_path']          = './uploads/';
        $config['allowed_types']        = 'jpg|png';
        $config['max_size']             = 3048;
        $config['max_width']            = 5000;
        $config['max_height']           = 5000;

        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('foto_produk')) {
            $this->create();
        } else {
            $result = $this->upload->data();
            $data = array(
                'id_produk' => $this->input->post('id_produk', TRUE),
                'nama_produk' => $this->input->post('nama_produk', TRUE),
                'harga_beli' => $this->input->post('harga_beli', TRUE),
                'harga_jual' => $this->input->post('harga_jual', TRUE),
                'stok_produk' => $this->input->post('stok_produk', TRUE),
                'kategori_produk' => $this->input->post('kategori_produk', TRUE),
                'foto_produk' => $result['file_name'],
                'deskripsi_produk' => $this->input->post('deskripsi_produk', TRUE),

            );
        }

        $this->Produk->insert($data);
        $this->session->set_flashdata('message', 'Berhasil Menambahkan Produk!');
        redirect(site_url('Produk_Ctrl'));
    }

    public function update($id)
    {
        $row = $this->Produk->get_by_kode($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('Produk/update_action'),
                'id_produk' => set_value('id_produk', $row->id_produk),
                'nama_produk' => set_value('nama_produk', $row->nama_produk),
                'harga_beli' => set_value('harga_beli', $row->harga_beli),
                'harga_jual' => set_value('harga_jual', $row->harga_jual),
                'stok_produk' => set_value('stok_produk', $row->stok_produk),
                'kategori_produk' => set_value('kategori_produk', $row->kategori_produk),
                'foto_produk' => set_value('foto_produk', $row->foto_produk),
                'deskripsi_produk' => set_value('deskripsi_produk', $row->deskripsi_produk)

            );
            $this->load->view('produk/produk_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Data Tidak Ditemukan !');
            redirect(site_url('Produk_Ctrl'));
        }
    }

    public function update_action()
    {
        $this->_rules();
        $this->form_validation->run();

        $config['upload_path']          = './uploads/';
        $config['allowed_types']        = 'jpg|png';
        $config['max_size']             = 3048;
        $config['max_width']            = 5000;
        $config['max_height']           = 5000;

        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('foto_produk')) {
            $this->create();
        } else {
            $result = $this->upload->data();
            $data = array(
                'id_produk' => $this->input->post('id_produk', TRUE),
                'nama_produk' => $this->input->post('nama_produk', TRUE),
                'harga_beli' => $this->input->post('harga_beli', TRUE),
                'harga_jual' => $this->input->post('harga_jual', TRUE),
                'stok_produk' => $this->input->post('stok_produk', TRUE),
                'kategori_produk' => $this->input->post('kategori_produk', TRUE),
                'foto_produk' => $result['file_name'],
                'deskripsi_produk' => $this->input->post('deskripsi_produk', TRUE),

            );
        }

        $this->Produk->update($this->input->post('id_produk', TRUE), $data);
        $this->session->set_flashdata('message', 'Berhasil Memperbarui Produk !');
        redirect(site_url('Produk_Ctrl'));
    }


    public function delete($id)
    {
        $row = $this->Produk->get_by_kode($id);
        $aktif = 1;
        $data = array(
            'aktif' => $aktif,
        );

        if ($row) {
            $this->Produk->update($id, $data);
            $this->session->set_flashdata('message', 'Berhasil Menghapus Produk !');
            redirect(site_url('Produk_Ctrl'));
        } else {
            $this->session->set_flashdata('message', 'Data Tidak Ditemukan !');
            redirect(site_url('Produk_Ctrl'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('id_produk', 'Id Produk', 'trim');
        $this->form_validation->set_rules('nama_produk', 'Nama Produk', 'trim|required');
        $this->form_validation->set_message('required', 'wajib diisi');
        $this->form_validation->set_error_delimiters('<span class="text-danger"> * ', '</span>');
    }
}
