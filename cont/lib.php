<?php

function Classloader($class,$admin = false){
    $admindir = '';
    if($admin == true){
        $admindir = 'admin/';
    }
    if(file_exists($admindir.'cont/'.$class.'.php')){
        require_once $admindir.'cont/'.$class.'.php';
        $reg = new $class;
    }else{
        $reg = false;
    }

    return $reg;
}

?>