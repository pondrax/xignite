<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Periode_controller extends CI_Controller {
  function __construct() {
    parent::__construct();
    $this->load->model('xadmin/users/users');
    $this->load->model('xadmin/master/pengisi');
    $this->load->model('xadmin/master/periode');
    $this->data=[
      'path'=>base_url('xadmin/master/periode'),
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
    if($json){
      $this->data=Periode::pengisi(['select'=>'id,instansi'])
                   ->table(null,$deleted_filter);
      jsonify($this->data);
    }
    else{
      $this->load->blade('xadmin/master/periode',$this->data);
    }
  }
  
  public function form($mode=''){
    $id=$this->input->get('id');
    if(!$id){
      $data=[[]];
    }else{
      $data=Periode::all(explode(',',$id));
    }
    $this->data['daftar_pengguna']=Users::select('id as value,instansi as text')->all(['id_grup'=>5]);
    foreach($data as $i=>$d){
      if($mode=='copy'){unset($d->id);}
      $this->data['data']=$d;
      $this->load->blade('xadmin/master/periode.form',$this->data);
    }
  }
  
  public function update(){
    $data=post_upload($this->data['upload_config'],true);
    foreach($data as $i=>$d){
      $data[$i]['pengisi']=implode(',',$d);
    }
    debug($data);
    // // $data=$this->input->post();
    // $relation=related_data($post);
    // $data=$relation['data'];
    // $related=$relation['related'];
    if(!$data[0]['id']){
      jsonify(Periode::insert_batch($data));
    }else{
      
      jsonify(Periode::update_batch($data,'id'));
      // foreach($related as $r){
        // debug($r);
        
      // }
    }
  }
  
  public function remove($force_delete=false){
    $id=explode(',',$this->input->post('id'));
    if($id){
      $keys=implode(',',array_keys($_FILES));
      $files=Periode::select($keys)->all($id,'only_deleted');
      if($force_delete){
        remove_files($files);
      }
      jsonify(Periode::delete($id,$force_delete));
    }
  }
  
  public function restore(){
    $id=explode(',',$this->input->post('id'));
    jsonify(Periode::restore_batch($id));
  }
}
