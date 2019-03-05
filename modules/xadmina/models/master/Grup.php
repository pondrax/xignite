<?php  if(!defined('BASEPATH')) exit('No direct script access allowed');

class Grup extends MY_Model{
  
  public $table='users__groups';
  public $primary_key='id';
  
  public $before_create = ['created_at','updated_at'];
  public $before_update = ['updated_at'];
  
  public $rules=[
    'insert'=>[
      ['field'=>'nama_grup','label'=>'Nama Grup','rules'=>'trim|required']
    ],
    'update'=>[
      ['field'=>'nama_grup','label'=>'Nama Grup','rules'=>'trim|required']
    ]
  ];
}