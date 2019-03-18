<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['base_url'] = base_url(); //site url
$config['total_rows'] = 200; //total row
$config['per_page'] = 10;  //show record per halaman
$config["uri_segment"] = 3;  // uri parameter
$choice = $config["total_rows"] / $config["per_page"];
$config["num_links"] = floor($choice);

// Membuat Style pagination untuk BootStrap v4
$config['first_link']       = 'First';
$config['last_link']        = 'Last';
$config['next_link']        = 'Next';
$config['prev_link']        = 'Prev';
$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
$config['full_tag_close']   = '</ul></nav></div>';
$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
$config['num_tag_close']    = '</span></li>';
$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
$config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
$config['prev_tagl_close']  = '</span>Next</li>';
$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
$config['first_tagl_close'] = '</span></li>';
$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
$config['last_tagl_close']  = '</span></li>';