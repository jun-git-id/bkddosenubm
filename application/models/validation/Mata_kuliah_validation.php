<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mata_kuliah_validation extends CI_Model {

	function __construct() {
	    parent::__construct();
	}

	public function detail(){
		$this->form_validation->set_data($this->input->get());
		$this->form_validation->set_rules('id_matkul', 'ID Mata Kuliah', 'required');
		return $this->form_validation->run();
	}

	public function add(){
		$this->form_validation->set_data($this->input->post());
		$this->form_validation->set_rules('nama_matkul', 'Nama', 'required');
		$this->form_validation->set_rules('sks', 'SKS', 'required|numeric');
		return $this->form_validation->run();
	}

	public function delete(){
		$this->form_validation->set_data($this->input->post());
		$this->form_validation->set_rules('id_matkul', 'ID Mata Kuliah', 'required');
		return $this->form_validation->run();
	}
	
}