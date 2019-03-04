<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Galeri_controller extends MX_Controller {
  function __construct() {
    parent::__construct();
    $this->load->model('xadmin/media/galeri');
    $this->data=[
      'path'=>base_url('xadmin/media/galeri'),
      'access'=>access_modul('media'),
      'logged'=>logged(true,'xadmin/auth'),
      'upload_config'=>[
        'file_name' => date('YmdHis'),
        'upload_path' => './public/uploads/'.logged()->username,
        'allowed_types' => 'jpeg|jpg|png|gif|pdf',
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
      $this->data=Galeri::table(null,$deleted_filter);
      jsonify($this->data);
    }
    else{
      $this->load->blade('media/galeri/galeri',$this->data);
    }
  }
  
  public function form($mode='',$clone=0){
    $id=$this->input->get('id');
    if(!$id){
      $data=[[]];
      clone_array($data,$clone);
    }else{
      $data=Galeri::all(explode(',',$id));
    }
    foreach($data as $i=>$d){
      if($mode=='copy'){unset($d->id);}
      $this->data['data']=$d;
      $this->load->blade('media/galeri/galeri.form',$this->data);
    }
  }
  
  public function update(){
    $data=post_upload($this->data['upload_config'],true);
    // d($data);
    
    if(!$data[0]['id']){
      jsonify(Galeri::insert_batch($data));
    }else{
      jsonify(Galeri::update_batch($data,'id'));
    }
  }
  
  public function remove($force_delete=false){
    $id=explode(',',$this->input->post('id'));
    if($id){
      $files=Galeri::select('url')->all($id,'only_deleted');
      if($force_delete){
        remove_files($files);
      }
      jsonify(Galeri::delete($id,$force_delete));
    }
  }
  
  public function restore(){
    $id=explode(',',$this->input->post('id'));
    jsonify(Galeri::restore_batch($id));
  }
}

