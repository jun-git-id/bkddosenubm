<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mata_kuliah extends API_Controller {

	function __construct() {
	    parent::__construct();
	    $this->load->model(array(
				'data/mata_kuliah_model', 
				'validation/mata_kuliah_validation'
			));
	}

	public function index_get() {
		$data = $this->mata_kuliah_model->index();
		self::response_ok('OK', $data);
	}

	public function detail_get() {
		$_GET = json_decode(file_get_contents("php://input"), true);
		if ($this->mata_kuliah_validation->detail()) {
			$data = $this->mata_kuliah_model->detail();
			self::response_ok('OK', $data);
		} else {
			$data['error']    = $this->form_validation->error_array();
			self::response_ok(
				'Validation error',
				$data
			);
		}
	}

	public function index_post() {
	    $_POST = json_decode(file_get_contents("php://input"), true);
		if ($this->mata_kuliah_validation->add()) {
			$data = $this->mata_kuliah_model->add();
			if(array_key_exists('error', $data)){
				self::response_failed(
					SELF::HTTP_INTERNAL_ERROR,
					'Validation error',
					$data
				);
			} else {
				self::response_ok('OK',$data);
			}
		} else {
			$data['result'] = $this->form_validation->error_array();
			self::response_failed(
				SELF::HTTP_INTERNAL_ERROR,
				'Validation error',
				[$data]
			);
		}
	}

	public function delete_post() {
		$_POST = json_decode(file_get_contents("php://input"), true);
		if ($this->mata_kuliah_validation->delete()) {
			$data = $this->mata_kuliah_model->delete();
			if(array_key_exists('error', $data)){
				self::response_failed(
					SELF::HTTP_INTERNAL_ERROR,
					'Validation error',
					$data
				);
			} else {
				self::response_ok('OK', $data);
			}
		} else {
			$data['error'] = $this->form_validation->error_array();
			self::response_failed(
				SELF::HTTP_INTERNAL_ERROR,
				'Validation error',
				$data
			);
		}
	}
}
