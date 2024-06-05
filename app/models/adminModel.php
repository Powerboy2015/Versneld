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
}
