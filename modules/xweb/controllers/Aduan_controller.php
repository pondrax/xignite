<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aduan_controller extends CI_Controller {
  function __construct() {
    parent::__construct();
    setlocale(LC_ALL, 'IND');
    $this->load->model('xweb/aduan');
  }
  function _remap($method='',$variable=[]){
    if($method==""){
      $this->index();
    }
    else if(method_exists($this,$method)){
      call_user_func(array($this, $method));
      return false;
    }
    else{
      array_unshift($variable,$method);
      $this->single($variable);
    }
  }	
  public function index(){
    $_GET['limit']=10;
    $data['aduan']=Aduan::join('pengguna')
                   ->where('aktif',1)
                   ->order_by('aduan.created_at','desc')
                   ->table();
    $this->load->blade('xweb/aduan/aduan',$data);
  }

	function single($variable=[]){
    $slug=$variable[0];
    $data['aduan']=Aduan::join('pengguna')->one(['slug'=>$slug]);
    if($data['aduan']){
      $data['aduan']->view+=1;
      Aduan::update($data['aduan']->id,['view'=>$data['aduan']->view],false);
      $this->load->blade('xweb/aduan/detail',$data);
    }else{
      show_404();
    }
  }	
  function lampiran(){
    $config=[
        'file_name' => date('YmdHis'),
        'upload_path' => './public/uploads/',
        'allowed_types' => 'gif|jpg|jpeg|png|pdf',
        'max_size' => '2048000',
        // 'overwrite'=>true
      ];
    jsonify($this->input->upload('lampiran',$config,true));
  }
  function tambah(){
    $lampiran=[];
    if(post('filename')!=''){
      foreach(post('filename') as $i=>$f){
        $lampiran[$i]=['filename'=>$f,'path'=>post('path')[$i]];
      }
    }
    $data=['aduan'=>[
              'judul'=>post('judul'),
              'aduan'=>post('aduan'),
              'tags'=>post('tags'),
              'anonim'=>post('anonim')=="on"?1:0,
              'rahasia'=>post('rahasia')=="on"?1:0,
              'id_kategori'=>post('kategori'),
              'lampiran'=>json_encode($lampiran),
              'id'=>time(),
              'slug'=>dechex(time()),
          ]];
    $this->session->set_userdata('aduan',$data['aduan']);
    if(logged()){
      $data['aduan']['id_user']=logged()->id;
      $insert_id=Aduan::insert($data['aduan']);
      // d($insert_id);
      // header('location:'.base_url('aduan/sukses'));
    }else{
      $this->load->blade('xweb/aduan/tambah_daftar',$data);
    }
  }
  function sukses(){
    $data['aduan']=$this->session->userdata('aduan');
    $this->load->blade('xweb/aduan/sukses',$data);
  }
}
