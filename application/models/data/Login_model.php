<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

	function __construct() {
	    parent::__construct();
	}

	public function index(){	
    $get = $this->db->select('b.id_dosen, b.nama_dosen, b.email_dosen, b.foto')
                    ->from('user_login a')
                    ->join('dosen b', 'a.email = b.email_dosen')
                    ->where('email', $this->input->post('username'))
                    ->where('password', md5($this->input->post('password')))
                    ->get()
                    ->row_array();

    if(!empty($get['id_dosen']))
      return ['result'  => $get];
    else
      return ['result' => ['error' => 'Username atau Password salah.']];
	}

	public function change_password(){
    $check = $this->db->select('id_user')
                      ->from('user_login')
                      ->where('email', $this->input->post('username'))
                      ->get()
                      ->row_array();

    if(empty($check['id_user'])) return ['result' => ['message' => 'Username tidak ditemukan.']];

    $check = $this->db->select('id_user')
                      ->from('user_login')
                      ->where('password', md5($this->input->post('old_password')))
                      ->get()
                      ->row_array();

    if(empty($check['id_user'])) return ['result' => ['message' => 'Password lama tidak sesuai.']];

    $where = ['email' => $this->input->post('username')];
    $set   = ['password' => md5($this->input->post('new_password'))];
    
    $update = $this->db->update('user_login', $set, $where);

    if($update == true) {
			return ['result' => ['message' => 'Data berhasil diubah']];
		} else { 
			return ['result' => ['message' => 'Data gagal diubah']];
		}
	}

  public function forgot_password(){
    $check = $this->db->select('tgl_lahir, telepon')
                      ->from('dosen')
                      ->where('email_dosen', $this->input->post('username'))
                      ->get()
                      ->row_array();

    if ($check['tgl_lahir'] != $this->input->post('tgl_lahir')) {
      return ['result' => ['message' => 'Tanggal lahir tidak sesuai.']];
    }
    else if ($check['telepon'] != $this->input->post('no_hp')) {
      return ['result' => ['message' => 'No Handphone tidak sesuai.']];
    }
    else {
      $where = ['email' => $this->input->post('username')];
      $set   = ['password' => md5(preg_replace('/\//','',$check['tgl_lahir']))];
      
      $update = $this->db->update('user_login', $set, $where);
      if($update == true) {
        return ['result' => ['message' => 'Data berhasil diubah']];
      } else { 
        return ['result' => ['message' => 'Data gagal diubah']];
      }
    }
  }
}
