<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_controller extends CI_Controller {
  function __construct() {
    parent::__construct();
    $this->load->library('form_validation');
    $this->data=[
      'path'=>base_url('xadmin/home'),
      'logged'=>logged(true)
    ];
  }
  
  public function index(){
    $this->load->blade('main',$this->data);
  }
  
  public function view(){
    echo "You are here";
  }
}
