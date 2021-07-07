<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User_Ctrl extends CI_Controller
{
   	function __construct(){
		parent::__construct();		
		$this->load->model('User');
        $this->load->library('form_validation');
 		
        if(!$this->session->userdata('logined') || $this->session->userdata('logined') != true)
        {
            //redirect('/');
        } 
	}
 
	public function index(){
		$data['user'] = $this->User->get_all();
        $this->load->view('user/user_list',$data);
	}

	public function change(){
		$this->load->view('user/user_password');
	}

	public function create() 
    {
        $data = array(
            'button' => 'create',
            'action' => site_url('User/create_action'),
            'id_user'=> set_value('id_user'),
            'nama_user'=> set_value('nama_user'),
            'email_user' => set_value('email_user'),
            'telp_user' => set_value('telp_user'),
            'alamat_user' => set_value('alamat_user'),
            'provinsi_user' => set_value('provinsi_user'),
            'kota_user' => set_value('kota_user'),
            'kode_pos' => set_value('kode_pos'),
            'password_user' => set_value('password_user')
		);
        $this->load->view('user/user_form', $data);
    }
	
	public function create_action()
    {
        $this->_rules();
        $this->form_validation->run();
		$email = $this->input->post('email_user');
		$cek = $this->User->cek_email($email)->num_rows();
		if($cek > 0){
			$row = $this->User->get_by_email($email);
			if($row->level_user != 1){
                $this->session->set_flashdata('message', '<script>alert("Registrasi Gagal! Email sudah terdaftar");</script>');
                redirect(site_url('Main_Ctrl/login'));
            }else{
                $this->session->set_flashdata('message', 'Email sudah terdaftar!');
                redirect(site_url('User_Ctrl'));
            }
		}else{
            $data = array(
    		'id_user' => $this->input->post('id_user',TRUE),
            'nama_user'=>$this->input->post('nama_user',TRUE),
            'email_user' => $this->input->post('email_user',TRUE),
            'telp_user' => $this->input->post('telp_user',TRUE),
            'alamat_user' => $this->input->post('alamat_user',TRUE),
            'provinsi_user' => $this->input->post('provinsi_user',TRUE),
            'kota_user' => $this->input->post('kota_user',TRUE),
            'kode_pos' => $this->input->post('kode_pos',TRUE),
            'password_user' => md5($this->input->post('password_user',TRUE))
			);
			
            $this->User->insert($data);
            $level = $this->session->userdata('level');
            if($level != 1){
                $this->session->set_flashdata('message', '<script>alert("Registrasi Berhasil! Silahkan login terlebih dahulu");</script>');
                redirect(site_url('Main_Ctrl/login'));
            }else{
                $this->session->set_flashdata('message', 'Berhasil Menambahkan User!');
                redirect(site_url('User_Ctrl'));
            }
		}
    }
	
	public function update($id) 
    {
        $row = $this->User->get_by_kode($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('User/update_action'),
        		'id_user' => set_value('id_user', $row->id_user),
        		'nama_user'=>set_value('nama_user', $row->nama_user),
                'email_user' => set_value('email_user', $row->email_user),
                'telp_user' => set_value('telp_user', $row->telp_user),
                'alamat_user' => set_value('alamat_user', $row->alamat_user),
                'provinsi_user' => set_value('provinsi_user', $row->provinsi_user),
                'kota_user' => set_value('kota_user', $row->kota_user),
                'kode_pos' => set_value('kode_pos', $row->kode_pos),
                'password_user' => set_value('password_user', md5($row->password_user))
	        );
            $this->load->view('user/user_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Data Tidak Ditemukan!');
            redirect(site_url('User_Ctrl'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();
        $this->form_validation->run();

            $data = array(
    		'id_user' => $this->input->post('id_user',TRUE),
            'nama_user'=>$this->input->post('nama_user',TRUE),
            'email_user' => $this->input->post('email_user',TRUE),
            'telp_user' => $this->input->post('telp_user',TRUE),
            'alamat_user' => $this->input->post('alamat_user',TRUE),
            'provinsi_user' => $this->input->post('provinsi_user',TRUE),
            'kota_user' => $this->input->post('kota_user',TRUE),
            'kode_pos' => $this->input->post('kode_pos',TRUE),
            'password_user' => md5($this->input->post('password_user',TRUE))
			);

            $this->User->update($this->input->post('id_user', TRUE), $data);
            $this->session->set_flashdata('message', 'Berhasil Memperbarui User!');
            redirect(site_url('User_Ctrl'));
    }
    
    public function delete($id) 
    {
		$row = $this->User->get_by_kode($id);
        $aktif=1;
        $data=array(
            'aktif' => $aktif,
        );
		
        if ($row) {
            $this->User->update($id,$data);
            $this->session->set_flashdata('message', 'Berhasil Menghapus User!');
            redirect(site_url('User_Ctrl'));
        } else {
            $this->session->set_flashdata('message', 'Data Tidak Ditemukan!');
            redirect(site_url('User_Ctrl'));
        }
    }
    
 
	public function change_password() {
		$this->_rules();
		$password = $this->input->post('password_user',TRUE);
		$password2 = $this->input->post('password_user2',TRUE);
		$kode=$this->session->userdata('kode');
		
		if($password == $password2){
			$data=array(
				'aktif' => 0,
				'password_user' => md5($password),
			);

			$this->User->update($kode, $data);
            $data['error'] = '<script language="javascript">alert("Berhasil perbarui password! Silahkan login kembali") </script>';
			$this->load->view('user/login', $data);
		}else{
			$data['error'] = '<script language="javascript">alert("Password tidak sama!") </script>';
			$this->load->view('user/change_password', $data);
		}
    }

    public function _rules(){
    	$this->form_validation->set_rules('pw_baru', 'Password baru', 'required');
		$this->form_validation->set_rules('cpw_baru', 'Konfirmasi password', 'required|matches[pw_baru]');
		$this->form_validation->set_message('required', 'wajib diisi');
		$this->form_validation->set_message('matches', '%s tidak sama');
		$this->form_validation->set_error_delimiters('<span class="text-danger"> * ', '</span>');
    }
}