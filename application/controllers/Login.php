<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends API_Controller {

	function __construct() {
	    parent::__construct();
	    $this->load->model(array(
				'data/login_model', 
				'validation/login_validation'
			));
  }
  
  public function index_post(){
		$_POST = json_decode(file_get_contents("php://input"), true);
    if ($this->login_validation->index()) {
			$data = $this->login_model->index();
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

  public function change_password_post(){
    if ($this->login_validation->change_password()) {
			$data = $this->login_model->change_password();
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