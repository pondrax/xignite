<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Laporan extends MY_Model{
  
  public $table = 'bab_i__laporan';
  public $primary_key = 'id';
  public $fields = [
    'id' => [
      'type' => 'int',
      'constraint' => '11',
      'auto_increment' => true
    ],
    'title' => [
      'type' => 'varchar',
      'constraint' => '255'
    ],
    'description' => [
      'type' => 'longtext'
    ],
    'url' => [
      'type' => 'varchar',
      'constraint' => '255'
    ],
    'status' => [
      'type' => 'varchar',
      'constraint' => '11'
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
      'field' => 'title',
      'label' => 'Judul',
      'rules' => 'required'
    ],
    [
      'field' => 'description',
      'label' => 'Deskripsi',
      'rules' => 'required'
    ],
    [
      'field' => 'url',
      'label' => 'Url',
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
  
  
  
  
}