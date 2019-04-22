<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Xweb_controller extends MX_Controller {
  function __construct() {
    parent::__construct();
    setlocale (LC_TIME, 'id_ID');
    setlocale (LC_TIME, 'IND');
  }
  
  public function index(){
    $this->load->model('xweb/aduan');
    $this->load->model('xweb/kategori');
    
    $where=['id_status>'=>1,'rahasia'=>0];
    $data['aduan']=Aduan::leftjoin('pengguna')
                        ->tindak_lanjut()
                        ->order_by('aduan.created_at','desc')
                        ->all($where);
    $data['kategori']=Kategori::select("id as value, kategori as text")->all();
    $this->load->blade('xweb/home',$data);
  }
  public function logout(){
    $this->session->sess_destroy();
    header('Location: '.base_url());
  }
}
