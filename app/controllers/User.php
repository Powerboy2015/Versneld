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
            }
        } else {
            header('Refresh:0,url=/home/index');
        }
    }

    // profile page.
    public function profile()
    {

        // FIXME this is absolute shit don't leave this like it is currenlty.
        // Why?
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

    // calls for the user change page, But I might want to do this inside the website already.
    // #TODO write this dumbass code.
    public function change()
    {
        $data = [];
        $this->view("user/change", $data);
    }

    public function makeReservation()
    {
        $this->view("user/reserve", $data = ['userType' => $this->user->UserType]);
    }
}
