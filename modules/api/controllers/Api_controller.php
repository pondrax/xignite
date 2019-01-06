<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api_controller extends MX_Controller {

  function __construct() {
    parent::__construct();
    $this->load->helper('jwt_helper');
    $this->secret_key=$this->config->item('api_secret_key');
  }
  public function authorize(){
    $this->load->model('xadmin/users/users');
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
        $logged->last_generate=strtotime(date('Ymd'));
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
    $token=apache_request_headers()['app_token'];
    $logged=jwt::decode($token,$this->secret_key);
    // d($logged);
    if(!$logged){
      http_response_code(403);
      jsonify(['status'=>'error','message'=>'Token Expired']);
    }else{
      $module=explode('module/',$_SERVER['PHP_SELF'])[1];
      // echo $module;
      echo modules::run($module);
    }
  }
}
