<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengguna_controller extends CI_Controller {
  function __construct() {
    parent::__construct();
    $this->load->model('xadmin/users/users');
    $this->load->model('xadmin/users/groups');
    $this->data=[
      'path'=>base_url('xadmin/users/pengguna'),
      'logged'=>logged(true)
    ];
  }
  
  public function index(){
    $this->load->blade('main',$this->data);
  }
  
  public function view($json=null,$deleted_filter=false){
    $data=$this->data;
    if($json){
      $data=Users::select('id,grup_id,username,email')
            ->groups(['select'=>'id,nama_grup'])
            ->table(null,$deleted_filter);
      jsonify($data);
    }
    else{
      $this->load->blade('users/pengguna',$data);
    }
  }
  
  public function form($id=null){
    $data=$this->data;
    if(!$id){
      $data['data']=[];
    }else{
      $data['data']=Users::groups()->one($id);
    }
    $data['daftar_grup']=Groups::select('nama_grup as text,id as grup_id')->all();
    
    $this->load->blade('users/pengguna.form',$data);
  }
  
  public function update($id=null){
    $data=$this->input->post();
    if(!$id){
      jsonify(Users::insert($data));
    }
    else{
      jsonify(Users::update($id,$data));
    }
  }
  
  public function remove($force_delete=false){
    $id=explode(',',$this->input->post('id'));
    if($id){
      jsonify(Users::delete($id,$force_delete));
    }
  }
  
  public function restore(){
    $id=$this->input->post('id');
    jsonify(Users::restore($id));
  }
}
