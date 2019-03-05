<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test_controller extends MX_Controller {

  function __construct() {
    parent::__construct();
    $this->load->model('xadmin/users/users');
    $this->load->model('xadmin/users/groups');
    $this->data=[
      'path'=>base_url('xadmin/users/pengguna'),
      // 'access'=>access_modul('users'),
      // 'logged'=>logged(true,'xadmin/auth'),
    ];
  }
  public function index(){
    $data=Users::select('id,id_grup,username,email')
        ->groups(['select'=>'id,nama_grup'])
        ->table(null);
    jsonify($data);
  }
	public function generate(){
	  $data=['coba'=>'aaaaa','coba2'=>'iufgwjuksgfkws'];
	  $secret_key='jukdb2yrknq8yrkn823kstmhvnuhs';
	  $encoded=JWT::encode($data, $secret_key);
	  d($encoded);
	  d(JWT::decode($encoded,$secret_key));
  }
  public function module(){
    $module=explode('module/',$_SERVER['PHP_SELF'])[1];
    d($module);
    $mod=$this->load->module('xadmin');
    //$mod->index();
  }
}
