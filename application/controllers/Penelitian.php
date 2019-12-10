<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penelitian extends API_Controller {

	function __construct() {
	    parent::__construct();
	    $this->load->model(array(
				'data/penelitian_model', 
				'validation/penelitian_validation'
			));
	}

	public function index_get() {
		$data = $this->penelitian_model->index();
		self::response_ok('OK', $data);
	}

	public function detail_get() {
		$_GET = json_decode(file_get_contents("php://input"), true);
		if ($this->penelitian_validation->detail() == true) {
			$data = $this->penelitian_model->detail();
			self::response_ok('OK', $data);
		} else {
			$data['error']    = [$this->form_validation->error_array()];
			self::response_failed(
				SELF::HTTP_INTERNAL_ERROR,
				'Validation error',
				$data
			);
		}
	}

	public function index_post() {
		$_POST = json_decode(file_get_contents("php://input"), true);
		if ($this->penelitian_validation->add() == true) {
			$data = $this->penelitian_model->add();
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
			$data['error']    = [$this->form_validation->error_array()];
			self::response_failed(
				SELF::HTTP_INTERNAL_ERROR,
				'Validation error',
				$data
			);
		}
	}

	public function delete_post() {
		$_POST = json_decode(file_get_contents("php://input"), true);
		if ($this->penelitian_validation->delete()) {
			$data = $this->penelitian_model->delete();
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
