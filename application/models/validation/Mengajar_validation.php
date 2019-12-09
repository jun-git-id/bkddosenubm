<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mengajar_validation extends CI_Model {

	function __construct() {
	    parent::__construct();
	}

	public function detail(){
		$this->form_validation->set_data($this->input->get());
		$this->form_validation->set_rules('id_mengajar', 'ID Mengajar', 'required');
		return $this->form_validation->run();
	}

	public function add(){
		$this->form_validation->set_data($this->input->post());
		$this->form_validation->set_rules('id_dosen', 'ID Dosen', 'required|numeric');
		$this->form_validation->set_rules('tahun_ajaran', 'Tahun Ajaran', 'required');
		$this->form_validation->set_rules('id_matkul', 'Mata Kuliah', 'required|numeric');
		$this->form_validation->set_rules('sks', 'SKS', 'required|numeric');
		return $this->form_validation->run();
	}

	public function delete(){
		$this->form_validation->set_data($this->input->post());
		$this->form_validation->set_rules('id_mengajar', 'ID Mengajar', 'required');
		return $this->form_validation->run();
	}
	
}
