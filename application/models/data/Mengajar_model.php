<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mengajar_model extends CI_Model {

	function __construct() {
	    parent::__construct();
	}

	public function index()
	{	
		$field = [
      'a.id_mengajar',
      'a.id_dosen',
      'c.nama_dosen',
      'a.tahun_ajaran',
      'a.id_matkul',
      'b.nama_matkul',
      'a.sks',
      'a.sk_mengajar'
		];

		$data ['result'] = $this->db->select(implode(',', $field))
                   ->from('mengajar a')
                   ->join('mata_kuliah b', 'a.id_matkul = b.id_matkul')
                   ->join('dosen c', 'a.id_dosen = c.id_dosen')
				 ->get()
				 ->result();

		$data['last'] = $this->db->last_query();

		return $data;
	}

	public function detail(){
		$where = ['id_mengajar' => $this->input->get('id_mengajar', true)];

		$field = [
			'a.id_mengajar',
      'a.id_dosen',
      'c.nama_dosen',
      'a.tahun_ajaran',
      'a.id_matkul',
      'b.nama_matkul',
      'a.sks',
      'a.sk_mengajar'
		];

		$data ['result'] = $this->db->select(implode(',', $field))
                                ->from('mengajar a')
                                ->join('mata_kuliah b', 'a.id_matkul = b.id_matkul')
                                ->join('dosen c', 'a.id_dosen = c.id_dosen')
                                ->where($where)
                                ->get()
                                ->result();

		$data['last'] = $this->db->last_query();

		return $data;
	}

	public function add(){
		$where = ['id_mengajar' => $this->input->post('id_mengajar', true)];
		$data = [
      'id_dosen'      => $this->input->post('id_dosen', true),
			'tahun_ajaran' 	=> $this->input->post('tahun_ajaran', true),
			'id_matkul' 		=> $this->input->post('id_matkul', true),
			'sks' 	        => $this->input->post('sks', true),
			'sk_mengajar' 	=> $this->input->post('sk_mengajar', true)
		];

		if(empty($where['id_mengajar'])){
			$insert = $this->db->insert('mengajar', $data);
			if($insert == true) 
				return ['result' => ['message' => 'Data berhasil ditambahkan']]; 
			else 
				return ['result' => ['error' => 'Data gagal ditambahkan']];
		} else {
			$update = $this->db->update('mengajar', $data, $where);
			if($update == true) 
				return ['result' => ['message' => 'Data berhasil diubah']]; 
			else 
				return ['result' => ['error' => 'Data gagal diubah']];
		}

	}

	public function picture_post(){
		if(!empty($_FILES) && !empty($_FILES['sk'])){
			$config['upload_path'] 			= 'assets/sk_mengajar/';
			$config['allowed_types'] 		= 'jpg|png|jpeg';
			$config['max_size'] 				= 5000;
			$config['file_name'] 				= round(microtime(true) * 1000);
			$config['overwrite']				= TRUE;
			$config['remove_spaces'] 		= TRUE;
			$config['file_ext_tolower'] = TRUE;
			$config['encrypt_name'] 		= FALSE;
			
			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('sk')){
				$error = ['success' => $this->upload->display_errors()];
				return $error;
			}
			else{
				$upload_file = $this->upload->data();
				$image_path = 'assets/sk_mengajar/';
				$image_path .= $upload_file['file_name'];
				$image = base_url($image_path);
				$data = $image;
			}

			return ['success' => $data];
		}
	}

	public function delete(){
		$where = ['id_mengajar' => $this->input->post('id_mengajar', true)];
		$data = $this->db
									->select('sk_mengajar')
									->from('mengajar')
									->where($where)
									->get()
                  ->row_array();
							
		if(!empty($data['sk_mengajar'])){
      $url  = str_replace(base_url(), '', $data['sk_mengajar']);
			if(file_exists($url)){
				unlink($url);
			}
    }

		$delete = $this->db->delete('mengajar', $where);
		if($delete == true) 
			return ['result' => ['success' => 'Data berhasil dihapus']]; 
		else 
			return ['result' => ['error' => 'Data gagal dihapus']];
	}
}
