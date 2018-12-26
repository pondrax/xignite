<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Kegiatan extends MY_Model{
  
  public $table = 'bab_v__kegiatan';
  public $primary_key = 'id';
  public $fields = [
    'id' => [
      'type' => 'int',
      'constraint' => '11',
      'auto_increment' => true
    ],
    'id_program' => [
      'type' => 'int',
      'constraint' => 11
    ],
    'kegiatan' => [
      'type' => 'int',
      'constraint' => 11
    ],
    'target' => [
      'type' => 'varchar',
      'constraint' => 50
    ],
    'realisasi' => [
      'type' => 'varchar',
      'constraint' => 50
    ],
    'persentase' => [
      'type' => 'varchar',
      'constraint' => 50
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
      'field' => 'id_program',
      'label' => 'Program',
      'rules' => 'required'
    ],
    [
      'field' => 'kegiatan',
      'label' => 'Kegiatan',
      'rules' => 'required'
    ],
    [
      'field' => 'target',
      'label' => 'Pagu Anggaran',
      'rules' => 'required'
    ],
    [
      'field' => 'realisasi',
      'label' => 'Realisasi Anggaran',
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
    'program' => [
      'model' => 'xadmin/bab_iv/program',
      'foreign_key' => 'id',
      'local_key' => 'id_program'
    ]
  ];
  public $has_many = [
    'kegiatan_indikator' => [
      'model' => 'xadmin/bab_iv/kegiatan_indikator',
      'foreign_key' => 'id_kegiatan',
      'local_key' => 'id'
    ]
  ];
  
}