<?php  if(!defined('BASEPATH')) exit('No direct script access allowed');

class Test__hasone extends MY_Model{
  
  public $table='test__hasone';
  
  public $has_one=[
    'belongsto'=>[ //reverse relation  belongs_to
      'model'=>'welcome/test',
      'foreign_key'=>'id',
      'local_key'=>'test_id'
    ],
    'joinnext'=>[ 
      'model'=>'welcome/test__joinnext',
      'foreign_key'=>'hasone_id',
      'local_key'=>'id'
    ]
  ];
}