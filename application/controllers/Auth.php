<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_models');
	}

	public function index()
	{
		check_already_login();
		$judul['halaman'] = "Halaman Login";

		$this->load->view('login', $judul, FALSE);
	}
	public function process()
	{
		$post = $this->input->post(null, TRUE);
		if (isset($post['login'])) {
			$query = $this->user_models->login($post);
			if ($query->num_rows() > 0) {
				$row = $query->row();
				$param = array(
					'id_users'	=>	$row->id_users,
					'username'	=>	$row->username,
					'level'		=>	$row->level
				);
				$this->session->set_userdata($param);
				echo "<script>
					alert('Login Berhasil');
					window.location='" . base_url('home') . "';
				</script>";
			} else {
				echo "<script>
					alert('Login Gagal. Silahkan cek username dan password kembali');
					window.location='" . base_url('auth') . "';
				</script>";
			}
		} else {
			echo "Masukkan Username dan Password dengan Benar";
		}
	}
	public function logout()
	{
		$param = array('id_users', 'username', 'level');
		$this->session->unset_userdata($param);
		redirect('auth', 'refresh');
	}
}

/* End of file Auth.php */
/* Location: ./application/controllers/Auth.php */