<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Publikasi extends API_Controller {

	function __construct() {
	    parent::__construct();
	    $this->load->model(array(
				'data/publikasi_model', 
				'validation/publikasi_validation'
			));
	}

	public function index_get() {
		$data = $this->publikasi_model->index();
		self::response_ok('OK', $data);
	}

	public function detail_get() {
		$_GET = json_decode(file_get_contents("php://input"), true);
		if ($this->publikasi_validation->detail()) {
			$data = $this->publikasi_model->detail();
			self::response_ok('OK', $data);
		} else {
			$data['result']    = [$this->form_validation->error_array()];
			self::response_failed(
				SELF::HTTP_INTERNAL_ERROR,
				'Validation error',
				$data
			);
		}
	}

	public function index_post() {
		$_POST = json_decode(file_get_contents("php://input"), true);
		if ($this->publikasi_validation->add()) {
			$data = $this->publikasi_model->add();
			if(array_key_exists('error', $data['result'])){
				self::response_failed(
					SELF::HTTP_INTERNAL_ERROR,
					'Validation error',
					$data
				);
			} else {
				self::response_ok('OK', $data);
			}
		} else {
			$data['result']    = [$this->form_validation->error_array()];
			self::response_failed(
				SELF::HTTP_INTERNAL_ERROR,
				'Validation error',
				$data
			);
		}
	}

	public function delete_post() {
		$_POST = json_decode(file_get_contents("php://input"), true);
		if ($this->publikasi_validation->delete()) {
			$data = $this->publikasi_model->delete();
			if(array_key_exists('error', $data['result'])){
				self::response_failed(
					SELF::HTTP_INTERNAL_ERROR,
					'Validation error',
					$data
				);
			} else {
				self::response_ok('OK', $data);
			}
		} else {
			$data['result'] = [$this->form_validation->error_array()];
			self::response_failed(
				SELF::HTTP_INTERNAL_ERROR,
				'Validation error',
				$data
			);
		}
	}
}
