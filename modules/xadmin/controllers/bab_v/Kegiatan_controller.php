<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Kegiatan_controller extends CI_Controller {
  function __construct() {
    parent::__construct();
    $this->load->model('xadmin/bab_v/pengisi');
    $this->load->model('xadmin/bab_v/program');
    $this->load->model('xadmin/bab_v/kegiatan');
    $this->data=[
      'path'=>base_url('xadmin/bab_v/kegiatan'),
      'access'=>access_modul('bab5'),
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
    if($logged->id_grup==5){
      $where['id_user']=$logged->id;
      $this->data['pengisi']=Pengisi::select('id')->one(['id_user'=>$logged->id]);
    }
    
    
    if($json){    
      $program=Program::select('id')->all($where);
      $id_program=[0];
      foreach($program as $p){
        $id_program[]=$p->id;
      }

      $this->data=Kegiatan::select('*')
                   ->program([
                      'select'=>'users.id,instansi,bab_v__program.*',
                      'join'=>'pengguna',
                      'where'=>$where
                     ])
                   ->where_in('id_program',$id_program)
                   ->table(null,$deleted_filter);
      jsonify($this->data);
    }
    else{
      $this->load->blade('xadmin/bab_v/kegiatan/kegiatan',$this->data);
    }
  }
  
  public function form($mode=''){
    $id=$this->input->get('id');    
    $logged=logged();
    $where=['id_tahun'=>$logged->id_tahun];
    if($logged->id_grup>=4){
      $where['id_user']=$logged->id;
    }
    
    
    $this->data['daftar_program']=Program::select('program as text,id as value')->all($where);
    
    if(!$id){
      $data=[[]];
    }else{
      $data=Kegiatan::all(explode(',',$id));
    }
    foreach($data as $i=>$d){
      if($mode=='copy'){unset($d->id);}
      $this->data['data']=$d;
      $this->load->blade('xadmin/bab_v/kegiatan/kegiatan.form',$this->data);
    }
  }
  
  public function update(){
    $data=post_upload($this->data['upload_config'],true);
    if(!$data[0]['id']){
      jsonify(Kegiatan::insert_batch($data));
    }else{
      jsonify(Kegiatan::update_batch($data,'id'));
    }
  }
  
  public function remove($force_delete=false){
    $id=explode(',',$this->input->post('id'));
    if($id){
      $keys=implode(',',array_keys($_FILES));
      $files=Kegiatan::select($keys)->all($id,'only_deleted');
      if($force_delete){
        remove_files($files);
      }
      jsonify(Kegiatan::delete($id,$force_delete));
    }
  }
  
  public function restore(){
    $id=explode(',',$this->input->post('id'));
    jsonify(Kegiatan::restore_batch($id));
  }
}
