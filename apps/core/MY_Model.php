<?php

class MY_Model extends CI_Model{
  protected static $db;
  
  protected $table;
  protected $primary_key='id';
  
  protected $protected = array();
  protected static $protected_filter = false;

  protected $has_one = array();
  protected $has_many = array();
  protected $has_many_pivot = array();
  protected static $related = array();
  protected static $related_pivot = array();

  protected $rules=null;
  
  protected static $default_select=true;
  
  protected static $soft_delete = true;
  protected static $deleted_filter = 'default'; //[default,with_deleted,only_deleted]
  
  protected $before_get = array();
  protected $after_get = array();
  protected $before_create = array();
  protected $after_create = array();
  protected $before_update = array();
  protected $after_update = array();
  protected $before_delete = array();
  protected $after_delete = array();
  
  protected static $callback_parameters = array();
  
  
  public function __construct(){
    // parent::__construct();
    $this->load->helper('inflector');
    self::$db = &get_instance()->db;
  }
  
  public static function _var($var){
    $self=new static(static::class);
    if($var=='table'){
      return ($self->{$var}?$self->{$var}:static::class);
    }else{
      return $self->{$var};
    }
  }
  
  public static function one($criteria=null,$deleted_filter='default'){
    $result=self::fetch($criteria,true,$deleted_filter);
    if(isset($result[0])){
      return $result[0];
    }
    return null;
  }
  public static function all($criteria=null,$deleted_filter='default'){
    return self::fetch($criteria,false,$deleted_filter);
  }
  
  public static function table($criteria=null,$deleted_filter='default',$search_fields=null){
    return self::fetch_table($criteria,$deleted_filter,$search_fields);
  }
  
  public static function fetch($criteria=null,$one=false,$deleted_filter='default'){
    // self::from();
    
    // $ci=&get_instance();
    // $limit =$ci->input->get('limit');
    // $offset=$ci->input->get('offset');
    // $sort  =$ci->input->get('sort');
    // $order =$ci->input->get('order');
    // $search=$ci->input->get('search');
    // $filter_where=$ci->input->get('filter');
    
    // $table=self::_var('table');
    // self::$deleted_filter=$deleted_filter;
    // if(self::$soft_delete){
    //   switch(self::$deleted_filter){
    //     case 'with_deleted':
    //       break;
    //     case 'only_deleted':
    //       self::where("$table.deleted_at!=",null);
    //       break;
    //     default:
    //       self::where("$table.deleted_at",null);
    //   }
    // }
    // if(is_array($criteria)){
    //   if(array_values($criteria)===$criteria){
    //     self::where_in(self::_var('primary_key'),$criteria);
    //   }else{
    //     self::where($criteria);
    //   }
    // }else{
    //   if($criteria){
    //     self::where(self::_var('primary_key'),$criteria);
    //   }
    // }
    // if($search_fields){
    //   self::search($search,$search_fields);
    // }else{
    //   self::search($search);
    // }
    // if($filter_where){
    //     self::where(json_decode($filter_where,true));
    // }
    // $total=self::$db->count_all_results('',false);
    // // debug($sort);
    // if($sort){
    // // self::order_by($table.'.'.$sort,$order);
    // self::order_by($sort,$order);
    // }
    // if($limit){
    //   self::limit($limit,$offset);
    // }    
    
    // $data=self::get_join_result(self::get());
    
    // $output=[
    //   'total'=>$total,
    //   'rows'=>$data
    // ];
    // return $output;
    self::from();
    
    $table=self::_var('table');
    self::$deleted_filter=$deleted_filter;
    if(self::$soft_delete){
      switch(self::$deleted_filter){
        case 'with_deleted':
          break;
        case 'only_deleted':
          self::where("$table.deleted_at!=",null);
          break;
        default:
          self::where("$table.deleted_at",null);
      }
    }
    
    if(is_array($criteria)){
      if(array_values($criteria)===$criteria){
        self::where_in(self::_var('primary_key'),$criteria);
      }else{
        self::where($criteria);
      }
    }else{
      if($criteria){
        self::where(self::_var('primary_key'),$criteria);
      }
    }
    if($one){
      self::limit(1);
    }
    
    $data=self::get_join_result(self::get());
    
    return $data;
  }
  
  
  public static function fetch_table($criteria=null,$deleted_filter='default',$search_fields=null){
    self::from();
    
    $ci=&get_instance();
    $limit =$ci->input->get('limit');
    $offset=$ci->input->get('offset');
    $sort  =$ci->input->get('sort');
    $order =$ci->input->get('order');
    $search=$ci->input->get('search');
    $filter_where=$ci->input->get('filter');
    
    $table=self::_var('table');
    self::$deleted_filter=$deleted_filter;
    if(self::$soft_delete){
      switch(self::$deleted_filter){
        case 'with_deleted':
          break;
        case 'only_deleted':
          self::where("$table.deleted_at!=",null);
          break;
        default:
          self::where("$table.deleted_at",null);
      }
    }
    if(is_array($criteria)){
      if(array_values($criteria)===$criteria){
        self::where_in(self::_var('primary_key'),$criteria);
      }else{
        self::where($criteria);
      }
    }else{
      if($criteria){
        self::where(self::_var('primary_key'),$criteria);
      }
    }
    if($search_fields){
      self::search($search,$search_fields);
    }else{
      self::search($search);
    }
    if($filter_where){
        self::where(json_decode($filter_where,true));
    }
    $total=self::$db->count_all_results('',false);
    // debug($sort);
    if($sort){
    // self::order_by($table.'.'.$sort,$order);
    self::order_by($sort,$order);
    }
    if($limit){
      self::limit($limit,$offset);
    }    
    
    $data=self::get_join_result(self::get());
    
    $output=[
      'total'=>$total,
      'rows'=>$data
    ];
    return $output;
  }
  
  private static function get_join_result($data){
    if(count($data)){
      if(self::$related){
        $local_values=[];
        foreach(self::$related as $relations){
          $related=$relations[0];
          $args=$relations[1];

          extract(self::get_related_model($related));
          $local_values[$model]=[];
          foreach($data as $d){
			if(isset($d->{$local_key})){
            array_push($local_values[$model],$d->{$local_key});
			}
          }
		  if(count($local_values[$model])){
          $query=$model::from($table)
            ->where_in("$table.$foreign_key",$local_values[$model]);
		  }
		  else{
			  $query=$model::from($table);
		  }
          if(array_key_exists('select',$args)){
            $query->select($args['select']);
          }
          if(array_key_exists('where',$args)){
            $query->where($args['where']);
          }
          if(array_key_exists('where_exclusive',$args)){
            $query->where($args['where_exclusive']);
            $where_exclusive=true;
          }
          if(array_key_exists('where_in',$args)){
            $name=array_keys($args['where_in'])[0];
            $criteria=$args['where_in'][$name];
            $query->where_in($name,$criteria);
          }
          if(array_key_exists('limit',$args)){
            $query->limit($args['limit']);
          }
          if(array_key_exists('order_by',$args)){
            $query->order_by($args['order_by']);
          }
          if(array_key_exists('join',$args)){
            $query->join($args['join']);
          }
          
          $related_data=[];
          foreach($query->get() as $r){
            $related_data[$r->{$foreign_key}][]=$r;
          }
          // jsonbug(array_keys($related_data));
          // jsonbug($data);
          // jsonbug(self::_var('protected'));
          $related_keys=array_keys($related_data);
          foreach($data as $i=>$d){
			  // d($d);
			if(isset($d->{$local_key})){
            if(isset($where_exclusive)){
              if(!in_array($d->{$local_key},$related_keys)){
                unset($data[$i]);
              }
            }
            foreach($related_data as $k=>$r){
              if($d->{$local_key}==$k){
                // if(count($r)==1){
                  // $r=$r[0];
                // }
                $data[$i]->{$model}=$r;
              }
            }
			}
          }
        }
        self::$related=[];
      }
      
      if(self::$related_pivot){
        foreach(self::$related_pivot as $relations){
          $related=$relations[0];
          $args=$relations[1];
          // debug(self::get_related_model($related));
          extract(self::get_related_model($related));
          
          $local_values=[];
          foreach($data as $d){
            array_push($local_values,$d->$pivot_local_key);
          }
          
          $pivot=$model::from($pivot_table)
            ->select("$local_key,group_concat($foreign_key) as $foreign_key")
            ->group_by($local_key)
            ->where_in($local_key,$local_values);
          
          $foreign_values=[];
          $related_pivot=[];
          foreach($pivot->get() as $p){
            $p->$foreign_key=explode(',',$p->$foreign_key);
            $foreign_values=array_merge($foreign_values,$p->$foreign_key);
            $related_pivot[$p->$local_key]=$p;
          }

          $query=$model::from($table)
            ->where_in($pivot_foreign_key,array_unique($foreign_values));
            
          if(array_key_exists('select',$args)){
            $query->select($args['select']);
          }
          if(array_key_exists('where',$args)){
            $query->where($args['where']);
          }
          if(array_key_exists('limit',$args)){
            $query->limit($args['limit']);
          }
          if(array_key_exists('order_by',$args)){
            $query->order_by($args['order_by']);
          }
          if(array_key_exists('join',$args)){
            $query->join($args['join']);
          }

          $related_pivot_data=[];
          foreach($query->get() as $r){
            foreach($related_pivot as $p){
              if(in_array($r->id,$p->$foreign_key)){
                $related_pivot_data[$p->$local_key][]=$r;
              }
            }
          }
          
          foreach($data as $i=>$d){
            foreach($related_pivot_data as $k=>$r){
              if($d->{$pivot_local_key}==$k){
                $data[$i]->{$model}=$r;
              }
            }
          }
        }
      }
    }
    if(!self::$protected_filter){
      foreach(self::_var('protected') as $protected){
        self::recursive_unset($data,$protected);
      }
    }
    // d($data);
    return $data;
  }
  
  private static function recursive_unset(&$array, $key) {
    if(is_object($array)){
      unset($array->$key);
    }elseif(is_array($array)){
      unset($array[$key]);
    }
    foreach ($array as &$value) {
      if (is_array($value)||is_object($value)) {
        self::recursive_unset($value, $key);
      }
    }
  }
  private static function get_related_model($related){
    $foreign=singular(static::class);
    $local_key=self::_var('primary_key');
    if(!is_array($related)){
      $model=$related;
      $local_key=$local_key;
      $foreign_key=$foreign.'_id';
    }else if(array_values($related)===$related){
      $model=$related[0];
      $foreign_key=isset($related[1])?$related[1]:$foreign.'_id';
      $local_key=isset($related[2])?$related[2]:$local_key;
    }else{
      $model=isset($related['model'])?$related['model']:$method;
      $foreign_key=isset($related['foreign_key'])?$related['foreign_key']:$foreign.'_id';
      $local_key=isset($related['local_key'])?$related['local_key']:$local_key;
    }
    $ci=&get_instance();
    $ci->load->model($model);
    $model=basename($model);
    $table=(new $model)->table;

    // d($related);
    $pivot_table=isset($related['pivot_table'])?$related['pivot_table']:null;
    $pivot_foreign_key=$pivot_table?$model::_var('primary_key'):null;
    $pivot_local_key=$pivot_table?self::_var('primary_key'):null;
    
    return [
      'model'=>$model,
      'table'=>$table,
      'local_key'=>$local_key,
      'foreign_key'=>$foreign_key,
      'pivot_table'=>$pivot_table,
      'pivot_local_key'=>$pivot_local_key,
      'pivot_foreign_key'=>$pivot_foreign_key,
    ];
  }
  
  
  /* ----------------------------------------------------------------------------
  View Utilities
  ---------------------------------------------------------------------------- */
	public static function get_next($column='id'){
    return self::select("MAX($column)+1 as $column")->one()->{$column};
  }
  /* ----------------------------------------------------------------------------
  Join section
  ---------------------------------------------------------------------------- */
	public static function leftjoin($has_one,$operator='='){
    self::join($has_one,$operator,'LEFT');
    return new static();
  }
  public static function rightjoin($has_one,$operator='='){
    self::join($has_one,$operator,'RIGHT');
    return new static();
  }
	public static function join($has_one,$operator='=',$type='ON'){
    if(is_array($has_one)){
      // debug($has_one);
      $key=array_keys($has_one)[0];
      self::join($key,$operator,$type);
      $value=array_values($has_one)[0];
      $related=self::_var('has_one')[$key];      
      extract(self::get_related_model($related));
      $localtable=$table;
      $localtable_key=$local_key;
      $relatedjoin= (new $model)->_var('has_one')[$value];
      extract(self::get_related_model($relatedjoin));
    //   d("$table.$foreign_key $operator $localtable.$localtable_key");
      self::$db->join($table,"$table.$foreign_key $operator $localtable.$localtable_key",$type);
      if(self::$default_select){
        self::$db->select("$table.*, $localtable.*");
      }
    }
    else{
      $related=self::_var('has_one')[$has_one];
      extract(self::get_related_model($related));
      $localtable=self::_var('table');
    //   d(self::get_related_model($related));
      self::$db->join($table,"$table.$foreign_key $operator $localtable.$local_key",$type);
      if(self::$default_select){
        self::$db->select("$table.*, $localtable.*");
      }
    }
    return new static();
	}
  /* ----------------------------------------------------------------------------
  Insert section
  ---------------------------------------------------------------------------- */
	public static function insert($data_insert,$validate=true){
    if($validate){      
      $data_insert = self::validate($data_insert,'insert');
    }
    if($data_insert!==false){
     $data_insert = self::trigger('before_create', $data_insert);
//        debug($data_insert);
      self::$db->insert(self::_var('table'), $data_insert);
      $insert_id = self::$db->insert_id();
     self::trigger('after_create');
      return ['success'=>$insert_id];
    }
    else{
      $ci=&get_instance();
      return ['error'=>$ci->form_validation->error_array()];
    }
	}
  
  public static function insert_batch($data_batch,$validate=true){
    if($validate){      
      foreach($data_batch as $d){
        $data_valid=self::validate($d,'insert');
        if($data_valid){
          $tmp[]=$data_valid;
        }else{
          $ci=&get_instance();
          return ['error'=>$ci->form_validation->error_array()];          
        }
      }
      $data_batch=$tmp;
    }
    if($data_batch!==false){
      $tmp=[];
      foreach($data_batch as $d){
        $tmp[]=self::trigger('before_create', $d);
      }
      $data_batch=$tmp;
      self::$db->insert_batch(self::_var('table'), $data_batch);
      $insert_id = self::$db->insert_id()+count($data_batch)-1;
      
      foreach($data_batch as $d){
        self::trigger('after_create');
      }
      return ['success'=>$insert_id];
    }
    else{
      $ci=&get_instance();
      return ['error'=>$ci->form_validation->error_array()];
    }
	}
   
  /* ----------------------------------------------------------------------------
  Update section
  ---------------------------------------------------------------------------- */
	public static function update($primary_value,$data,$validate=true){
    if($validate){      
      $data = self::validate($data,'update');
    }
    if($data!==false){
     $data = self::trigger('before_update', $data);
      $result=self::$db
             ->where(self::_var('primary_key'),$primary_value)
             ->update(self::_var('table'), $data);
     self::trigger('after_update');
      return ['success'=>$result];
    }
    else{
      $ci=&get_instance();
      return ['error'=>$ci->form_validation->error_array()];
    }
	}
  public static function update_batch($data_batch,$key,$validate=true){
    if($validate){      
      foreach($data_batch as $d){
        $data_valid=self::validate($d,'update');
        if($data_valid){
          $tmp[]=$data_valid;
        }else{
          $ci=&get_instance();
          return ['error'=>$ci->form_validation->error_array()];          
        }
      }
      $data_batch=$tmp;
    }
    if($data_batch!==false){
      $tmp=[];
      foreach($data_batch as $d){
        $tmp[]=self::trigger('before_update', $d);
      }
      $data_batch=$tmp;
      // debug(count($data_batch));
      self::$db->update_batch(self::_var('table'), $data_batch,$key);
      $insert_id = self::$db->insert_id()+count($data_batch)-1;
      foreach($data_batch as $d){
        self::trigger('after_update');
      }
      $data_batch=$tmp;
      
      return ['success'=>$insert_id];
    }
    else{
      $ci=&get_instance();
      return ['error'=>$ci->form_validation->error_array()];
    }
	}
  
  /* ----------------------------------------------------------------------------
  Delete section
  ---------------------------------------------------------------------------- */
	public static function delete($id=null,$force_delete=false){
    if($id){
      self::trigger('before_delete',$id);
      self::where_in(self::_var('primary_key'),$id);
    }
    if(!self::$soft_delete || $force_delete){
      $result=self::$db->delete(self::_var('table'));
    }else{
      $result=self::$db->update(self::_var('table'),self::deleted_at());
    }
    self::trigger('after_delete');
    return $result;
	}
  public static function force_delete($id=null){
    self::delete($id,true);
  }
  public static function restore($id){
    return self::update($id,['deleted_at'=>null],false);
  }
  public static function restore_batch($id){
    $data=[];
    $primary_key=self::_var('primary_key');
    foreach($id as $k=>$i){
      $data[]=[
        $primary_key=>$i,
        'deleted_at'=>null
      ];
    }
    // debug($data);
    return self::update_batch($data,$primary_key);
    // debug($id);
    // return self::update_batch($id,['deleted_at'=>null],false);
  }
  
  
  /* ----------------------------------------------------------------------------
  Extended native query
  ---------------------------------------------------------------------------- */
  public static function from($table = null){
    $table = $table? $table : self::_var('table');
		self::$db->from($table);
		return new static();
	}
  
  public static function get($table = null,$limit=null,$offset=null){
    self::trigger('before_get');
    $data= self::$db->get($table,$limit,$offset)->result();
    $data = self::trigger('after_get', $data);
		return $data;
	}
  
  public static function select($select = '*', $escape = null){
		static::$db->select($select, $escape);
    self::$default_select=false;
		return new static();
	}
  
	public static function where($criteria, $value=null){
		if (is_array($criteria)){
      self::$db->where($criteria);
    }else{
      self::$db->where($criteria,$value);
    }
    return new static();
  }
  
	public static function or_where($criteria, $value=null){
		if (is_array($criteria)){
      self::$db->or_where($criteria);
    }else{
      self::$db->or_where($criteria,$value);
    }
    return new static();
  }
  
	public static function where_in($name,$criteria){
		if ($name&&is_array($criteria)){
      self::$db->where_in($name,$criteria);
    }
    return new static();
  }
  public function where_not_in($name,$criteria){
		if ($name&&is_array($criteria)){
      self::$db->where_not_in($name,$criteria);
    }
    return new static();
  }
  
	public static function order_by($criteria, $order = 'ASC'){
		if (is_array($criteria)){
			foreach ($criteria as $key => $value){
				self::$db->order_by($key, $value);
			}
		}else{
			self::$db->order_by($criteria, $order);
		}
		return new static();
	}
  
	public static function limit($limit, $offset = 0){
		self::$db->limit($limit, $offset);
		return new static();
	}
  
	public static function like($field, $value = null){
		if (is_array($field)){
			foreach ($field as $key => $value){
				self::$db->like($key, $value);
			}
		} else {
			self::$db->like($field, $value);
		}
		return new static();
	}
  
	public static function or_like($field, $value = null){
		if (is_array($field)){
			foreach ($field as $key => $value){
				self::$db->or_like($key, $value);
			}
		} else {
			self::$db->or_like($field, $value);
		}
		return new static();
	}
	public static function group_by($field){
    self::$db->group_by($field);
		return new static();
	}
	public static function count(){
		$count=self::$db->from(self::_var('table'));
        return self::$db->count_all_results();
	}
  
  /* ----------------------------------------------------------------------------
  Delete utilities
  ---------------------------------------------------------------------------- */
  public static function trashed($state='default'){
    self::$deleted_filter=$state;
    return new static();
  }
  public static function with_deleted(){
    self::$deleted_filter='with_deleted';
    return new static();
  }
  public static function only_deleted(){
    self::$deleted_filter='only_deleted';
    return new static();
  }
  public static function with_protected(){
    self::$protected_filter=true;
    return new static();
  }
  /* ----------------------------------------------------------------------------
  Search utilities
  ---------------------------------------------------------------------------- */
  public static function search($keyword=null,$fields=null){
    $table=self::_var('table');
    if(!$fields){
      $fields=self::$db->list_fields($table);
    }else{
      $fields=explode(',',$fields);
    }
    // debug($fields);
    $fields=array_diff($fields,['id','created_at','updated_at','deleted_at']);
    //debug($fields);
    if($keyword){
      self::$db->group_start();
      foreach($fields as $f){
        self::$db->or_like($f, $keyword);
      }
      self::$db->group_end();
    }
    return new static();
  }
  
  /* ----------------------------------------------------------------------------
  Timestamp utilities
  ---------------------------------------------------------------------------- */
  private static function add_timestamp($row,$method=null){
    if($method){
    //   if(!self::$db->field_exists($method,self::_var('table'))){
    //     $this->load->dbforge();
    //     self::$dbforge->add_column($this->table,[$method => ['type' => 'DATETIME']]);
    //   }
      if (is_object($row)){
        $row->{$method} = date('Y-m-d H:i:s');
      }else{
        $row[$method] = date('Y-m-d H:i:s');
      }
    }
    return $row;
  }
  private static function created_at($row){
    if(!isset($row['created_at'])){
      $row=self::add_timestamp($row,'created_at');
    }
    return $row;
  }
  private static function updated_at($row){
    $row=self::add_timestamp($row,'updated_at');
    return $row;
  }
  private static function deleted_at($row=[]){
    $row=self::add_timestamp($row,'deleted_at');
    return $row;
  }
  
  public static function with($method,$args=[]){
    $has_one = self::_var('has_one');
    $args=isset($args[0])?$args[0]:$args;
    if(array_key_exists($method,$has_one)){
      array_push(self::$related,[$has_one[$method],$args]);
    }
    
    $has_many = self::_var('has_many');
    if(array_key_exists($method,$has_many)){
      array_push(self::$related,[$has_many[$method],$args]);
    }
    
    $has_many_pivot = self::_var('has_many_pivot');
    if(array_key_exists($method,$has_many_pivot)){
      array_push(self::$related_pivot,[$has_many_pivot[$method],$args]);
    }
    return new static();
  }
  
  /* ----------------------------------------------------------------------------
  Utilities
  ---------------------------------------------------------------------------- */
  public function __call($method,$args){
    $one = self::_var('has_one');
    $many = self::_var('has_many');
    $many_pivot = self::_var('has_many_pivot');
    // debug($method);
    if(array_key_exists($method,array_merge($one,$many,$many_pivot))){
      $this->with($method,$args);
      return $this;
    }
    return "Method $method Not found";
  }
  
  public static function __callStatic($method,$args){
    $one = self::_var('has_one');
    $many = self::_var('has_many');
    $many_pivot = self::_var('has_many_pivot');
    // debug($method);
    if(array_key_exists($method,array_merge($one,$many,$many_pivot))){
      self::with($method,$args);
      return new static();
    }
    return "Method $method Not found";
  }
  
  private static function trigger($event, $data = false, $last = true){
    $event=self::_var($event);
    if (isset($event) && is_array($event)){
      foreach ($event as $method){
        if (strpos($method, '(')){
          preg_match('/([a-zA-Z0-9\_\-]+)(\(([a-zA-Z0-9\_\-\., ]+)\))?/', $method, $matches);
          $method = $matches[1];
          self::$callback_parameters = explode(',', $matches[3]);
        }
      $data = call_user_func_array(array(static::class, $method), array($data, $last));
      }
    }
    return $data;
  }
  
  public static function validate($data,$method=null){
    if(!empty(self::_var('rules'))){
      $rules=self::_var('rules');
      if(array_key_exists($method,$rules)){
        $rules=$rules[$method];
      }
      $ci=&get_instance();
      $ci->load->library('form_validation');
      $ci->form_validation->set_data($data);
      $ci->form_validation->set_rules($rules);
      if ($ci->form_validation->run() === true){
        return $data;
      }else{
        // debug($ci->form_validation->error_array());
        return false;
      }
    }else{
      return $data;
    }
  }
}
?>