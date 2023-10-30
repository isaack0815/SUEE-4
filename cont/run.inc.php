<?php

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['run'])){
        $RunClass = Classloader('run');
        $ret = $RunClass->run($_POST['run']);
        if($ret != 1){
            require_once $ret;
        }
    }
}

?>