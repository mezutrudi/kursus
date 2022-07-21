<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {
	public function tampildata($table, $id){
		return $this->db->from($table)
					->order_by($id, 'DESC')
					->get('');
	}
	public function simpandata($table, $data){
		return $this->db->insert($table, $data);
	}
	public function formubahdata($table, $primary, $id){
		return $this->db->get_where($table, array($primary=>$id))->row();
	}
	public function ubahdata($table, $primary, $id, $data){
		return $this->db->where($primary, $id)
						->update($table, $data);
						
	}
    public function ubahnilai($nilai, $id){
        $this->db->set('nilai', $nilai);
        $this->db->where('id_nilai', $id);
        $this->db->update('nilai'); 
    }
	public function hapusdata($table, $id, $primary){
		return $this->db->delete($table, array($primary=>$id));
		
	}
    public function pesertakelas($id)
    {
        return $this->db->select('*')
                        ->from('kelaspeserta as kelpes')
                        ->where('kelpes.id_kelas',$id)
                        ->join('peserta as peserta','kelpes.id_peserta = peserta.id_peserta')
                        ->order_by('kelpes.id_kp', 'DESC')
                        ->get();       
    }
    public function materikelas($id)
    {
        return $this->db->select('*')
                        ->from('materi')
                        ->where('id_kelas',$id)
                        ->order_by('id_materi', 'DESC')
                        ->get();       
    }
	public function getdatauser($table, $primary, $id){
		return $this->db->get_where($table, array($primary=>$id))->row();
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
    public function nilaikelas($id)
    {
        return $this->db->select('*')
                        ->from('nilai as nilai')
                        ->where('nilai.id_kelas',$id)
                        ->join('peserta as peserta','nilai.id_peserta = peserta.id_peserta')
                        ->join('pengajar as pengajar','nilai.id_pengajar = pengajar.nip')
                        ->join('materi as materi','nilai.id_materi = materi.id_materi')
                        ->order_by('id_nilai', 'DESC')
                        ->get();       
    }
    public function admin()
    {
        return $this->db->select('*')
                        ->from('admin as admin')
                        ->join('users as users','admin.username = users.username')
                        ->order_by('id_admin', 'DESC')
                        ->get();       
    }
    public function kelaspengajar($nip){
        return $this->db->select('*')
                        ->from('kelas')
                        ->where('nip', $nip)
                        ->order_by('id_kelas', 'DESC')
                        ->get();
    }
    public function nilaipeserta($peserta)
    {
        return $this->db->select('*')
                        ->from('nilai as nilai')
                        ->where('nilai.id_peserta',$peserta)
                        ->join('pengajar as pengajar','nilai.id_pengajar = pengajar.nip')
                        ->join('materi as materi','nilai.id_materi = materi.id_materi')
                        ->order_by('id_nilai', 'DESC')
                        ->get();       
    }
    public function peserta()
    {
        return $this->db->select('*')
                        ->from('peserta as peserta')
                        ->join('users as users','peserta.username = users.username')
                        ->order_by('id_peserta', 'DESC')
                        ->get();       
    }
    public function pengajar()
    {
        return $this->db->select('*')
                        ->from('pengajar as pengajar')
                        ->join('users as users','pengajar.username = users.username')
                        ->order_by('nip', 'DESC')
                        ->get();       
    }
    public function resetpass($pass, $id){
        $this->db->set('password', $pass);
        $this->db->where('id_users', $id);
        $this->db->update('users'); 
    }

}

/* End of file Admin_model.php */
/* Location: ./application/models/Admin_model.php */