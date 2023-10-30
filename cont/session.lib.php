<?php

if(!isset($_SESSION['login'])) $_SESSION['login'] = false;
if(!isset($_SESSION['admin'])) $_SESSION['admin'] = false;
if(!isset($_SESSION['lang'])) $_SESSION['lang'] = 'de';
if(!isset($_SESSION[$_SESSION['lang']])) $_SESSION[$_SESSION['lang']] = array();


$SessionClass = Classloader('session');

if($_SESSION['login'] == true) $SessionClass->CheckSession();

if(isset($_GET['logout'])){
    if($_GET['logout'] == 'true') $SessionClass->Logout();
}

?>