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

    if(empty($check['id_user'])) return ['result' => 'Username tidak ditemukan.'];

    $check = $this->db->select('id_user')
                      ->from('user_login')
                      ->where('password', md5($this->input->post('old_password')))
                      ->get()
                      ->row_array();

    if(empty($check['id_user'])) return ['result' => 'Password lama tidak sesuai.'];

    $check = $this->db->select('tgl_lahir, telepon')
                      ->from('dosen')
                      ->where('email_dosen', $this->input->post('username'))
                      ->get()
                      ->row_array();

    if ($check['tgl_lahir'] != $this->input->post('tgl_lahir')) {
      return ['result' => 'Tanggal lahir tidak sesuai.'];
    }
    if ($check['telepon'] != $this->input->post('no_hp')) {
      return ['result' => 'No Handphone tidak sesuai.'];
    }

    $where = ['email' => $this->input->post('username')];
    $set   = ['password' => md5($this->input->post('new_password'))];
    
    $update = $this->db->update('user_login', $set, $where);

    if($update == true) {
			return ['result' => 'Data berhasil diubah'];
		} else { 
			return ['result' => 'Data gagal diubah'];
		}
	}
}
