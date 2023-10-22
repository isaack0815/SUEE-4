<?php

function Classloader($class,$admin = false){
    $adminDir = $admin ? 'admin/' : '';
    $classPath = $adminDir . 'cont/' . $class . '.php';
    if (!file_exists($classPath)) {
        return false;
    }
    require_once $classPath;
    return new $class();
}

function meldung($nachricht,$error) {
    echo "<script>var nachricht = $js_nachricht; var error = $js_error;</script>";
}


?>