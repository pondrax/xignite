<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Laporan extends MY_Model{
  
  public $table = 'bab_iv__laporan';
  public $primary_key = 'id';
  public $fields = [
    'id' => [
      'type' => 'int',
      'constraint' => '11',
      'auto_increment' => true
    ],
    'tujuan' => [
      'type' => 'varchar',
      'constraint' => 11
    ],
    'permasalahan' => [
      'type' => 'varchar',
      'constraint' => 11
    ],
    'solusi' => [
      'type' => 'varchar',
      'constraint' => 11
    ],
    'penghargaan' => [
      'type' => 'varchar',
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
  
  
  
  
}