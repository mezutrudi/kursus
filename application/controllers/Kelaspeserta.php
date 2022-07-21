<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelaspeserta extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->model('admin_model');
	}
	public function index()
	{
		$judul = array(
			'halaman'	=> 'Halaman Kelas Peserta',
			'menu'		=> 'Kelas Peserta',
			'awal'		=> 'Halaman Kelas Peserta',
			'pusat'		=> 'Penugasan',
			'content'	=> 'admin/kelaspeserta',
			'kelas'		=> $this->admin_model->tampildata('kelas', 'id_kelas'),
		);
		$this->load->view('template/wrapper', $judul, FALSE);
	}
	public function pesertakelas($id_kelas)
	{
		$judul['halaman']="Halaman Kelas Peserta";
		$judul['menu']="Kelas Peserta";
		$judul['awal']="Halaman Kelas Peserta";
		$judul['pusat']="Penugasan";
		$judul['peserta']=$this->admin_model->pesertakelas($id_kelas);
		$judul['content']="admin/pesertakelas";
		$this->load->view('template/wrapper', $judul, FALSE);
	}
	public function tpeskel()
	{
		$data = $this->admin_model->tampildata('kelas', 'id_kelas');
		$kelas[null]= '--Pilih Kelas--';
		foreach($data->result() as $kls){
			$kelas[$kls->id_kelas] = $kls->nama_kelas;
		};
		$judul = array(
			'halaman'	=> 'Halaman Form Set Kelas Peserta',
			'menu'		=> 'Kelas Peserta',
			'awal'		=> 'Form Setting Kelas Peserta',
			'pusat'		=> 'Penugasan',
			'content'	=> 'admin/formpesertakelas',
			'kelas'		=> $kelas, 'selectedkelas' => null,
			'peserta'	=> $this->admin_model->tampildata('peserta', 'id_peserta')->result(),

		);
		$this->load->view('template/wrapper', $judul, FALSE);	
	}
  	public function simpanpeskel()
  	{
		$kelas_id = $this->input->post('id_kelas');
		$peserta = count($this->input->post('id_peserta'));
	    for ($i = 0; $i < $peserta; $i++) {
	    	$datas[$i] = array(
	    		'id_kelas' => $kelas_id,
	    		'id_peserta' => $this->input->post('id_peserta[' . $i . ']')
	        );
	        $this->db->insert('kelaspeserta', $datas[$i]);
	      }
	      redirect('kelaspeserta');
	}
	public function hapus(){
		$id = $this->input->get('id_kp');
		$result = $this->admin_model->hapusdata('kelaspeserta', $id, 'id_kp');
		$msg['success'] = false;
		if($result){
			$msg['success'] = true;
		}
		echo json_encode($msg);
	}

}

/* End of file Kelaspeserta.php */
/* Location: ./application/controllers/Kelaspeserta.php */