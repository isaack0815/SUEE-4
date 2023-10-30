<?php

class run{
    private $db;
    private $error = 0;
    private $meldung;
    private $session;
    
    public function __construct(){
        global $db,$_SESSION;
        $this->db = $db;
        $this->session = $_SESSION;
    }

    private function CheckIfFileExists($query){
        if(!file_exists(DIR_FS . 'cont/run/' . $this->db->get_row($query,true)->PostFile)){
            $this->error = 1;
        }
    }

    private function CheckPostRights($row){
        if($this->session['login'] != true && $row->PostRights == 1){
            $this->error = 1;
        }elseif($this->session['admin'] != 1 && $row->PostRights == 2){
            $this->error = 1;
        }elseif($this->session['login'] == true && $row->PostRights == 0){
            $this->error = 1;
        }
    }

    public function run($post){
        $post = array_key_first($post);
        $query = "SELECT * FROM run_inc WHERE PostName = '" . $this->db->escape($post) . "'";
        if($this->db->get_row($query)){
            $row = $this->db->get_row($query,true);
            $this->CheckIfFileExists($query);
            $this->CheckPostRights($row);
            if($this->error == 0) {
                return DIR_FS . 'cont/run/' . $row->PostFile;
            }else{
                return 1;
            }
        }else{
            return 1;
        }

        if($this->error == 1) meldung($this->meldung,$this->error);
    }
}