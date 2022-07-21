<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->model('admin_model');
	}

	public function index()
	{
		$username = $this->fungsi->user_login()->username;

		$judul['halaman'] = "Halaman Utama Administrator";
		$judul['menu'] = "Dashboard";
		$judul['awal'] = "Halaman Dashboard";
		$judul['pusat'] = "Dashboard";
		$judul['content'] = "admin/dashboard";
		if ($this->fungsi->user_login()->level == "1") {
			$judul['pengajar'] = $this->admin_model->getdatauser('pengajar', 'username', $username);
		} else if ($this->fungsi->user_login()->level == "2") {
			$judul['peserta'] = $this->admin_model->getdatauser('peserta', 'username', $username);
		}


		$this->load->view('template/wrapper', $judul, FALSE);
	}
}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */