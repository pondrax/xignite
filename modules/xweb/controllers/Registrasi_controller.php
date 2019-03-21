<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registrasi_controller extends CI_Controller {
  function __construct() {
    parent::__construct();
    $this->load->helper('jwt_helper');
    $this->secret_key=$this->config->item('api_secret_key');
    setlocale(LC_ALL, 'IND');
    $this->load->model('xadmin/master/pengguna');
  }
  function _remap($method='',$variable=[]){
    if($method==""){
      $this->index();
    }
    else if(method_exists($this,$method)){
      call_user_func_array(array($this, $method),$variable);
      return false;
    }
    else{
      array_unshift($variable,$method);
      $this->single($variable);
    }
  }	
  public function index(){
    $data=[];
    $post=$this->input->post();
    if($post){
      $post['id_grup']=3;
      $post['token']=strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 8));
      $data=Pengguna::insert($post);
    }
    if(isset($data['success'])){
      header('Location:'.base_url('registrasi/sukses/?email='.urlencode($post['email'])));
    }else{
      $this->load->blade('xweb/auth/registrasi',$data);
    }
  }

  function sukses(){
    $data['email']=get('$email');
    $akun=Pengguna::one(['email'=>$data['email']]);
    if(count($akun)>0){
      $token=$akun->token;
      $encrypted_token=jwt::encode(['email'=>$data['email'],'token'=>$token],$this->secret_key);
      echo $encrypted_token;
      $link=base_url("registrasi/aktivasi/$encrypted_token");
      $message="
      Token pendaftaran akun Wadul anda adalah : $token telah dikirimkan melalui email $data[email].<br>
      Selanjutnya, silahkan melakukan aktivasi pendaftaran akun anda dengan mengklik link dibawah ini atau dengan cara memasukkan nomor token dihalaman profil anda.
      <br>
      <br>
      <br>
      <a href='$link'>$link</a>
      <br>
      <br>
      Hormat Kami,<br>
      Administrator Cettar Wadul Jatim<br>
      Pemerintah Provinsi Jawa Timur<br>
      ".base_url()."<br>
      <br>
      Email ini dikirimkan secara otomatis oleh sistem, kami tidak melakukan pengecakan email yang dikirimkan ke email ini. Jika ada pertanyaan, silahkan hubungi (031) 829-4608
      ";
      
      
      $this->load->library('email');
      $this->email->from('wadul@jatimprov.go.id', 'Wadul Jatim');
      $this->email->to($data['email']);
      $this->email->subject('Pendaftaran akun WADUL');
      $this->email->message($message);
      //Send mail
      $this->email->send();
      // if($this->email->send())
          // echo "Congraulation Email Send Successfully.";
      // else
          // echo "You have encountered an error";
      if(APP_DEBUG)$this->email->print_debugger();
      $this->load->blade('xweb/auth/sukses',$data);
    }else{
      $this->load->blade('xweb/auth/gagal',$data);
    }
  }
  function aktivasi($encrypted_token){
    if($encrypted_token!=''){
      $decode=jwt::decode($encrypted_token,$this->secret_key);
      $akun=Pengguna::select('id,token')->one(['email'=>$decode->email]);
      if($decode->token==$akun->token){
        Pengguna::update($akun->id,['aktif'=>1,'token'=>''],false);
        $data['message']="Akun $decode->email berhasil diaktifkan";
      }else{
        $data['message']="Token tidak sesuai, pendaftaran gagal dilakukan";
      }
      $this->load->blade('xweb/auth/aktif',$data);
    }else{
      show_404();
    }
  }
}
