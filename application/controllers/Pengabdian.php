<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengabdian extends API_Controller {

	function __construct() {
	    parent::__construct();
	    $this->load->model(array(
				'data/pengabdian_model', 
				'validation/pengabdian_validation'
			));
	}

	public function index_get() {
		$data = $this->pengabdian_model->index();
		self::response_ok('OK', $data);
	}

	public function detail_get() {
		$_GET = json_decode(file_get_contents("php://input"), true);
		if ($this->pengabdian_validation->detail()) {
			$data = $this->pengabdian_model->detail();
			self::response_ok('OK', $data);
		} else {
			$data['error']    = $this->form_validation->error_array();
			self::response_failed(
				SELF::HTTP_INTERNAL_ERROR,
				'Validation error',
				$data,
			);
		}
	}

	public function index_post() {
		if ($this->pengabdian_validation->add()) {
			$data = $this->pengabdian_model->add();
			if(array_key_exists('error', $data)){
				self::response_failed(
					SELF::HTTP_INTERNAL_ERROR,
					'Validation error',
					$data,
				);
			} else {
				self::response_ok('OK', $data);
			}
		} else {
			$data['error']    = $this->form_validation->error_array();
			self::response_failed(
				SELF::HTTP_INTERNAL_ERROR,
				'Validation error',
				$data,
			);
		}
	}

	public function index_delete() {
		$_POST = json_decode(file_get_contents("php://input"), true);
		if ($this->pengabdian_validation->delete()) {
			$data = $this->pengabdian_model->delete();
			self::response_ok('OK', $data);
		} else {
			$data['error']    = $this->form_validation->error_array();
			self::response_failed(
				SELF::HTTP_INTERNAL_ERROR,
				'Validation error',
				$data,
			);
		}
	}
}
