<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome_controller extends CI_Controller {
  function __construct() {
    parent::__construct();
    $this->data=[
      'APP_NAME'=>APP_NAME
    ];
}
  
	public function index()
	{
		$this->load->blade('welcome',$this->data);
	}
  public function test(){
    $this->load->model('test');
    $this->load->model('test__hasone');
    // jsonbug(Test__hasone::join('joinnext')->all());
    jsonbug(Test::join(['hasone'=>'joinnext'])->all());
    // jsonbug(Test::hasone()->all());
    // jsonbug(Test::hasmany([
      // 'where'=>['manyname'=>'data many 1 a']
    // ])->all());
    // jsonbug(Test::hasmanypivot()->all());
    
    // $this->load->model('test__hasone');
    // jsonbug(test__hasone::belongsto()->all());
  }
}
