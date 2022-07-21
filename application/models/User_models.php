<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_models extends CI_Model {

	public function login($post)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('username', $post['username']);
		$this->db->where('password', sha1($post['password']));
		$query =$this->db->get();
		return $query;
	}
	public function get($id = null)
	{
		$this->db->from('users');
		if ($id != null) {
			$this->db->where('id_users', $id);
		}
		$query = $this->db->get();
		return $query;
	}
    public function getpeserta($username)
    {
        return $this->db->select('*')
                        ->from('users as users')
                        ->where('users.username',$username)
                        ->join('peserta as peserta','users.username = peserta.username')
                        ->get();       
    }
    public function getpengajar($username)
    {
        return $this->db->select('*')
                        ->from('users as users')
                        ->where('users.username',$username)
                        ->join('pengajar as pengajar','users.username = pengajar.username')
                        ->get();       
    }

}

/* End of file User_models.php */
/* Location: ./application/models/User_models.php */