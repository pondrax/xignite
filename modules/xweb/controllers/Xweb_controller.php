<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Xweb_controller extends MX_Controller {
  function __construct() {
    parent::__construct();
    setlocale (LC_TIME, 'id_ID');
    setlocale (LC_TIME, 'IND');
  }
  
  public function index(){
    $this->load->model('xweb/media/media');
    $this->load->model('xweb/aduan');
    $data['media']=Media::table();
    
    $data['aduan']=Aduan::join('pengguna')
                   ->where('aktif',1)
                   ->order_by('aduan.created_at','desc')
                   ->all();
    $this->load->blade('xweb/home',$data);
  }
  public function logout(){
    $this->session->sess_destroy();
    header('Location: '.base_url());
  }
}
