<?php

class UserData
{

    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getUserData($userName)
    {
        $this->db->query('SELECT * FROM Users WHERE userName = :username');
        $this->db->bind(":username", $userName);
        return $this->db->single();
    }

    public function getProfile(string $username)
    {
        $this->db->query('SELECT UserName,Email,GeboorteDatum,BSN,Tel,Adres FROM users WHERE UserName = :username');
        $this->db->bind(":username", $username);

        $result = $this->db->single();

        return $result;
    }
}
