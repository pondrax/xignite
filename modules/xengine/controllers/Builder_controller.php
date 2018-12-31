<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Builder_controller extends CI_Controller {
  function __construct() {
    parent::__construct();
    if(strtolower(ENVIRONMENT)!='development'){
      echo "Forbidden";
      exit;
    }
    ini_set('max_execution_time', 0);
    $this->data=[
      'assets'=>base_url('modules/xengine/assets'),
      'templates'=>base_url('modules/xengine/templates'),
      'modulepath'=>base_url('xengine/builder')
    ];
  }
  
  public function index(){
    $this->load->blade('xengine/builder/main',$this->data);
  }
  
}