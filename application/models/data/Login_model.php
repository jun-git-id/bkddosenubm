<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

	function __construct() {
	    parent::__construct();
	}

	public function index(){	
    $get = $this->db->select('b.id_dosen, b.foto')
                    ->from('user_login a')
                    ->join('dosen b', 'a.email = b.email_dosen')
                    ->where('email', $this->input->post('username'))
                    ->where('password', md5($this->input->post('password')))
                    ->get()
                    ->row_array();

    if(!empty($get['id_dosen']))
      return ['result'  => [$get]];
    else
      return ['error' => 'Username atau Password salah.'];
	}

	public function change_password(){
    $check = $this->db->select('id_user')
                      ->from('user_login')
                      ->where('email', $this->input->post('username'))
                      ->get()
                      ->row_array();

    if(empty($check['id_user'])) return ['error' => 'Username tidak ditemukan.'];

    $check = $this->db->select('id_user')
                      ->from('user_login')
                      ->where('password', md5($this->input->post('old_password')))
                      ->get()
                      ->row_array();

    if(empty($check['id_user'])) return ['error' => 'Password lama tidak sesuai.'];

    $where = ['email' => $this->input->post('username')];
    $set   = ['password' => md5($this->input->post('new_password'))];
    
    $update = $this->db->update('user_login', $set, $where);

    if($update == true) {
			return array('success' => 'Data berhasil diubah');
		} else { 
			return array('error' => 'Data gagal diubah');
		}
	}
}
