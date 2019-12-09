<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Publikasi_model extends CI_Model {

	function __construct() {
	    parent::__construct();
	}

	public function index(){	
		$field = [
			'a.id_publikasi',
      'a.id_dosen',
      'b.nama_dosen',
      'a.judul_buku',
      'a.jenis_buku',
      'a.isbn',
      'a.penerbit',
      'a.tahun_terbit'
		];

		$data ['result'] = $this->db->select(implode(',', $field))
                                ->from('publikasi a')
                                ->join('dosen b', 'a.id_dosen = b.id_dosen')
                                ->get()
                                ->result();

		$data['last'] = $this->db->last_query();

		return $data;
	}

	public function detail(){
		$where = ['id_publikasi' => $this->input->get('id_publikasi', true)];

		$field = [
			'a.id_publikasi',
      'a.id_dosen',
      'b.nama_dosen',
      'a.judul_buku',
      'a.jenis_buku',
      'a.isbn',
      'a.penerbit',
      'a.tahun_terbit'
		];

		$data ['result'] = $this->db->select(implode(',', $field))
                                ->from('publikasi a')
                                ->join('dosen b', 'a.id_dosen = b.id_dosen')
                                ->where($where)
                                ->get()
                                ->result();

		$data['last'] = $this->db->last_query();

		return $data;
	}

	public function add(){
		$where = ['id_publikasi' => $this->input->post('id_publikasi', true)];

		$data = [
      'id_dosen'     => $this->input->post('id_dosen'),
      'judul_buku'   => $this->input->post('judul_buku'),
      'jenis_buku'   => $this->input->post('jenis_buku'),
      'isbn'         => $this->input->post('isbn'),
      'penerbit'     => $this->input->post('penerbit'),
      'tahun_terbit' => $this->input->post('tahun_terbit')
    ];

		if(empty($where['id_publikasi'])){
			$insert = $this->db->insert('publikasi', $data);
			if($insert == true) 
				return ['message' => 'Data berhasil ditambahkan']; 
			else 
				return ['error' => 'Data gagal ditambahkan'];
		} else {
			$update = $this->db->update('publikasi', $data, $where);
			if($update == true) 
				return ['message' => 'Data berhasil diubah']; 
			else 
				return ['error' => 'Data gagal diubah'];
		}

	}

	public function delete(){
    $where = ['id_publikasi' => $this->input->post('id_publikasi', true)];
    
		$delete = $this->db->delete('publikasi', $where);
		if($delete == true) 
			return ['message' => 'Data berhasil dihapus']; 
		else 
			return ['error' => 'Data gagal dihapus'];
	}
}