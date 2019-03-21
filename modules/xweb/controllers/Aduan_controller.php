<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aduan_controller extends CI_Controller {
  function __construct() {
    parent::__construct();
    setlocale(LC_ALL, 'IND');
    $this->load->model('xweb/aduan');
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
      $this->single($variable);
    }
  }	
  public function index(){
    $_GET['limit']=10;
    $data['aduan']=Aduan::join('pengguna')
                   ->order_by('aduan.created_at','desc')
                   ->table();
    $this->load->blade('xweb/aduan/aduan',$data);
  }

	function single($variable=[]){
    $slug=$variable[0];
    $data['aduan']=Aduan::join('pengguna')->one(['slug'=>$slug]);
    if($data['aduan']){
      $data['aduan']->view+=1;
      Aduan::update($data['aduan']->id,['view'=>$data['aduan']->view],false);
      $this->load->blade('xweb/aduan/detail',$data);
    }else{
      show_404();
    }
  }	
}
