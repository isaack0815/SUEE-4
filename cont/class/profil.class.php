<?php

class profil{
    private $db;
    private $error = 0;
    private $meldung;
    private $session;
    private $post = array();
    private $inhalt = array("head" => "", "body" => "");
    const PROFIL_DIR = DIR_FS . 'page/konto/profil_include/';
    
    public function __construct(){
        global $db, $_SESSION;
        if($_SESSION['login'] != true) die("Zugriffsverletzung");
        $this->db = $db;
        $this->session = $_SESSION;
    }

    private function make_array($post){
        foreach($post AS $key => $value){
            if($key != '' && $key != 'run' && $value!= ''){
                $this->post[$this->db->escape($key)] = $this->db->escape($value);
            }
        }
    }

    private function MakePasswordSecure(){
        $this->post['passwort1'] = PASS_AD . hash("sha256", $this->post['passwort1']);
    }

    public function GetContentForProfilPage(){
        foreach(array_diff(scandir(self::PROFIL_DIR), array('..', '.')) AS $file){
            require_once(self::PROFIL_DIR.$file);
            $this->inhalt['head'] .= $content['head'];
            $this->inhalt['body'] .= $content['body'];
        }

        return $this->inhalt;
    }

    private function CheckNewPassword(){
        if($this->post['passwort1'] != $this->post['passwort2']){
            $this->error++;
            $this->meldung .= $_SESSION[$_SESSION['lang']]['ERROR_PASSWORT_NOT_EQUAL'];
        }elseif(strlen($this->post['passwort1']) < 8){
            $this->error++;
            $this->meldung .= $_SESSION[$_SESSION['lang']]['ERROR_PASSWORT_TO_SHORT'];
        }
    }

    public function SetNewPassForUser($post){
        $this->make_array($post);
        $this->CheckPasswort();
        if($this->error == 0) $this->MakePasswordSecure();
        if($this->error == 0){
            if($this->db->update("user", array("user_pass" => $this->post['passwort1'],array("user_id" => $this->session['user_id'])) == true)){
                $this->meldung = $_SESSION[$_SESSION['lang']]['PASSWORT_CHANGED'];
            }else{
                $this->error = 1;
                $this->meldung = $_SESSION[$_SESSION['lang']]['ERROR_PASSWORT_NOT_CHANGED'];
            }
        }
        meldung($this->meldung, $this->error);
    }

    private function CheckUserName(){
        if($this->db->num_rows("SELECT * FROM user WHERE user_nick = '" . $this->post['username'] . "'") > 0){
            $this->error = 1;
            $this->meldung = $this->session[$_SESSION['lang']]['username_already_exists'];
        }
    }

    private function CheckEMailIsValidAndNotExist(){
        if(!filter_var($this->post['email'], FILTER_VALIDATE_EMAIL)){
            $this->error = 1;
            $this->meldung = $this->session[$_SESSION['lang']]['email_not_valid'];
        }elseif($this->db->num_rows("SELECT * FROM user WHERE user_mail = '" . $this->post['email'] . "' AND user_id != '". $this->session['user_id'] ."' ") > 0){
            $this->error = 1;
            $this->meldung = $this->session[$_SESSION['lang']]['email_already_exists'];
        }
    }

    public function SaveDefaultUserDetails($post){
        $this->make_array($post);
        $this->CheckUserName();
        $this->CheckEMailIsValidAndNotExist();
        if($this->error == 0){
            if($this->db->update("user", array("user_mail" => $this->post['email'], "user_nick" => $this->post['username']), array("user_id" => $this->session['user_id'])) == true){
                $this->meldung = $_SESSION[$_SESSION['lang']]['USER_DATA_CHANGED'];
            }else{
                $this->error = 1;
                $this->meldung = $_SESSION[$_SESSION['lang']]['USER_DATA_NOT_CHANGED'];
            }
        }
        meldung($this->meldung, $this->error);
    }
}