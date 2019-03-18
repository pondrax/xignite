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
    $data['aduan']=Aduan::pengguna()
                   ->order_by('created_at','desc')
                   ->table();
    $this->load->blade('xweb/aduan',$data);
  }

	function single($variable=[]){
    $data['aduan']=Aduan::join('pengguna')->one(['slug'=>$variable[0]]);
    if($data['aduan']){
      $this->load->blade('xweb/detail',$data);
    }else{
      show_404();
    }
  }	
}
