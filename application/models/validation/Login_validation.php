<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_validation extends CI_Model {

	function __construct() {
	    parent::__construct();
	}

	public function index(){
		$this->form_validation->set_data($this->input->post());
		$this->form_validation->set_rules('username', 'Email', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		return $this->form_validation->run();
  }
  
  public function change_password(){
    $this->form_validation->set_data($this->input->post());
	$this->form_validation->set_rules('username', 'Email', 'trim|required');
	$this->form_validation->set_rules('old_password', 'Password Lama', 'trim|required');
	$this->form_validation->set_rules('new_password', 'Password Baru', 'trim|required|alpha_numeric|differs[old_password]');
	$this->form_validation->set_rules('conf_password', 'Konfirmasi Password', 'trim|required|matches[new_password]');
	return $this->form_validation->run();
  }
	
}
