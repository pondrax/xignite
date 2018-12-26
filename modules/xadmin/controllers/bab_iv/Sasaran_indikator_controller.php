<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Sasaran_indikator_controller extends CI_Controller {
  function __construct() {
    parent::__construct();
    $this->load->model('xadmin/bab_iv/pengisi');
    $this->load->model('xadmin/bab_iv/sasaran');
    $this->load->model('xadmin/bab_iv/sasaran_indikator');
    $this->data=[
      'path'=>base_url('xadmin/bab_iv/sasaran_indikator'),
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
    $id_sasaran=$this->input->get('id_sasaran','');
    $logged=logged();
    $where=['id_tahun'=>$logged->id_tahun];
    if($logged->id_grup==4){
      $where['id_user']=Users::one(['username'=>$logged->username.'.1'])->id;
      $this->data['access']='readable';
    }
    if($logged->id_grup==5){
      $where['id_user']=$logged->id;
      $kunci=Pengisi::one(['id_user'=>$logged->id])->kunci;
      if($kunci!=0){
        $this->data['access']='readable';
      }
    }
    if($id_sasaran!=''){
      $where=['id_sasaran'=>$id_sasaran];        
    }
    
    if($json){
      $this->data=Sasaran_indikator::join('sasaran')
                ->select('bab_iv__sasaran.id,sasaran,bab_iv__sasaran_indikator.*')
                ->where($where)
                ->table(null,$deleted_filter);
      jsonify($this->data);
    }
    else{
      if($this->input->get()){
        $this->data['get']=http_build_query($this->input->get());
      }
      $this->load->blade('xadmin/bab_iv/sasaran/sasaran_indikator',$this->data);
    }
  }
  
  public function form($mode=''){
    $id=$this->input->get('id');
    $logged=logged();
    $where=['id_tahun'=>$logged->id_tahun];
    if($logged->id_grup>=4){
      $where['id_user']=$logged->id;
    }
    
    if(!$id){
      $data=[(object)['id_sasaran'=>$this->input->get('id_sasaran','')]];
    }else{
      $data=Sasaran_indikator::all(explode(',',$id));
    }
    
    $this->data['daftar_sasaran']=Sasaran::select('sasaran as text,id as value')->all($where);
    foreach($data as $i=>$d){
      if($mode=='copy'){unset($d->id);}
      $this->data['data']=$d;
      $this->load->blade('xadmin/bab_iv/sasaran/sasaran_indikator.form',$this->data);
    }
  }
  
  public function update(){
    $data=post_upload($this->data['upload_config'],true);
    if(!$data[0]['id']){
      jsonify(Sasaran_indikator::insert_batch($data));
    }else{
      jsonify(Sasaran_indikator::update_batch($data,'id'));
    }
  }
  
  public function remove($force_delete=false){
    $id=explode(',',$this->input->post('id'));
    if($id){
      $keys=implode(',',array_keys($_FILES));
      $files=Sasaran_indikator::select($keys)->all($id,'only_deleted');
      if($force_delete){
        remove_files($files);
      }
      jsonify(Sasaran_indikator::delete($id,$force_delete));
    }
  }
  
  public function restore(){
    $id=explode(',',$this->input->post('id'));
    jsonify(Sasaran_indikator::restore_batch($id));
  }
}
