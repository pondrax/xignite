<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pdf_controller extends CI_Controller {

  function __construct() {
    parent::__construct();
    $this->load->library('pdf');
  }
	public function index(){
    forbidden_access();
  }
  public function view(){
    $html=$this->input->post('html','<html></html>');
    $size=$this->input->post('size','folio');
    $orientation=$this->input->post('orientation','potrait');
    $html=$this->load->blade('xadmin/report/berita_acara',[],true);
    Pdf::generate($html,'name.pdf',true);    
  }
  public function generate(){
    $html=$this->input->post('html','<html></html>');
    $size=$this->input->post('size','folio');
    $orientation=$this->input->post('orientation','potrait');
    $html=$this->load->blade('xadmin/report/berita_acara',[],true);
    Pdf::generate($html,'name.pdf',true);
  }
}
