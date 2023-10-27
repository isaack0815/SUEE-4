<?php

class install{
    private $db;
    private $error = 0;
    private $meldung;

    public function __construct(){
        global $datenbank;
        $this->db = $datenbank;
    }
}