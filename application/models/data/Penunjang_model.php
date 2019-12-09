<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penunjang_model extends CI_Model {

	function __construct() {
	    parent::__construct();
	}

	public function index()
	{	
		$field = [
			'a.id_penunjang',
      'a.id_dosen',
      'b.nama_dosen',
      'a.semester_penunjang',
      'a.tahun_penunjang',
      'a.jenis_kegiatan',
      'a.topik_penunjang',
      'a.tempat_penunjang',
      'a.tgl_pelaksanaan',
      'a.penyelenggara_penunjang',
      'a.sertifikat_penunjang'
		];

		$data ['result'] = $this->db->select(implode(',', $field))
                                ->from('penunjang a')
                                ->join('dosen b', 'a.id_dosen = b.id_dosen')
                                ->get()
                                ->result();

		$data['last'] = $this->db->last_query();

		return $data;
	}

	public function detail(){
		$where = ['id_penunjang' => $this->input->get('id_penunjang', true)];

		$field = [
			'a.id_penunjang',
      'a.id_dosen',
      'b.nama_dosen',
      'a.semester_penunjang',
      'a.tahun_penunjang',
      'a.jenis_kegiatan',
      'a.topik_penunjang',
      'a.tempat_penunjang',
      'a.tgl_pelaksanaan',
      'a.penyelenggara_penunjang',
      'a.sertifikat_penunjang'
		];

		$data ['result'] = $this->db->select(implode(',', $field))
                                ->from('penunjang a')
                                ->join('dosen b', 'a.id_dosen = b.id_dosen')
                                ->where($where)
                                ->get()
                                ->result();

		$data['last'] = $this->db->last_query();

		return $data;
	}

	public function add(){
		$where = ['id_penunjang' => $this->input->post('id_penunjang', true)];

		$data = [
      'id_dosen' => $this->input->post('id_dosen'),
      'semester_penunjang' => $this->input->post('semester_penunjang'),
      'tahun_penunjang' => $this->input->post('tahun_penunjang'),
      'jenis_kegiatan' => $this->input->post('jenis_kegiatan'),
      'topik_penunjang' => $this->input->post('topik_penunjang'),
      'tempat_penunjang' => $this->input->post('tempat_penunjang'),
      'tgl_pelaksanaan' => $this->input->post('tgl_pelaksanaan'),
      'penyelenggara_penunjang' => $this->input->post('penyelenggara_penunjang')
    ];
    
    if(!empty($_FILES) && !empty($_FILES['sampul'])){
			$config['upload_path'] 			= 'assets/penunjang/';
			$config['allowed_types'] 		= 'jpg|png|jpeg';
			$config['max_size'] 				= 5000;
			$config['file_name'] 				= $data['id_dosen'].'-'.$data['topik_penunjang'];
			$config['overwrite']				= TRUE;
			$config['remove_spaces'] 		= TRUE;
			$config['file_ext_tolower'] = TRUE;
			$config['encrypt_name'] 		= FALSE;
			
			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('sertifikat')){
				$error = array('error' => $this->upload->display_errors());
				return $error;
			}
			else{
				$upload_file = $this->upload->data();
				$image_path = 'assets/penunjang/';
				$image_path .= $upload_file['file_name'];
				$image = base_url($image_path);
				$data['sertifikat_penunjang'] = $image;
			}
		}

		if(empty($where['id_penunjang'])){
			$insert = $this->db->insert('penunjang', $data);
			if($insert == true) 
				return ['message' => 'Data berhasil ditambahkan']; 
			else 
				return ['error' => 'Data gagal ditambahkan'];
		} else {
			$update = $this->db->update('penunjang', $data, $where);
			if($update == true) 
				return ['message' => 'Data berhasil diubah']; 
			else 
				return ['error' => 'Data gagal diubah'];
		}

	}

	public function delete(){
    $where = ['id_penunjang' => $this->input->post('id_penunjang', true)];
    
    $data = $this->db->select('sertifikat_penunjang')
                     ->from('penunjang')
                     ->where($where)
                     ->get()
                     ->row_array();

    if(!empty($data['sertifikat_penunjang'])){
      $url  = str_replace(base_url(), '', $data['sertifikat_penunjang']);
      if(file_exists($url)){
        unlink($url);
      }
    }
		
		$delete = $this->db->delete('penunjang', $where);
		if($delete == true) 
			return ['message' => 'Data berhasil dihapus']; 
		else 
			return ['error' => 'Data gagal dihapus'];
	}
}