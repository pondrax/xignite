<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Xweb_controller extends CI_Controller {
  function __construct() {
    parent::__construct();
  }
  
  public function index(){
    $this->load->model('xweb/media/media');
    $this->load->model('xweb/aduan');
    $data['media']=Media::table();
    
    $data['aduan']=Aduan::pengguna()->order_by('created_at','desc')->limit(10)->all();
    $this->load->blade('xweb/home',$data);
  }
}
