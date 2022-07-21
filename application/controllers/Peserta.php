<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Peserta extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->model('admin_model');
	}

	public function index()
	{
		$judul['halaman']="Halaman Peserta";
		$judul['menu']="Peserta";
		$judul['awal']="Halaman Peserta";
		$judul['pusat']="Master";
		$judul['content']="admin/peserta";
		$judul['peserta']=$this->admin_model->peserta();

		$this->load->view('template/wrapper', $judul, FALSE);
	}

	public function tambah()
	{
		$data = array(
			'username'=>$this->input->post('username'),
			'nama_peserta'=>$this->input->post('nama'),
			'alamat'=>$this->input->post('alamat'),
			'nohp'=>$this->input->post('nohp'),
		);
		$data1 = array(
			'username'=>$this->input->post('username'),
			'password'=>sha1($this->input->post('password')),
			'level'=>$this->input->post('level'),
		);
		$this->admin_model->simpandata('users', $data1);
		$this->admin_model->simpandata('peserta', $data);
	}
	public function ubah(){
		$data=array(
			'nama_peserta'=>$this->input->post('nama'),
			'alamat'=>$this->input->post('alamat'),
			'nohp'=>$this->input->post('nohp'),
		);
		$id = $this->input->post('id_peserta');
		$this->admin_model->ubahdata('peserta', 'id_peserta', $id, $data);
	}
	public function hapus(){
		$id = $this->input->get('id_peserta');
		$uname = $this->input->get('uname');
		$result = $this->admin_model->hapusdata('peserta', $id, 'id_peserta');
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
	// public function formtpeserta()
	// {
	// 	$judul['halaman']="Halaman Tambah Peserta";
	// 	$judul['menu']="Peserta";
	// 	$judul['awal']="Halaman Tambah Peserta";
	// 	$judul['pusat']="Master";
	// 	$judul['content']="admin/formtpeserta";

	// 	$this->load->view('template/wrapper', $judul, FALSE);
	// }
	// public function simpan()
	// {
	// 	$data = array(
	// 		'nama_peserta'=>$this->input->post('nama'),
	// 		'alamat'=>$this->input->post('alamat'),
	// 		'nohp'=>$this->input->post('nohp')
	// 	);
	// 	$this->admin_model->simpandata('peserta', $data);
	// 	redirect('Peserta','refresh');

	// }
	// public function formupeserta($id)
	// {
	// 	$judul['halaman']="Halaman Tambah Peserta";
	// 	$judul['menu']="Peserta";
	// 	$judul['awal']="Halaman Tambah Peserta";
	// 	$judul['pusat']="Master";
	// 	$judul['content']="admin/formupeserta";
	// 	$judul['peserta']=$this->admin_model->formubahdata('peserta', 'id_peserta', $id);

	// 	$this->load->view('template/wrapper', $judul, FALSE);
	// }
	// public function ubah()
	// {
	// 	$data = array(
	// 		'nama_peserta'=>$this->input->post('nama'),
	// 		'alamat'=>$this->input->post('alamat'),
	// 		'nohp'=>$this->input->post('nohp')
	// 	);
	// 	$id = $this->input->post('id');
	// 	$this->admin_model->ubahdata('peserta', 'id_peserta', $id, $data);
	// 	redirect('Peserta','refresh');

	// }
	// public function hapus($id)
	// {
	// 	$this->admin_model->hapusdata('peserta', $id, 'id_peserta');
	// 	redirect('Peserta','refresh');

	// }


}

/* End of file Peserta.php */
/* Location: ./application/controllers/Peserta.php */