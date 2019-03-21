<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_controller extends CI_Controller {
  function __construct() {
    parent::__construct();
    setlocale(LC_ALL, 'IND');
    $this->load->model('xadmin/master/pengguna');
    $this->load->model('xadmin/master/modul');
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
    $data=[];
    $post=$this->input->post();
    if($post){
      $this->load->library('form_validation');
      $this->form_validation->set_rules('email','Email','trim|required');
      $this->form_validation->set_rules('password','Password','trim|required');
      if ($this->form_validation->run() === true){
        $login_id=Pengguna::verify_password($post['password'],['email'=>$post['email']]);
        if($login_id){
          $this->set_session($login_id);
        }
        else{
          $data['error']=['email'=>'Email atau Password tidak sesuai'];
        }
      }else{
        $data['error']=$this->form_validation->error_array();
      }
    }
    if(isset($data['success'])){
      header('Location:'.base_url());
    }else{
      $this->load->blade('xweb/auth/login',$data);
    }
  }
  public function set_session($id){
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
    header('Location: '.base_url());
  }
}
