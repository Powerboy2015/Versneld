<?php
class User extends controller
{
    private $usermodel;
    private $user;

    public function __construct()
    {
        session_start();
        $this->usermodel = $this->model('UserData');

        // we set the user variable in the construct because
        //  it will quite probably be used on literally every page about the user.
        //also sends us back if there is no user

        if (isset($_SESSION['username'])) {
            $this->user = $this->usermodel->getUserData($_SESSION['username']);

            if (!$this->user->isVerified) {
                header('Refresh:0, url=/home/notVerified');

                // if the user islbocked is true it will not let them get into the page. This can be done by the admin(owner account).
            } else if ($this->user->isBlocked == 1) {
                header("Refresh:0, url=/home/index");
            }
        } else {
            header('Refresh:0,url=/home/index');
        }
    }

    public function index()
    {
        header('Refresh:0,url=/user/profile');
    }

    // profile page.
    public function profile()
    {
        $data = [];

        // only feeds the non backend information through

        $tablerow = "";
        foreach ($this->usermodel->getProfile($_SESSION['username']) as $key => $value) {
            // checks if each field has a value and if not gives it a placeholder
            if ($value == "" || is_null($value)) {
                $value = "to be filled in...";
            } else if ($key == 'wachtwoord') {
                $value = "**************";
            }

            $tablerow .= '<tr>
                                <th>' . ucwords($key) . '</td>
                                <td>' . $value . '</td>';
        }

        $data = [
            'userTable' => $tablerow,
            'userType'  => $this->user->UserType
        ];
        $this->view("user/profile", $data);
    }

    public function reservations()
    {

        $this->view('user/reservations', $data = ['userType' => $this->user->UserType]);
    }

    public function change()
    {
        $data = [];
        $this->view("user/change", $data);
    }

    public function makeReservation()
    {
        $instructors = $this->usermodel->getInstructors();

        $instructorTable = "";

        foreach ($instructors as $key => $instructor) {
            $instructorTable .= "<option value={$instructor->userId}>{$instructor->userName}</option>";
        }

        $this->view("user/reserve", $data = ['userType' => $this->user->UserType, 'instructTabel' => $instructorTable]);
    }

    public function adminPanel()
    {
        if ($this->user->UserType == 3) {

            $this->view('user/AdminPanel', $data = ['userType' => $this->user->UserType]);
        } else {
            header('refresh:0, url=/user/profile');
        }
    }

    public function deleteReservation(int $resId)
    {
        $this->usermodel->cancelReservation($resId);
    }


    // // #TODO I don't think this exists anymore. could prolly be deleted 
    // // leave this in for a bit
    // does indeed not exist anymore
    // public function AdminRes()
    // {
    //     if ($this->usermodel->getUsrType($_SESSION['username']) != 3) {
    //         header("refresh:0,url=/user/profile");
    //     }


    //     $data = [
    //         'userType'  => $this->user->UserType
    //     ];
    //     $this->view('user/AdminReservation', $data);
    // }
}
