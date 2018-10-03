<?php

class MY_Model extends CI_Model{
  
  protected $table;
  protected $primary_key = 'id';
  
  protected $protected = array();

  protected $has_one = array();
  protected $has_many = array();
  protected $related = array();
  protected $related_pivot = array();

  protected $rules=null;
  
  protected $soft_delete = true;
  protected $deleted_filter = 'default'; //[default,with_deleted,only_deleted]
  protected $create_at_column = false;
  
  protected $before_get = array();
  protected $after_get = array();
  protected $before_create = array();
  protected $after_create = array();
  protected $before_update = array();
  protected $after_update = array();
  protected $before_delete = array();
  protected $after_delete = array();
  
  protected $callback_parameters = array();
  
  
  
  
  public function __construct(){
    parent::__construct();
    $this->load->helper('inflector');
  }
  
  /* ----------------------------------------------------------------------------
  prep view section
  ---------------------------------------------------------------------------- */
  public function _persist(){
    $this->class=strtolower(get_called_class());
    $this->table=$this->table?$this->table:$this->class;
    if($this->soft_delete && $this->create_at_column){
      if(!$this->db->field_exists('deleted_at',$this->table)){
        $this->load->dbforge();
        $this->dbforge->add_column($this->table,['deleted_at' => ['type' => 'DATETIME']]);
      }
    }
  }
  
  /* ----------------------------------------------------------------------------
  View section
  ---------------------------------------------------------------------------- */   
  
  public function fetch_row($criteria='all'){
    return $this->fetch($criteria,true)[0];
  }
  
  public function fetch($criteria='all',$limit=false){
    $this->from();
    
    if(is_array($criteria)){
      if(array_values($criteria)===$criteria){
        $this->where_in($this->primary_key,$criteria);
      }else{
        $this->where($criteria);
      }
    }else{
      if($criteria!='all'){
        $this->where($this->primary_key,$criteria);
      }
    }
    if($limit){
      $this->limit(1);
    }
    $data=$this->get_join_result($this->get());
    
    return $data;
  }
  
  public function fetch_table($criteria='all'){
    $this->from();
    
    $limit =$this->input->get('limit');
    $offset=$this->input->get('offset');
    $sort  =$this->input->get('sort');
    $order =$this->input->get('order');
    $search=$this->input->get('search');
    $filter=$this->input->get('filter');
    
    $this->search($search);
    if($this->soft_delete){
      switch($this->deleted_filter){
        case 'with_deleted':
          break;
        case 'only_deleted':
          $this->where('deleted_at!=',null);
          break;
        default:
          $this->where('deleted_at',null);
      }
    }
    $total=$this->db->count_all_results('',false);
    $this->order_by($sort,$order);
    if($limit){
      $this->limit($limit,$offset);
    }
    
    if(is_array($criteria)){
      if(array_values($criteria)===$criteria){
        $this->where_in($this->primary_key,$criteria);
      }else{
        $this->where($criteria);
      }
    }else{
      if($criteria!='all'){
        $this->where($this->primary_key,$criteria);
      }
    }
    
    
    $data=$this->get_join_result($this->get());
    
    $output=[
      'total'=>$total,
      'rows'=>$data
    ];
    return $output;
  }
  
  private function get_join_result($data){
    if(count($data)){
      if($this->related){
        $local_values=[];
        foreach($this->related as $relations){
          $related=$relations[0];
          $args=$relations[1];

          extract($this->get_related_model($related));
          $local_values[$model]=[];
          foreach($data as $d){
            array_push($local_values[$model],$d->{$local_key});
          }
          
          $query=$this->$model
            ->from($table)
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
        $this->related=[];
      }
      
      if($this->related_pivot){
        foreach($this->related_pivot as $relations){
          $related=$relations[0];
          $args=$relations[1];
          // debug($this->get_related_model($related));
          extract($this->get_related_model($related));
          
          $local_values=[];
          foreach($data as $d){
            array_push($local_values,$d->$pivot_local_key);
          }
          
          $pivot=$this->from($pivot_table)
            ->select("$local_key,group_concat($foreign_key) as $foreign_key")
            ->group_by($local_key)
            ->where_in($local_key,$local_values)->get();
          
          $foreign_values=[];
          $related_pivot=[];
          foreach($pivot as $p){
            $p->$foreign_key=explode(',',$p->$foreign_key);
            $foreign_values=array_merge($foreign_values,$p->$foreign_key);
            $related_pivot[$p->$local_key]=$p;
          }

          $query=$this->$model->from($table)
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

          $result=$query->get();
          $related_pivot_data=[];
          foreach($result as $r){
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
  
  private function get_related_model($related){
    $class=$this->class;
    $foreign=singular($class);
    $local_key=$this->primary_key;

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
    $this->load->model($model);
    $model=basename($model);
    $table=$this->$model->table?$this->$model->table:$model;

    $pivot_table=isset($related['pivot_table'])?$related['pivot_table']:null;
    $pivot_foreign_key=$pivot_table?$this->$model->primary_key:null;
    $pivot_local_key=$pivot_table?$this->primary_key:null;
    
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
	public function get_next($column='id'){
    return $this->select("MAX($column)+1 as $column")->fetch_row()->{$column};
  }
  /* ----------------------------------------------------------------------------
  Join section
  ---------------------------------------------------------------------------- */
	public function leftjoin($has_one,$operator='='){
    $this->join($has_one,$operator,'LEFT');
  }
  public function rightjoin($has_one,$operator='='){
    $this->join($has_one,$operator,'RIGHT');
  }
	public function join($has_one,$operator='=',$type='ON'){
    $this->_persist();
    $related=$this->has_one[$has_one];
    extract($this->get_related_model($related));
    $this->db->join($table,"$table.$foreign_key $operator $this->table.$local_key",$type);
    return $this;
	}
  /* ----------------------------------------------------------------------------
  Insert section
  ---------------------------------------------------------------------------- */
	public function insert($data,$validate=true){
    if($validate){      
      $data = $this->validate($data,'insert');
    }
    if($data!==false){
      $data = $this->trigger('before_create', $data);
      $this->db->insert($this->table, $data);
      $insert_id = $this->db->insert_id();
      $this->trigger('after_create');
      return ['success'=>$insert_id];
    }
    else{
      return ['error'=>$this->form_validation->error_array()];
    }
	}
   
  /* ----------------------------------------------------------------------------
  Update section
  ---------------------------------------------------------------------------- */
	public function update($primary_value,$data,$validate=true){
    if($validate){      
      $data = $this->validate($data,'update');
    }
    if($data!==false){
      $data = $this->trigger('before_update', $data);
      $result=$this->db
             ->where($this->primary_key,$primary_value)
             ->update($this->table, $data);
      $this->trigger('after_update');
      return ['success'=>$result];
    }
    else{
      return ['error'=>$this->form_validation->error_array()];
    }
	}
  
  /* ----------------------------------------------------------------------------
  Delete section
  ---------------------------------------------------------------------------- */
	public function delete($id,$force_delete=false){
    $this->_persist();
    $this->trigger('before_delete',$id);
    $this->where_in($this->primary_key,$id);
    if(!$this->soft_delete || $force_delete){
      $result=$this->db->delete($this->table);
    }else{
      $result=$this->db->update($this->table,$this->deleted_at());
    }
    $this->trigger('after_delete');
    return $result;
	}
  public function restore($id){
    return $this->update($id,['deleted_at'=>null],false);
  }
  /* ----------------------------------------------------------------------------
  Extended native query
  ---------------------------------------------------------------------------- */
  public function get($table = null,$limit=null,$offset=null){
    $this->trigger('before_get');
    $data= $this->db->get($table,$limit,$offset)->result();
    $data = $this->trigger('after_get', $data);
		return $data;
	}
  public function from($table = null){
    if(!$table){
      $this->_persist();
      $table=$this->table;
    }
		$this->db->from($table);
		return $this;
	}
  public function select($select = '*', $escape = null){
		$this->db->select($select, $escape);
		return $this;
	}
  
	public function where($criteria, $value=null){
		if (is_array($criteria)){
      $this->db->where($criteria);
    }else{
      $this->db->where($criteria,$value);
    }
    return $this;
  }
  
	public function or_where($criteria, $value=null){
		if (is_array($criteria)){
      $this->db->or_where($criteria);
    }else{
      $this->db->or_where($criteria,$value);
    }
    return $this;
  }
  
	public function where_in($name,$criteria){
		if ($name&&is_array($criteria)){
      $this->db->where_in($name,$criteria);
      return $this;
    }
  }
  
	public function order_by($criteria, $order = 'ASC'){
		if (is_array($criteria)){
			foreach ($criteria as $key => $value){
				$this->db->order_by($key, $value);
			}
		}else{
			$this->db->order_by($criteria, $order);
		}
		return $this;
	}
  
	public function limit($limit, $offset = 0){
		$this->db->limit($limit, $offset);
		return $this;
	}
	
	public function like($field, $value = null){
		if (is_array($field)){
			foreach ($field as $key => $value){
				$this->db->like($key, $value);
			}
		} else {
			$this->db->like($field, $value);
		}
		return $this;
	}
  
	public function or_like($field, $value = null){
		if (is_array($field)){
			foreach ($field as $key => $value){
				$this->db->or_like($key, $value);
			}
		} else {
			$this->db->or_like($field, $value);
		}
		return $this;
	}
	public function group_by($field){
    $this->db->group_by($field);
		return $this;
	}
  
  /* ----------------------------------------------------------------------------
  Delete utilities
  ---------------------------------------------------------------------------- */
  public function trashed($state='default'){
    $this->deleted_filter=$state;
    return $this;
  }
  public function with_deleted(){
    $this->deleted_filter='with_deleted';
    return $this;
  }
  public function only_deleted(){
    $this->deleted_filter='only_deleted';
    return $this;
  }
  /* ----------------------------------------------------------------------------
  Search utilities
  ---------------------------------------------------------------------------- */
  public function search($keyword=null,$fields=null){
    if(!$fields){
      $this->_persist();
      $fields=$this->db->list_fields($this->table);
    }else{
      $fields=explode(',',$fields);
    }
    if($keyword){
      $this->db->group_start();
      foreach($fields as $f){
        $this->db->or_like($f, $keyword);
      }
      $this->db->group_end();
    }
    return $this;
  }
  
  /* ----------------------------------------------------------------------------
  Timestamp utilities
  ---------------------------------------------------------------------------- */
  private function add_timestamp($row,$method=null){
    if($method){
      if(!$this->db->field_exists($method,$this->table)){
        $this->load->dbforge();
        $this->dbforge->add_column($this->table,[$method => ['type' => 'DATETIME']]);
      }
      if (is_object($row)){
        $row->{$method} = date('Y-m-d H:i:s');
      }else{
        $row[$method] = date('Y-m-d H:i:s');
      }
    }
    return $row;
  }
  private function created_at($row){
    $row=$this->add_timestamp($row,'created_at');
    return $row;
  }
  private function updated_at($row){
    $row=$this->add_timestamp($row,'updated_at');
    return $row;
  }
  private function deleted_at($row=[]){
    $row=$this->add_timestamp($row,'deleted_at');
    return $row;
  }
  
  /* ----------------------------------------------------------------------------
  Utilities
  ---------------------------------------------------------------------------- */
  public function __call($method,$args){
    $args=isset($args[0])?$args[0]:array();
    if(array_key_exists($method,$this->has_one)){
      array_push($this->related,[$this->has_one[$method],$args]);
      return $this;
    }
    if(array_key_exists($method,$this->has_many)){
      array_push($this->related,[$this->has_many[$method],$args]);
      return $this;
    }
    if(array_key_exists($method,$this->has_many_pivot)){
      array_push($this->related_pivot,[$this->has_many_pivot[$method],$args]);
      return $this;
    }
  }
  private function trigger($event, $data = false, $last = true){
    if (isset($this->$event) && is_array($this->$event)){
      foreach ($this->$event as $method){
        if (strpos($method, '(')){
          preg_match('/([a-zA-Z0-9\_\-]+)(\(([a-zA-Z0-9\_\-\., ]+)\))?/', $method, $matches);
          $method = $matches[1];
          $this->callback_parameters = explode(',', $matches[3]);
        }
      $data = call_user_func_array(array($this, $method), array($data, $last));
      }
    }
    return $data;
  }
  
  private function validate($data,$method=null){
    if(!empty($this->rules)){
      $rules=$this->rules;
      if(array_key_exists($method,$rules)){
        $rules=$rules[$method];
      }
      $this->load->library('form_validation');
      $this->form_validation->set_data($data);
      $this->form_validation->set_rules($rules);
      if ($this->form_validation->run() === true){
        return $data;
      }else{
        return false;
      }
    }else{
      return $data;
    }
  }
}