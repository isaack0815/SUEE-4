<?php

class menu{
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

    private function GetLinkList($id){
        $ret = '';
        foreach($this->db->get_results("SELECT * FROM MainMenu WHERE child_from = ". $id ." AND active = 1 ORDER BY LinkOrder") as $row){
            if($this->db->num_rows("SELECT * FROM MainMenu WHERE child_from = ". $row->id ." AND active = 1") > 0){
                $ret .= '<div class="card">';
                $ret .= '<div class="card-header">'. $row->LinkName .'</div>';
                $ret .= '<div class="card-body">';
                $ret .= $this->GetLinkList($row->LinkID);
                $ret .= '</div>';
                $ret .= '</div>';
            }else{
                $icon = '';
                if($row->LinkIcon != '0'){
                    $icon = '<i class="bi bi-'. $row->LinkIcon .'"></i> ';
                }
                $ret .= '<a href="'. $row->LinkURL .'" class="btn btn-primary">'. $icon .' '. $row->LinkName .'</a><br>';
            }

            return $ret;
        }

        return $ret;
    }

    private function GetNavAsSidebar(){
        $ret = '';
        if($this->session['login'] == true){ $LinkLogin = 1; }else{ $LinkLogin = 0; }
        foreach($this->db->get_results("SELECT * FROM MainMenu WHERE child_from = 0 AND active = 1 AND LinkLogin = ". $LinkLogin ." ORDER BY LinkOrder") as $row){
            $ret .= '<div class="card">';
            $ret .= '<div class="card-header">'. $row->LinkName .'</div>';
            $ret .= '<div class="card-body">';
            $ret .= $this->GetLinkList($row->id);
            $ret .= '</div>';
            $ret .= '</div>';
        }

        return $ret;
    }

    private function GetLinkListHeader($id){
        $ret = '';
        foreach($this->db->get_results("SELECT * FROM MainMenu WHERE child_from = ". $id ." AND active = 1 ORDER BY LinkOrder") as $row){
            $ret .= '<li><a class="dropdown-item" href="'. $row->LinkURL .'">'. $row->LinkName .'</a></li>';
        }
    }

    private function GetNavAsHeader(){
        $ret = '<nav class="navbar navbar-expand-lg bg-body-tertiary">';
        $ret .= '<div class="container-fluid">';
        $ret .= '<div class="collapse navbar-collapse" id="navbarSupportedContent">';
        $ret .= '<ul class="navbar-nav me-auto mb-2 mb-lg-0">';
        if($this->session['login'] == true){ $LinkLogin = 1; }else{ $LinkLogin = 0; }
        foreach($this->db->get_results("SELECT * FROM MainMenu WHERE child_from = 0 AND active = 1 AND LinkLogin = ". $LinkLogin ." ORDER BY LinkOrder") as $row){
            $ret .= '<li class="nav-item">';
            $ret .= '<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">'. $row->LinkName .'</a>';
            $ret .= '<ul class="dropdown-menu">';
            $ret .= $this->GetLinkListHeader($row->LinkID);
            $ret .= '</ul>';
            $ret .= '</li>';
        }
        $ret .= '</ul>';
        $ret .= '</div>';
        $ret .= '</div>';
        $ret .= '</nav>';

        return $ret;
    }

    public function GetMenu($header = false){
        $ret = false;
        if($header == false && $this->templateSetting->navbar == 'sidebar'){
            $ret = '<div class="col-md-4">'. $this->GetNavAsSidebar() .'</div>';
        }elseif($header == true && $this->templateSetting->navbar == 'header'){
            $ret = $this->GetNavAsHeader();
        }
        return $ret;
    }
}