<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Aduan_controller extends CI_Controller {
  function __construct() {
    parent::__construct();
    $this->load->model('xweb/aduan');
    $this->data=[
      'path'=>base_url('xweb/aduan'),
      'access'=>access_modul('users'),
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
    // debug($deleted_filter);
    $data=$this->data;
    if($json){
      $data=Aduan::table(null,$deleted_filter);
      jsonify($data);
    }
    else{
      $this->load->blade('xweb/aduan',$data);
    }
  }
  
  public function form($mode=''){
    $id=$this->input->get('id');
    if(!$id){
      $data=[[]];
    }else{
      $data=Aduan::all(explode(',',$id));
    }
    foreach($data as $i=>$d){
      if($mode=='copy'){unset($d->id);}
      $this->data['data']=$d;
      $this->load->blade('xweb/aduan.form',$this->data);
    }
  }
  
  public function update(){
    $data=post_upload($this->data['upload_config'],true);
    if(!$data[0]['id']){
      jsonify(Aduan::insert_batch($data));
    }else{
      jsonify(Aduan::update_batch($data,'id'));
    }
  }
  
  public function remove($force_delete=false){
    $id=explode(',',$this->input->post('id'));
    if($id){
      $keys=implode(',',array_keys($_FILES));
      $files=Aduan::select($keys)->all($id,'only_deleted');
      if($force_delete){
        remove_files($files);
      }
      jsonify(Aduan::delete($id,$force_delete));
    }
  }
  
  public function restore(){
    $id=explode(',',$this->input->post('id'));
    jsonify(Aduan::restore_batch($id));
  }
}
