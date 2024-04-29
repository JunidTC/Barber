<?php

class Data {

    public $server;
    public $user;
    public $password;
    public $db;
    public $connection;
    public $isActive;

    /* constructor */

    public function __construct() {
        $hostName = gethostname();
        
        switch ($hostName) {
            case "DESKTOP-G76HN88": //Office's PC
                $this->isActive = false;
                $this->server = "127.0.0.1";
                $this->user = "root";
                $this->password = "";
                $this->db = "bdbarberia";
                break;
            case "hostName": //laptop's PC
                $this->isActive = false;
                $this->server = "127.0.0.1";
                $this->user = "root";
                $this->password = "";
                $this->db = "bdbarberia";
                break;
            default: //Hosting
                 $this->isActive = false;
      			 $this->server = "127.0.0.1";
                 $this->user = "root";
                 $this->password = "";
                 $this->db = "bdbarberia";
                break;
        }
    }

}


