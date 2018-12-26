<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Program extends MY_Model{
  
  public $table = 'bab_v__program';
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
    'program' => [
      'type' => 'varchar',
      'constraint' => 255
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
      'field' => 'id_user',
      'label' => 'ID User',
      'rules' => 'required'
    ],
    [
      'field' => 'id_tahun',
      'label' => 'Tahun',
      'rules' => 'required'
    ],
    [
      'field' => 'program',
      'label' => 'Program',
      'rules' => 'required'
    ],
    [
      'field' => 'bab',
      'label' => 'Subbab Tugas Pembantuan / Dekonsentrasi',
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
    'program_indikator' => [
      'model' => 'xadmin/bab_iv/program_indikator',
      'foreign_key' => 'id_program',
      'local_key' => 'id'
    ],
    'kegiatan' => [
      'model' => 'xadmin/bab_iv/kegiatan',
      'foreign_key' => 'id_program',
      'local_key' => 'id'
    ]
  ];
  
}