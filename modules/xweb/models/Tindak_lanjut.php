<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Tindak_lanjut extends MY_Model{
  
  public $table = 'aduan__tindak_lanjut';
  public $primary_key = 'id';
  public $fields = [
    'id' => [
      'type' => 'int',
      'constraint' => '11',
      'auto_increment' => true
    ],
    'id_aduan' => [
      'type' => 'int',
      'constraint' => 11
    ],
    'id_user' => [
      'type' => 'int',
      'constraint' => 11
    ],
    'tindakan' => [
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
      'field' => 'id_aduan',
      'label' => 'Aduan',
      'rules' => 'trim'
    ],
    [
      'field' => 'id_user',
      'label' => 'Pengguna',
      'rules' => 'trim'
    ],
    [
      'field' => 'tindakan',
      'label' => 'Tindakan',
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
      'model' => 'xadmin/master/pengguna',
      'foreign_key' => 'id',
      'local_key' => 'id_user'
    ]
  ];
}