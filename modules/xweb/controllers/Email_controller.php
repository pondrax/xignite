<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email_controller extends CI_Controller {
  function __construct() {
    parent::__construct();
    setlocale(LC_ALL, 'IND');
    $this->load->model('xadmin/master/pengguna');
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
    $this->load->library('email');

    $this->email->from('wadul@jatimprov.go.id', 'Your Name');
    $this->email->to('pondrax3@gmail.com');
    // $this->email->cc('another@another-example.com');
    // $this->email->bcc('them@their-example.com');

    $this->email->subject('Email Test');
    $this->email->message('Testing the email class.');

    $this->email->send();
    print_r($this->email->print_debugger(), true);


  }

	function single($variable=[]){
    $slug=$variable[0];
    $data['aduan']=Aduan::join('pengguna')->one(['slug'=>$slug]);
    if($data['aduan']){
      $data['aduan']->view+=1;
      Aduan::update($data['aduan']->id,['view'=>$data['aduan']->view],false);
      $this->load->blade('xweb/detail',$data);
    }else{
      show_404();
    }
  }	
  
}
