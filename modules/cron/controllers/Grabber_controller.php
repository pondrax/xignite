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
                           ,'media'=>'.AdaptiveMedia-photoContainer'
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
            $time=$c->find($g['time'],0)->{'data-time'};
            $media=[];
            foreach($c->find($g['media']) as $i=>$m){
                $media[$i]=['filename'=>'#'.dechex($time).'_'.$i,'url'=>$m->{'data-image-url'}];
            }
            $grabdata[]=[
                        'source'=>strip_tags($c->find($g['user'],0)->innertext)
                       ,'aduan'=>strip_tags($c->find($g['message'],0)->innertext)
                       ,'lampiran'=>json_encode($media)
                       ,'created_at'=>date('Y-m-d H:i:s',$time)
                       ,'slug'=>dechex($time)
                       
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
  public function test(){
    $this->load->library("simple_html_dom");
    $html = new simple_html_dom();
    $grabdata=[];
    foreach($this->grab as $g){
        $page = file_get_html($g['url']);
        
        foreach($page->find($g['content']) as $c) {
            $time=$c->find($g['time'],0)->{'data-time'};
            $media=[];
            foreach($c->find($g['media']) as $i=>$m){
                $media[$i]=['filename'=>'#'.dechex($time).'_'.$i,'url'=>$m->{'data-image-url'}];
            }
            $grabdata[]=[
                        'source'=>strip_tags($c->find($g['user'],0)->innertext)
                       ,'aduan'=>strip_tags($c->find($g['message'],0)->innertext)
                       ,'lampiran'=>json_encode($media)
                       ,'created_at'=>date('Y-m-d H:i:s',$time)
                       ,'slug'=>dechex($time)
                       
            ];
            
        }
    }
    
    d($grabdata);
    // foreach($grabdata as $i=>$g){
    //     $count=Aduan::where(['source'=>$g['source'],'created_at'=>$g['created_at']])->count();
    //     if($count>0){
    //         unset($grabdata[$i]);
    //     }
    // }
    // if(count($grabdata)>0){
    //     Aduan::insert_batch($grabdata,false);
    // }
    // jsonify(date('Y-m-d H:i:s').'---'.(count($grabdata)>0?count($grabdata):0).' data ditambahkan');
  }
}
