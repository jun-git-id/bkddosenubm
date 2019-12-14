<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengabdian_model extends CI_Model {

	function __construct() {
	    parent::__construct();
	}

	public function index()
	{	
		$field = [
			'a.id_pengabdian',
      'a.id_dosen',
      'b.nama_dosen',
      'a.semester_pengabdian',
      'a.tahun_pengabdian',
      'a.anggota_pengabdian',
      'c.nama_dosen AS nama_anggota',
      'a.mitra_pengabdian',
      'a.alamat_mitra',
      'a.sampul_laporan'
		];

		$data ['result'] = $this->db->select(implode(',', $field))
                                ->from('pengabdian a')
                                ->join('dosen b', 'a.id_dosen = b.id_dosen')
                                ->join('dosen c', 'a.anggota_pengabdian = c.id_dosen')
                                ->get()
                                ->result();

		$data['last'] = $this->db->last_query();

		return $data;
	}

	public function detail(){
		$where = ['id_pengabdian' => $this->input->get('id_pengabdian', true)];

		$field = [
			'a.id_pengabdian',
      'a.id_dosen',
      'b.nama_dosen',
      'a.semester_pengabdian',
      'a.tahun_pengabdian',
      'a.anggota_pengabdian',
      'c.nama_dosen AS nama_anggota',
      'a.mitra_pengabdian',
      'a.alamat_mitra',
      'a.sampul_laporan'
		];

		$data ['result'] = $this->db->select(implode(',', $field))
                                ->from('pengabdian a')
                                ->join('dosen b', 'a.id_dosen = b.id_dosen')
                                ->join('dosen c', 'a.anggota_pengabdian = c.id_dosen')
                                ->where($where)
                                ->get()
                                ->result();

		$data['last'] = $this->db->last_query();

		return $data;
	}

	public function add(){
		$where = ['id_pengabdian' => $this->input->post('id_pengabdian', true)];
		$data = [
      'id_dosen'            => $this->input->post('id_dosen'),
      'semester_pengabdian' => $this->input->post('semester_pengabdian'),
      'tahun_pengabdian'    => $this->input->post('tahun_pengabdian'),
      'anggota_pengabdian'  => $this->input->post('anggota_pengabdian'),
      'mitra_pengabdian'    => $this->input->post('mitra_pengabdian'),
      'alamat_mitra'        => $this->input->post('alamat_mitra'),
      'sampul_laporan' 		=> $this->input->pos('sampul_laporan')

    ];

		if(empty($where['id_pengabdian'])){
			$insert = $this->db->insert('pengabdian', $data);
			if($insert == true) 
				return ['result' => ['message' => 'Data berhasil ditambahkan']]; 
			else 
				return ['result' => ['error' => 'Data gagal ditambahkan']];
		} else {
			$update = $this->db->update('pengabdian', $data, $where);
			if($update == true) 
				return ['result' => ['message' => 'Data berhasil diubah']]; 
			else 
				return ['result' => ['error' => 'Data gagal diubah']];
		}
	}

	public function picture_post(){
		if(!empty($_FILES) && !empty($_FILES['sampul_laporan'])){
			$config['upload_path'] 			= 'assets/pengabdian/';
			$config['allowed_types'] 		= 'jpg|png|jpeg';
			$config['max_size'] 				= 5000;
			$config['file_name'] 				= round(microtime(true) * 1000);
			$config['overwrite']				= TRUE;
			$config['remove_spaces'] 		= TRUE;
			$config['file_ext_tolower'] = TRUE;
			$config['encrypt_name'] 		= FALSE;
			
			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('sampul_laporan')){
				$error = ['success' => $this->upload->display_errors()];
				return $error;
			}
			else{
				$upload_file = $this->upload->data();
				$image_path = 'assets/pengabdian/';
				$image_path .= $upload_file['file_name'];
				$image = base_url($image_path);
				$data = $image;
			}
			
			return ['success' => $data];
		}
	}

	public function delete(){
    $where = ['id_pengabdian' => $this->input->post('id_pengabdian', true)];
    
    $data = $this->db->select('sampul_laporan')
                     ->from('pengabdian')
                     ->where($where)
                     ->get()
                     ->row_array();

    if(!empty($data['sampul_laporan'])){
      $url  = str_replace(base_url(), '', $data['sampul_laporan']);
      if(file_exists($url)){
        unlink($url);
      }
    }
		
		$delete = $this->db->delete('pengabdian', $where);
		if($delete == true) 
			return ['result' => ['message' => 'Data berhasil dihapus']]; 
		else 
			return ['result' => ['error' => 'Data gagal dihapus']];
	}
}
