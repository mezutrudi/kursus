<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nilaipeserta extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->model('admin_model');
	}
	public function index()
	{
		$peserta = $this->fungsi->user_login()->id_peserta;
		$judul = array(
			'halaman'	=> 'Halaman Peserta',
			'menu'		=> 'HPeserta',
			'awal'		=> 'Halaman Peserta',
			'pusat'		=> 'HPeserta',
			'content'	=> 'peserta/nilaipeserta',
			'nilai'		=> $this->admin_model->nilaipeserta($peserta),
		);
		$this->load->view('template/wrapper', $judul, FALSE);
	}
	public function cetak()
	{
		$peserta = $this->fungsi->user_login()->id_peserta;
		$judul['nilai']= $this->admin_model->nilaipeserta($peserta);
		$html = $this->load->view('peserta/cetak', $judul, true);
		$this->fungsi->PdfGenerator($html, 'Nilai Peserta', 'portrait');
	}

}

/* End of file Nilaipeserta.php */
/* Location: ./application/controllers/Nilaipeserta.php */