<?php


// In this file there will be all the methods javascript will use.
class Api extends Controller
{

    private $apiModel;
    private $USERLOG;
    private object $user;

    public function __construct()
    {
        session_start();
        $this->apiModel = $this->model("ApiModel");
        $this->USERLOG = $this->model("userlog");
        if (isset($_SESSION['username'])) {
            $this->user = $this->model("UserData")->getUserData($_SESSION['username']);
        }
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
            && !$this->apiModel->checkEmailUsed($_POST['email'])
            && $this->apiModel->registerBaseInformation($_POST)
        ) {
            // sets the session with the username and returns true.
            $_SESSION['username'] = $_POST['username'];
            $user = $this->apiModel->getUser($_SESSION['username']);

            $this->USERLOG->userAction(3, $user->userId);
            $this->USERLOG->userAction(1, $user->userId);
            echo json_encode(true);
        } else {
            // #TODO make this proper error code.
            echo json_encode('WHoops, something went wrong');
        }
    }

    // will check username and password and logs in the user. then redirects to page.
    public function login(): void
    {
        $userData = $this->apiModel->getUser($_POST['username']);

        if ($userData != false && password_verify($_POST['password'], $userData->wachtwoord)) {
            $_SESSION['username'] = $userData->username;
            $this->USERLOG->userAction(1, $userData->userId);
            $res = true;
        } else {
            $res = "wrong password or username";
        }

        echo json_encode($res);
    }

    public function clear()
    {
        $userData = $this->apiModel->getUser($_SESSION['username']);
        $this->USERLOG->userAction(2, $userData->userId);
        session_destroy();
        header("refresh:0, url=/home/index");
    }

    // Sends the verification email to the user again.
    public function sendVerifyEmail()
    {
        $Email = new Mail($this->user->email, $this->user->userName);
        $Email->body('Verify your account!', 'verify', $this->user);

        if ($Email->send()) {
            echo json_encode(true);
        } else {
            echo json_encode(false);
        }
    }

    public function getReservations()
    {
        $result = $this->apiModel->getReservations($this->user->userId);

        $data = [];

        // we rebuild the whole object but change all the required values.
        foreach ($result as $key => $res) {
            $arr = [];
            foreach ($res as $record => $value) {
                if ($record == "pakketType") {
                    switch ($value) {
                        case 1:
                            $value = 'Privéles 2,5 uur';
                            break;
                        case 2:
                            $value = 'Losse Duo Kiteles 3,5 uur';
                            break;
                        case 3:
                            $value = 'Kitesurf Duo lespakket 3 lessen 10,5 uur';
                            break;
                        case 4:
                            $value = 'Kitesurf Duo lespakket 5 lessen 17,5 uur';
                            break;
                    }
                }
                $arr[$record] = $value;
            }
            $data[$key] = $arr;
        }

        echo json_encode($data);
    }

    // right okay so you get all of your data from the POST.
    public function createReservation()
    {
        // just redirecting it to our model.
        $result = $this->apiModel->createReservation($this->user->userId, $_POST);

        // gives back an true or false.
        echo json_encode($result);
    }
}
