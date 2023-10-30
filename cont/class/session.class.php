<?php

class session{
    private $db;
    private $error = 0;
    private $meldung;
    private $session;
    private $templateSetting;
    private $post = array();
    private $gconfig;

    public function __construct(){
        global $db,$_SESSION,$template,$gconfig;
        $this->db = $db;
        $this->session = $_SESSION;
        $this->templateSetting = $template;
        $this->gconfig = $gconfig;
    }

    private function make_array($post){
        foreach($post AS $key => $value){
            if($key != '' && $key != 'run' && $value != ''){
                $this->post[$this->db->escape($key)] = $this->db->escape($value);
            }
        }
    }

    private function CheckInputFilds(){
        if($this->post['email'] == ''){
            $this->error = 1;
            $this->meldung = $this->session[$_SESSION['lang']]['username_empty'];
        }elseif($this->post['password'] == ''){
            $this->error = 1;
            $this->meldung = $this->session[$_SESSION['lang']]['password_empty'];
        }
    }

    private function MakePasswordSecure(){
        $this->post['passwort'] = PASS_AD . hash("sha256", $this->post['password']);
    }

    private function CheckUser(){
        if($this->db->num_rows("SELECT * FROM user WHERE user_mail = '" . $this->post['email'] . "' AND user_pass = '" . $this->post['passwort'] . "'") == 0){
            $this->error = 1;
            $this->meldung = $this->session[$_SESSION['lang']]['user_not_found'];
        }
    }

    private function CheckStatus(){
        if($this->db->get_row("SELECT * FROM user WHERE user_mail = '" . $this->post['email'] . "' AND user_pass = '" . $this->post['passwort'] . "'",true)->user_status == 0){
            $this->error = 1;
            $this->meldung = $this->session[$_SESSION['lang']]['user_not_active'];
        }
    }

    private function SetLogin(){
        global $_SESSION;
        $_SESSION['login'] = true;
        $row = $_SESSION['user'] = $this->db->get_row("SELECT * FROM user WHERE user_mail = '" . $this->post['email'] . "' AND user_pass = '" . $this->post['passwort'] . "'",true);
        $_SESSION['admin'] = $row->user_admin;
        $_SESSION['user_id'] = $row->user_id;
        $_SESSION['user_nick'] = $row->user_nick;
        $_SESSION['user_pass'] = $row->user_pass;
        $_SESSION['autologin'] = 'true';
    }

    private function SetCookieWhenAutoLoginSet(){
        if(isset($this->post['autologin'])){
            if($this->post['autologin'] == 1){
                $cookie = $this->db->get_row("SELECT * FROM user WHERE user_mail = '" . $this->post['email'] . "' AND user_pass = '" . $this->post['passwort'] . "'",true);
                setcookie("user_id", $cookie->user_id, time() + (86400 * 30), "/");
                setcookie("user_nick", $cookie->user_nick, time() + (86400 * 30), "/");
                setcookie("user_pass", $cookie->user_pass, time() + (86400 * 30), "/");
            }
        }
    }

    public function Login($post){
        $this->make_array($post);
        $this->CheckInputFilds();
        if($this->error == 0) $this->MakePasswordSecure();
        if($this->error == 0) $this->CheckUser();
        if($this->error == 0) $this->CheckStatus();
        if($this->error == 0) $this->SetLogin();
        if($this->error == 0) $this->SetCookieWhenAutoLoginSet();
        if($this->error == 0) $this->meldung = $this->session[$this->session['lang']]['LOGIN_TRUE'];

        meldung($this->meldung,$this->error);
    }

    private function CheckUserStatusNew(){
        if($this->session['login'] == true){
            if($this->db->get_row("SELECT * FROM user WHERE user_id = '" . $this->session['user_id'] . "'",true)->user_status == 0){
                $this->error = 1;
            }
        }
    }

    private function CheckUserLogin(){
        if($this->session['login'] == true){
            if($this->db->num_rows("SELECT * FROM user WHERE user_id = '" . $this->session['user_id'] . "' AND user_nick = '" . $this->session['user_nick'] . "' AND user_pass = '" . $this->session['user_pass'] . "'") == 0){
                $this->error = 1;
            }
        }
    }

    public function CheckSession(){
        global $_SERVER;
        $this->CheckUserStatusNew();
        if($this->error == 0) $this->CheckUserLogin();
        if($this->error == 0 && $this->session['autologin'] == 'true'){
            $row = $this->db->get_row("SELECT * FROM user WHERE user_id = '" . $this->session['user_id'] . "'",true);
            $_SESSION['login'] = true;
            $_SESSION['admin'] = $row->user_admin;
            $_SESSION['user_id'] = $row->user_id;
            $_SESSION['user_nick'] = $row->user_nick;
            $_SESSION['user_pass'] = $row->user_pass;
            $_SESSION['autologin'] = 'true';
        }

        if($this->error == 1){
            session_destroy();
            setcookie("user_id", '' , time() -300, "/");
            setcookie("user_nick", '', time() -300, "/");
            setcookie("user_pass", '', time() -300, "/");
        }
    }

    public function Logout(){
        session_destroy();
        setcookie("user_id", '' , time() -300, "/");
        setcookie("user_nick", '', time() -300, "/");
        setcookie("user_pass", '', time() -300, "/");
        header("Location: ". $this->gconfig->domain);
    }
}

?>