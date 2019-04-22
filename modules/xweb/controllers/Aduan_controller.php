<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aduan_controller extends CI_Controller {
  function __construct() {
    parent::__construct();
    setlocale(LC_ALL, 'IND');
    setlocale(LC_ALL, 'id_ID');
    $this->load->model('xweb/aduan');
    $this->load->model('xweb/status');
    $this->load->model('xweb/tindak_lanjut');
    $this->load->model('xadmin/master/pengguna');
    $this->load->model('xadmin/master/modul');
    $this->load->model('xweb/kategori');
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
    $status=$this->input->get('status');
    $where=['id_status>'=>1];
    $where_status=[2,3,4];
    $where_count=['id_status>'=>1];
    if(logged()&&logged()->id_grup==1){
        $where=['id_status>'=>-1];
        $where_status=array_merge($where_status,[0,1]);
        $where_count=['id_status>'=>-1];
	}
    if($status!=''&&$status<=4){
        $where=['id_status'=>$status];
    }
    // d($status);
    $data['aduan']=Aduan::select('users.*,status_pengaduan.*,aduan.*')
                        ->leftjoin('pengguna')
                        ->join('status')
                        ->tindak_lanjut()
                        ->order_by('aduan.created_at','desc')
                        ->table($where);
                        
    $data['status']=Status::all($where_status);
    
    $data['count_status']=[
                        Aduan::where(["id_status"=>0])->count(),
                        Aduan::where(["id_status"=>1])->count(),
                        Aduan::where(["id_status"=>2])->count(),
                        Aduan::where(["id_status"=>3])->count(),
                        Aduan::where(["id_status"=>4])->count(),
                        'all'=>Aduan::where($where_count)->count()];
    $this->load->blade('xweb/aduan/aduan',$data);
  }

  function single($variable=[]){
    $id=($variable[0]);
    $data['owner']=false;
    $data['aduan']=Aduan::leftjoin('pengguna')
                        ->join('status')
                        ->tindak_lanjut()
                        ->one(['aduan.slug'=>$id]);
    $data['instansi']=Pengguna::all(['id_grup'=>2]);
    $data['tindakan']=Tindak_lanjut::join('pengguna')->all(['id_aduan'=>$data['aduan']->id]);
    $data['status']=Status::all();
    $data['kategori']=Kategori::select("id as value, kategori as text")->all();
    if(logged()){
        switch(logged()->id_grup){
            case 1:
                $data['owner']=true;
            break;
            case 2:
                $sender=Tindak_lanjut::where(['id_user'=>logged()->id,'id_aduan'=>$data['aduan']->id])->count()>0;
                $mentioned=Tindak_lanjut::like('tindakan','data-id-user="'.logged()->id.'"')->where(['id_aduan'=>$data['aduan']->id])->count()>0;
                // d($mentioned);
                $data['owner']=$sender||$mentioned;
            break;
            default:
                $data['owner']=($data['aduan']->id_user==logged()->id)&&!empty($data['tindakan']);
            break;
        }
	}
    
    
    if($data['aduan']){
      $data['aduan']->view+=1;
      Aduan::update($data['aduan']->id,['view'=>$data['aduan']->view],false);
      $this->load->blade('xweb/aduan/detail',$data);
    }else{
      show_404();
    }
  }	
  
  function verifikasi(){
    $id=post('id');
    $aduan=$this->input->post();
    unset($aduan['files']);
    // d($aduan);
    Aduan::update($id,$aduan,false);
    redirect($_SERVER['HTTP_REFERER'],'refresh');
  }
  
    function update_status(){
        $id=post('id');
        $id_status=post('id_status');
        Aduan::update($id,['id'=>$id,'id_status'=>$id_status],false);
        redirect($_SERVER['HTTP_REFERER'],'refresh');
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
        $lampiran[$i]=['filename'=>$f,'url'=>post('path')[$i]];
      }
    }
    $data=['aduan'=>[
              'judul'=>post('judul'),
              'aduan'=>post('aduan'),
              'tags'=>post('tags'),
              'anonim'=>post('anonim')=="on"?1:0,
              'rahasia'=>post('rahasia')=="on"?1:0,
              'id_kategori'=>post('kategori'),
              'latitude'=>post('latitude'),
              'longitude'=>post('longitude'),
              'lampiran'=>$lampiran,
              'slug'=>dechex(time()),
          ]];
        //   d($data);
    $this->session->set_userdata('aduan',$data['aduan']);
    if(logged()){
        redirect(base_url('aduan/simpan'),'refresh');
    }else{
      $data['aduan']=(object)$this->session->userdata('aduan');
      $this->load->blade('xweb/aduan/tambah',$data);
    }
  }
  function simpan(){
      $data['aduan']=$this->session->userdata('aduan');
      $data['aduan']['id']=time();
      $data['aduan']['id_user']=logged()->id;
      $data['aduan']['lampiran']=json_encode($data['aduan']['lampiran']);
      
      $insert_id=Aduan::insert($data['aduan']);
    //   d($insert_id);
    
        redirect(base_url('aduan/simpan'),'refresh');
      header('location:'.base_url('aduan/sukses'));
      
  }
  function sukses(){
    $data['aduan']=$this->session->userdata('aduan');
    $this->load->blade('xweb/aduan/sukses',$data);
    $data['aduan']=$this->session->unset_userdata('aduan');
  }
  
  
  function registrasi(){
    $data=[];
    $post=$this->input->post();
    if($post){
      $post['id']=time();
      $post['id_grup']=3;
      $post['token']=strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 8));
      $data=Pengguna::insert($post);
    }
    //   d($data);
    if(isset($data['success'])){
      $this->auto_login($data['success']);
      header('location:'.base_url('aduan/simpan'));
    }else{
      $data['aduan']=(object)$this->session->userdata('aduan');
      $this->load->blade('xweb/aduan/tambah',$data);
    }
  }
  function auto_login($id){
    $logged=Pengguna::select('id,id_grup,email,aktif')
            ->grup(['select'=>'id,nama_grup,modul_read,modul_write,modul_delete'])
            ->one($id);
    $modules=(object)[];
    $read=explode(',',$logged->grup[0]->modul_read);
    $write=explode(',',$logged->grup[0]->modul_write);
    $delete=explode(',',$logged->grup[0]->modul_delete);
    foreach(Modul::all() as $m){
      $modul_name=strtolower($m->nama_modul);
      $modul_id=$m->id;
      $modules->{$modul_name}=(object)[
        'read'=>in_array($modul_id,$read),
        'write'=>in_array($modul_id,$write),
        'delete'=>in_array($modul_id,$delete)
      ];
    }
    $logged->nama_grup=$logged->grup[0]->nama_grup;
    unset($logged->grup);
    $this->session->set_userdata(['logged'=>$logged]);
    $this->session->set_userdata(['modules'=>$modules]);
  }
}
?>