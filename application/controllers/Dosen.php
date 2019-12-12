<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dosen extends API_Controller {

	function __construct() {
	    parent::__construct();
	    $this->load->model(array(
				'data/dosen_model', 
				'validation/dosen_validation'
			));
	}

	public function index_get() {
		$data = $this->dosen_model->index();
		self::response_ok('OK', $data);
	}

	public function detail_get() {
		$_GET = json_decode(file_get_contents("php://input"), true);
		if ($this->dosen_validation->detail()) {
			$data = $this->dosen_model->detail();
			self::response_ok('OK', $data);
		} else {
			$data['result'] = $this->form_validation->error_array();
			self::response_failed(
				SELF::HTTP_OK,
				'Validation error',
				$data
			);
		}
	}

	public function index_post() {
	    $_POST = json_decode(file_get_contents("php://input"), true);
		if ($this->dosen_validation->add()) {
			$data = $this->dosen_model->add();
			if(array_key_exists('error', $data['result'])){
				self::response_failed(
					SELF::HTTP_OK,
					'Validation error',
					$data
				);
			} else {
				self::response_ok('OK',$data);
			}
		} else {
			$data['result'] = ['error' => $this->form_validation->error_array()];
			self::response_failed(
				SELF::HTTP_OK,
				'Validation error',
				$data
			);
		}
	}

	public function picture_post(){
	    $_POST = json_decode(file_get_contents("php://input"), true);
		$data = $this->dosen_model->picture_post();
		// if(array_key_exists('error', $data['success'])){
		// 	self::response_failed(
		// 		SELF::HTTP_OK,
		// 		'Validation error',
		// 		$data
		// 	);
		// } else {
			self::response_ok('OK',$data);
		// }
	}

	public function delete_post() {
		$_POST = json_decode(file_get_contents("php://input"), true);
		if ($this->dosen_validation->delete()) {
			$data = $this->dosen_model->delete();
			if(array_key_exists('error', $data['result'])){
				self::response_failed(
					SELF::HTTP_OK,
					'Validation error',
					$data
				);
			} else {
				self::response_ok('OK', $data);
			}
		} else {
			$data['result'] = $this->form_validation->error_array();
			self::response_failed(
				SELF::HTTP_OK,
				'Validation error',
				$data
			);
		}
	}
}
