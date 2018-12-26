<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Deskripsi_controller extends CI_Controller {
  function __construct() {
    parent::__construct();
    $this->load->model('xadmin/master/periode');
    $this->load->model('xadmin/bab_v/pengisi');
    $this->load->model('xadmin/bab_v/deskripsi');
    $this->data=[
      'path'=>base_url('xadmin/bab_v/deskripsi'),
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
    if($logged->id_grup>=4){
      $where['id_user']=$logged->id;
      $this->data['pengisi']=Pengisi::select('id')->one(['id_user'=>$logged->id]);
    }
    
    if($json){
      $this->data=Deskripsi::select('users.id,instansi,master__periode.id,tahun,bab_v__deskripsi.*')
                   ->join('pengguna')
                   ->join('periode')
                   ->where($where)
                   ->table(null,$deleted_filter);
      jsonify($this->data);
    }
    else{
      $this->load->blade('xadmin/bab_v/deskripsi/deskripsi',$this->data);
    }
  }
  
  public function form($mode=''){
    $id=$this->input->get('id');    
    $logged=logged();
    $where=['id_tahun'=>$logged->id_tahun];
    $where_pengisi="1=1";
    if($logged->id_grup>=4){
      $where['id_user']=$logged->id;
      $where_pengisi=['id_user'=>$logged->id];
    }
    
    $this->data['daftar_tugas']=Pengisi::select('bab as value, bab as text')->group_by('bab')->all($where);
    
    $this->data['daftar_periode']=Periode::select('tahun as text,id as value')->all();
    $this->data['daftar_pengguna']=Pengisi::join('pengguna')
                    ->select('instansi as text,id_user as value')
                    ->where($where_pengisi)
                    ->all();
    if(!$id){
      $data=[(object)[]];
    }else{
      $data=Deskripsi::all($where);
    }
    foreach($data as $i=>$d){
      if($mode=='copy'){unset($d->id);}
      $this->data['data']=$d;
      $this->load->blade('xadmin/bab_v/deskripsi/deskripsi.form',$this->data);
    }
  }
  
  public function update(){
    $data=post_upload($this->data['upload_config'],true);
    if(!$data[0]['id']){
      jsonify(Deskripsi::insert_batch($data));
    }else{
      jsonify(Deskripsi::update_batch($data,'id'));
    }
  }
  
  public function remove($force_delete=false){
    $id=explode(',',$this->input->post('id'));
    if($id){
      $keys=implode(',',array_keys($_FILES));
      $files=Deskripsi::select($keys)->all($id,'only_deleted');
      if($force_delete){
        remove_files($files);
      }
      jsonify(Deskripsi::delete($id,$force_delete));
    }
  }
  
  public function restore(){
    $id=explode(',',$this->input->post('id'));
    jsonify(Deskripsi::restore_batch($id));
  }
}
