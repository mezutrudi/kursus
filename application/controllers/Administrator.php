<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Administrator extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->model('admin_model');
	}

	public function index()
	{
		$judul['halaman'] = "Halaman Administrator";
		$judul['menu'] = "Admin";
		$judul['awal'] = "Halaman Administrator";
		$judul['pusat'] = "Pengaturan";
		$judul['content'] = "admin/admin";
		$judul['admin'] = $this->admin_model->admin();

		$this->load->view('template/wrapper', $judul, FALSE);
	}

	public function tambah()
	{
		$nama = $this->input->post('nama');
		$nohp = $this->input->post('nohp');
		$uname = $this->input->post('username');
		$pass = sha1($this->input->post('password'));
		$level = $this->input->post('level');
		// $check = $this->db->get_where('users', array('username' => $uname), $limit, $offset);
		$data = array(
			'username' => $uname,
			'nama_admin' => $nama,
			'no_hp' => $nohp,
		);
		$data1 = array(
			'username' => $uname,
			'password' => $pass,
			'level' => $level,
		);
		$this->admin_model->simpandata('users', $data1);
		$this->admin_model->simpandata('admin', $data);
	}
	public function ubah()
	{
		$data = array(
			'username' => $this->input->post('username'),
			'nama_admin' => $this->input->post('nama'),
			'no_hp' => $this->input->post('nohp'),
		);
		$id = $this->input->post('id_admin');
		$this->admin_model->ubahdata('admin', 'id_admin', $id, $data);
	}
	public function hapus()
	{
		$id = $this->input->get('id_admin');
		$uname = $this->input->get('uname');
		$result = $this->admin_model->hapusdata('admin', $id, 'id_admin');
		$result = $this->admin_model->hapusdata('users', $uname, 'username');
		$msg['success'] = false;
		if ($result) {
			$msg['success'] = true;
		}
		echo json_encode($msg);
	}
	public function ubahPassword()
	{
		$id = $this->input->post('id');
		$pass = sha1($this->input->post('password'));
		$this->admin_model->resetpass($pass, $id);
	}
}

/* End of file Administrator.php */
/* Location: ./application/controllers/Administrator.php */