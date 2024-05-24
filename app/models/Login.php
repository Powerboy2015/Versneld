<?php

class Login {
    
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getUser(string $username) {
        $this->db->query("SELECT username, wachtwoord 
                          FROM Users 
                        WHERE username = :username");
        $this->db->bind(":username",$username);
        
        return $this->db->single();
    }


}