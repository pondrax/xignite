<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Sasaran_indikator extends MY_Model{
  
  public $table = 'bab_iv__sasaran_indikator';
  public $primary_key = 'id';
  public $fields = [
    'id' => [
      'type' => 'int',
      'constraint' => '11',
      'auto_increment' => true
    ],
    'id_sasaran' => [
      'type' => 'int',
      'constraint' => 11
    ],
    'indikator' => [
      'type' => 'int',
      'constraint' => 11
    ],
    'target' => [
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
      'field' => 'id_sasaran',
      'label' => 'Sasaran',
      'rules' => 'required'
    ],
    [
      'field' => 'indikator',
      'label' => 'Indikator Kinerja',
      'rules' => 'required'
    ],
    [
      'field' => 'target',
      'label' => 'Target',
      'rules' => 'required'
    ],
    [
      'field' => 'realisasi',
      'label' => 'Realisasi',
      'rules' => 'required'
    ],
    [
      'field' => 'persentase',
      'label' => 'Persentase',
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
    'sasaran' => [
      'model' => 'xadmin/bab_iv/sasaran',
      'foreign_key' => 'id',
      'local_key' => 'id_sasaran'
    ]
  ];
  
  
}