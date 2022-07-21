<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengajar extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->model('admin_model');
	}

	public function index()
	{
		$judul['halaman']="Halaman Pengajar";
		$judul['menu']="Pengajar";
		$judul['awal']="Halaman Pengajar";
		$judul['pusat']="Master";
		$judul['content']="admin/pengajar";
		$judul['pengajar']=$this->admin_model->pengajar();

		$this->load->view('template/wrapper', $judul, FALSE);
	}

	public function tambah()
	{
		$data = array(
			'nip'=>$this->input->post('nip'),
			'nama_pengajar'=>$this->input->post('nama'),
			'alamat_pengajar'=>$this->input->post('alamat'),
			'no_hp'=>$this->input->post('no_hp'),
		);
		$data1 = array(
			'username'=>$this->input->post('username'),
			'password'=>sha1($this->input->post('password')),
			'level'=>$this->input->post('level'),
		);
		$this->admin_model->simpandata('users', $data1);
		$this->admin_model->simpandata('pengajar', $data);
	}
	public function ubah(){
		$data=array(
			'nama_pengajar'=>$this->input->post('nama'),
			'alamat_pengajar'=>$this->input->post('alamat'),
			'no_hp'=>$this->input->post('no_hp'),
		);
		$id = $this->input->post('nip');
		$this->admin_model->ubahdata('pengajar', 'nip', $id, $data);
	}
	public function hapus(){
		$nip = $this->input->get('nip');
		$uname = $this->input->get('uname');
		$result = $this->admin_model->hapusdata('pengajar', $nip, 'nip');
		$result = $this->admin_model->hapusdata('users', $uname, 'username');
		$msg['success'] = false;
		if($result){
			$msg['success'] = true;
		}
		echo json_encode($msg);
	}
	public function ubahPassword(){
		$id = $this->input->post('id');
		$pass = sha1($this->input->post('password'));
		$this->admin_model->resetpass($pass, $id);
	}

}

/* End of file Pengajar.php */
/* Location: ./application/controllers/Pengajar.php */