<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Aduan extends MY_Model{
  
  public $table = 'aduan';
  public $primary_key = 'id';
  public $fields = [
    'id' => [
      'type' => 'int',
      'constraint' => '11',
      'auto_increment' => true
    ],
    'id_user' => [
      'type' => 'int',
      'constraint' => 11
    ],
    'id_kategori' => [
      'type' => 'int',
      'constraint' => 11
    ],
    'judul' => [
      'type' => 'varchar',
      'constraint' => 11
    ],
    'aduan' => [
      'type' => 'text',
      'constraint' => 11
    ],
    'status' => [
      'type' => 'varchar',
      'constraint' => 11
    ],
    'view' => [
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
      'rules' => 'trim|required'
    ],
    [
      'field' => 'id_user',
      'label' => 'User ID',
      'rules' => 'trim|required'
    ],
    [
      'field' => 'id_kategori',
      'label' => 'Kategori ID',
      'rules' => 'trim|required'
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
      'local_key' => 'id_user'
    ]
  ];
  
  
}