<?php
class User extends controller
{
    private $usermodel;

    public function __construct()
    {
        session_start();
        $this->usermodel = $this->model('UserData');
    }

    public function profile()
    {
        $result = $this->usermodel->getUserData($_SESSION['username']);

        // FIXME this is absolute shit don't leave this like it is currenlty.
        $data = [];

        // only feeds the non backend information through

        $tablerow = "";
        foreach ($result as $key => $value) {
            if ($key != 'wachtwoord' && $key != "isLoggedIn" && $key != 'userId') {

                // checks if each field has a value and if not gives it a placeholder
                if ($value == "" || is_null($value)) {
                    $value = "to be filled in...";
                }

                $tablerow .= '<tr>
                                <th>' . ucwords($key) . '</td>
                                <td>' . $value . '</td>';
            }
        }

        $data = [
            'userTable' => $tablerow
        ];

        $this->view("user/profile", $data);
    }

    public function change()
    {


        $data = [];
        $this->view("user/change", $data);
    }
}
