<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Kegiatan_indikator extends MY_Model{
  
  public $table = 'bab_iv__kegiatan_indikator';
  public $primary_key = 'id';
  public $fields = [
    'id' => [
      'type' => 'int',
      'constraint' => '11',
      'auto_increment' => true
    ],
    'id_kegiatan' => [
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
    'realisasi' => [
      'type' => 'varchar',
      'constraint' => 11
    ],
    'persentase' => [
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
      'field' => 'id_kegiatan',
      'label' => 'ID Kegiatan',
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
    'kegiatan' => [
      'model' => 'xadmin/bab_iv/kegiatan',
      'foreign_key' => 'id',
      'local_key' => 'id_kegiatan'
    ]
  ];
  
  
}