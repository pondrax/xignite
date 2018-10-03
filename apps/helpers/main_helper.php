<?php

function debug($data){
  echo '<pre>';
  var_dump($data);
  echo '</pre>';  
}
function jsonbug($data){
  echo '<pre>'.json_encode($data,JSON_PRETTY_PRINT).'</pre>';  
}
function jsonify($data){
  echo json_encode($data,JSON_PRETTY_PRINT);  
}
function jsonform($data){
  echo htmlentities(json_encode($data,JSON_PRETTY_PRINT));  
}
function mark_start($class='test'){
  $ci =& get_instance();
  $ci->benchmark->mark($class);
}
function mark_end($class='test'){
  $ci =& get_instance();
  $ci->benchmark->mark($class.'_end');
  echo $ci->benchmark->elapsed_time($class,$class.'_end').' sec<br>';
}
function logged($redirect=false){
  $ci = &get_instance();
  $ci->load->library('session');
  $logged=$ci->session->userdata('logged');
  if($logged){
    return $logged;
  }
  else if($redirect){
    header('Location: '.base_url('xadmin/auth'));
  }
}
function read_modul($modul_name=''){
  return modul($modul_name)->read;
}
function write_modul($modul_name=''){
  return modul($modul_name)->write;
}
function delete_modul($modul_name=''){
  return modul($modul_name)->delete;
}
function modul($modul_name=''){
  $ci = &get_instance();
  $ci->load->library('session');
  $modul=$ci->session->userdata('modules');
  return $modul->{$modul_name};
}
function forbidden_access(){
  echo '
  <div class="container-fluid py-3">
    <h4>Forbidden. Access is unauthorized.</h4>
  </div>';
}
function replace_pattern($pattern,$str){
  $find=[];
  $replace=[];
  foreach($pattern as $k=>$v){
    array_push($find,$k);
    array_push($replace,$v);
  }
  return str_replace($find,$replace,$str);
}
?>