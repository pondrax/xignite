<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Category extends MY_Model{
  
  public $table = 'pages__category';
  public $primary_key = 'id';
  public $fields = [
    'id' => [
      'type' => 'int',
      'constraint' => '11',
      'auto_increment' => true
    ],
    'slug_kategori' => [
      'type' => 'varchar',
      'constraint' => '255'
    ],
    'nama_kategori' => [
      'type' => 'varchar',
      'constraint' => '255'
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
      'field' => 'slug_kategori',
      'label' => 'Slug',
      'rules' => 'trim'
    ],
    [
      'field' => 'nama_kategori',
      'label' => 'Nama Kategori',
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
    'pages' => [
      'model' => 'xadmin/pages/pages',
      'foreign_key' => 'kategori_id',
      'local_key' => 'id'
    ]
  ];
  
  
}