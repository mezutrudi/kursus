<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Materi extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->model('admin_model');
	}
	public function index()
	{
		$judul = array(
			'halaman'	=> 'Halaman Materi',
			'menu'		=> 'Materi',
			'awal'		=> 'Halaman Materi',
			'pusat'		=> 'Master',
			'content'	=> 'admin/materi',
			'pengajar'	=> $this->admin_model->tampildata('pengajar', 'nip'),
			'kelas'		=> $this->admin_model->tampildata('kelas', 'id_kelas'),
			'materi'	=> $this->admin_model->tampildata('materi', 'id_materi'),
		);
		$this->load->view('template/wrapper', $judul, FALSE);
	}

	public function tambah()
	{
		$data = array(
			'nip'=>$this->input->post('nip'),
			'id_kelas'=>$this->input->post('id_kelas'),
			'nama_materi'=>$this->input->post('nama_materi'),
		);
		$this->admin_model->simpandata('materi', $data);
	}
	public function ubah(){
		$data=array(
			'nip'=>$this->input->post('nip'),
			'id_kelas'=>$this->input->post('id_kelas'),
			'nama_materi'=>$this->input->post('nama_materi'),
		);
		$id = $this->input->post('id_materi');
		$this->admin_model->ubahdata('materi', 'id_materi', $id, $data);
	}
	public function hapus(){
		$id = $this->input->get('id');
		$result = $this->admin_model->hapusdata('materi', $id, 'id_materi');
		$msg['success'] = false;
		if($result){
			$msg['success'] = true;
		}
		echo json_encode($msg);
	}

}

/* End of file Materi.php */
/* Location: ./application/controllers/Materi.php */