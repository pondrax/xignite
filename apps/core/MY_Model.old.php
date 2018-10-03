<?php

class MY_Model extends CI_Model{
  protected static $db;
  
  protected static $class;
  protected static $model;
  protected static $table;
  protected static $primary_key='id';
  
  protected static $protected = array();

  protected static $has_one = array();
  protected static $has_many = array();
  protected static $has_many_pivot = array();
  protected static $related = array();
  protected static $related_pivot = array();

  protected static $rules=null;
  
  protected static $soft_delete = true;
  protected static $deleted_filter = 'default'; //[default,with_deleted,only_deleted]
  protected static $create_at_column = false;
  
  protected static $before_get = array();
  protected static $after_get = array();
  protected static $before_create = array();
  protected static $after_create = array();
  protected static $before_update = array();
  protected static $after_update = array();
  protected static $before_delete = array();
  protected static $after_delete = array();
  
  protected static $callback_parameters = array();
  
  
  public function __construct(){
    parent::__construct();
    $this->load->helper('inflector');
    self::$db = &get_instance()->db;
    static::$table=static::$table?static::$table:static::class;
    static::$primary_key=static::$primary_key;
  }
  
  
  public static function one($criteria='all'){
    return self::fetch($criteria,true)[0];
  }
  public static function all($criteria='all'){
    return self::fetch($criteria);
  }
  
  public static function fetch($criteria='all',$one=false){
    self::from();
    if(is_array($criteria)){
      if(array_values($criteria)===$criteria){
        self::where_in(static::$primary_key,$criteria);
      }else{
        self::where($criteria);
      }
    }else{
      if($criteria!='all'){
        self::where(static::$primary_key,$criteria);
      }
    }
    if($one){
      self::limit(1);
    }
    $data=self::get_join_result(self::get());
    
    return $data;
  }
  
  
  public static function fetch_table($criteria='all'){
    self::from();
    
    $ci=&get_instance();
    $limit =$ci->input->get('limit');
    $offset=$ci->input->get('offset');
    $sort  =$ci->input->get('sort');
    $order =$ci->input->get('order');
    $search=$ci->input->get('search');
    $filter=$ci->input->get('filter');
    
    if(static::$soft_delete){
      switch(self::$deleted_filter){
        case 'with_deleted':
          break;
        case 'only_deleted':
          self::where('deleted_at!=',null);
          break;
        default:
          self::where('deleted_at',null);
      }
    }
    if(is_array($criteria)){
      if(array_values($criteria)===$criteria){
        self::where_in(static::$primary_key,$criteria);
      }else{
        self::where($criteria);
      }
    }else{
      if($criteria!='all'){
        self::where(static::$primary_key,$criteria);
      }
    }
    
    self::search($search);
    $total=self::$db->count_all_results('',false);
    
    self::order_by($sort,$order);
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
            array_push($local_values[$model],$d->{$local_key});
          }

          $query=$model::from($table)
            ->where_in($foreign_key,$local_values[$model]);
            
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
          
          $related_data=[];
          foreach($query->get() as $r){
            if(!isset($related_data[$r->{$foreign_key}])){
              $related_data[$r->{$foreign_key}]=$r;
            }else{
              $related_data[$r->{$foreign_key}]=[$related_data[$r->{$foreign_key}],$r];
            }
          }
          
          foreach($data as $i=>$d){
            foreach($related_data as $k=>$r){
              if($d->{$local_key}==$k){
                $data[$i]->{$model}=$r;
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

          $related_pivot_data=[];
          foreach($query->get() as $r){
            foreach($related_pivot as $p){
              if(in_array($r->id,$p->$foreign_key)){
                if(!isset($related_pivot_data[$p->$local_key])){
                  $related_pivot_data[$p->$local_key]=[];
                }
                array_push($related_pivot_data[$p->$local_key],$r);
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
    return $data;
  }
  
  private static function get_related_model($related){
    $class=self::$class;
    $foreign=singular($class);
    $local_key=static::$primary_key;

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
    $table=$model::$table;

    $pivot_table=isset($related['pivot_table'])?$related['pivot_table']:null;
    $pivot_foreign_key=$pivot_table?$model::$primary_key:null;
    $pivot_local_key=$pivot_table?static::$primary_key:null;
    
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
  }
  public static function rightjoin($has_one,$operator='='){
    self::join($has_one,$operator,'RIGHT');
  }
	public static function join($has_one,$operator='=',$type='ON'){
    $related=static::$has_one[$has_one];
    extract(self::get_related_model($related));
    $localtable=static::$table;
    self::$db->join($table,"$table.$foreign_key $operator $localtable.$local_key",$type);
    return new static();
	}
  /* ----------------------------------------------------------------------------
  Insert section
  ---------------------------------------------------------------------------- */
	public static function insert($data,$validate=true){
    if($validate){      
      $data = self::validate($data,'insert');
    }
    if($data!==false){
      $data = self::trigger('before_create', $data);
      self::$db->insert(static::$table, $data);
      $insert_id = self::$db->insert_id();
      self::trigger('after_create');
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
             ->where(static::$primary_key,$primary_value)
             ->update(static::$table, $data);
      self::trigger('after_update');
      return ['success'=>$result];
    }
    else{
      $ci=&get_instance();
      return ['error'=>$ci->form_validation->error_array()];
    }
	}
  
  /* ----------------------------------------------------------------------------
  Delete section
  ---------------------------------------------------------------------------- */
	public static function delete($id,$force_delete=false){
    self::trigger('before_delete',$id);
    self::where_in(static::$primary_key,$id);
    if(!self::$soft_delete || $force_delete){
      $result=self::$db->delete(static::$table);
    }else{
      $result=self::$db->update(static::$table,self::deleted_at());
    }
    self::trigger('after_delete');
    return $result;
	}
  public static function restore($id){
    return self::update($id,['deleted_at'=>null],false);
  }
  
  /* ----------------------------------------------------------------------------
  Extended native query
  ---------------------------------------------------------------------------- */
  public static function from($table = null){
    $table = $table? $table : static::$table;
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
  /* ----------------------------------------------------------------------------
  Search utilities
  ---------------------------------------------------------------------------- */
  public static function search($keyword=null,$fields=null){
    if(!$fields){
      $fields=self::$db->list_fields(static::$table);
    }else{
      $fields=explode(',',$fields);
    }
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
      if(!self::$db->field_exists($method,static::$table)){
        $this->load->dbforge();
        self::$dbforge->add_column($this->table,[$method => ['type' => 'DATETIME']]);
      }
      if (is_object($row)){
        $row->{$method} = date('Y-m-d H:i:s');
      }else{
        $row[$method] = date('Y-m-d H:i:s');
      }
    }
    return $row;
  }
  private static function created_at($row){
    $row=self::add_timestamp($row,'created_at');
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
    if(array_key_exists($method,static::$has_one)){
      array_push(self::$related,[static::$has_one[$method],$args]);
    }
    if(array_key_exists($method,static::$has_many)){
      array_push(self::$related,[static::$has_many[$method],$args]);
    }
    if(array_key_exists($method,static::$has_many_pivot)){
      array_push(self::$related_pivot,[static::$has_many_pivot[$method],$args]);
    }
    return new static();
  }
  
  /* ----------------------------------------------------------------------------
  Utilities
  ---------------------------------------------------------------------------- */
  // public static function __callStatic($method,$args){
    // $args=isset($args[0])?$args[0]:array();
    // if(array_key_exists($method,static::$has_one)){
      // array_push(self::$related,[static::$has_one[$method],$args]);
    // }
    // if(array_key_exists($method,static::$has_many)){
      // array_push(self::$related,[static::$has_many[$method],$args]);
    // }
    // if(array_key_exists($method,static::$has_many_pivot)){
      // array_push(self::$related_pivot,[static::$has_many_pivot[$method],$args]);
    // }
    // return new static();
  // }
  
  public static function __callStatic($method,$args){
    echo $method;
    return new static();
  }
  
  private static function trigger($event, $data = false, $last = true){
    if (isset(static::$event) && is_array(static::$event)){
      foreach (static::$event as $method){
        if (strpos($method, '(')){
          preg_match('/([a-zA-Z0-9\_\-]+)(\(([a-zA-Z0-9\_\-\., ]+)\))?/', $method, $matches);
          $method = $matches[1];
          self::$callback_parameters = explode(',', $matches[3]);
        }
      $data = call_user_func_array(array(self, $method), array($data, $last));
      }
    }
    return $data;
  }
  
  public static function validate($data,$method=null){
    if(!empty(static::$rules)){
      $rules=static::$rules;
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
        return false;
      }
    }else{
      return $data;
    }
  }
}
?>