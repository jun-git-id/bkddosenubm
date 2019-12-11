<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dosen_model extends CI_Model {

	function __construct() {
	    parent::__construct();
	}

	public function index()
	{	
		$field = [
			'id_dosen',
			'nidn',
			'nama_dosen',
			'email_dosen',
			'jenis_kelamin',
			'tgl_lahir',
			'telepon',
			'jabatan',
			'foto'
		];

		$data['result'] = $this->db->select(implode(',', $field))
									 ->from('dosen')
									 ->get()
									 ->result();

		$data['last'] = $this->db->last_query();

		return $data;
	}

	public function detail(){
		$where = ['id_dosen' => $this->input->get('id_dosen', true)];

		$field = [
			'id_dosen',
			'nidn',
			'nama_dosen',
			'email_dosen',
			'jenis_kelamin',
			'tgl_lahir',
			'telepon',
			'jabatan',
			'foto'
		];

		$data['result'] = $this->db->select(implode(',', $field))
									 ->from('dosen')
									 ->where($where)
									 ->get()
									 ->result();

		$data['last'] = $this->db->last_query();

		return $data;
	}

	public function add(){
		$where = ['id_dosen' => $this->input->post('id_dosen', true)];
		$data = [
			'nidn' 			=> $this->input->post('nidn', true),
			'nama_dosen' 	=> $this->input->post('nama_dosen', true),
			'email_dosen' 	=> $this->input->post('email_dosen', true),
			'jenis_kelamin' => $this->input->post('jenis_kelamin', true),
			'tgl_lahir' 	=> $this->input->post('tgl_lahir', true),
			'telepon' 		=> $this->input->post('telepon', true),
			'jabatan' 		=> $this->input->post('jabatan', true),
		];

		$select = $this->db
						->select('nidn, email_dosen')
						->from('dosen')
						->where('nidn', $data['nidn'])
						->get()
						->row_array();
		
		if(!empty($_FILES) && !empty($_FILES['foto'])){
			$config['upload_path'] 		= 'assets/foto_dosen/';
			$config['allowed_types'] 	= 'jpg|png|jpeg';
			$config['max_size'] 		= 5000;
			$config['file_name'] 		= $data['nidn'];
			$config['overwrite']		= TRUE;
			$config['remove_spaces'] 	= TRUE;
			$config['file_ext_tolower'] = TRUE;
			$config['encrypt_name'] 	= FALSE;
			
			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('foto')){
				$error = ['result' => ['error' => $this->upload->display_errors()]];
				return $error;
			}
			else{
				$upload_file = $this->upload->data();
				$image_path = 'assets/foto_dosen/';
				$image_path .= $upload_file['file_name'];
				$image = base_url($image_path);
				$data['foto'] = $image;
			}
		}
		
		if(empty($where['id_dosen'])){
			if(!empty($select['nidn'])){
				$response['result']    = ['error' => 'Data NIDN '.$data['nidn'].' sudah ada dalam server'];
				return $response;
			}
			$insert = $this->db->insert('dosen', $data);
			if($insert == true) {
				self::addLogin($data);
				$response['result']  = ['message' => 'Data berhasil ditambahkan'];
				return $response;
			} else { 
				$response['result']    = ['error' => 'Data gagal ditambahkan'];
				return $response;
			}
		} else {
			$update = $this->db->update('dosen', $data, $where);
			if($update == true) {
				if($data['email_dosen'] != $select['email_dosen']) self::editLogin($select,$data);
				$response['result']  = ['message' => 'Data berhasil diubah'];
				return $response;
			} else { 
				$response['result']  = ['error' => 'Data gagal diubah'];
			}
		}

	}

	private function addLogin($data) {
		$field['email'] = $data['email_dosen'];
		$field['password'] = md5(preg_replace('/\//','',$data['tgl_lahir']));
		return $this->db->insert('user_login', $field);
	}

	private function editLogin($details,$data) {
		$field['email'] = $data['email_dosen'];
		$where = ['email' => $details['email_dosen']];
		return $this->db->update('user_login', $field, $where);
	}

	public function delete(){
		$where = ['id_dosen' => $this->input->post('id_dosen', true)];
		$data = $this->db
					 ->select('foto')
					 ->from('dosen')
					 ->where($where)
					 ->get()
					 ->row_array();
							
		if(!empty($data['foto'])){
			$url  = str_replace(base_url(), '', $data);
			if(file_exists($url)){
				unlink($url);
			}
		}

		$delete = $this->db->delete('dosen', $where);
		if($delete == true) {
			$response['result']  = ['message' => 'Data berhasil dihapus'];
			return $response;
		} else { 
			$response['result']  = ['error' => 'Data gagal dihapus'];
			return $response;
		}
	}
}
