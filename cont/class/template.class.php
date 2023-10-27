<?php

class template{
    private $error = 0;
    private $db;

    public function __construct(){
        global $db;
        $this->db = $db;
    }

    public function get_template_setting(){
        $ret = new stdClass();
        foreach($this->db->get_results("SELECT * FROM template_setting") as $row){
           $ret->{$row->TempKey} = $row->TempValue;
        }

        return $ret;
    }
}

?>