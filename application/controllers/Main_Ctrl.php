<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Main_Ctrl extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('User');
		$this->load->model('Produk');
		$this->load->model('Transaksi');
		$this->load->model('Pembayaran');
	}

	public function index()
	{
		$data['produk'] = $this->Produk->get_all();

		$this->load->view('produk/produk_catalog', $data);
	}

	public function produk()
	{
		$data['produk'] = $this->Produk->get_all();

		$this->load->view('produk/produk_daftar', $data);
	}

	public function detailProduk($id_produk = '')
	{
		# code...
		$data['produk']	= $this->Produk->get_all();
		$data['getProdukById']	= $this->Produk->getDetailProduk($id_produk);

		$this->load->view('produk/produk_detail', $data);
	}

	public function login()
	{
		$this->load->view('user/login');
	}

	public function register()
	{
		$this->load->view('user/register');
	}

	public function getProdukById($id)
	{
		$data       = $this->Produk->getById($id);
		echo json_encode(array('data' => $data));
		die;
	}

	public function forgetpassword()
	{
		$this->load->view('user/forget_password');
	}

	public function about()
	{
		$this->load->view('produk/produk_about');
	}

	public function keranjang()
	{
		$id = $this->session->userdata('kode');
		if ($id == '') {
			$this->session->set_flashdata('message', '<script>alert("Silahkan login terlebih dahulu");</script>');
			redirect(site_url('Main_Ctrl/login'));
		} else {
			$data['produk'] = $this->Produk->get_keranjang($id);
			$data['total'] = $this->Produk->get_total($id);
			$this->load->view('produk/produk_keranjang', $data);
		}
	}

	public function history()
	{
		$id = $this->session->userdata('kode');
		if ($id == '') {
			$this->session->set_flashdata('message', '<script>alert("Silahkan login terlebih dahulu");</script>');
			redirect(site_url('Main_Ctrl/login'));
		} else {
			$data['history'] = $this->Transaksi->get_history($id);
			$this->load->view('produk/produk_history', $data);
		}
	}

	public function addComments()
	{
		$id = $this->input->post('id_transaksi');
		$comment = $this->input->post('komentar');
		if ($comment == '') {
			$this->session->set_flashdata('kosong', 'Komentar Tidak boleh kosong !');
			redirect('Main_Ctrl/history');
		} else if ($comment == 'pantek') {
			$this->session->set_flashdata('kosong', 'Komentar Anda kasar !');
			redirect('Main_Ctrl/history');
		} else if ($comment == 'babi kau') {
			$this->session->set_flashdata('kosong', 'Komentar Anda kasar !');
			redirect('Main_Ctrl/history');
		} else if ($comment == 'anjing kau') {
			$this->session->set_flashdata('kosong', 'Komentar Anda kasar !');
			redirect('Main_Ctrl/history');
		} else if ($comment == 'Bangsat kau') {
			$this->session->set_flashdata('kosong', 'Komentar Anda kasar !');
			redirect('Main_Ctrl/history');
		} else {
			$this->Transaksi->addComment($id, $comment);
			$this->session->set_flashdata('success', 'Berhasil !');
			redirect('Main_Ctrl/history');
		}
	}

	public function getTransaksiById($id)
	{
		$data       = $this->Transaksi->getDataById($id);
		echo json_encode(array('data' => $data));
		die;
	}

	public function kategori_produk($produk)
	{
		$data['produk'] = $this->Produk->get_by_kategoriProduk($produk);
		$this->load->view('produk/produk_catalog', $data);
	}

	public function kategori_mobil($produk)
	{
		$data['produk'] = $this->Produk->get_by_kategoriMobil($produk);
		$this->load->view('produk/produk_catalog', $data);
	}

	public function pencarian()
	{
		$cari = $this->input->post('cari');
		$data['produk'] = $this->Produk->get_by_namaProduk($cari);
		$this->load->view('produk/produk_catalog', $data);
	}

	public function catalog()
	{
		$this->load->view('produk/produk_catalog');
	}

	public function change_password()
	{
		$this->load->view('user/change_password');
	}

	public function aksi_login()
	{
		$email = $this->input->post('email_user');
		$password = $this->input->post('password_user');
		$where = array(
			'email_user' => $email,
			'password_user' => md5($password),
			'aktif' => 0
		);
		$cek = $this->User->cek_login("tbl_user", $where)->num_rows();
		if ($cek > 0) {

			$row = $this->User->get_by_email($email);

			$data_session = array(
				'kode' => $row->id_user,
				'email' => $email,
				'nama' => $row->nama_user,
				'level' => $row->level_user,
				'logined' => true
			);

			$this->session->set_userdata($data_session);
			if ($row->aktif == 0) {
				if ($row->level_user == 0) {
					redirect(base_url("Main_Ctrl"));
				} elseif ($row->level_user == 1) {
					redirect(base_url("Produk_Ctrl"));
				}
			} else if ($row->aktif == 2) {
				redirect(base_url("Main_Ctrl/change_password"));
			} else {
				$data['error'] = '<script language="javascript">alert("Email anda dinonaktifkan oleh admin!") </script>';
				$this->load->view('user/login', $data);
			}
		} else {
			$data['error'] = '<script language="javascript">alert("Email atau password salah!") </script>';
			$this->load->view('user/login', $data);
		}
	}

	public function aksi_resetPassword()
	{
		$email = $this->input->post('email_user');
		$cek = $this->User->cek_email($email)->num_rows();
		$password = 'cre4t1ve4ud10';
		if ($cek > 0) {
			$row = $this->User->get_by_email($email);
			$data = array(
				'aktif' => 2,
				'password_user' => md5($password),
			);
			$this->User->update($row->id_user, $data);

			$this->sendEmail($email, 'Reset Password Creative Audio', 'Silahkan login ke aplikasi menggunakan password berikut <b>cr34t1ve4ud1o</b>');
			$data['error'] = '<script language="javascript">alert("Silahkan cek email anda!") </script>';
			$this->load->view('user/login', $data);
		} else {
			$data['error'] = '<script language="javascript">alert("Email tidak terdaftar!") </script>';
			$this->load->view('user/login', $data);
		}
	}

	function sendEmail($email, $subject, $message)
	{
		// Konfigurasi email
		$config = [
			'mailtype'  => 'html',
			'charset'   => 'utf-8',
			'protocol'  => 'smtp',
			'smtp_host' => 'smtp.gmail.com',
			'smtp_user' => 'satria.novrianto@gmail.com',  // Email gmail
			'smtp_pass'   => '54tr14dh4rm4',  // Password gmail
			'smtp_crypto' => 'ssl',
			'smtp_port'   => 465,
			'crlf'    => "\r\n",
			'newline' => "\r\n"
		];

		//https://masrud.com/post/kirim-email-dengan-smtp-gmail

		$this->load->library('email', $config);
		$this->email->from('no-reply@creativeaudio.com', 'Creative Audio Pekanbaru');
		$this->email->subject($subject);
		$this->email->message($message);
		$this->email->to($email);
		$this->email->send();
	}
	
	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url('Main_Ctrl'));
	}
}
