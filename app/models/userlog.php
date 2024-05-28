<?php

class userlog
{
    private $db;
    public function __construct()
    {
        $this->db = new Database();
    }

    // adds a record that logs in the user and their login time.
    public function userLogin(string $userId): bool
    {
        $date = (new DateTime())->format('Y-m-d h:i:s.u');
        $this->db->query('INSERT INTO USERLOG(userId,logDate,logType) VALUES (:userId,:logDate,:logType)');
        $this->db->bind(':userId', $userId);
        $this->db->bind(':logDate', $date);
        $this->db->bind(':logType', "User logged in");

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // same as login but for logging out.
    public function userLogOut(string $userId): bool
    {
        $date = (new DateTime())->format('Y-m-d h:i:s.u');
        $this->db->query('INSERT INTO USERLOG(userId,logDate,logType) VALUES (:userId,:logDate,:logType)');
        $this->db->bind(':userId', $userId);
        $this->db->bind(':logDate', $date);
        $this->db->bind(':logType', "User logged out");

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
