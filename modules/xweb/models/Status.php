<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Status extends MY_Model{
  
  public $table = 'status_pengaduan';
  public $primary_key = 'id_status_pengaduan';
  public $fields = [
    'id' => [
      'type' => 'int',
      'constraint' => '11',
      'auto_increment' => true
    ],
    'status_aduan' => [
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
      'field' => 'status_aduan',
      'label' => 'Status pengaduan',
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