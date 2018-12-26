<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class MY_Input extends CI_Input{
  
  function post($index = NULL, $default_value = NULL, $xss_clean = FALSE){
    $value = parent::post($index, $xss_clean);

    if(!$value)
      $value = $default_value;

    return $value;
  }

  function get($index = NULL, $default_value = NULL, $xss_clean = FALSE){
    $value = parent::get($index, $xss_clean);

    if(!$value)
      $value = $default_value;

    return $value;
  }
  
  function upload_all($config,$get_link=false){
    $names=array_keys($_FILES);
    $uploaded=[];
    foreach($names as $i=>$name){
      $uploaded[$name]=$this->upload($name,$config,$get_link);
    }
    return $uploaded;
  }
  function upload($name,$config,$get_link=false){
    $ci=&get_instance();
    $ci->load->library('upload', $config);
    if ($ci->upload->do_upload($name)){
      $data=$ci->upload->data();
      if($get_link){
        foreach($data as $i=>$d){
          $data[$i]=$d['link_path'];
        }
      }
      return $data;
    }
    else{
      return ['error'=>$ci->upload->display_errors()];
    }
  }
}