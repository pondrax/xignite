<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_controller extends CI_Controller {
  function __construct() {
    parent::__construct();
    $this->load->model('xadmin/users/users');
    $this->load->model('xadmin/bab_v/pengisi');
    $this->load->model('xadmin/bab_v/deskripsi');
    $this->load->model('xadmin/bab_v/program');
    $this->load->model('xadmin/bab_v/kegiatan');
    $this->data=[
      'path'=>base_url('xadmin/bab_v/laporan'),
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
  
  public function view($html=null){
    $this->load->blade('xadmin/bab_v/laporan/frame',$this->data);
  }
  public function pdf($html=null){
    $pengguna=Users::select('id,instansi')->all();
    $daftar_pengguna=[];
    foreach($pengguna as $p){
      $daftar_pengguna[$p->id]=$p->instansi;
    }
    $this->data['pengguna']=$daftar_pengguna;
    $this->data['daftar_pengisi']=Pengisi::all();
    $this->data['daftar_deskripsi']=Deskripsi::all();
    $this->data['daftar_program']=Program::all();
    $this->data['daftar_kegiatan']=Kegiatan::all();
    
    if(!$html){
      $this->load->library('pdf');
      $html=$this->load->blade('xadmin/bab_v/laporan/laporan',$this->data,true);
      $this->pdf->generate($html);
    }else{
      $this->data['show_toolbar']=true;
      $this->load->blade('xadmin/bab_v/laporan/laporan',$this->data);
    }
  }
  
}
