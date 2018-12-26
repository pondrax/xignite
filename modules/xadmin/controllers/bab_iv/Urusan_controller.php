<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Urusan_controller extends CI_Controller {
  function __construct() {
    parent::__construct();
    $this->load->model('xadmin/users/users');
    $this->load->model('xadmin/master/periode');
    $this->load->model('xadmin/bab_iv/urusan');
    $this->data=[
      'path'=>base_url('xadmin/bab_iv/urusan'),
      'access'=>access_modul('bab4'),
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
      $this->data=Urusan::select('master__periode.id,tahun,bab_iv__urusan.*')
                   // ->join('pengguna')
                   ->join('periode')
                   ->table(null,$deleted_filter);
      jsonify($this->data);
    }
    else{
      $this->load->blade('xadmin/bab_iv/urusan/urusan',$this->data);
    }
  }
  
  public function form($mode=''){
    $id=$this->input->get('id');
    if(!$id){
      $data=[(object)[]];
    }else{
      $data=Urusan::all(explode(',',$id));
    }
    $this->data['daftar_periode']=Periode::select('tahun as text,id as value')->all();
    foreach($data as $i=>$d){
      if($mode=='copy'){unset($d->id);}
      $this->data['data']=$d;
      $this->load->blade('xadmin/bab_iv/urusan/urusan.form',$this->data);
    }
  }
  
  public function update(){
    $data=post_upload($this->data['upload_config'],true);
    // $pengisi=[];
    // foreach($data as $i=>$d){
      // $data[$i]['pengisi']=implode(',',$d['pengisi']);
    // }
    if(!$data[0]['id']){
      jsonify(Urusan::insert_batch($data));
    }else{
      jsonify(Urusan::update_batch($data,'id'));
    }
  }
  
  public function remove($force_delete=false){
    $id=explode(',',$this->input->post('id'));
    if($id){
      $keys=implode(',',array_keys($_FILES));
      $files=Urusan::select($keys)->all($id,'only_deleted');
      if($force_delete){
        remove_files($files);
      }
      jsonify(Urusan::delete($id,$force_delete));
    }
  }
  
  public function restore(){
    $id=explode(',',$this->input->post('id'));
    jsonify(Urusan::restore_batch($id));
  }
}
