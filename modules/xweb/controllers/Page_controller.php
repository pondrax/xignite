<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page_controller extends CI_Controller {
  function __construct() {
    parent::__construct();
  }
  function _remap(){
    $category = $this->uri->segment(1);
    $slug = $this->uri->segment(2);
    switch ($category) {
      case null:
      case false:
      case '':
        $this->index();
      break;
      case 'kontak':
        $this->about();
      break;
      case 'galeri':
        $this->galeri($slug);
      break;  
      default:
        $this->view($slug);
      break;
    }
  }	
  public function index(){
    $data=[];
    $this->load->blade('xweb/page',$data);
    show_404();
  }
  function about(){
    $this->load->blade('xweb/about');     
	}

	function galeri($url_title = '',$page=1){
    $this->load->model('xweb/media/media');
    $data['media']=Media::table();
    $this->load->blade('xweb/media',$data);
	}

	function view($slug = ''){
    $this->load->model('xweb/pages/pages');
    $this->load->model('xweb/pages/category');
    $data=[];
    $page=Pages::where('slug',$slug)->one();
    if($page){
      $data['page']=$page;
      $data['related']=Category::pages([
                        'select'=>'id,kategori_id,slug,title',
                        'where'=>"id!=$page->id"
                       ])
                       ->one($page->kategori_id,'default',false);
      if($slug=='laporan-informasi'){
        $this->load->model('xweb/requests/permohonan');
        $data['permohonan']=Permohonan::all();
      }
      $this->load->blade('xweb/page',$data);      
    }
    else{
      // $this->load->blade('xweb/page',$data);      
      show_404();
    }

	}	
}
