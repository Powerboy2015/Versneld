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

    public function getUsrId(string $username)
    {
        $this->db->query('SELECT userId FROM users WHERE userName = :userName');
        $this->db->bind(":userName", $username);
        return $this->db->single()->userId;
    }

    public function getUsrType(string $username)
    {
        $this->db->query('SELECT userType FROM users WHERE userName = :userName');
        $this->db->bind(":userName", $username);
        return $this->db->single()->userType;
    }
    public function getInstructors()
    {
        $this->db->query("SELECT userId, userName FROM users WHERE userType = 2");
        $result = $this->db->resultSet();

        return $result;
    }

    public function cancelReservation(int $resId)
    {
        $this->db->query('DELETE FROM Reservation WHERE resId = :resId');
        $this->db->bind(':resid', $resId);
        return $this->db->execute();
    }
}
