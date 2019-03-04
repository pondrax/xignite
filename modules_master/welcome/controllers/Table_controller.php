<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Table_controller extends CI_Controller {
  function __construct() {
    parent::__construct();
    $this->load->model('welcome/users');
  }
  
  public function index(){
    $this->blade->render('table');
    // $this->view();
  }
  
  public function view(){  
    // mark_start();
    $data=$this->users
      // ->select('id,username,email')
      // ->search('test','username,email')
      ->details(['select'=>'user_id,first_name,last_name,address'])
      ->posts(['select'=>'user_id,title'])
      // ->fetch([3,4,5]);
      // ->fetch();
      ->fetch_table();
    // echo json_encode($data,JSON_PRETTY_PRINT);
    jsonify($data);
    // mark_end();
    // echo "<br><br>";
  }
  
  public function form(){
    
  }
  
  public function update($id=null){
    // $data=$this->input->post();
    $data=['email'=>'test'];
    if(!$id){
      return $this->users->insert($data);
    }else{
      return $this->users->update($id,$data);
    }
  }
  
  public function remove($id=null){
    // $id=$this->input->post('id');
    if($id){
      return $this->users->delete($id);
    }
  }
}
