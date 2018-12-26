<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Pengisi extends MY_Model{
  
  public $table = 'bab_v__pengisi';
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
  
  public $has_one = [
    'pengguna' => [
      'model' => 'xadmin/users/users',
      'foreign_key' => 'id',
      'local_key' => 'id_user'
    ],
    'tahun' => [
      'model' => 'xadmin/master/periode',
      'foreign_key' => 'id',
      'local_key' => 'id_tahun'
    ]
  ];
  
  
  
  
}