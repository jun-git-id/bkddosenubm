<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Publikasi_validation extends CI_Model {

	function __construct() {
	    parent::__construct();
	}

	public function detail(){
		$this->form_validation->set_data($this->input->get());
		$this->form_validation->set_rules('id_publikasi', 'ID Publikasi', 'required');
		return $this->form_validation->run();
	}

	public function add(){
		$this->form_validation->set_data($this->input->post());
		$this->form_validation->set_rules('id_dosen', 'ID Dosen', 'required|numeric');
		$this->form_validation->set_rules('judul_buku', 'Judul', 'required');
		$this->form_validation->set_rules('jenis_buku', 'Jenis', 'required');
		$this->form_validation->set_rules('isbn', 'ISBN', 'required');
		$this->form_validation->set_rules('penerbit', 'Penerbit', 'required');
		$this->form_validation->set_rules('tahun_terbit', 'Tahun Terbit', 'required|numeric');
		return $this->form_validation->run();
	}

	public function delete(){
		$this->form_validation->set_data($this->input->post());
		$this->form_validation->set_rules('id_publikasi', 'ID Publikasi', 'required');
		return $this->form_validation->run();
	}
	
}
