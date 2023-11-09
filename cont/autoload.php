<?php

//Datenbank anbindung erstellen
$db = Classloader('db');

//Template einstellungen laden
$ret = Classloader('template');
$template = $ret->get_template_setting();

//Laden der Globalen Config
$gconfig = $db->get_row("SELECT * FROM GlobalConfig",true);

//Session laden
require_once DIR_FS . 'cont/session.lib.php';

//Check Admin Folder und Permission
if($AdminFolder == true){
    if(!isset($_SESSION['login']) || $_SESSION['login'] != true || $_SESSION['admin'] != 1){
        header('Location: ../index.php');
        exit;
    }
}

//Laden der Language
require_once DIR_FS . 'cont/language.lib.php';

//Laden der Run Inc
require_once DIR_FS . 'cont/run.inc.php';

//Laden der Template functionen
require_once DIR_FS . 'template/template.lib.php';

//Laden der Navigation
$NavClass = Classloader('menu');

//Laden der Pageclass
if(!isset($_GET['page']) || $_GET['page'] == ''){
    if($_SESSION['login'] != true){
        $_GET['page'] = $gconfig->no_user_start;
    }else{
        $_GET['page'] = $gconfig->user_start;
    }
}

$PageClass = Classloader('page');
?>