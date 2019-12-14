<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengabdian extends API_Controller {

	function __construct() {
	    parent::__construct();
	    $this->load->model([
			'data/pengabdian_model', 
			'validation/pengabdian_validation'
		]);
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
		if ($this->pengabdian_validation->add()) {
			$data = $this->pengabdian_model->add();
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
			$data['result'] = $this->form_validation->error_array();
			self::response_failed(
				SELF::HTTP_OK,
				'Validation error',
				$data
			);
		}
	}

	public function picture_post(){
	    $_POST = json_decode(file_get_contents("php://input"), true);
		$data = $this->mengajar_model->picture_post();
		self::response_ok('OK',$data);
	}

	public function delete_post() {
		$_POST = json_decode(file_get_contents("php://input"), true);
		if ($this->pengabdian_validation->delete()) {
			$data = $this->pengabdian_model->delete();
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
