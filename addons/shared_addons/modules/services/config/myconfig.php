<?php
$config['myftp'] = array(
					 "hostname" => "localhost", 
					 "username" => "root", 
					 "password" => ""
					);
$config['produkhukum_upload'] = array(
					 "upload_path" => realpath((@$_SERVER['DOCUMENT_ROOT'] && file_exists(@$_SERVER['DOCUMENT_ROOT'].$_SERVER['PHP_SELF'])) ? $_SERVER['DOCUMENT_ROOT'] : str_replace(dirname(@$_SERVER['PHP_SELF']), '', str_replace(DIRECTORY_SEPARATOR, '/', realpath('.')))).'/application/public/download/produkhukum', 
					 "encrypt_name" => TRUE, 
					 "allowed_types" => "pdf|doc|docx|xls|xlsx|ppt|pptx|zip|rar"
					);	
$config['produkhukum_document_type'] = array(0=>"Publik", 1=>"Privat");	
?>