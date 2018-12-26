<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_controller extends CI_Controller {
  function __construct() {
    parent::__construct();
    $this->load->model('xadmin/users/users');
    $this->load->model('xadmin/bab_iv/urusan');
    $this->load->model('xadmin/bab_iv/pengisi');
    $this->load->model('xadmin/bab_iv/deskripsi');
    $this->load->model('xadmin/bab_iv/sasaran');
    $this->load->model('xadmin/bab_iv/program');
    $this->load->model('xadmin/bab_iv/kegiatan');
    $this->data=[
      'path'=>base_url('xadmin/bab_iv/laporan'),
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
    $where=['id_tahun'=>logged()->id_tahun];
    if(logged()->id_grup==4){
      $where['id_user']=Users::one(['username'=>logged()->username.'.1'])->id;
    }
    if(logged()->id_grup==5){
      $where['id_user']=logged()->id;
    }
    if($json){
      $this->data=Pengisi::select('users.id,instansi,bab_iv__urusan_pengisi.*')
                         ->join('pengguna')
                         ->join('urusan')
                         ->where($where)
                         ->table(null,$deleted_filter);
      jsonify($this->data);
    }
    else{
      if($this->input->get()){
        $this->data['get']=http_build_query($this->input->get());
      }
      $this->load->blade('xadmin/bab_iv/laporan/laporan',$this->data);
    }
  }
  
  public function frame($html=null){
    if($this->input->get()){
      $this->data['get']=http_build_query($this->input->get());
    }
    $this->load->blade('xadmin/bab_iv/laporan/frame',$this->data);
  }
  public function result($html=null){
    $where=$this->input->get(null,[]);    
    $where['id_grup']=5;
    if(logged()->id_grup==4){
      $where['users.id']=Users::one(['username'=>logged()->username.'.1'])->id;
    }
    if(logged()->id_grup==5){
      $where['users.id']=logged()->id;
    }
    // debug($where);
    $pengguna=Users::select('id,instansi')->all($where);
    $daftar_pengguna=[];
    foreach($pengguna as $p){
      $daftar_pengguna[$p->id]=$p->instansi;
    }
    $id_pengguna=array_keys($daftar_pengguna);    

    $daftar_pengisi=Pengisi::select('id_urusan')->where_in('id_user',$id_pengguna)->all();
    // debug($daftar_pengisi);
    $id_urusan=[];
    foreach($daftar_pengisi as $p){
      $id_urusan[]=$p->id_urusan;
    }
    // debug($id_urusan);
    $this->data['pengguna']=$daftar_pengguna;
    
    $this->data['daftar_urusan']=Urusan::pengisi(['where_in'=>['id_user'=>$id_pengguna]])->all($id_urusan);
    
    
    $where_pengisi=$this->input->get(null,[]);    
    $where_pengisi['id_tahun']=logged()->tahun;
    if(logged()->id_grup>=4){
        $where_pengisi['id_user']=logged()->id;
    }
    $this->data['daftar_deskripsi']=Deskripsi::all();
    $this->data['daftar_sasaran']=Sasaran::sasaran_indikator()->all();
    $this->data['daftar_program']=Program::program_indikator()->all();
    $this->data['daftar_kegiatan']=Kegiatan::kegiatan_indikator()->all();
    
    if(!$html){
      $this->load->library('pdf');
      $html=$this->load->blade('xadmin/bab_iv/laporan/report',$this->data,true);
      $this->pdf->generate($html);
    }else{
      $this->load->blade('xadmin/bab_iv/laporan/report',$this->data);
    }
  }
  
  public function update(){
    $data=post_upload($this->data['upload_config'],true);
    // debug($data);
    if(!$data[0]['id']){
      jsonify(Sasaran::insert_batch($data));
    }else{
      jsonify(Pengisi::update_batch($data,'id'));
    }
  }
}
