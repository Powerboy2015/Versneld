<?php

class Verify
{

    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function isValidCode(string $code): int|false
    {
        $this->db->query("SELECT userId 
                          FROM users 
                          WHERE wachtwoord = :pass");
        $this->db->bind(':pass', $code);
        $result = $this->db->resultSet();

        if (isset($result[0])) {
            return $result[0]->userId;
        } else {
            return false;
        }
    }

    public function isUserVerified(int $userid): false|object
    {
        $this->db->query('SELECT isVerified FROM Users WHERE userId = :userId');
        $this->db->bind(':userId', $userid);

        $result = $this->db->single();

        if (isset($result)) {
            return $result;
        } else {
            return false;
        }
    }

    // updates user profile in database to isverfied = TRUE
    public function VerifyUser(string $userId): bool
    {
        $this->db->query('UPDATE users
                          SET isVerified = true
                          WHERE userId = :userid');
        $this->db->bind(':userid', $userId);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
