<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Profil_controller extends CI_Controller {
  function __construct() {
    parent::__construct();
    setlocale(LC_ALL, 'IND');
    setlocale(LC_ALL, 'id_ID');
    $this->load->model('xweb/profil');
    $this->load->model('xadmin/master/pengguna');
    $this->load->model('xadmin/master/modul');
    logged(true);
  }


  public function index(){
    $where = (['id_users'=>logged()->id]);
    $data['profil']=Profil::select('users__profile.*', 'users.*')
                            ->where($where)
                            ->one();
    // d($data['profil']->nama_lengkap);
    $this->load->blade('xweb/profil/profil',$data);
  }
  
 
  
  public function form(){
    $id=$this->input->post('id');
    if(!$id){
      $data=[[]];
    }else{
      $data=Profil::all(explode(',',$id));
    }
    foreach($data as $i=>$d){
      if($mode=='copy'){unset($d->id);}
      $this->data['data']=$d;
      $this->load->blade('xweb/profil.form',$this->data);
    }
  }
  
  public function update(){
      
      $data= ['nama_lengkap'=>post('nama_lengkap'),
           'id'=>post('id'),
           'id_users'=>logged()->id,
           'nik'=>post('nik'),
           'jenis_kelamin'=>post('jenis_kelamin'),
           'tempat_lahir'=>post('tempat_lahir'),
           'pendidikan'=>post('pendidikan'),
           'tanggal_lahir'=>post('tanggal_lahir'),
           'pekerjaan'=>post('pekerjaan'),
           'alamat'=>post('alamat'),
           'rt'=>post('rt'),
           'rw'=>post('rw'),
           'dusun'=>post('dusun'),
           'provinsi'=>post('provinsi'),
           'kabupaten'=>post('kabupaten'),
           'kabupaten'=>post('kabupaten'),
           'kecamatan'=>post('kecamatan'),
           'kelurahan'=>post('kelurahan'),
           ];
           
           
           
    if(post('id')!=''){
        $id = post('id');
        Profil::update($id, $data);
        redirect(base_url().'profil', 'refresh');
        
    }else{
        Profil::insert($data);
        redirect(base_url().'profil', 'refresh');
    }
   
      
  }
  
  public function remove($force_delete=false){
    $id=explode(',',$this->input->post('id'));
    if($id){
      $keys=implode(',',array_keys($_FILES));
      $files=Profil::select($keys)->all($id,'only_deleted');
      if($force_delete){
        remove_files($files);
      }
      jsonify(Profil::delete($id,$force_delete));
    }
  }
  
  public function getdata(){
      $data = get('nik');
      if(strlen($data)==16){
        $variable = file_get_contents('http://192.168.1.2/kependudukan/?nik='.$data);
        echo $variable;    
      }else{
        $msg = (object)array("pesan"=>"NIK harus 16 digit");
        echo json_encode($msg) ;    
      }
      
  }
  
  
}
