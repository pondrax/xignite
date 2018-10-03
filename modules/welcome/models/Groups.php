<?php  if(!defined('BASEPATH')) exit('No direct script access allowed');

class Groups extends MY_Model{
  
  public $table='users__groups';
  public $primary_key='id';
  
  public $before_create = ['created_at','updated_at'];
  public $before_update = ['updated_at'];
  
}