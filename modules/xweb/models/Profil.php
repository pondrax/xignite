<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Profil extends MY_Model{
  
  public $table = 'users__profile';
  public $primary_key = 'id';
  
  
  public $fields = [
    'id' => [
      'type' => 'int',
      'constraint' => '11',
      'auto_increment' => true
    ],
    'kategori' => [
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
    ]
  ];
  
  
  public $before_create = [
    'created_at',
    'updated_at'
  ];
  public $before_update = [
    'updated_at'
  ];
  
  
    public $has_one = [
    'pengguna' => [
      'model' => 'xadmin/master/pengguna',
      'foreign_key' => 'id',
      'local_key' => 'id_users'
    ]
  ];
  
}