<?php
class ApiModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    // registers the important userinformation
    // in this case being username, email, password and isLoggedIn
    public function RegisterBaseInformation(array $userData): bool
    {
        $this->db->query('INSERT INTO users(userName,email,wachtwoord,isLoggedIn,UserType,isVerified) VALUES (:userName,:email,:password,true,1,false)');

        $this->db->bind(":userName", $userData['username'], PDO::PARAM_STR);
        $this->db->bind(":email", $userData['email'], PDO::PARAM_STR);
        $this->db->bind(":password", password_hash($userData['password'], PASSWORD_BCRYPT), PDO::PARAM_STR);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getUser(string $username): bool|object
    {
        $this->db->query("SELECT userId,username, wachtwoord 
                          FROM Users 
                        WHERE username = :username");
        $this->db->bind(":username", $username);

        // returns row when found, false when nothing is found or no rows.
        return $this->db->single();
    }

    public function getReservations(string $userId): object
    {
        #TODO Get all the reservations that are connected to the user.
        $this->db->query('SELECT * 
                          FROM reservations 
                          WHERE userId = :userId
                          ');

        $this->db->bind(":userId", $userId);
        $result = $this->db->resultSet();
        return $result;
    }
}
