<?php

//Datenbank anbindung erstellen
$db = Classloader('db');

//Template einstellungen laden
$ret = Classloader('template');
$template = $ret->get_template_setting();

//Session laden
require_once DIR_FS . 'cont/session.lib.php';

//Laden der Navigation
$NavClass = Classloader('menu');
?>