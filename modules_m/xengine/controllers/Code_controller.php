<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Code_controller extends CI_Controller {
  function __construct() {
    parent::__construct();
    ini_set('max_execution_time', 0);
    if(strtolower(ENVIRONMENT)!='development'){
      echo "Forbidden";
      exit;
    }
    $this->load->helper('file');
    $this->data=[
      'assets'=>base_url('modules/xengine/assets'),
      'templates'=>base_url('modules/xengine/templates'),
      'modulepath'=>base_url('xengine/code')
    ];
  }
  
  public function index(){
    $this->data['files']=$this->glob_all2(realpath(FCPATH));
    $this->load->blade('xengine/code/main',$this->data);
  }
  public function view(){
    $this->data['path']=str_replace(FCPATH,'',realpath($this->input->get('path','')));
    $this->data['content']=file_get_contents($this->input->get('path'));
    $this->data['file_type']=get_mime_by_extension($this->data['path']);
    $this->load->blade('xengine/code/editor',$this->data);
  }
  public function save(){
    // d($this->input->post());
    $path=$this->input->post('path');
    $content=$this->input->post('content');
    file_put_contents($path,$content);
    jsonify('success');
  }
  
  public function glob_all2($dir,$target='',$first=true){
    // debug($target);
    if($first){
      $str="<ul class='collapse show' style='padding:0;list-style:none'>";      
    }else{
      $str="<ul class='collapse' style='padding:0 0 0 15px;list-style:none;' id='$target'>";      
    }
    
    $dirs = glob($dir.'/*', GLOB_ONLYDIR);

    $files = array_merge(glob($dir.'/.*'),glob($dir.'/*'));
    // debug($files);
    // $files = glob('{,.}*', GLOB_BRACE);
    
    foreach(array_unique(array_merge($dirs, $files)) as $d){
      // debug(basename($d));
      if(is_dir($d) && !in_array(basename($d),['.','..','.git'])){
        $path=str_replace(realpath(FCPATH),'',$d);
        $id='xplor'.str_replace('/','-',$path);
        // debug($id);
        $str.="<li><a href='#' data-toggle='collapse' data-target='#$id'><i class='fas fa-folder-open'></i> ".basename($d)."</a>".$this->glob_all2($d,$id,false)."</li>";
      }elseif(is_file($d)){
        $d=base_url('xengine/code/view/?path=').$d;
        $str.="<li><a  class='add-tab' href='#' data-href='$d' style='
  white-space: nowrap;'><i class='fas fa-file'></i> ".basename($d)."</a></li>";
      }
    }
    $str.= "</ul>";
    return $str;
  }
  public function glob_all($dir){
    $files=[];
    foreach(glob($dir.'/*') as $d){
      $d=realpath($d);
      if(is_dir($d)){
        array_push($files,[$d=>$this->glob_all($d)]);
      }else{
        array_push($files,$d);
      }
    }
    return $files;
  }
}

