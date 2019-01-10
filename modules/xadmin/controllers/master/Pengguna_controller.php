<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pengguna_controller extends MX_Controller {
  function __construct() {
    parent::__construct();
    $this->load->model('xadmin/master/pengguna');
    $this->load->model('xadmin/master/grup');
    $this->data=[
      'path'=>base_url('xadmin/master/pengguna'),
      'access'=>access_modul('master'),
      'logged'=>logged(true,'xadmin/auth'),
    ];
  }
  
  public function index(){
    $this->load->blade('ui/main',$this->data);
  }
  
  public function view($json=null,$deleted_filter=false){
    if($json || $this->input->get('json')){
      $data=Pengguna::join('grup')->table(null,$deleted_filter);
      jsonify($data);
    }
    else{
      $this->load->blade('master/pengguna/pengguna',$this->data);
    }
  }
  
  public function form($mode=''){
    $id=$this->input->get('id');
    if(!$id){
      $data=[[]];
    }else{
      $data=Pengguna::grup()->all(explode(',',$id));
    }
    $this->data['daftar_grup']=Grup::select('nama_grup as text,id as value')
                             ->all();
    foreach($data as $i=>$d){
      if($mode=='copy'){unset($d->id);}
      $this->data['data']=$d;
      $this->load->blade('master/pengguna/pengguna.form',$this->data);
    }
  }
  
  public function update(){
    $data=$this->input->post();
    
    if(!$data[0]['id']){
      jsonify(Pengguna::insert_batch($data));
    }else{
      jsonify(Pengguna::update_batch($data,'id'));
    }
  }
  
  public function remove($force_delete=false){
    $id=explode(',',$this->input->post('id'));
    if($id){
      jsonify(Pengguna::delete($id,$force_delete));
    }
  }
  
  public function restore(){
    $id=explode(',',$this->input->post('id'));
    jsonify(Pengguna::restore_batch($id));
  }
}

