<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aduan_controller extends CI_Controller {
  function __construct() {
    parent::__construct();
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
      $this->view($variable);
    }
  }	
  public function index(){
    
    $this->load->model('xweb/aduan');
    $data['aduan']=Aduan::pengguna()
                   ->order_by('created_at','desc')
                   ->limit(10)
                   ->table();
    $this->load->blade('xweb/aduan',$data);
  }

	function view($variable=[]){
    if(true){
    d($variable);
    }
    else{
      // $this->load->blade('xweb/page',$data);      
      show_404();
    }

	}	
}
