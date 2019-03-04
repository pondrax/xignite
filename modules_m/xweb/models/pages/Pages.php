<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends MY_Model{
  
  public $table = 'pages';
  public $primary_key = 'id';
  public $fields = [
    'id' => [
      'type' => 'int',
      'constraint' => '11',
      'auto_increment' => true
    ],
    'kategori_id' => [
      'type' => 'int',
      'constraint' => '11'
    ],
    'slug' => [
      'type' => 'varchar',
      'constraint' => '255'
    ],
    'title' => [
      'type' => 'varchar',
      'constraint' => '255'
    ],
    'content' => [
      'type' => 'longtext'
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
      'field' => 'kategori_id',
      'label' => 'ID Kategori',
      'rules' => 'trim'
    ],
    [
      'field' => 'slug',
      'label' => 'Slug',
      'rules' => 'trim'
    ],
    [
      'field' => 'title',
      'label' => 'Judul',
      'rules' => 'trim'
    ],
    [
      'field' => 'content',
      'label' => 'Isi',
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
    'category' => [
      'model' => 'xadmin/pages/category',
      'foreign_key' => 'id',
      'local_key' => 'kategori_id'
    ]
  ];
  
  
}