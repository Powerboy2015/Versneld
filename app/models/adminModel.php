<?php
class adminModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    // gets the data of the reservation.
    public function getResData(int $resId)
    {
        $this->db->query("SELECT userId,instructorId,startDatum,eindDatum,pakketType,locatie,aantPers,resStatus FROM reservation WHERE resId = :resId");
        $this->db->bind(":resId", $resId);
        return $this->db->single();
    }

    public function getInstructorName(int $id)
    {
        $this->db->query('SELECT userName FROM users WHERE userId = :userId AND userType > 1');
        $this->db->bind(':userId', $id);

        $ref = $this->db->single();

        if (!$ref) {
            return 'not set';
        } else {
            return $ref->userName;
        }
    }

    public function getInstructors()
    {
        $this->db->query("SELECT userId, userName,UserType FROM users WHERE userType = 2");
        $result = $this->db->resultSet();

        return $result;
    }

    public function updateRes($postdata, $resId)
    {
        $this->db->query('UPDATE reservation 
                          SET startDatum = :startDatum,
                              eindDatum = :eindDatum,
                              pakketType = :pakketType,
                              locatie = :locatie,
                              aantPers = :aantPers,
                              instructorId = :instructorId,
                              resStatus = :resStatus
                          WHERE resId = :resId
                              ;');

        $this->db->bind(':resId', $resId);

        $startDate = new dateTime($postdata['startDatum']);
        $this->db->bind(':startDatum', $startDate->format('Y-m-d h:i:s'));

        $endDate = new DateTime($postdata['eindDatum']);
        $this->db->bind(':eindDatum', $endDate->format('Y-m-d h:i:s'));

        $this->db->bind(':pakketType', $postdata['pakketType']);
        $this->db->bind(':locatie', $postdata['locatie']);
        $this->db->bind(':aantPers', $postdata['aantPers']);
        $this->db->bind(':instructorId', $postdata['instructorId']);
        $this->db->bind(':resStatus', $postdata['resStatus']);

        return $this->db->execute();
    }
}
