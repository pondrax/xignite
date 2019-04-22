<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tindakan_controller extends CI_Controller {
  function __construct() {
    parent::__construct();
    setlocale(LC_ALL, 'IND');
    setlocale(LC_ALL, 'id_ID');
    // $this->load->model('xweb/aduan');
    $this->load->model('xweb/tindak_lanjut');
  }
  function _remap($method='',$variable=[]){
    if($method==""){
      $this->index();
    }
    else if(method_exists($this,$method)){
      call_user_func(array($this, $method));
      return false;
    }
    else{
      array_unshift($variable,$method);
      $this->index($variable);
    }
  }	
  public function index(){
    $_GET['limit']=10;
    // $data['aduan']=Aduan::join('pengguna')
    $data['aduan']=Aduan::leftjoin('pengguna')
                        ->tindak_lanjut()
                        ->order_by('aduan.created_at','desc')
                        ->table();
    $this->load->blade('xweb/aduan/aduan',$data);
  }
  
  public function tambah(){
    $post=$this->input->post();
    unset($post['files']);
    
    $insert=Tindak_lanjut::insert($post);
    // jsonify($insert);
    header("Location: {$_SERVER['HTTP_REFERER']}");
    //   d($this->input->post());
    // $this->load->blade('xweb/aduan/aduan',$data);
  }
  

}
