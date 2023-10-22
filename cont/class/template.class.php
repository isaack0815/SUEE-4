<?php

class template{
    private $error = 0;
    private $db;

    public function __construct(){
        global $db;
        $this->db = $db;
    }

    private function get_template_setting(){
        $sql = "SELECT * FROM template_setting";
        $result = $this->db->query($sql);
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            return $row;
        }else{
            $this->error = 1;
            return false;
        }
    }
}