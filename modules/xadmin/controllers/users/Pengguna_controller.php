<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pengguna_controller extends MX_Controller {
  function __construct() {
    parent::__construct();
    $this->load->model('xadmin/users/users');
    $this->load->model('xadmin/users/groups');
    $this->data=[
      'path'=>base_url('xadmin/users/pengguna'),
      'access'=>access_modul('users'),
      'logged'=>logged(true,'xadmin/auth'),
    ];
  }
  
  public function index(){
    $this->load->blade('ui/main',$this->data);
  }
  
  public function view($json=null,$deleted_filter=false){
    // debug($deleted_filter);
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
  
  public function form($mode=''){
    $id=$this->input->get('id');
    if(!$id){
      $data=[[]];
    }else{
      $data=Users::groups()->all(explode(',',$id));
    }
    $this->data['daftar_grup']=Groups::select('nama_grup as text,id as value')
                             ->all();
    foreach($data as $i=>$d){
      if($mode=='copy'){unset($d->id);}
      $this->data['data']=$d;
      $this->load->blade('users/pengguna.form',$this->data);
    }
  }
  
  public function update(){
    $data=$this->input->post();
    if(!$data[0]['id']){
      jsonify(users::insert_batch($data));
    }else{
      jsonify(users::update_batch($data,'id'));
    }
  }
  
  public function remove($force_delete=false){
    $id=explode(',',$this->input->post('id'));
    if($id){
      jsonify(users::delete($id,$force_delete));
    }
  }
  
  public function restore(){
    $id=explode(',',$this->input->post('id'));
    jsonify(users::restore_batch($id));
  }
}

