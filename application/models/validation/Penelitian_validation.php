<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penelitian_validation extends CI_Model {

	function __construct() {
	    parent::__construct();
	}

	public function detail(){
		$this->form_validation->set_data($this->input->get());
		$this->form_validation->set_rules('id_penelitian', 'ID Penelitian', 'required');
		return $this->form_validation->run();
	}

	public function add(){
		$this->form_validation->set_data($this->input->post());
		$this->form_validation->set_rules('id_dosen', 'ID Dosen', 'required|numeric');
		$this->form_validation->set_rules('semester_penelitian', 'Semester', 'required');
		$this->form_validation->set_rules('tahun_penelitian', 'Tahun', 'required');
		$this->form_validation->set_rules('judul_penelitian', 'Judul', 'required');
		$this->form_validation->set_rules('biaya_penelitian', 'Biaya', 'required|numeric');
		$this->form_validation->set_rules('lokasi_penelitian', 'Lokasi', 'required');
		$this->form_validation->set_rules('anggota_penelitian', 'Anggota', 'required');
		return $this->form_validation->run();
	}

	public function delete(){
		$this->form_validation->set_data($this->input->post());
		$this->form_validation->set_rules('id_penelitian', 'ID Penelitian', 'required');
		return $this->form_validation->run();
	}
	
}
