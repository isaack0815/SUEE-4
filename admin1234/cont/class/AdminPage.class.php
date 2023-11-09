<?php

class AdminPage{
    private $db;
    private $error = 0;
    private $meldung;
    private $gconfig;
    private $session;

    public function __construct(){
        global $db,$gconfig,$_SESSION;
        if($_SESSION['admin'] != 1){
            header('Location: ../index.php');
            exit;
        }
        $this->db = $db;
        $this->gconfig = $gconfig;
        $this->session = $_SESSION;
    }

    private function CheckFileExist($get){
        if(file_exists(DIR_FS . ADMIN_DIR . 'template/' . $get['page'] . '.php')){
            require_once DIR_FS . ADMIN_DIR . 'template/' . $get['page'] . '.php';
        }else{
            require_once DIR_FS . ADMIN_DIR . 'template/404.php';
        }
    }

    private function CheckUserPermission($get){
        $permission = $this->db->get_row("SELECT * FROM MainMenu WHERE LinkURL = '?page=".$get['page']."'",true);
        if($get['page'] != 'dashboard'){
            if($permission->LinkAdmin == 0){
                require_once DIR_FS . ADMIN_DIR . 'template/405.php';
            }
        }
    }

    public function RequirePageContent($get){
        $this->CheckFileExist($get);
        $this->CheckUserPermission($get);
        if($this->error == 0){
            if(file_exists(DIR_FS . ADMIN_DIR . 'page/' . $get['page'] . '.php')){
                require_once DIR_FS . ADMIN_DIR . 'page/' . $get['page'] . '.php';
            }
            if(file_exists(DIR_FS . ADMIN_DIR . 'template/' . $get['page'] . '.php')){
                require_once DIR_FS . ADMIN_DIR . 'template/' . $get['page'] . '.php';
            }
            if(file_exists(DIR_FS . ADMIN_DIR . 'js/' . $get['page'] . '.js')){
                require_once DIR_FS . ADMIN_DIR . 'js/' . $get['page'] . '.js';
            }
            
        }
    }
}