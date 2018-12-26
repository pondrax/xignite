<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pengisi_controller extends CI_Controller {
  function __construct() {
    parent::__construct();
    $this->load->model('xadmin/users/users');
    $this->load->model('xadmin/master/periode');
    $this->load->model('xadmin/bab_v/pengisi');
    $this->data=[
      'path'=>base_url('xadmin/bab_v/pengisi'),
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
      $id_urusan=$this->input->get('id_urusan','');
      $where="1=1";
      if($id_urusan!=''){
        $where=['id_urusan'=>$id_urusan];        
      }
      $this->data=Pengisi::select('users.id,instansi,master__periode.id,tahun,bab_v__pengisi.*')
                         ->join('tahun')
                         ->join('pengguna')
                         ->where($where)
                         ->table(null,$deleted_filter);
      jsonify($this->data);
    }
    else{
      if($this->input->get()){
        $this->data['get']=http_build_query($this->input->get());
      }
      $this->load->blade('xadmin/bab_v/master/pengisi',$this->data);
    }
  }
  
  public function form($mode=''){
    $id=$this->input->get('id');
    if(!$id){
      $data=[(object)[]];
    }else{
      $data=Pengisi::all(explode(',',$id));
    }
    $this->data['daftar_tugas']=[
      ['value'=>'Tugas Pembantuan','text'=>'Tugas Pembantuan'],
      ['value'=>'Dekonsentrasi','text'=>'Dekonsentrasi']
    ];
    $this->data['daftar_periode']=Periode::select('id as value,tahun as text')->all();
    $this->data['daftar_pengguna']=Users::select('id as value,instansi as text')->where('id_grup=5')->all();
    foreach($data as $i=>$d){
      if($mode=='copy'){unset($d->id);}
      $this->data['data']=$d;
      $this->load->blade('xadmin/bab_v/master/pengisi.form',$this->data);
    }
  }
  
  public function update(){
    $data=post_upload($this->data['upload_config'],true);
    if(!$data[0]['id']){
      jsonify(Pengisi::insert_batch($data));
    }else{
      jsonify(Pengisi::update_batch($data,'id'));
    }
  }
  
  public function remove($force_delete=false){
    $id=explode(',',$this->input->post('id'));
    if($id){
      $keys=implode(',',array_keys($_FILES));
      $files=Pengisi::select($keys)->all($id,'only_deleted');
      if($force_delete){
        remove_files($files);
      }
      jsonify(Pengisi::delete($id,$force_delete));
    }
  }
  
  public function restore(){
    $id=explode(',',$this->input->post('id'));
    jsonify(Pengisi::restore_batch($id));
  }
  public function test(){
    $data=Periode::user()->all();
    jsonbug($data);
  }
}
