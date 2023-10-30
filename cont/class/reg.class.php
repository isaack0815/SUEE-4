<?php

class reg{
    private $db;
    private $error = 0;
    private $meldung;
    private $session;
    private $post = array();
    private $server;

    public function __construct(){
        global $db,$_SESSION,$_SERVER;
        $this->db = $db;
        $this->session = $_SESSION;
        $this->server = $_SERVER;
    }

    private function make_array($post){
        foreach($post AS $key => $value){
            if($key != '' && $key != 'run' && $value != ''){
                $this->post[$this->db->escape($key)] = $this->db->escape($value);
            }
        }
    }

    private function GetStandardInputFilds($row){
        $required = '';
        if($row->FieldRequired == 1) $required = 'required';
        $this->meldung .= '<div class="form-group">';
        $this->meldung .= '<label for="' . $row->FieldName . '">' . $row->FieldLabel . '</label>';
        $this->meldung .= '<input type="' . $row->FieldType . '" class="form-control" id="' . $row->FieldName . '" name="' . $row->FieldName . '" placeholder="' . $row->FieldPlaceholder . '" '. $required .'>';
        $this->meldung .= '</div>';
    }

    public function GetRegistryFormInputFilds(){
        foreach($this->db->get_results("SELECT * FROM RegFields WHERE FieldPage = 'registry' ORDER BY FieldOrder ASC") AS $row){
            $this->GetStandardInputFilds($row);
        }
        return $this->meldung;
    }

    private function CheckEMailIsValidAndNotExist(){
        if(!filter_var($this->post['email'], FILTER_VALIDATE_EMAIL)){
            $this->error = 1;
            $this->meldung = $this->session[$_SESSION['lang']]['email_not_valid'];
        }elseif($this->db->num_rows("SELECT * FROM user WHERE user_mail = '" . $this->post['email'] . "'") > 0){
            $this->error = 1;
            $this->meldung = $this->session[$_SESSION['lang']]['email_already_exists'];
        }
    }

    private function CheckPasswordIsValidAndSame(){
        if($this->post['passwort'] != $this->post['passwort2']){
            $this->error = 1;
            $this->meldung = $this->session[$_SESSION['lang']]['password_not_same'];
        }elseif(strlen($this->post['passwort']) < 8){
            $this->error = 1;
            $this->meldung = $this->session[$_SESSION['lang']]['password_to_short'];
        }
    }

    private function MakePasswordSecure(){
        $this->post['passwort'] = PASS_AD . hash("sha256", $this->post['passwort']);
    }

    private function CheckUserName(){
        if($this->db->num_rows("SELECT * FROM user WHERE user_nick = '" . $this->post['nick'] . "'") > 0){
            $this->error = 1;
            $this->meldung = $this->session[$_SESSION['lang']]['username_already_exists'];
        }
    }

    private function CheckOtherInputFieldsForAccuracyAndRequirement(){
        foreach($this->db->get_results("SELECT * FROM RegFields WHERE FieldPage = 'registry' ORDER BY FieldOrder ASC") AS $row){
            if($row->FieldRequired == 1 && $this->post[$row->FieldName] == ''){
                $this->error = 1;
                $this->meldung = $this->session[$_SESSION['lang']]['field_required'];
            }
        }
    }

    private function SaveUser(){
        $insert = array(
            "user_nick" => $this->post['nick'],
            "user_mail" => $this->post['email'],
            "user_pass" => $this->post['passwort'],
            "user_regdate" => time(),
            "user_lastlogin" => 0,
            "user_ip" => $this->server['REMOTE_ADDR'],
            "user_name" => $this->post['name'],
            "user_vorname" => $this->post['vorname'],
            "user_other" => json_encode($this->post)
        );

        if($this->db->insert("user",$insert)){
            $this->meldung = $this->session[$_SESSION['lang']]['registry_success'];
        }else{
            $this->error = 1;
            $this->meldung = $this->session[$_SESSION['lang']]['registry_error'];
        }
    }

    public function RunRegestry($post){
        $this->make_array($post);
        $this->CheckEMailIsValidAndNotExist();
        if($this->error == 0) $this->CheckPasswordIsValidAndSame();
        if($this->error == 0) $this->MakePasswordSecure();
        if($this->error == 0) $this->CheckUserName();
        if($this->error == 0) $this->CheckOtherInputFieldsForAccuracyAndRequirement();
        if($this->error == 0) $this->SaveUser();

        meldung($this->meldung,$this->error);
    }
}