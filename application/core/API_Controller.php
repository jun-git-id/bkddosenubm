<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* 
*/
// require_once('core_app/libraries/REST_Controller.php');
require_once(APPPATH.'libraries/REST_Controller.php');

use chriskacerguis\RestServer\RestController as REST_Controller;

class API_Controller extends REST_Controller
{

  function __construct()
  {
    parent::__construct();
  }
  
  function force_response($data, $http_code){
    $this->response($data, $http_code);
    $this->output
         ->_display();
    exit;
  }

  function response_ok($data, $append = array()){
    $response = [
        'status' => true,
        'code' => SELF::HTTP_OK,
        'result' => $data
    ];
    if(!empty($append) && is_array($append)){
        $response = array_merge($response, $append);
    }
    self::force_response($response, SELF::HTTP_OK);        
  }

  function response_failed($code, $message = 'Unauthorized', $append = array()){
    $response = [
        'status' => FALSE,
        'code'   => $code,
        'message' => $message
    ];

    if(!empty($append) && is_array($append)){
        $response = array_merge($response, $append);
    }
    self::force_response($response, $code);        
  }

}