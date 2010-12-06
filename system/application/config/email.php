<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| EMAIL CONFING
| -------------------------------------------------------------------
| Configuration of outgoing mail server.
| */
$config['protocol']='smtp';
$config['mailtype'] = 'html';
$config['smtp_host']='ssl://smtp.googlemail.com';
$config['smtp_port']='465';
$config['smtp_timeout']='30';
$config['smtp_user']='mat@redstudiohosting.co.uk';
$config['smtp_pass']='4488mat';
$config['charset']='iso-8859-1';
$config['newline']="\r\n";
/* End of file email.php */
/* Location: ./system/application/config/email.php */