<?php  if(!defined('BASEPATH')) exit('No direct script access allowed');

class Users extends MY_Model{
  
  public $table='users';
  public $primary_key='id';
  
  public $before_create = ['created_at','updated_at','hash_password'];
  public $before_update = ['updated_at','hash_password'];
  
  public $has_one=[
    'groups'=>[
      'model'=>'xadmin/users/groups',
      'foreign_key'=>'id',
      'local_key'=>'grup_id'
    ]
  ];
  
  public $rules=[
    'insert'=>[
      ['field'=>'username','rules'=>'trim|alpha_numeric|required'],
      ['field'=>'email','rules'=>'trim|required|valid_email|is_unique[users.email]']
    ],
    'update'=>[
      ['field'=>'username','rules'=>'trim|alpha_numeric|required'],
      ['field'=>'email','rules'=>'trim|required|valid_email|is_unique[users.email]']
    ]
  ];
  
  public static function hash_password($data){
    if(isset($data['password'])){
      $data['password']=password_hash($data['password'],PASSWORD_DEFAULT);
    }
    return $data;
  }
  
  public static function verify_password($pass,$where){
    $data=self::select('id,password')->one($where);
    if(count($data)&&password_verify($pass,$data->password)){
      return $data->id;
    }else{
      return false;
    }
  }
}