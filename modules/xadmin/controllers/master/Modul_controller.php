<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Modul_controller extends MX_Controller {
  function __construct() {
    parent::__construct();
    $this->load->model('xadmin/master/modul');
    $this->data=[
      'path'=>base_url('xadmin/master/modul'),
      'access'=>access_modul('master'),
      'logged'=>logged(true,'xadmin/auth'),
    ];
  }
  
  public function index(){
    $this->load->blade('ui/main',$this->data);
  }
  
  public function view($json=null,$deleted_filter=false){
    if($json || $this->input->get('json')){
      $data=Modul::table(null,$deleted_filter);
      jsonify($data);
    }
    else{
      $this->load->blade('master/modul/modul',$this->data);
    }
  }
  
  public function form($mode='',$clone=0){
    $id=$this->input->get('id');
    if(!$id){
      $data=[[]];
      clone_array($data,$clone);
    }else{
      $data=Modul::all(explode(',',$id));
    }
    foreach($data as $i=>$d){
      if($mode=='copy'){unset($d->id);}
      $this->data['data']=$d;
      $this->load->blade('master/modul/modul.form',$this->data);
    }
  }
  
  public function update(){
    $data=$this->input->post();
    if(!$data[0]['id']){
      jsonify(Modul::insert_batch($data));
    }else{
      jsonify(Modul::update_batch($data,'id'));
    }
  }
  
  public function remove($force_delete=false){
    $id=explode(',',$this->input->post('id'));
    if($id){
      jsonify(Modul::delete($id,$force_delete));
    }
  }
  
  public function restore(){
    $id=explode(',',$this->input->post('id'));
    jsonify(Modul::restore_batch($id));
  }
}

