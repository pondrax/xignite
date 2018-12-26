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


function post_upload($config,$remove=false,$prefix="old_"){
  $ci =& get_instance();
  $post=$ci->input->post();
  $uploaded=$ci->input->upload_all($config,true);
  foreach($uploaded as $key=>$name){
    foreach($name as $i=>$value){
      if($value){
        if($remove){
          remove_file($post[$i][$prefix.$key]);
        }
        $post[$i][$key]=$value;
      }
      else{
        $post[$i][$key]=$post[$i][$prefix.$key];
      }
      unset($post[$i][$prefix.$key]);
    }
  }
  $data=isset($post[0])?$post:[$post];
  // debug($data);
  return $data;
}

function path_to_link($path){
  return str_replace(str_replace("\\","/",FCPATH),base_url(),$path);
}
function link_to_path($link){
  return str_replace(str_replace("\\","/",base_url()),'./',$link);
}
function remove_files($array_path){
  foreach($array_path as $i=>$path){
    $path=$path->{array_keys((array)$path)[0]};
    remove_file($path);
  }
}
function remove_file($path,$is_link=true){
  if($is_link){
    $path=link_to_path($path);
  }
  if(file_exists($path)){
    unlink($path);
  }
}


function jsonform($data){
  return htmlspecialchars(json_encode($data),ENT_NOQUOTES);
}
function selectize($data){
  $arr=[];
  foreach($data as $val){
    array_push($arr,['text'=>$val,'value'=>$val]);
  }
  return $arr;
}
function related_data($datas){
  $tmps=['data'=>[],'related'=>[]];
  foreach($datas as $data){
    // $tmp=['data'=>$data];
    $_data=$data;
    $_related=[];
    foreach($_data as $key=>$value){
      $_key=explode('__',$key);
      if(count($_key)>1){
        $_related[$_key[1]]=$value;
        unset($_data[$key]);
      }
    }
    array_push($tmps['data'],$_data);
    array_push($tmps['related'],$_related);
  }
  return $tmps;
}
// function related_data($datas){
  // $tmps=['data'=>[],'related'=>[]];
  // foreach($datas as $data){
    // $tmp=['data'=>$data];
    // foreach($data as $key=>$value){
      // $_key=explode('__',$key);
      // if(count($_key)>1){
        // $tmp[$_key[0]][$_key[1]]=$value;
        // unset($tmp['data'][$key]);
      // }
    // }
    // array_push($tmps,$tmp);
  // }
  // return $tmps;
// }
function mark_start($class='test'){
  $ci =& get_instance();
  $ci->benchmark->mark($class);
}
function mark_end($class='test'){
  $ci =& get_instance();
  $ci->benchmark->mark($class.'_end');
  echo $ci->benchmark->elapsed_time($class,$class.'_end').' detik<br>';
}
function logged($redirect=false,$path=''){
  $ci = &get_instance();
  $ci->load->library('session');
  $logged=$ci->session->userdata('logged');
  if($logged){
    return $logged;
  }
  else if($redirect){
    header('Location: '.base_url($path));
  }
}
function where_logged(){
  $logged=logged();
  return ['id_user'=>$logged->id,'id_tahun'=>$logged->id_tahun];
}
function pengisi_logged(){
  $logged=logged();
  return ['id_user'=>$logged->id,'id_tahun'=>$logged->id_tahun];
}
function admin_logged(){
  $logged=logged();
  return ['id_user'=>$logged->id,'id_tahun'=>$logged->id_tahun];
}
function access_modul($modul_name=''){
  $modul=modul($modul_name);
  $akses=[];
  if($modul->read){
    array_push($akses,'readable');
  }
  if($modul->write){
    array_push($akses,'writable');
  }
  if($modul->delete){
    array_push($akses,'deletable');
  }
  return implode(',',$akses);
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
function get_value($key,$array){
  if(!is_array($key)){
    $key=explode(',',$key);
  }
  foreach($key as $k){
    if(array_key_exists($k,$array)) {
      return $array[$k];
    };    
  }
}
function tick(){
  return "<span class='symbol'>&#10003;</span>";
}
function checked(){
  return "<span class='symbol'>&#9745;</span>";
}
function unchecked(){
  return "<span class='symbol'>&#9744;</span>";
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
function pretty_var($var, array $opts = []){
  $opts = array_merge(['indent' => '  ', 'tab' => '  ', 'array-align' => false], $opts);
  switch (gettype($var)) {
    case 'array':
      $r = [];
      $indexed = array_keys($var) === range(0, count($var) - 1);
      $maxLength = $opts['array-align'] ? max(array_map('strlen', array_map('trim', array_keys($var)))) + 2 : 0;
      foreach ($var as $key => $value) {
          $key = str_replace("'' . \"\\0\" . '*' . \"\\0\" . ", "", pretty_var($key));
          $r[] = $opts['indent'] . $opts['tab']
              . ($indexed ? '' : str_pad($key, $maxLength) . ' => ')
              . pretty_var($value, array_merge($opts, ['indent' => $opts['indent'] . $opts['tab']]));
      }
      return "[\n" . implode(",\n", $r) . "\n" . $opts['indent'] . "]";
    case 'boolean':
      return $var ? 'true' : 'false';
    case 'NULL':
      return 'null';
    default:
      return var_export($var, true);
  }
}
function parseRP($num){
  $num=(int)str_replace('.','',$num);
  return number_format($num,2,",",".");
}
function get_jumlah($num){
  if($num!=''){
    $num=explode(' ',$num,2);
    if(count($num)>=1){
      return $num[0];
    }
    return '';
  }
}
function get_satuan($num){
  if($num!=''){
    $num=explode(' ',$num,2);
    if(count($num)>1){
      return $num[1];
    }
    return '';
  }  
}
?>
