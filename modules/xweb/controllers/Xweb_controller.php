<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Xweb_controller extends CI_Controller {
  function __construct() {
    parent::__construct();
  }
  
  public function index(){
    $this->load->model('xweb/media/media');
    $data['media']=Media::table();
    $this->load->blade('xweb/home',$data);
  }
}
