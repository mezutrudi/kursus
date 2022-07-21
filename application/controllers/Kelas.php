<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelas extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->model('admin_model');
	}
	public function index()
	{
		$judul = array(
			'halaman'	=> 'Halaman Kelas',
			'menu'		=> 'Kelas',
			'awal'		=> 'Halaman Kelas',
			'pusat'		=> 'Master',
			'content'	=> 'admin/kelas',
			'pengajar'	=> $this->admin_model->tampildata('pengajar', 'nip'),
			'kelas'		=> $this->admin_model->tampildata('kelas', 'id_kelas'),
		);
		$this->load->view('template/wrapper', $judul, FALSE);
	}

	public function tambah()
	{
		$data = array(
			'nip'=>$this->input->post('nip'),
			'nama_kelas'=>$this->input->post('nama_kelas'),
		);
		$this->admin_model->simpandata('kelas', $data);
	}
	public function ubah(){
		$data=array(
			'nip'=>$this->input->post('nip'),
			'nama_kelas'=>$this->input->post('nama_kelas'),
		);
		$id = $this->input->post('id_kelas');
		$this->admin_model->ubahdata('kelas', 'id_kelas', $id, $data);
	}
	public function hapus(){
		$id = $this->input->get('id');
		$result = $this->admin_model->hapusdata('kelas', $id, 'id_kelas');
		$msg['success'] = false;
		if($result){
			$msg['success'] = true;
		}
		echo json_encode($msg);
	}

}

/* End of file Kelas.php */
/* Location: ./application/controllers/Kelas.php */