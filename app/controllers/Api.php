<?php


// In this file there will be all the methods javascript will use.
class Api extends Controller
{

    private $apiModel;
    private $USERLOG;
    public function __construct()
    {
        $this->apiModel = $this->model("ApiModel");
        $this->USERLOG = $this->model("userlog");
        session_start();
    }

    // loops through the values provided by the register form and are  bound to the  placeholder values in the SQL statment.
    // #FIXME this needs to be done properly later on. 
    // For now this is a good bit of code that just needs to be altered according to everyting else.
    public function Register(): void
    {
        // Checks if passwords are filled in the same, 
        //if it's an actual email 
        //and if it is stored into the database.
        if (
            $_POST['password'] === $_POST['repeat-pass']
            && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)
            && $this->apiModel->registerBaseInformation($_POST)
        ) {
            // sets the session with the username and returns true.
            $_SESSION['username'] = $_POST['username'];
            $user = $this->apiModel->getUser($_SESSION['username'])->userId;
            $this->USERLOG->userLogin($user->userId);
            echo json_encode(true);
        } else {
            echo json_encode('WHoops, something went wrong');
        }
    }

    // will check username and password and logs in the user. then redirects to page.
    public function login(): void
    {
        $userData = $this->apiModel->getUser($_POST['username']);

        if ($userData != false && password_verify($_POST['password'], $userData->wachtwoord)) {
            $_SESSION['username'] = $userData->username;
            $this->USERLOG->userLogin($userData->userId);
            $res = true;
        } else {
            $res = "wrong password or username";
        }

        echo json_encode($res);
    }

    public function clear()
    {
        $userData = $this->apiModel->getUser($_SESSION['username']);
        $this->USERLOG->userLogOut($userData->userId);
        session_destroy();
        header("refresh:0, url=/home/index");
    }

    // a part api that calls all reservations form the database.
    // #TODO this an api so we can do search queries and dynamically load the list.
    public function getReservations()
    {
        $result = $this->apiModel->getReservations($_POST);

        $data = [];

        $tablerow = "";

        // loops through each reservation
        foreach ($result as $table => $fields) {
            // loops through each value in the reservation.
            foreach ($fields as $key => $value) {
                //#TODO switch case statement here to change the required data.

                $tablerow .=    '<tr>
                                <th>' . ucwords($key) . '</td>
                                <td>' .    $value     . '</td>
                            </tr>';
            }

            // add the table of reservation data to the data variable using the reservation Id
            $data[$fields->resId] = $tablerow;
        }

        // sends back the data to the javascript.
        echo $data;
    }
}
