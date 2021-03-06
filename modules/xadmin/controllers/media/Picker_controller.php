<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Picker_controller extends CI_Controller {
  function __construct() {
    parent::__construct();
    $this->load->model('xadmin/media/media');
    $this->data=[
      'path'=>base_url('xadmin/media/galeri'),
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
    $this->data['media']=Media::all();
    $this->load->blade('media/picker',$this->data);
  }
  
  public function view($json=null,$deleted_filter=false){
    // debug($deleted_filter);
    $data=$this->data;
    if($json){
      $data=Media::table(null,$deleted_filter);
      jsonify($data);
    }
    else{
      $this->load->blade('media/galeri',$data);
    }
  }
  
  public function form($mode=''){
    $id=$this->input->get('id');
    if(!$id){
      $data=[[]];
    }else{
      $data=Media::all(explode(',',$id));
    }
    foreach($data as $i=>$d){
      if($mode=='copy'){unset($d->id);}
      $this->data['data']=$d;
      $this->load->blade('media/galeri.form',$this->data);
    }
  }
  
  public function update(){
    $data=post_upload($this->data['upload_config'],true);
    if(!$data[0]['id']){
      jsonify(Media::insert_batch($data));
    }else{
      jsonify(Media::update_batch($data,'id'));
    }
  }
  
  public function remove($force_delete=false){
    $id=explode(',',$this->input->post('id'));
    if($id){
      $files=Media::select('url')->all($id,'only_deleted');
      if($force_delete){
        remove_files($files);
      }
      jsonify(Media::delete($id,$force_delete));
    }
  }
  
  public function restore(){
    $id=explode(',',$this->input->post('id'));
    jsonify(Media::restore_batch($id));
  }
}

