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

            $Email = new Mail($this->user->email, $user->userName);
            $Email->body('Welcome ' . $_SESSION['username'], 'verify', $this->user);
            $Email->send();

            $this->USERLOG->userAction(3, $user->userId);
            $this->USERLOG->userAction(1, $user->userId);
            echo json_encode(true);
        } else {
            // #TODO make this proper error code.
            echo json_encode('Username or Email already in use!');
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

    // gets the reservations and builds them into cards to display.
    public function getReservations()
    {
        if ($this->user->UserType == 3) {
            $result = $this->apiModel->getReservations();
        } else {
            $result = $this->apiModel->getReservations($this->user->userId);
        }

        $reservations = "<div class='inner'>";
        foreach ($result as $key => $res) {
            switch ($res->pakketType) {
                case 1:
                    $type = "Privéles 2,5 uur";
                    break;
                case 2:
                    $type = "Losse Duo Kiteles 3,5 uur";
                    break;
                case 3:
                    $type = "Kitesurf Duo lespakket 3 lessen 10,5 uur";
                    break;
                case 4:
                    $type = "Kitesurf Duo lespakket 5 lessen 17,5 uur";
                    break;
                default:
                    $type = "Geen gekozen, error?";
                    break;
            }

            // card body.   
            $reservations .= "<div class='card'>
                                <h2>reservation Id: {$res->resId}</h2>
                                <p> {$res->startDatum} - {$res->eindDatum}</p>
                                <p> Locatie: {$res->locatie}</p>
                                <p> {$type}</p>
                                <p> aantal personen: {$res->aantPers}</p>
                                <a class='changeRes' href='/admin/callRes/{$res->resId}'>change</a>
                                <a class='DeleteRes' href='/admin/DeleteRes/{$res->resId}'>Delete</a>
                              </div>";
        }

        $reservations .= "</div>";
        echo json_encode($reservations);
    }

    // right okay so you get all of your data from the POST.
    public function createReservation()
    {
        // just redirecting it to our model.
        $result = $this->apiModel->createReservation($this->user->userId, $_POST);

        // gives back an true or false.
        echo json_encode($result);
    }

    public function fetchAdminTable()
    {
        $table = $this->apiModel->fetchUsers();

        $tablerows = '';

        foreach ($table as $key => $user) {
            $tablerows .= '<tr>';
            foreach ($user as $record => $value) {

                // changes the number in the database to userTypes.
                if ($record == "UserType") {
                    switch ($value) {
                        case 1:
                            $value = 'user';
                            break;
                        case 2:
                            $value = "Instructor";
                            break;
                        case 3:
                            $value = "admin";
                            break;
                        default:
                            $value = "user";
                    }
                    $tablerows .= "<td><a class='user-type' href='/api/openElevationPanel/" . $user->userName . "'>" . $value . "</a></td>";
                } else if ($record == "isVerified") {
                    switch ($value) {
                        case 1:
                            $value = 'verified';
                            break;
                        case 2:
                            $value = 'not verified';
                            break;
                        default:
                            $value = 'not verified';
                    }
                    $tablerows .= "<td>" . $value . "</td>";
                } else {
                    $tablerows .= "<td>" . $value . "</td>";
                }
            }
            $tablerows .= "<td><a class='change-User' href='/api/fetchUpdatePanel/" . $user->userName . "'>change User</a></td>
                           <td class='delete-User'> X </td>";
            $tablerows .= '</tr>';
        }

        echo json_encode($tablerows);
    }

    // calls for updateUser template, and shoots it back to the js code
    public function fetchUpdatePanel(string $username = null): void
    {
        // uses SESSION username instead of given string as username.
        if (isset($username) && $this->user->UserType == 3) {
            $result = $this->apiModel->getUserData($username);
        } else {
            $result = $this->apiModel->getUserData($_SESSION['username']);
        }

        // adds autmatically filled labels and input for all the fields.
        $tablerows = '';
        foreach ($result[0] as $record => $value) {
            if ($record == "geboorteDatum") {
                $tablerows .= "<label>" . $record . "</label>
                           <input type='date' name='" . $record . "' value ='" . $value . "'>";
            } else if ($record == "BSN") {
                $tablerows .= "<label>" . $record . "</label>
                           <input type='number' min='100000000' max='999999999' name='" . $record . "' value ='" . $value . "'>";
            } else {
                $tablerows .= "<label>" . $record . "</label>
                               <input type='text' maxlength='129' name='" . $record . "' value ='" . $value . "'>";
            }
        }

        $data = [
            'rows' => $tablerows,
            'userName' => $result[0]->userName
        ];

        // gets the page fully filled in
        ob_start();
        $this->view('components/updateUser', $data);
        $result = ob_get_clean();

        // return file back to the js for the fetch
        echo json_encode($result);
    }

    // as usual, acquires data through POST
    public function changeData(string $username = null)
    {
        // redirects data and model anwser.
        //But only if the email is a legit email
        if (!filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL)) {
            echo json_encode("email not clean!");
        } else {
            if (isset($username)) {
                echo json_encode($this->apiModel->updateUser($this->apiModel->getUser($username)->userId, $_POST));
            } else {
                $_SESSION['username'] = $_POST['userName'];
                echo json_encode($this->apiModel->updateUser($this->user->userId, $_POST));
            }
        }
    }

    public function openElevationPanel(string $username)
    {
        $data = [
            'username' => $username
        ];
        ob_start();
        $this->view('components/elevation', $data);
        echo json_encode(ob_get_clean());
    }

    public function updateUserType(string $username)
    {
        $res = $this->apiModel->getUser($username);
        echo json_encode($this->apiModel->updateUserType($_POST['userType'], $res->userId));
    }

    public function editRes(int $resId)
    {
        echo json_encode($this->apiModel->editRes($resId, $_POST));
    }
}
