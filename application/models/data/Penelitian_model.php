<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penelitian_model extends CI_Model {

	function __construct() {
	    parent::__construct();
	}

	public function index()
	{	
		$field = [
			'a.id_penelitian',
      'a.id_dosen',
      'b.nama_dosen',
      'a.semester_penelitian',
      'a.tahun_penelitian',
      'a.judul_penelitian',
      'a.biaya_penelitian',
      'a.lokasi_penelitian',
      'a.anggota_penelitian',
      'c.nama_dosen AS nama_anggota'
		];

		$data ['result'] = $this->db->select(implode(',', $field))
                                ->from('penelitian a')
                                ->join('dosen b', 'a.id_dosen = b.id_dosen')
                                ->join('dosen c', 'a.anggota_penelitian = c.id_dosen')
                                ->get()
                                ->result();

		$data['last'] = $this->db->last_query();

		return $data;
	}

	public function detail(){
		$where = ['id_penelitian' => $this->input->get('id_penelitian', true)];

		$field = [
			'a.id_penelitian',
      'a.id_dosen',
      'b.nama_dosen',
      'a.semester_penelitian',
      'a.tahun_penelitian',
      'a.judul_penelitian',
      'a.biaya_penelitian',
      'a.lokasi_penelitian',
      'a.anggota_penelitian',
      'c.nama_dosen AS nama_anggota'
		];

		$data ['result'] = $this->db->select(implode(',', $field))
                                ->from('penelitian a')
                                ->join('dosen b', 'a.id_dosen = b.id_dosen')
                                ->join('dosen c', 'a.anggota_penelitian = c.id_dosen')
                                ->where($where)
                                ->get()
                                ->result();

		$data['last'] = $this->db->last_query();

		return $data;
	}

	public function add(){
		$where = ['id_penelitian' => $this->input->post('id_penelitian', true)];

		$data = [
      'id_dosen'            => $this->input->post('id_dosen'),
      'semester_penelitian' => $this->input->post('semester_penelitian'),
      'tahun_penelitian'    => $this->input->post('tahun_penelitian'),
      'judul_penelitian'    => $this->input->post('judul_penelitian'),
      'biaya_penelitian'    => $this->input->post('biaya_penelitian'),
      'lokasi_penelitian'   => $this->input->post('lokasi_penelitian'),
      'anggota_penelitian'  => $this->input->post('anggota_penelitian')
		];

		if(empty($where['id_penelitian'])){
			$insert = $this->db->insert('penelitian', $data);
			if($insert == true) {
				return ['result' => ['message' => 'Data berhasil ditambahkan']];
			}
			else 
				return ['result' => ['error' => 'Data gagal ditambahkan']];
		} else {
			$update = $this->db->update('penelitian', $data, $where);
			if($update == true) {
				return ['result' => ['message' => 'Data berhasil diubah']];
			}
			else 
				return ['result' => ['error' => 'Data gagal diubah']];
		}

	}

	public function delete(){
		$where = ['id_penelitian' => $this->input->post('id_penelitian', true)];
		
		$delete = $this->db->delete('penelitian', $where);
		if($delete == true) {
			return ['result' => ['message' => 'Data berhasil dihapus']];
		}
		else 
			return ['result' => ['error' => 'Data gagal dihapus']];
	}
}
