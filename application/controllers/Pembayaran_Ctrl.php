<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pembayaran_Ctrl extends CI_Controller
{
    function __construct(){
        parent::__construct();
        $this->load->model('Pembayaran');
        $this->load->library('form_validation');
        $this->load->library('datatables');

        if(!$this->session->userdata('logined') || $this->session->userdata('logined') != true)
        {
            redirect('/');
        }        
    }

    public function index()
    {
        $data['pembayaran'] = $this->Pembayaran->get_all();
        $this->load->view('pembayaran/pembayaran_list',$data);
    } 
    
    public function read($id) 
    {
        $row = $this->Pembayaran->get_by_kode($id);
        if ($row) {
            $data = array(
		'id_pembayaran' => $row->id_pembayaran,
		'total_pembayaran' => $row->total_pembayaran,
		'bukti_pembayaran' => $row->bukti_pembayaran,
		'nomor_resi' => $row->nomor_resi,
		'kurir_pengiriman' => $row->kurir_pengiriman,
		'tgl_pembayaran' => $row->tgl_pembayaran,
		'status_pembayaran' => $row->status_pembayaran
	    );
            $this->load->view('pembayaran/pembayaran_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Data Tidak Ditemukan!');
            redirect(site_url('Pembayaran_Ctrl'));
        }
    }

	public function create() 
    {
        $data = array(
            'button' => 'create',
            'action' => site_url('Pembayaran/create_action'),
            'id_pembayaran'=>set_value('id_pembayaran'),
	        'total_pembayaran' => set_value('total_pembayaran'),
            'bukti_pembayaran' => set_value('bukti_pembayaran'),
            'nomor_resi' => set_value('nomor_resi'),
            'kurir_pengiriman' => set_value('kurir_pengiriman'),
            'tgl_pembayaran' => set_value('tgl_pembayaran'),
            'status_pembayaran' => set_value('status_pembayaran')
	    );
        $this->load->view('pembayaran/pembayaran_form', $data);
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
        if (!$this->upload->do_upload('bukti_pembayaran')) {
            $this->create();
        } else {
            $result=$this->upload->data();
            $data = array(
    		'id_pembayaran' => $this->input->post('id_pembayaran',TRUE),
    		'total_pembayaran' => $this->input->post('total_pembayaran',TRUE),
    		'bukti_pembayaran' => $result['file_name'],
    		'nomor_resi' => $this->input->post('nomor_resi',TRUE),
    		'kurir_pengiriman' => $this->input->post('kurir_pengiriman',TRUE),
    		'tgl_pembayaran' => $this->input->post('tgl_pembayaran',TRUE),
    		'status_pembayaran' => $this->input->post('status_pembayaran',TRUE)
			);
		}

            $this->Pembayaran->insert($data);
            $this->session->set_flashdata('message', 'Berhasil Menambahkan Pembayaran!');
            redirect(site_url('Pembayaran_Ctrl'));
    }

    public function update($id) 
    {
        $row = $this->Pembayaran->get_by_kode($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('Pembayaran/update_action'),
        		'id_pembayaran' => set_value('id_pembayaran', $row->id_pembayaran),
        		'total_pembayaran' => set_value('total_pembayaran', $row->total_pembayaran),
                'bukti_pembayaran' => set_value('bukti_pembayaran', $row->bukti_pembayaran),
                'nomor_resi' => set_value('nomor_resi', $row->nomor_resi),
                'kurir_pengiriman' => set_value('kurir_pengiriman', $row->kurir_pengiriman),
                'tgl_pembayaran' => set_value('tgl_pembayaran', $row->tgl_pembayaran),
                'status_pembayaran' => set_value('status_pembayaran', $row->status_pembayaran)
	    );
            $this->load->view('pembayaran/pembayaran_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Data Tidak Ditemukan !');
            redirect(site_url('Pembayaran_Ctrl'));
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
        if (!$this->upload->do_upload('bukti_pembayaran')) {
            $this->create();
        } else {
            $result=$this->upload->data();
            $data = array(
            'id_pembayaran' => $this->input->post('id_pembayaran',TRUE),
            'total_pembayaran' => $this->input->post('total_pembayaran',TRUE),
    		'bukti_pembayaran' => $result['file_name'],
    		'nomor_resi' => $this->input->post('nomor_resi',TRUE),
    		'kurir_pengiriman' => $this->input->post('kurir_pengiriman',TRUE),
    		'tgl_pembayaran' => $this->input->post('tgl_pembayaran',TRUE),
    		'status_pembayaran' => $this->input->post('status_pembayaran',TRUE)
			);
		}

            $this->Pembayaran->update($this->input->post('id_pembayaran', TRUE), $data);
            $this->session->set_flashdata('message', 'Berhasil Memperbarui Pembayaran !');
            redirect(site_url('Pembayaran_Ctrl'));
    }
	
	
    public function delete($id) 
    {
        $row = $this->Pembayaran->get_by_kode($id);
        $aktif=1;
        $data=array(
            'aktif' => $aktif,
        );

        if ($row) {
            $this->Pembayaran->update($id, $data);
            $this->session->set_flashdata('message', 'Berhasil Menghapus Pembayaran !');
            redirect(site_url('Pembayaran_Ctrl'));
        } else {
            $this->session->set_flashdata('message', 'Data Tidak Ditemukan !');
            redirect(site_url('Pembayaran_Ctrl'));
        }
    }
	
    public function _rules() 
    {
    	$this->form_validation->set_rules('id_pembayaran', 'Id Pembayaran', 'trim');
        $this->form_validation->set_message('required', 'wajib diisi');
    	$this->form_validation->set_error_delimiters('<span class="text-danger"> * ', '</span>');
    }
}
