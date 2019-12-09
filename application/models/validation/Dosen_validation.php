<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dosen_validation extends CI_Model {

	function __construct() {
	    parent::__construct();
	}

	public function detail(){
		$this->form_validation->set_data($this->input->get());
		$this->form_validation->set_rules('id_dosen', 'ID Dosen', 'required');
		return $this->form_validation->run();
	}

	public function delete(){
		$this->form_validation->set_data($this->input->post());
		$this->form_validation->set_rules('id_dosen', 'ID Dosen', 'required');
		return $this->form_validation->run();
	}

	public function add(){
		$this->form_validation->set_data($this->input->post());
		$this->form_validation->set_rules('nidn', 'NIDN', 'required|numeric');
		$this->form_validation->set_rules('nama_dosen', 'Nama', 'required');
		$this->form_validation->set_rules('email_dosen', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
		$this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required');
		$this->form_validation->set_rules('telepon', 'Telepon', 'required|numeric|min_length[10]');
		$this->form_validation->set_rules('jabatan', 'Jabatan', 'required');
		return $this->form_validation->run();
	}
	
}
