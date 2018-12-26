<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_controller extends CI_Controller {
  function __construct() {
    parent::__construct();
    $this->load->model('xadmin/bab_iii/pengisi');
    $this->load->model('xadmin/bab_iii/laporan');
    $this->data=[
      'path'=>base_url('xadmin/bab_iii/laporan'),
      'access'=>access_modul('bab1'),
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
    $logged=logged();
    $where=['id_tahun'=>$logged->id_tahun];
    $this->data['pengisi']=true;
    if($logged->id_grup>=4){
      $where['id_user']=$logged->id;
      $this->data['pengisi']=Pengisi::select('id')->one(['id_user'=>$logged->id]);
    }
    
    if($json){
      $this->data=Laporan::table(null,$deleted_filter);
      jsonify($this->data);
    }
    else{
      $this->load->blade('xadmin/bab_iii/laporan/laporan',$this->data);
    }
  }
  
  public function form($mode=''){
    $id=$this->input->get('id');
    if(!$id){
      $data=[(object)[]];
    }else{
      $data=Laporan::all(explode(',',$id));
    }
    
    foreach($data as $i=>$d){
      if($mode=='copy'){unset($d->id);}
      $this->data['data']=$d;
      $this->load->blade('xadmin/bab_iii/laporan/laporan.form',$this->data);
    }
  }
  
  public function update(){
    $data=post_upload($this->data['upload_config'],true);
    if(!$data[0]['id']){
      jsonify(Laporan::insert_batch($data));
    }else{
      jsonify(Laporan::update_batch($data,'id'));
    }
  }
  
  public function remove($force_delete=false){
    $id=explode(',',$this->input->post('id'));
    if($id){
      $keys=implode(',',array_keys($_FILES));
      $files=Laporan::select($keys)->all($id,'only_deleted');
      if($force_delete){
        remove_files($files);
      }
      jsonify(Laporan::delete($id,$force_delete));
    }
  }
  
  public function restore(){
    $id=explode(',',$this->input->post('id'));
    jsonify(Laporan::restore_batch($id));
  }
}
