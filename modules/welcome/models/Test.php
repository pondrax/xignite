<?php  if(!defined('BASEPATH')) exit('No direct script access allowed');

class Test extends MY_Model{
  
  public $table='test';
  
  public $has_one=[
    'hasone'=>[
      'model'=>'welcome/test__hasone',
      'foreign_key'=>'test_id',
      'local_key'=>'id'
    ],
    'belongone'=>[ //reverse relation  belongs_to
      'model'=>'welcome/test__belongsone',
      'foreign_key'=>'id',
      'local_key'=>'test_id'
    ]
  ];
  public $has_many=[
    'hasmany'=>[
      'model'=>'welcome/test__hasmany',
      'foreign_key'=>'test_id',
      'local_key'=>'id'
    ]
  ];
  public $has_many_pivot=[
    'hasmanypivot'=>[
      'model'=>'welcome/test__hasmanypivot',
      'foreign_key'=>'pivot_id',
      'local_key'=>'test_id',
      'pivot_table'=>'test__pivot'
    ]
  ];
}