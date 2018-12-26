<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Urusan extends MY_Model{
  
  public $table = 'bab_iv__urusan';
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
    ],
    [
      'field' => 'no',
      'label' => 'No',
      'rules' => 'required|trim'
    ],
    [
      'field' => 'urusan',
      'label' => 'Urusan',
      'rules' => 'required|trim'
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
    'periode' => [
      'model' => 'xadmin/master/periode',
      'foreign_key' => 'id',
      'local_key' => 'id_tahun'
    ]
  ];
  
  public $has_many = [
    'pengisi' => [
      'model' => 'xadmin/bab_iv/pengisi',
      'foreign_key' => 'id_urusan',
      'local_key' => 'id'
    ]
  ];
  
  
  
  
}