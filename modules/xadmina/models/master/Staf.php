<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Staf extends MY_Model{
  
  public $table = 'users__workers';
  public $primary_key = 'id';
  public $fields = [
    'id' => [
      'type' => 'int',
      'constraint' => '11',
      'auto_increment' => true
    ],
    'nip' => [
      'type' => 'varchar',
      'constraint' => '255'
    ],
    'nama' => [
      'type' => 'int',
      'constraint' => '255'
    ],
    'jabatan' => [
      'type' => 'int',
      'constraint' => '255'
    ],
    'akses_modul' => [
      'type' => 'int',
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
      'field' => 'nip',
      'label' => 'Nip',
      'rules' => 'trim|required'
    ],
    [
      'field' => 'nama',
      'label' => 'Nama',
      'rules' => 'trim|required'
    ],
    [
      'field' => 'jabatan',
      'label' => 'Jabatan',
      'rules' => 'trim|required'
    ]
  ];
  
  
  public $before_create = [
    'created_at',
    ' updated_at'
  ];
  
  public $before_update = [
    'updated_at'
  ];
  
  
  
  
}