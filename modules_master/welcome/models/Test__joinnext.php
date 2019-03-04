<?php  if(!defined('BASEPATH')) exit('No direct script access allowed');

class Test__joinnext extends MY_Model{
  
  public $table='test__joinnext';
  
  public $has_one=[
    'hasone'=>[ 
      'model'=>'welcome/test__hasone',
      'foreign_key'=>'id',
      'local_key'=>'hasone_id'
    ]
  ];
}