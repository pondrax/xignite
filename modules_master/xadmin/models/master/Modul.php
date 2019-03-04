<?php  if(!defined('BASEPATH')) exit('No direct script access allowed');

class Modul extends MY_Model{
  
  public $table='users__modules';
  public $primary_key='id';
  
  public $before_create = ['created_at','updated_at'];
  public $before_update = ['updated_at'];
  
}