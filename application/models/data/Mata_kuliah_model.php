<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mata_kuliah_model extends CI_Model {

	function __construct() {
	    parent::__construct();
	}

	public function index()
	{	
		$field = [
			'id_matkul',
			'nama_matkul',
			'sks'
		];

		$data ['result'] = $this->db->select(implode(',', $field))
									 ->from('mata_kuliah')
									 ->get()
									 ->result();

		$data['last'] = $this->db->last_query();

		return $data;
	}

	public function detail(){
		$where = ['id_matkul' => $this->input->get('id_matkul', true)];

		$field = [
			'id_matkul',
			'nama_matkul',
			'sks'
		];

		$data ['result'] = $this->db->select(implode(',', $field))
									 ->from('mata_kuliah')
									 ->where($where)
									 ->get()
									 ->result();

		$data['last'] = $this->db->last_query();

		return $data;
	}

	public function add(){
		$where = ['id_matkul' => $this->input->post('id_matkul', true)];
		$data = [
			'nama_matkul' => $this->input->post('nama_matkul', true),
			'sks'         => $this->input->post('sks', true),
		];

		if(empty($where['id_matkul'])){
			$insert = $this->db->insert('mata_kuliah', $data);
			if($insert == true) {
				$data = self::index();
				return $data;
			}
			else 
				return ['result' => ['error' => 'Data gagal ditambahkan']];
		} else {
			$update = $this->db->update('mata_kuliah', $data, $where);
			if($update == true) {
				$data = self::index();
				return $data; 
			}
			else 
				return ['result' => ['error' => 'Data gagal diubah']];
		}
	}

	public function delete(){
		$where = ['id_matkul' => $this->input->post('id_matkul', true)];
		
		$delete = $this->db->delete('mata_kuliah', $where);
		if($delete == true) {
			$data = self::index();
			return $data; 
		}
		else 
			return ['result' => ['error' => 'Data gagal dihapus']];
	}
}
