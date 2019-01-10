<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Kamera_controller extends MX_Controller {
  function __construct() {
    parent::__construct();
    $this->load->model('xadmin/media/kamera');
    $this->data=[
      'path'=>base_url('xadmin/media/kamera'),
      'access'=>access_modul('media'),
      'logged'=>logged(true,'xadmin/auth'),
      'upload_config'=>[
        'file_name' => date('YmdHis'),
        'upload_path' => './public/uploads/'.logged()->username,
        'allowed_types' => '*',
        'max_size' => '2048000',
        // 'overwrite'=>true
      ]
    ];
  }
  
  public function index(){
    $this->load->blade('ui/main',$this->data);
  }
  
  public function view($json=null,$deleted_filter=false){
    if($json || $this->input->get('json')){
      $this->data=Kamera::table(null,$deleted_filter);
      jsonify($this->data);
    }
    else{
      $this->load->blade('media/kamera/kamera',$this->data);
    }
  }
  
  public function form($mode=''){
    $id=$this->input->get('id');
    if(!$id){
      $data=[[]];
    }else{
      $data=Kamera::all(explode(',',$id));
    }
    foreach($data as $i=>$d){
      if($mode=='copy'){unset($d->id);}
      $this->data['data']=$d;
      $this->load->blade('media/kamera/kamera.form',$this->data);
    }
  }
  
  public function update(){
    $data=post_upload($this->data['upload_config'],true);
    // d($data);
    if(!$data[0]['id']){
      jsonify(Kamera::insert_batch($data));
    }else{
      jsonify(Kamera::update_batch($data,'id'));
    }
  }
  
  public function remove($force_delete=false){
    $id=explode(',',$this->input->post('id'));
    if($id){
      jsonify(Kamera::delete($id,$force_delete));
    }
  }
  
  public function restore(){
    $id=explode(',',$this->input->post('id'));
    jsonify(Kamera::restore_batch($id));
  }
}

