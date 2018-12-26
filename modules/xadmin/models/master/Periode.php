<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Periode extends MY_Model{
  
  public $table = 'master__periode';
  public $primary_key = 'id';
  public $fields = [
    'id' => [
      'type' => 'int',
      'constraint' => '11',
      'auto_increment' => true
    ],
    'id_tahun' => [
      'type' => 'int',
      'constraint' => 11
    ],
    'id_user' => [
      'type' => 'int',
      'constraint' => 11
    ],
    'created_at' => [
      'type' => 'datetime',
      'null' => true
    ],
    'updated_at' => [
      'type' => 'datetime',
      'null' => true
    ],
    'deleted_at' => [
      'type' => 'datetime',
      'null' => true
    ]
  ];  
  public $rules = [
    [
      'field' => 'id',
      'label' => 'ID',
      'rules' => 'trim'
    ],
    [
      'field' => 'id_tahun',
      'label' => 'ID Tahun',
      'rules' => 'required'
    ],
  ];
  
  
  public $before_create = [
    'created_at',
    'updated_at'
  ];
  
  public $before_update = [
    'updated_at'
  ];
  
  
  public $has_many_pivot=[
    'pengisi'=>[
      'model'=>'xadmin/users/users',
      'foreign_key'=>'id_user',
      'local_key'=>'id_tahun',
      'pivot_table'=>'master__pengisi'
    ]
  ];
}