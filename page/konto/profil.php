<?php

$ProfilClass = Classloader('profil');
$ret = $ProfilClass->GetContentForProfilPage();

$HeaderContent = $ret['head'];
$BodyContent = $ret['body'];
?>