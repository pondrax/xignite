<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Grup_controller extends MX_Controller {
  function __construct() {
    parent::__construct();
    $this->load->model('xadmin/master/grup');
    $this->load->model('xadmin/master/modul');
    $this->data=[
      'path'=>base_url('xadmin/master/grup'),
      'access'=>access_modul('master'),
      'logged'=>logged(true,'xadmin/auth'),
    ];
  }
  
  public function index(){
    $this->load->blade('ui/main',$this->data);
  }
  
  public function view($json=null,$deleted_filter=false){
    if($json || $this->input->get('json')){
      $data=Grup::table(null,$deleted_filter);
      jsonify($data);
    }
    else{
      $modul=Modul::select('id,nama_modul')->all();
      $this->data['daftar_modul']=remap('id',$modul);
      $this->load->blade('master/grup/grup',$this->data);
    }
  }
  
  public function form($mode='',$clone=0){
    $id=$this->input->get('id');
    if(!$id){
      $data=[[]];
      clone_array($data,$clone);
    }else{
      $data=Grup::all(explode(',',$id));
    }
    
    $this->data['daftar_modul']=Modul::select('id as value,nama_modul as text')->all();
    foreach($data as $i=>$d){
      if($mode=='copy'){unset($d->id);}
      $this->data['data']=$d;
      $this->load->blade('master/grup/grup.form',$this->data);
    }
  }
  
  public function update(){
    $data=$this->input->post();
    if(!$data[0]['id']){
      jsonify(Grup::insert_batch($data));
    }else{
      jsonify(Grup::update_batch($data,'id'));
    }
  }
  
  public function remove($force_delete=false){
    $id=explode(',',$this->input->post('id'));
    if($id){
      jsonify(Grup::delete($id,$force_delete));
    }
  }
  
  public function restore(){
    $id=explode(',',$this->input->post('id'));
    jsonify(Grup::restore_batch($id));
  }
}

