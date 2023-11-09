<?php

class update{
    private $db;
    private $error = 0;
    private $meldung;
    private $gconfig;
    private $session;
    
    public function __construct(){
        global $db,$_SESSION,$gconfig;
        if($_SESSION['admin'] != 1) die("Zugriffsverletzung");
        $this->db = $db;
        $this->gconfig = $gconfig;
        $this->session = $_SESSION;
    }

    public function CheckIfUpdateAvalibleFromGithub(){
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, 'https://api.github.com/repos/isaack0815/SUEE-4/releases/latest');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_USERAGENT, 'SUEE-4');
        $result = curl_exec($curl);
        curl_close($curl);
        $result = json_decode($result,true);
        if($result['tag_name'] > $this->gconfig['version']){
            $this->error = 1;
            $this->meldung = "Update verfügbar";
        }else{
            $this->error = 0;
            $this->meldung = "Kein Update verfügbar";
        }
    }
}