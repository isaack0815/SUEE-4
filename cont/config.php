<?php

const DB_HOST = 'localhost';
const DB_USER = 'd03e81bb';
const DB_PASS = 'DdhmdCkQoYGSHopKfxE8';
const DB_NAME = 'd03e81bb';

const DIR_FS = '/www/htdocs/w01ddc0a/suee4.klebehumor.de/SUEE-4/';
const ADMIN_DIR = 'admin1234/';
const TEMPLATE_DIR = DIR_FS . 'template/';

const PASS_AD = 'JEB7980jebI';


if(file_exists($_SERVER['DOCUMENT_ROOT'].'/error')){
	error_reporting(E_ALL);
	ini_set('display_errors', 'On');
	ini_set('error_log', $_SERVER['DOCUMENT_ROOT'].'/error/error-'. date("d.m.Y",time()).'.log');
	ini_set('log_errors', 'On');
	if(!file_exists($_SERVER['DOCUMENT_ROOT'].'/error/error-'. date("d.m.Y",time()).'.log')){
		$datei = fopen($_SERVER['DOCUMENT_ROOT'].'/error/error-'. date("d.m.Y",time()).'.log',"w");
		fwrite($datei, " ",100);
		fclose($datei);
	}
}

function deleteOldLogFiles(){
    $files = glob($_SERVER['DOCUMENT_ROOT'].'/error/error-*.log');
    $now = time();
    foreach($files as $file){
        if(is_file($file)){
            if($now - filemtime($file) >= 60*60*24*7){
                unlink($file);
            }
        }
    }
}

?>