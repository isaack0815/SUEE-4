<?php

class menu{
    private $db;
    private $error = 0;
    private $meldung;
    private $session;
    private $templateSetting;
    private $gconfig;

    public function __construct(){
        global $db,$_SESSION,$template,$gconfig;
        $this->db = $db;
        $this->session = $_SESSION;
        $this->templateSetting = $template;
        $this->gconfig = $gconfig;
    }

    private function GetLinkList($id){
        $ret = '';
        foreach($this->db->get_results("SELECT * FROM MainMenu WHERE child_from = ". $id ." AND active = 1 ORDER BY LinkOrder") as $row){
            if($this->db->num_rows("SELECT * FROM MainMenu WHERE child_from = ". $row->id ." AND active = 1") > 0){
                $ret .= Menuhead($this->session[$this->session['lang']][$row->BoxTitel], $this->GetLinkList($row->id));
            }else{
                $ret .= Menulinks($row->LinkURL,$this->session[$this->session['lang']][$row->LinkName], $row->LinkIcon);
            }
        }

        return $ret;
    }

    private function GetNavAsSidebar(){
        $ret = '';
        if($this->session['admin'] == true){
            $ret .= Menuhead($this->session[$this->session['lang']]['ADMIN_LINK'], '<a href="'. $this->gconfig->domain . $this->gconfig->admindir .'" class="btn btn-primary"><i class="bi bi-gear"></i> '. $this->session[$this->session['lang']]['ADMIN_LINK'] .'</a><br>', );
        }
        if($this->session['login'] == true){ $LinkLogin = 1; }else{ $LinkLogin = 0; }
        foreach($this->db->get_results("SELECT * FROM boxes WHERE BoxLocation = 'navigation' AND BoxVisibleFor = '". $LinkLogin ."' OR BoxVisibleFor = '2' ORDER by BoxOrder") as $row){
            $ret .= Menuhead($this->session[$this->session['lang']][$row->BoxTitel], require_once(TEMPLATE_DIR. 'boxes/'.$row->BoxFile));
        }
        foreach($this->db->get_results("SELECT * FROM MainMenu WHERE child_from = 0 AND active = 1 AND LinkLogin = ". $LinkLogin ."  ORDER BY LinkOrder") as $row){
            $ret .= Menuhead($this->session[$this->session['lang']][$row->LinkName],$this->GetLinkList($row->id));
        }

        return $ret;
    }

    private function GetLinkListHeader($id){
        $ret = '';
        foreach($this->db->get_results("SELECT * FROM MainMenu WHERE child_from = ". $id ." AND active = 1 ORDER BY LinkOrder") as $row){
            $ret .= '<li><a class="dropdown-item" href="'. $row->LinkURL .'">'. $this->session[$this->session['lang']][$row->LinkName] .'</a></li>';
        }
    }

    private function GetNavAsHeader(){
        $ret = '<nav class="navbar navbar-expand-lg bg-body-tertiary">';
        $ret .= '<div class="container-fluid">';
        $ret .= '<div class="collapse navbar-collapse" id="navbarSupportedContent">';
        $ret .= '<ul class="navbar-nav me-auto mb-2 mb-lg-0">';
        if($this->session['login'] == true){ $LinkLogin = 1; }else{ $LinkLogin = 0; }
        $admin = '';
        if($this->session['admin'] == true){
            $admin = '<li class="nav-item"><a class="nav-link active" aria-current="page" href="'. $this->$gconfig->domain . $this->gconfig->admindir .'">'. $this->session[$this->session['lang']]['ADMIN_LINK'] .'</a></li>
            ';
        }
        foreach($this->db->get_results("SELECT * FROM MainMenu WHERE child_from = 0 AND active = 1 AND LinkLogin = ". $LinkLogin ." ORDER BY LinkOrder") as $row){
            $ret .= '<li class="nav-item">';
            $ret .= '<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">'. $_SESSION[$_SESSION['lang']][$row->LinkName] .'</a>';
            $ret .= '<ul class="dropdown-menu">';
            $ret .= $this->GetLinkListHeader($row->LinkID);
            $ret .= '</ul>';
            $ret .= '</li>';
        }
        $ret .= $admin;
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