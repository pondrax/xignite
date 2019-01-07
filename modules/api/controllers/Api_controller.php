<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api_controller extends MX_Controller {

  function __construct() {
    parent::__construct();
    $this->load->helper('jwt_helper');
    $this->secret_key=$this->config->item('api_secret_key');
  }
  public function authorize(){
    $this->load->model('xadmin/users/users');
    $this->load->model('xadmin/users/modul');
    $this->load->library('form_validation');
    $username=$this->input->post('username');
    $password=$this->input->post('password');
    $this->form_validation->set_rules('username', 'Username', 'required');
    $this->form_validation->set_rules('password', 'Password', 'required');
    if ($this->form_validation->run() === true){
      $login_id=Users::verify_password($password,['username'=>$username]);
      if($login_id){
        $logged=Users::select('id,id_grup,username')
            ->groups(['select'=>'id,nama_grup,modul_read,modul_write,modul_delete'])
            ->one($login_id);
            
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
        $logged->modules=$modules;
        $logged->last_generate=strtotime(date('Ymd'));
        // d($logged);
        jsonify(['status'=>'success','message'=>jwt::encode($logged,$this->secret_key)]);
      }
      else{
        jsonify(['status'=>'error','message'=>(object)['username'=>'Username or Password invalid']]);
      }
    }else{
      jsonify(['status'=>'error','message'=>(object)$this->form_validation->error_array()]);
    }
  }
  
  public function module(){
    if(!isset(apache_request_headers()['app_token'])){
      http_response_code(401);
      jsonify(['status'=>'error','message'=>'Missing Token request']);
      die();
    }
    $token=apache_request_headers()['app_token'];
    $logged=jwt::decode($token,$this->secret_key);
    // d($logged);
    if(!$logged){
      http_response_code(403);
      jsonify(['status'=>'error','message'=>'Token Expired']);
    }else{
      $module=explode('module/',$_SERVER['PHP_SELF']);
      if(count($module)>1){
        // echo $module[1];
        echo modules::run($module[1]);
      }
    }
  }
}
