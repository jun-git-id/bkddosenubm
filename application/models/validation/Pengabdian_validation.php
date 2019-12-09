<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengabdian_validation extends CI_Model {

	function __construct() {
	    parent::__construct();
	}

	public function detail(){
		$this->form_validation->set_data($this->input->get());
		$this->form_validation->set_rules('id_pengabdian', 'ID Pengabdian', 'required');
		return $this->form_validation->run();
	}

	public function add(){
		$this->form_validation->set_data($this->input->post());
		$this->form_validation->set_rules('id_dosen', 'ID Dosen', 'required|numeric');
		$this->form_validation->set_rules('semester_pengabdian', 'Semester', 'required');
		$this->form_validation->set_rules('tahun_pengabdian', 'Tahun', 'required');
		$this->form_validation->set_rules('anggota_pengabdian', 'Anggota', 'required');
		$this->form_validation->set_rules('mitra_pengabdian', 'Mitra', 'required');
		$this->form_validation->set_rules('alamat_mitra', 'Alamat', 'required');
		return $this->form_validation->run();
	}

	public function delete(){
		$this->form_validation->set_data($this->input->post());
		$this->form_validation->set_rules('id_pengabdian', 'ID Pengabdian', 'required');
		return $this->form_validation->run();
	}
	
}
