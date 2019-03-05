<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pengajuan_informasi_controller extends CI_Controller {
  function __construct() {
    parent::__construct();
  }
  
  public function index(){
    $this->load->model('xweb/requests/permohonan');
    $data=$this->input->post();
    // debug($data);
    Permohonan::insert($data);
  }
}
