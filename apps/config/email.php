<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Email Sections
| -------------------------------------------------------------------------
| This file lets you determine whether or not various sections of Email
| data are displayed when the Email is enabled.
| Please see the user guide for info:
|
|	https://codeigniter.com/user_guide/libraries/email.html
|
*/

$config['useragent'] = 'CodeIgniter';
$config['protocol'] = MAIL_DRIVER;
//$config['mailpath'] = '/usr/sbin/sendmail';
$config['smtp_host'] = MAIL_HOST;
$config['smtp_crypto'] = MAIL_CRYPTO;
$config['smtp_user'] = MAIL_USERNAME;
$config['smtp_pass'] = MAIL_PASSWORD;
$config['smtp_port'] = MAIL_PORT; 
$config['smtp_timeout'] = 5;
$config['wordwrap'] = TRUE;
$config['wrapchars'] = 76;
$config['mailtype'] = 'html';
$config['charset'] = 'utf-8';
$config['validate'] = FALSE;
$config['priority'] = 3;
$config['crlf'] = "\r\n";
$config['newline'] = "\r\n";
$config['bcc_batch_mode'] = FALSE;
$config['bcc_batch_size'] = 200;