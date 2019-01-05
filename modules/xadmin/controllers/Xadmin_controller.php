<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Xadmin_controller extends CI_Controller {
  function __construct() {
    parent::__construct();
    $this->load->model('xadmin/users/users');
    $this->load->model('xadmin/users/modul');
    $this->load->library('form_validation');
    $this->data=[
      'path'=>base_url('xadmin/auth'),
      'logged'=>logged()
    ];
  }
  
  public function index(){
    if(logged()){
      header('Location: '.base_url('home'));
    }
    $this->auth();
  }
  public function home(){
    logged(true,'xadmin/auth');
    $this->load->blade('ui/main',$this->data);    
  }
  public function auth($mode='login'){
    if($mode=='login'){
      $this->login();
    }
    else{
      $this->logout();
    }
  }
  public function login(){
    if($this->input->post()){      
      $data=$this->input->post();
      extract($data);
      $this->data=array_merge($this->data,$data);
      $this->form_validation->set_rules('username', 'Username', 'required');
      $this->form_validation->set_rules('password', 'Password', 'required');
      if ($this->form_validation->run() === true){
        $login_id=Users::verify_password($password,['username'=>$username]);
      //debug($data);
        if($login_id){
          $this->set_session($login_id);
        }
        else{
          $this->data['error']=(object)['username'=>'Username or Password invalid'];
        }
      }else{
        $this->data['error']=(object)$this->form_validation->error_array();
      }
    }
    $this->load->blade('auth/login',$this->data);
  }
  public function set_session($id){
    $logged=Users::select('id,id_grup,username')
            ->groups(['select'=>'id,nama_grup,modul_read,modul_write,modul_delete'])
            ->one($id);
    $modules=(object)[];
    $read=explode(',',$logged->groups[0]->modul_read);
    $write=explode(',',$logged->groups[0]->modul_write);
    $delete=explode(',',$logged->groups[0]->modul_delete);
    foreach(Modul::all() as $m){
      $modul_name=strtolower($m->nama_modul);
      $modul_id=$m->id;
      $modules->{$modul_name}=(object)[
        'read'=>in_array($modul_id,$read),
        'write'=>in_array($modul_id,$write),
        'delete'=>in_array($modul_id,$delete)
      ];
    }
    $logged->nama_grup=$logged->groups[0]->nama_grup;
    unset($logged->groups);
    $this->session->set_userdata(['logged'=>$logged]);
    $this->session->set_userdata(['modules'=>$modules]);
    $this->set_year();
    header('Location: '.base_url('home'));
  }
  public function set_year($year=18){
    $logged=logged();
    $logged->id_tahun=$year;
    // $logged->tahun=Periode::select('tahun')->one($year)->tahun;
    $this->session->set_userdata(['logged'=>$logged]);
    // jsonify($logged);
  }
  public function logout(){
    $this->session->sess_destroy();
    header('Location: '.base_url('xadmin/login'));
  }
}
