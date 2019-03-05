<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Kamera extends MY_Model{
  
  public $table = 'media__kamera';
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
      'type' => 'varchar',
      'constraint' => '255'
    ],
    'url' => [
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