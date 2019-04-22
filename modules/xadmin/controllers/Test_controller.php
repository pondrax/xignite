<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Test_controller extends CI_Controller {
  function __construct() {
    parent::__construct();
    $this->load->model('xadmin/test');
    // $this->data=[
    //   'path'=>base_url('xadmin/test'),
    //   'access'=>access_modul('users'),
    //   //'logged'=>logged(true,'xadmin/auth'),
    //   'upload_config'=>[
    //     'file_name' => date('YmdHis'),
    //     'upload_path' => './public/uploads/'.logged()->username,
    //     'allowed_types' => '*',
    //     'max_size' => '2048000',
    //     // 'overwrite'=>true
    //   ]
    // ];
  }
  
  public function index(){
    $this->load->blade('ui/main',$this->data);
  }
  public function test(){
      d(Test::all());
      d(Test::table());
  }
  public function view($json=null,$deleted_filter=false){
    // debug($deleted_filter);
    $data=$this->data;
    if($json){
      $data=Test::table(null,$deleted_filter);
      jsonify($data);
    }
    else{
      $this->load->blade('xadmin/test',$data);
    }
  }
  
  public function form($mode=''){
    $id=$this->input->get('id');
    if(!$id){
      $data=[[]];
    }else{
      $data=Test::all(explode(',',$id));
    }
    foreach($data as $i=>$d){
      if($mode=='copy'){unset($d->id);}
      $this->data['data']=$d;
      $this->load->blade('xadmin/test.form',$this->data);
    }
  }
  
  public function update(){
    $data=post_upload($this->data['upload_config'],true);
    if(!$data[0]['id']){
      jsonify(Test::insert_batch($data));
    }else{
      jsonify(Test::update_batch($data,'id'));
    }
  }
  
  public function remove($force_delete=false){
    $id=explode(',',$this->input->post('id'));
    if($id){
      $keys=implode(',',array_keys($_FILES));
      $files=Test::select($keys)->all($id,'only_deleted');
      if($force_delete){
        remove_files($files);
      }
      jsonify(Test::delete($id,$force_delete));
    }
  }
  
  public function restore(){
    $id=explode(',',$this->input->post('id'));
    jsonify(Test::restore_batch($id));
  }
}
