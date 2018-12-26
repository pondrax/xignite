<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dbtest_controller extends CI_Controller {
  function __construct() {
    parent::__construct();
    $this->load->model('welcome/test');
  }
  
	public function index(){
    $this->view();
  }
  
  public function view(){  
    mark_start();
    $data=$this->users
      // ->select('id,username,email')
      // ->search('test','username,email')
      // ->details(['select'=>'user_id,first_name,last_name,address'])
      // ->posts(['select'=>'user_id,title'])
      // ->fetch([3,4,5]);
      ->fetch();
      // ->table();
    jsonify($data);
    mark_end();
    echo "<br><br>";
  }
  
  public function form(){
    
  }
  
  public function update($id=null){
    // $data=$this->input->post();
    $data=['email'=>'test'];
    if(!$id){
      return $this->user->insert($data);
    }else{
      return $this->user->update($id,$data);
    }
  }
  
  public function remove($id=null){
    if($id){
      return $this->user->delete($id);
    }
  }
}
