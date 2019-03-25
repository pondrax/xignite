<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Grabber_controller extends CI_Controller {
  function __construct() {
    parent::__construct();
    $this->load->model('xweb/aduan');
    $this->grab=['twitter'=>[
                            'url'=>'https://twitter.com/search?q=%2B%40jatimpemprov&src=typd&lang=en'
                           ,'content'=>'.tweet'
                           ,'user'=>'.username'
                           ,'message'=>'.tweet-text'
                           ,'time'=>'._timestamp']
        ];
  }
  
  
  public function index(){
    $this->load->library("simple_html_dom");
    $html = new simple_html_dom();
    $grabdata=[];
    foreach($this->grab as $g){
        $page = file_get_html($g['url']);
        
        foreach($page->find($g['content']) as $c) {
            $grabdata[]=[
                        'source'=>strip_tags($c->find($g['user'],0)->innertext)
                       ,'aduan'=>$c->find($g['message'],0)->innertext
                       ,'created_at'=>date('Y-m-d H:i:s',$c->find($g['time'],0)->{'data-time'})
            ];
            
        }
    }
    foreach($grabdata as $i=>$g){
        $count=Aduan::where(['source'=>$g['source'],'created_at'=>$g['created_at']])->count();
        if($count>0){
            unset($grabdata[$i]);
        }
    }
    if(count($grabdata)>0){
        Aduan::insert_batch($grabdata,false);
    }
    jsonify(date('Y-m-d H:i:s').'---'.(count($grabdata)>0?count($grabdata):0).' data ditambahkan');
  }
}
