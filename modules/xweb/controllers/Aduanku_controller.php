<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aduanku_controller extends CI_Controller {
  function __construct() {
    parent::__construct();
    setlocale(LC_ALL, 'IND');
    setlocale(LC_ALL, 'id_ID');
    $this->load->model('xweb/aduan');
    $this->load->model('xweb/status');
    $this->load->model('xadmin/master/pengguna');
    $this->load->model('xadmin/master/modul');
    $this->load->model('xweb/tindak_lanjut');
    logged(true);
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
    // $data['aduan']=Aduan::join('pengguna')
    // $data['aduan']=Aduan::leftjoin('pengguna')
    //               ->order_by('aduan.created_at','desc')
    //               ->table();
    $where=[];
    
    $data['status']=Status::all();
    $data['count_status']=[
                        Aduan::where(["id_status"=>0])->count(),
                        Aduan::where(["id_status"=>1])->count(),
                        Aduan::where(["id_status"=>2])->count(),
                        Aduan::where(["id_status"=>3])->count(),
                        Aduan::where(["id_status"=>4])->count()
                        ];
    switch(logged()->id_grup){
        case 1:
            $data['aduan']=Aduan::select('users.*,aduan.*')
                  ->leftjoin('pengguna')
                  ->order_by('aduan.created_at','desc')
                  ->table();
            break;
        case 2: 
            $where=[];
            $owned=Tindak_lanjut::select('id_aduan')->like('tindakan','data-id-user="'.logged()->id.'"')->all();
            foreach($owned as $o){
                array_push($where,$o->id_aduan);
            }
            $data['aduan']=Aduan::select('users.*,aduan.*')
                  ->leftjoin('pengguna')
                  ->where_in('aduan.id',$where)
                  ->order_by('aduan.created_at','desc')
                  ->table();
            // d($where);
            break;
        default: 
            $where=['id_user'=>logged()->id];
            $data['aduan']=Aduan::select('users.*,aduan.*')
                  ->leftjoin('pengguna')
                  ->where($where)
                  ->order_by('aduan.created_at','desc')
                  ->table();
            break;
      }
    $this->load->blade('xweb/aduan/aduanku',$data);
  }

}
