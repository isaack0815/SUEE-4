<?php

class page{
    private $db;
    private $error = 0;
    private $meldung;
    private $session;
    private $templateSetting;

    public function __construct(){
        global $db,$_SESSION,$template;
        $this->db = $db;
        $this->session = $_SESSION;
        $this->templateSetting = $template;
    }

    private function CheckPage($page){
        if(!file_exists(DIR_FS . 'template/' . $page . '.php')){
            $this->error = 1;
        }
    }

    public function GetPage($page){
        $this->CheckPage($page);
        if($this->error == 0){
            if(file_exists(DIR_FS . 'page/'. $page .'.php')){
                require_once DIR_FS . 'page/'. $page .'.php';
            }
            require_once DIR_FS . 'template/' . $page . '.php';
        }else{
            require_once DIR_FS . 'template/404.php';
        }
    }
}