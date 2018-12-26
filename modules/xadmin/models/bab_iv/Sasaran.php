<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Sasaran extends MY_Model{
  
  public $table = 'bab_iv__sasaran';
  public $primary_key = 'id';
  public $fields = [
    'id' => [
      'type' => 'int',
      'constraint' => '11',
      'auto_increment' => true
    ],
    'id_user' => [
      'type' => 'int',
      'constraint' => 11
    ],
    'id_tahun' => [
      'type' => 'int',
      'constraint' => 11
    ],
    'sasaran' => [
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
      'field' => 'id_user',
      'label' => 'ID User',
      'rules' => 'required'
    ],
    [
      'field' => 'id_tahun',
      'label' => 'ID Tahun',
      'rules' => 'required'
    ],
    [
      'field' => 'sasaran',
      'label' => 'Sasaran',
      'rules' => 'required'
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
    'sasaran_indikator' => [
      'model' => 'xadmin/bab_iv/sasaran_indikator',
      'foreign_key' => 'id_sasaran',
      'local_key' => 'id'
    ]
  ];
  
}