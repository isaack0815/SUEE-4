<?php

$query = "SELECT SourceCode," . $_SESSION['lang'] . " FROM language ";

if(!isset($_SESSION[$_SESSION['lang']]) || empty($_SESSION[$_SESSION['lang']])){
    foreach($db->get_results($query) AS $row){
        $_SESSION[$_SESSION['lang']][$row->SourceCode] = $row->{$_SESSION['lang']};
    }
}else{
    if($db->num_rows($query) >= count($_SESSION[$_SESSION['lang']])){
        foreach($db->get_results($query) AS $row){
            $_SESSION[$_SESSION['lang']][$row->SourceCode] = $row->{$_SESSION['lang']};
        }
    }
}

?>