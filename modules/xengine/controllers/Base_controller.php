<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Base_controller extends CI_Controller {
  function __construct() {
    parent::__construct();
    if(strtolower(ENVIRONMENT)!='development'){
      echo "Forbidden";
      exit;
    }
    ini_set('max_execution_time', 0);
  }
  
  public function index(){
    $url=rtrim(base_url(),'/');
    $db_name = 'db_'. date("Y-m-d_H.i.s") .'.sql';
    echo "
      <h2>### <a href='$url/xengine/base'>XBASE</a></h2>
      <h3>Export Database: </h3>";
    $this->load->helper('form');
    echo form_open('xengine/base/export');
    echo 'List Tables<br>';
    foreach ($this->db->list_tables() as $table){
      echo form_checkbox('table[]',$table, TRUE).$table.'<br>';
    }
    echo form_input('name',$db_name).'<br>';
    echo "<input type='submit' value='export'>";
    echo form_close();
    echo "<h3>Import Database : </h3>";
    $files = glob('backup/*.{sql}', GLOB_BRACE);
    usort($files, create_function('$a,$b', 'return filemtime($b) - filemtime($a);'));
    foreach($files as $file) {
      $file=basename($file);
      echo "- $file : ";
      echo "<a href='$url/xengine/base/import/$file'>import</a> / ";
      echo "<a href='$url/backup/$file'>download</a> / ";
      echo "<a href='$url/xengine/base/remove/$file'>delete</a> <br>";
    }
  }
  public function export(){
    $table=$this->input->post('table');
    $db_name=$this->input->post('name');
    // debug($table);
    $url=rtrim(base_url(),'/');
    $this->load->dbutil();
    $backup = $this->dbutil->backup(['tables'=>$table,'format'=>'txt']);

    $save = 'backup/'.$db_name;
    
    $this->load->helper('file');
    write_file($save, $backup); 
    
    echo "<h2>### <a href='$url/xengine/base'>XBASE</a> 
    :: Database Export Complete </h2> 
    - Download : <a href='$url/$save'>$db_name</a>" ;
  }
  
  public function import($file){
    $url=rtrim(base_url(),'/');
    echo "<h2>### <a href='$url/xengine/base'>XBASE</a> :: Database Import</h2>";
    $file='backup/'.$file;
    if (file_exists($file)){
      // $this->empty_all();
      $lines = file($file);
      $statement = '';
      foreach ($lines as $line){
        $statement .= $line;
        if (substr(trim($line), -1) === ';'){
          echo "<blockquote style='border-bottom:1px dashed;margin-top:30px;'>";
          echo $statement;
          echo "</blockquote>";
          $this->db->query($statement);
          $statement = '';
        }
      }
    }else{
      echo "Import Error";
    }
  }
  
  public function remove($file){
    $url=rtrim(base_url(),'/');
    echo "<h2>### <a href='$url/xengine/base'>XBASE</a> :: Database Remove</h2>";
    $file='backup/'.$file;
    if (file_exists($file)){
      unlink($file);
      echo "Delete \"$file\" Complete";
    }else{
      echo "Delete Error";
    }
  }
  function empty_all(){
    $query = $this->db->query("SHOW TABLES");
    $name = $this->db->database;
    foreach ($query->result_array() as $row){
      $table = $row['Tables_in_' . $name];
      $this->db->query("TRUNCATE " . $table);
      $this->db->query("ALTER TABLE ".$table." AUTO_INCREMENT = 1");
    }
    $this->output->set_output("Database emptyed");
  }
}
