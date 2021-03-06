<?php
function d($data){
  highlight_string("<?php\n " . var_export($data, true) . "?>");
  echo '<script>document.getElementsByTagName("code")[0].getElementsByTagName("span")[1].remove() ;document.getElementsByTagName("code")[0].getElementsByTagName("span")[document.getElementsByTagName("code")[0].getElementsByTagName("span").length - 1].remove() ; </script>';
}
function dd($data){
  d($data);
  die();
}
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
function get($var=null,$ret=''){
  $ci =& get_instance();
	if($var){
		return $ci->input->get($var,$ret);
	}else{
		return $ci->input->get();
	}
}
function post($var=null,$ret=''){
  $ci =& get_instance();
	if($var){
		return $ci->input->post($var,$ret);
	}else{
		return $ci->input->post();
	}
}
function paginate($total,$path=''){
  $get = [
        'filter'=>get('filter'),
        'search'=>get('search'),
        'sort'=>get('sort'),
        'order'=>get('order'),
        'offset'=>get('offset',0),
        'limit'=>get('limit',10),
        ];  
//   d($get);
  $str='<ul class="pagination">';
  for($i=1;$i<=ceil($total/$get['limit']);$i++){
    $get['offset']=($i-1)*$get['limit'];
    $link=$path.'?'.urldecode(http_build_query(array_filter($get)));
    $active=$get['offset']==get('offset')?'active disabled':'';
    // if($i<=5){
        $str.="<li class='page-item $active'><a class='page-link' href='$link'>$i</a></li>";
    // }elseif($i==ceil($total/$get['limit'])){
    //     $str.="<li class='page-item $active'><a class='page-link' href='$link'>last</a></li>";
        
    // }
  }
  $str.='</ul>';
  return $str;
}
function stats($total){
  $current=get('offset',0)+1;
  $pages=$current*get('limit',10);
  return $current.' - '.$pages;
}
function safeurl($string){
  return preg_replace("/[^A-Za-z0-9]/", '-', strtolower($string));
}
function post_upload($config,$remove=false,$prefix="old_"){
  $ci =& get_instance();
  $post=$ci->input->post();
  $uploaded=$ci->input->upload_all($config,true);
  // $post=isset($post[0])?$post:[$post];
  // d($post);
  if(!isset($post[0])){
    foreach ($post as $p=>$v){
      if(count(explode($prefix,$p))>1){
        unset($post[$p]);
      }
    }
    $post=[$post];
  }
  foreach($uploaded as $key=>$name){
    foreach($name as $i=>$value){
      if($value){
        if($remove){
          d($post[$i]);
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
  // $data=$post;
  // debug($data);
  return $post;
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
  $ci->load->helper('jwt_helper');
  $secret_key=$ci->config->item('api_secret_key');
  if(isset(apache_request_headers()['app_token'])){
    $token=apache_request_headers()['app_token'];
    $logged=jwt::decode($token,$secret_key);
  }else{
    $ci->load->library('session');
    $logged=$ci->session->userdata('logged');
  }
  if($logged){
    $ci->load->model('xadmin/master/pengguna');
		if($redirect=='update'){
			Pengguna::update($logged->id,['id'=>$logged->id],false);
		}
    // d($logged);
    return $logged;
  }
  else if($redirect==true){
    header('Location: '.base_url($path));
  }
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
  if(isset(modul($modul_name)->read)){
    return modul($modul_name)->read;
  }else {
    return false;
  }
}
function write_modul($modul_name=''){
  if(isset(modul($modul_name)->write)){
    return modul($modul_name)->write;
  }else {
    return false;
  }
}
function delete_modul($modul_name=''){
  if(isset(modul($modul_name)->delete)){
    return modul($modul_name)->delete;
  }else {
    return false;
  }
}
function modul($modul_name=''){
  $ci = &get_instance();
  $secret_key=$ci->config->item('api_secret_key');
  if(isset(apache_request_headers()['app_token'])){
    $token=apache_request_headers()['app_token'];
    $logged=jwt::decode($token,$secret_key);
    $modul=$logged->modules;
  }else{
    $ci->load->library('session');
    $modul=$ci->session->userdata('modules');
  }
  return $modul->{$modul_name};
}
function forbidden_access(){
  echo '
  <div class="container-fluid py-3">
    <h4>Forbidden. Access is unauthorized.</h4>
  </div>';
}
function remap($key,$array){
  $tmp=[];
  foreach($array as $i=>$a){
    $tmp[$a->{$key}]=$array[$i];
  }
  return $tmp;
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
function clone_array(&$data,$length=0){
  if($length>0){
    for ($i = 1; $i < $length; $i++) { 
      $data[$i]=$data[0]; 
    }
  }
}



function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'tahun',
        'm' => 'bulan',
        'w' => 'minggu',
        'd' => 'hari',
        'h' => 'jam',
        'i' => 'menit',
        's' => 'detik',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? '' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' lalu' : 'baru saja';
}


if (!is_callable('getallheaders')) {
    # Convert a string to mixed-case on word boundaries.
    function uc_all($string) {
        $temp = preg_split('/(\W)/', str_replace("_", "-", $string), -1, PREG_SPLIT_DELIM_CAPTURE);
        foreach ($temp as $key=>$word) {
            $temp[$key] = ucfirst(strtolower($word));
        }
        return join ('', $temp);
    }

    function getallheaders() {
        $headers = array();
        foreach ($_SERVER as $h => $v)
            if (preg_match('/HTTP_(.+)/', $h, $hp))
                $headers[str_replace("_", "-", uc_all($hp[1]))] = $v;
        return $headers;
    }

    function apache_request_headers() { return getallheaders(); }
}
?>