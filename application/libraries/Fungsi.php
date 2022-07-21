<?php

class Fungsi
{

	protected $ci;

	function __construct()
	{
		$this->ci = &get_instance();
	}

	function user_login()
	{
		$this->ci->load->model('user_models');
		if ($this->ci->session->userdata('level') == "1") {
			$username = $this->ci->session->userdata('username');
			$user_data = $this->ci->user_models->getpengajar($username)->row();
			return $user_data;
		} elseif ($this->ci->session->userdata('level') == "2") {
			$username = $this->ci->session->userdata('username');
			$user_data = $this->ci->user_models->getpeserta($username)->row();
			return $user_data;
		} elseif ($this->ci->session->userdata('level') == "0") {
			$id_users = $this->ci->session->userdata('id_users');
			$user_data = $this->ci->user_models->get($id_users)->row();
			return $user_data;
		}
	}

	function PdfGenerator($html, $filename, $rotasi)
	{

		$dompdf = new Dompdf\Dompdf();
		$dompdf->loadHtml($html);
		$dompdf->setPaper('A4', $rotasi);
		$dompdf->render();
		$dompdf->stream($filename, array('Attachment'	=>	0));
	}
}
