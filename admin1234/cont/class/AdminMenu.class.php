<?php

class AdminMenu{
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

    private function MenuHead($name,$LinkIcon){
        $icon = '';
        if($LinkIcon != 0) $icon = '<i class="nav-icon '. $LinkIcon .'"></i>';
        $ret = '<a href="#" class="nav-link">';
        $ret .= $icon;
        $ret .= '<p>';
        $ret .= $name;
        $ret .= '<i class="fas fa-angle-left right"></i>';
        $ret .= '</p>';
        $ret .= '</a>';
        return $ret;
    }

    private function MenuLink($id){
        $ret = '';
        foreach($this->db->get_results("SELECT * FROM MainMenu WHERE child_from = $id ORDER BY LinkOrder ASC") as $row){
            $icon = '';
            if($row->LinkIcon != 0) $icon = '<i class="'. $row->LinkIcon .' nav-icon"></i>';
            $ret .= '<li class="nav-item">';
            $ret .= '<a href="index.php'.$row->LinkURL.'" class="nav-link">';
            $ret .= $icon;
            $ret .= '<p>'.$this->session[$this->session['lang']][$row->LinkName].'</p>';
            $ret .= '</a>';
            $ret .= '</li>';
        }

        return $ret;
    }

    public function get_menu(){
        $ret = '';
        foreach($this->db->get_results("SELECT * FROM MainMenu WHERE LinkLogin = 3 AND LinkAdmin = 1 AND child_from = 0 ORDER BY LinkOrder ASC") as $row){
            $ret .= '<li class="nav-item">';
            $ret .= $this->MenuHead($this->session[$this->session['lang']][$row->LinkName],$row->LinkIcon);
            $ret .= '<ul class="nav nav-treeview">';
            $ret .= $this->MenuLink($row->id);
            $ret .= '</ul>';
            $ret .= '</li>';
        }

        return $ret;
    }
}