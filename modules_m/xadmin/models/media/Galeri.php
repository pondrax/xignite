<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Galeri extends MY_Model{
  
  public $table = 'media__galeri';
  public $primary_key = 'id';
  public $fields = [
    'id' => [
      'type' => 'int',
      'constraint' => '11',
      'auto_increment' => true
    ],
    'judul' => [
      'type' => 'varchar',
      'constraint' => '255'
    ],
    'deskripsi' => [
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
    ],
    [
      'field' => 'judul',
      'label' => 'Judul',
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
  
  
  
  
}