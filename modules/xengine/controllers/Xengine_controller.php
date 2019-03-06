<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Xengine_controller extends CI_Controller {
  function __construct() {
    parent::__construct();
    if(strtolower(ENVIRONMENT)!='development'){
      echo "Forbidden";
      exit;
    }
    ini_set('max_execution_time', 0);
    $this->data=[
      'assets'=>base_url('modules/xengine/assets'),
      'templates'=>base_url('modules/xengine/templates'),
      'modulepath'=>base_url('xengine/')
    ];
  }
  
  public function index(){
    $this->load->blade('xengine/ui/main',$this->data);
  }
  public function view_builder(){
    $this->load->blade('xengine/ui/view_builder',$this->data);
  }
  public function view_controller(){
    $this->load->blade('xengine/ui/view_controller',$this->data);
  }
  public function view_model(){
    $this->load->blade('xengine/ui/view_model',$this->data);
  }
  public function make_controller(){
    $data=$this->data;
    $post=$this->input->post();
    extract($post);
    $data['realpath']=dirname('modules/'.$controller_path).'/'.ucfirst(basename($controller_path)).'_controller.php';
    $controller_path=str_replace('/controllers/','/',$controller_path);
    
    $model_path=str_replace('/models/','/',$model_path);
    $view_path=str_replace('/views/','/',$view_path);
    
    
    $pattern=[
      '#controller_path'=>$controller_path,
      '#controller_name'=>ucfirst(basename($controller_path)).'_controller',
      '#model_path'=>$model_path,
      '#model_name'=>ucfirst(basename($model_path)),
      '#view_path'=>$view_path,
      '#view_form_path'=>$view_path.'.form'
    ];
    // debug($pattern);
    
    
    $file=file_get_contents($data['templates'].'/controller.xengine');    
    $data['result']=replace_pattern($pattern,$file);
    $data['result_view']=base_url($controller_path);
    
    $this->load->blade('xengine.make',$data);
    
    $this->save($data['realpath'],$data['result']);
  }
  
  public function make_model(){
    $data=$this->data;
    $post=$this->input->post();
    // debug($post);
    extract($post);
    
    $config_rules=[];
    $fields=[];
    foreach($field as $i=>$f){
      //fields table builder
      if($f!=''){
        $v=['type'=>'int','constraint'=>11];
        if($type[$i]!=''){
          $v['type']=$type[$i];
        }
        if($constraint[$i]!=''){
          $v['constraint']=$constraint[$i];
        }
        if($f==$primary_key){
          $v['auto_increment']=true;
        }
        $fields[$f]=$v;
        
        //config rules
        $l=!empty($label[$i])?$label[$i]:ucwords($f);
        $r=!empty($rules[$i])?$rules[$i]:'';
        if($r!=''){
          array_push($config_rules,['field'=>$f,'label'=>$l,'rules'=>$r]);
        }
      }
    }
    if($created_at){
      $fields['created_at']=['type'=>'datetime','null'=>true];
    }
    if($updated_at){
      $fields['updated_at']=['type'=>'datetime','null'=>true];
    }
    if($deleted_at){
      $fields['deleted_at']=['type'=>'datetime','null'=>true];
    }
    $this->load->dbforge();
    $this->dbforge->add_field($fields);
    $this->dbforge->add_key($primary_key);
    $this->dbforge->drop_table($table,true);
    $this->dbforge->create_table($table);
    
    $config_rules=count($config_rules)?'public $rules = '.pretty_var($config_rules).';':'';
    
    $config_fields=count($fields)?'public $fields = '.pretty_var($fields).';':'';
    
    
    $_tmp=[];
    foreach($one_model as $i=>$m){
      $f=isset($one_foreign_key[$i])?$one_foreign_key[$i]:'';
      $l=isset($one_local_key[$i])?$one_local_key[$i]:'';
      if($m!='' || $f!='' || $l!=''){
        $base=basename($m);
        $_tmp[$base]=['model'=>$m,'foreign_key'=>$f,'local_key'=>$l];
      }
    }
    $has_one=count($_tmp)?'public $has_one = '.pretty_var($_tmp).';':'';
    
    
    $_tmp=[];
    foreach($many_model as $i=>$m){
      $f=isset($many_foreign_key[$i])?$many_foreign_key[$i]:'';
      $l=isset($many_local_key[$i])?$many_local_key[$i]:'';
      if($m!='' || $f!='' || $l!=''){
        $base=basename($m);
        $_tmp[$base]=['model'=>$m,'foreign_key'=>$f,'local_key'=>$l];
      }
    }
    $has_many=count($_tmp)?'public $has_many = '.pretty_var($_tmp).';':'';
    
    
    $_tmp=[];
    foreach($pivot_model as $i=>$m){
      $f=isset($pivot_foreign_key[$i])?$pivot_foreign_key[$i]:'';
      $l=isset($pivot_local_key[$i])?$pivot_local_key[$i]:'';
      $t=isset($pivot_table[$i])?$pivot_table[$i]:'';
      if($m!='' || $f!='' || $l!='' || $t!=''){
        $base=basename($m);
        $_tmp[$base]=['model'=>$m,'foreign_key'=>$f,'local_key'=>$l,'pivot_table'=>$t];
      }
    }
    $has_many_pivot=count($_tmp)?'public $has_many_pivot = '.pretty_var($_tmp).';':'';
    $before_get=$before_get!=''?
      'public $before_get = '.pretty_var(explode(',',str_replace(' ','',$before_get))).';':'';
    $after_get=$after_get!=''?
      'public $after_get = '.pretty_var(explode(',',str_replace(' ','',$after_get))).';':'';
    $before_create=$before_create!=''?
      'public $before_create = '.pretty_var(explode(',',str_replace(' ','',$before_create))).';':'';
    $after_create=$after_create!=''?
      'public $after_create = '.pretty_var(explode(',',str_replace(' ','',$after_create))).';':'';
    $before_update=$before_update!=''?
      'public $before_update = '.pretty_var(explode(',',str_replace(' ','',$before_update))).';':'';
    $after_update=$after_update!=''?
      'public $after_update = '.pretty_var(explode(',',str_replace(' ','',$after_update))).';':'';
    
    // debug($before_get);
    
    
    $pattern=[
      '#model_name'=>ucfirst(basename($model_path)),
      '#table'=>$table,
      '#primary_key'=>$primary_key,
      '#fields'=>$config_fields,
      '#rules'=>$config_rules,
      '#has_one'=>$has_one,
      '#has_many_pivot'=>$has_many_pivot,
      '#has_many'=>$has_many,
      '#before_get'=>$before_get,
      '#after_get'=>$after_get,
      '#before_create'=>$before_create,
      '#after_create'=>$after_create,
      '#before_update'=>$before_update,
      '#after_update'=>$after_update,
    ];
    
    
    $data['realpath']=dirname('modules/'.$model_path).'/'.ucfirst(basename($model_path)).'.php';
    
    $file=file_get_contents($data['templates'].'/model.xengine');    
    $data['result']=replace_pattern($pattern,$file);
    
    $this->load->blade('xengine.make',$data);
    
    $this->save($data['realpath'],$data['result']);
  }
  
  
  
  public function save($path,$str){
    $this->load->helper('file');
    $dir=dirname($path);
    if(!is_dir($dir)){
      mkdir($dir,755,true);
    }
    
    return write_file($path, $str); 
  }
}