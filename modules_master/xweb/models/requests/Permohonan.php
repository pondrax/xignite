<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Permohonan extends MY_Model{
  
  public $table = 'requests';
  public $primary_key = 'id';
  public $fields = [
    'id' => [
      'type' => 'int',
      'constraint' => '11',
      'auto_increment' => true
    ],
    'nik' => [
      'type' => 'varchar',
      'constraint' => '255'
    ],
    'nama' => [
      'type' => 'varchar',
      'constraint' => '255'
    ],
    'alamat' => [
      'type' => 'varchar',
      'constraint' => '255'
    ],
    'rincian_informasi' => [
      'type' => 'varchar',
      'constraint' => '255'
    ],
    'tujuan_informasi' => [
      'type' => 'varchar',
      'constraint' => '255'
    ],
    'telepon' => [
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