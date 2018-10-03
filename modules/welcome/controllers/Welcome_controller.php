<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome_controller extends CI_Controller {
  function __construct() {
    parent::__construct();
    $this->load->model('welcome/users');
    $this->data=[
      'APP_NAME'=>APP_NAME
    ];
}
  
	public function index()	{
		$this->load->blade('welcome',$this->data);
	}
  public function test(){
    // debug(Groups::all());
    debug(Users::select()->groups()->all());
    // $data=$this->users->fetch();
    // echo json_encode($data);
    // echo $data;
  }
}
