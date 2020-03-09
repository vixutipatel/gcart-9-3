<?php defined('BASEPATH') OR exit('No direct script access allowed');

$config = array(
	'protocol'     =>  'smtp',
	'smtp_host'    => (get_settings('smtp_host') != null) ? trim(get_settings('smtp_host')) : 'smtp.gmail.com',
	'smtp_port'    => (get_settings('smtp_port') != null) ? trim(get_settings('smtp_port')) : 465,
	'smtp_user'    => (get_settings('smtp_user') != null) ? trim(get_settings('smtp_user')) : 'test.narolainfotech@gmail.com',
	'smtp_pass'    => (get_settings('smtp_password') != null) ? trim(get_settings('smtp_password')) : '#N@rol@12',
	'smtp_crypto'  => (get_settings('smtp_encryption')) ? get_settings('smtp_encryption') : 'ssl',
	'mailtype'     => 'html',
	'smtp_timeout' => 30,
	'charset'      => 'UTF-8',
	'wordwrap'     => true,
	'newline'      => "\r\n",
	'crlf'         => "\r\n",
);
