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

    public function getUser(string $username)
    {
        $this->db->query("SELECT userId,userName,email, wachtwoord 
                          FROM Users 
                        WHERE username = :username");
        $this->db->bind(":username", $username);

        // returns row when found, false when nothing is found or no rows.
        return $this->db->single();
    }

    public function getReservations(string $userId = null)
    {
        if (!isset($userId)) {
            $this->db->query('SELECT * 
                          FROM Reservation 
                          ');
        } else {
            $this->db->query('SELECT * 
                          FROM Reservation 
                          WHERE userId = :userId
                          ');
            $this->db->bind(":userId", $userId);
        }

        $result = $this->db->resultSet();
        return $result;
    }

    public function checkEmailUsed(string $email): bool
    {
        $this->db->query('SELECT email FROM users WHERE email = :email');
        $this->db->bind(':email', $email);

        if ($this->db->resultSet() != false) {
            return true;
        }
        return false;
    }


    // creates a reservation using the postdata from the array and the userID from the user.
    public function createReservation($userId, array $postdata)
    {
        $this->db->query("INSERT INTO Reservation(userId,instructorId,startdatum, eindDatum,pakketType,locatie,aantPers)
                               VALUES (:userId,:instructorId,:startDatum,:eindDatum,:pakketType,:locatie,:aantPers);");
        $this->db->bind(':userId', $userId);

        $startDate = new dateTime($postdata['startdate']);
        $this->db->bind(':startDatum', $startDate->format('Y-m-d h:i:s'));

        $endDate = new DateTime($postdata['enddate']);
        $this->db->bind(':eindDatum', $endDate->format('Y-m-d h:i:s'));

        $this->db->bind(':pakketType', $postdata['pakketType']);
        $this->db->bind(':locatie', $postdata['location']);
        $this->db->bind(':aantPers', $postdata['amountPeople']);
        $this->db->bind(':instructorId', $postdata['instructorId']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function fetchUsers(): array
    {
        $this->db->query("SELECT userId,userName,email,Tel,Adres,UserType,isVerified FROM users WHERE userType < 3");
        return $this->db->resultSet();
    }

    // gets all required userdata to change it.
    public function getUserData(string $username): array
    {
        $this->db->query("SELECT userName,email,geboorteDatum,BSN,Tel,Adres FROM Users WHERE userName = :username");
        $this->db->bind(":username", $username);

        $result = $this->db->resultSet();

        return $result;
    }

    public function getInstructorEmail(string $instructId)
    {
        $this->db->query("SELECT email FROM users WHERE userId = :userId AND UserType = 2;");
        $this->db->bind(':userId', $instructId);
        return $this->db->single()->email;
    }

    public function updateUser($userId, array $formData)
    {
        $this->db->query("UPDATE users
                          SET userName = :username,
                              email= :email,
                              geboorteDatum = :date,
                              BSN = :BSN,
                              Tel = :Tel,
                              Adres = :Adres
                          WHERE userId = :userId");
        $this->db->bind(":username", $formData['userName']);
        $this->db->bind(':email', $formData['email']);
        $this->db->bind(":date", $formData['geboorteDatum']);
        $this->db->bind(":BSN", $formData['BSN']);
        $this->db->bind(":Tel", $formData['Tel']);
        $this->db->bind(":Adres", $formData['Adres']);
        $this->db->bind(":userId", $userId);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateUserType(int $userType, int $userId)
    {
        if ($userType == 4) {
            $this->db->query('UPDATE users
                              set userType = 1,
                                  isBlocked = true
                              WHERE userId = :userId');
        } else {
            $this->db->query('UPDATE users
                              set userType = :userType,
                                  isBlocked = false
                              WHERE userId = :userId');
            $this->db->bind(":userType", $userType);
        }
        $this->db->bind(":userId", $userId);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function editRes(int $resId, array $postData)
    {
        $this->db->query('UPDATE Reservation
                          SET instructorId = :instructorId,
                              startDatum = :startDatum,
                              einDatum = :eindDatum,
                              pakketType = :pakketType,
                              locatie = :locatie,
                              aantPers = :aantPers,
                              resStatus =:resStatus
                          WHERE resId = :resId');

        // TODO fix this shit.
        // $this->db->bind();
    }

    public function getUserName(int $userId)
    {
        $this->db->query("SELECT userName FROM users WHERE userId = :userId");
        $this->db->bind(':userId', $userId);

        $res = $this->db->single();

        if (isset($res)) {
            return $res->userName;
        }
        return false;
    }

    public function deleteUser($username)
    {
        $this->db->query("DELETE FROM users WHERE userName = :username");
        $this->db->bind(":username", $username);
        try {
            $this->db->execute();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function getIntructRes(int $instructId)
    {

        $this->db->query('SELECT * 
                          FROM Reservation
                          WHERE InstructorId = :instructId 
                          ');
        $this->db->bind(":instructId", $instructId);

        $result = $this->db->resultSet();
        return $result;
    }
}
