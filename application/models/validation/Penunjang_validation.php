<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penunjang_validation extends CI_Model {

	function __construct() {
	    parent::__construct();
	}

	public function detail(){
		$this->form_validation->set_data($this->input->get());
		$this->form_validation->set_rules('id_penunjang', 'ID penunjang', 'required');
		return $this->form_validation->run();
	}

	public function add(){
		$this->form_validation->set_data($this->input->post());
		$this->form_validation->set_rules('id_dosen', 'ID Dosen', 'required|numeric');
		$this->form_validation->set_rules('semester_penunjang', 'Semester', 'required');
		$this->form_validation->set_rules('tahun_penunjang', 'Tahun', 'required');
		$this->form_validation->set_rules('jenis_kegiatan', 'Jenis', 'required');
		$this->form_validation->set_rules('topik_penunjang', 'Topik', 'required');
		$this->form_validation->set_rules('tempat_penunjang', 'Tempat', 'required');
		$this->form_validation->set_rules('tgl_pelaksanaan', 'Tanggal', 'required');
		$this->form_validation->set_rules('penyelenggara_penunjang', 'Penyelenggara', 'required');
		return $this->form_validation->run();
	}

	public function delete(){
		$this->form_validation->set_data($this->input->post());
		$this->form_validation->set_rules('id_penunjang', 'ID penunjang', 'required');
		return $this->form_validation->run();
	}
	
}
