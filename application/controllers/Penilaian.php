<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penilaian extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->model('admin_model');
	}
	public function index()
	{
		$nip = $this->fungsi->user_login()->nip;
		$judul = array(
			'halaman'	=> 'Halaman Penilaian',
			'menu'		=> 'Penilaian',
			'awal'		=> 'Halaman Penilaian',
			'pusat'		=> 'Penilaian',
			'content'	=> 'admin/penilaian',
			'kelas'		=> $this->admin_model->kelaspengajar($nip),
		);
		$this->load->view('template/wrapper', $judul, FALSE);
	}
	public function pesertakelas($id_kelas)
	{
		$judul['halaman']="Halaman Input Nilai";
		$judul['menu']="Penilaian";
		$judul['awal']="Halaman Input Nilai";
		$judul['pusat']="Penilaian";
		$judul['materi']=$this->admin_model->materikelas($id_kelas);
		$judul['peserta']=$this->admin_model->pesertakelas($id_kelas);
		$judul['content']="admin/pesertakelasnilai";
		$this->load->view('template/wrapper', $judul, FALSE);
	}
	public function add()
	{
		$pengajar = $this->fungsi->user_login()->nip;
		$peserta = $this->input->post('peserta');
		$materi = $this->input->post('materi');
		$nilai = $this->input->post('nilai');
		for ($i=0; $i < count($peserta); $i++) {
			$data[] = [
				'id_pengajar'	=>	$pengajar,
				'id_peserta'	=>	$peserta[$i],
				'id_materi'		=>	$materi,
				'nilai'			=>	$nilai[$i]
			];

		}
		$result = $this->db->insert_batch('nilai', $data);
		if ($result) {
			echo "<script>window.location='".base_url('Penilaian')."'</script>";
		}else{
			echo "error";
		}
	}
	public function materikelas($id_kelas)
	{
		$judul['halaman']="Halaman Materi Kelas";
		$judul['menu']="Materi Kelas";
		$judul['awal']="Halaman Materi Kelas";
		$judul['pusat']="Penilaian";
		$judul['materi']=$this->admin_model->materikelas($id_kelas);
		$judul['content']="admin/materikelas";
		$this->load->view('template/wrapper', $judul, FALSE);
	}
	public function lihatnilai()
	{
		$nip = $this->fungsi->user_login()->nip;
		$judul = array(
			'halaman'	=> 'Halaman Lihat Penilaian',
			'menu'		=> 'Lihat Nilai',
			'awal'		=> 'Halaman Lihat Penilaian',
			'pusat'		=> 'Penilaian',
			'content'	=> 'admin/lihatnilai',
			'kelas'		=> $this->admin_model->kelaspengajar($nip),
		);
		$this->load->view('template/wrapper', $judul, FALSE);
	}
	public function lihatnilaikelas($id)
	{
		$judul = array(
			'halaman'	=> 'Halaman Lihat Penilaian',
			'menu'		=> 'Lihat Nilai',
			'awal'		=> 'Halaman Lihat Penilaian',
			'pusat'		=> 'Penilaian',
			'content'	=> 'admin/lihatnilaikelas',
			'nilai'		=> $this->admin_model->nilaikelas($id),
		);
		$this->load->view('template/wrapper', $judul, FALSE);
	}

	public function tambahnilaikelas()
	{
		$data = array(
			'nip'=>$this->input->post('nip'),
			'nama_kelas'=>$this->input->post('nama_kelas'),
		);
		$this->admin_model->simpandata('kelas', $data);
	}
	public function ubahnilaikelas(){
		$id = $this->input->post('id_nilai');
		$nilai = $this->input->post('nilai');
		$this->admin_model->ubahnilai($nilai, $id);
	}
	public function hapusnilaikelas(){
		$id = $this->input->get('id_nilai');
		$result = $this->admin_model->hapusdata('nilai', $id, 'id_nilai');
		$msg['success'] = false;
		if($result){
			$msg['success'] = true;
		}
		echo json_encode($msg);
	}

}

/* End of file Penilaian.php */
/* Location: ./application/controllers/Penilaian.php */