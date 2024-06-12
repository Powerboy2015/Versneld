<?php

class Admin extends Controller
{
    private $adminModel;
    private $usermodel;
    private $user;

    public function __construct()
    {
        session_start();
        $this->adminModel = $this->model('AdminModel');
        $this->usermodel = $this->model('UserData');
        if (isset($_SESSION['username'])) {
            $this->user = $this->usermodel->getUserData($_SESSION['username']);
        }

        // if ($this->user->UserType < 2) {
        //     header('refresh:0, url=/user/profile');
        // }
    }

    public function editRes(int $resId)
    {
        $resData = $this->adminModel->getResData($resId);

        // changes the pakketype int to the name.
        switch ($resData->pakketType) {
            case 1:
                $resData->pakketType = "Privéles 2,5 uur";
                break;
            case 2:
                $resData->pakketType = "Losse Duo Kiteles 3,5 uur";
                break;
            case 3:
                $resData->pakketType = "Kitesurf Duo lespakket 3 lessen 10,5 uur";
                break;
            case 4:
                $resData->pakketType = "Kitesurf Duo lespakket 5 lessen 17,5 uur";
                break;
            default:
                $resData->pakketType = "Geen gekozen, error?";
                break;
        }

        switch ($resData->resStatus) {
            case 1:
                $resData->resStatus = 'in behandeling';
                break;
            case 2:
                $resData->resStatus = 'wachten op reactie';
                break;
            case 3:
                $resData->resStatus = 'confirmed';
                break;
            default:
                $resData->resStatus = 'aangemeld';
                break;
        }
        // switches out the instructorId for the instructor Username.
        // gives not set if not set.
        $resData->instructorId = $this->adminModel->getInstructorName($resData->instructorId);

        // Gets an list of all instructors.
        $instructorList = $this->adminModel->getInstructors();

        $innerForm = '';
        foreach ($resData as $key => $value) {
            switch ($key) {
                case 'userId':
                    $innerForm .= "<h2>Reservation Nummer: {$resId}</h2>";
                    break;
                    // makes all the date forms a datetime-local.
                case 'startDatum':
                case 'eindDatum':
                    $innerForm .= "<label for='{$key}'>{$key}</label>
                                   <input type='datetime-local' name='{$key}' value='{$value}'>";
                    break;

                    // creates select element with all location options.
                case 'locatie':
                    $innerForm .= '<label for="' . $key . '">' . $key . '</label>
                                   <select name="' . $key . '" required>
                                        <option value="Muiderberg">Muiderberg</option>
                                        <option value="Zandvoort">Zandvoort</option>
                                        <option value="Wijk aan Zee">Wijk aan Zee</option>
                                        <option value="Ijmuiden">Ijmuiden</option>
                                        <option value="Scheveningen">Scheveningen</option>
                                        <option value="Hoek van holland">Hoek van holland</option>
                                    </select>';
                    break;

                    // adds an select element with all the instructors. 
                case 'instructorId':
                    $innerForm .= "<label for='{$key}'>instructeur</label>
                                   <select name='{$key}' required>";
                    foreach ($instructorList as $id => $instructor) {
                        $innerForm .= "<option value='{$instructor->userId}'>{$instructor->userName}</option>";
                    }
                    $innerForm .= "</select>";
                    break;

                    // if value is an int it will make the input accept numbers only.
                case is_int($value):
                    $innerForm .= "<label for='{$key}'>{$key}</label>
                                   <input type='number' max-number='2' name='{$key}' value='{$value}'>";
                    break;

                case 'resStatus':
                    // makes it not possible for default users to change reservation status.
                    if ($this->user->UserType == 1) {
                        $innerForm .= '';
                    } else {

                        $innerForm .= '<label for="' . $key . '">' . $key . '</label>
                        <select name="' . $key . '" required>
                        <option value="1">in behandeling</option>
                        <option value="2">wachten op reactie</option>
                        <option value="3">confirmed</option>
                        <option value="4">aangemeld</option>
                        </select>';
                    }
                    break;

                    // switch case for pakketType
                case 'pakketType':
                    $innerForm .= '<label for="' . $key . '">' . $key . '</label>
                                   <select name="' . $key . '" required>
                                        <option value="1">Privéles 2,5 uur</option>
                                        <option value="2">Losse Duo Kiteles 3,5 uur</option>
                                        <option value="3">Kitesurf Duo lespakket 3 lessen 10,5 uur</option>
                                        <option value="4">Kitesurf Duo lespakket 5 lessen 17,5 uur</option>
                                    </select>';
                    break;



                    // everything else is set to be a text
                default:
                    $innerForm .= "<label for='{$key}'>{$key}</label>
                                   <input type='text' name='{$key}' value='{$value}'>";
                    break;
            }
        }


        $this->view('admin/editRes', $data = ['resData' => $innerForm, 'resId' => $resId]);
    }

    public function deleteRes(int $resId)
    {
        $connUser = $this->adminModel->findConnectedUser($resId);
        $instructEmail = $this->usermodel->GetInstructorEmail($connUser->instructorId);

        // sends email that user has removed the reservation.
        $mail = new Mail($connUser->email, $connUser->userName);
        $mail->addCC($instructEmail, 'instructor');
        $mail->body('reservation sucessfully removed', 'userCancel', $connUser);
        $mail->send();

        // deletes reservation from database.
        $this->adminModel->deleteReservation($resId);

        // returns user to homepage.
        header("refresh:0, url=/user/profile");
    }

    public function updateRes($resId)
    {
        // updates the reservation.
        if ($this->adminModel->updateRes($_POST, $resId)) {
            echo 'redirect...';
            header('refresh:0,url=/user/reservations');
        };
    }

    public function cancelRes(int $resId)
    {
        // send user to the page.
        $this->view('admin/cancelReservation', $data = ['resId' => $resId]);
    }

    // handles canceling the reservation.
    public function cancel(int $resId)
    {
        $foundUser = $this->adminModel->findConnectedUser($resId);
        $this->adminModel->deleteReservation($resId);
        $email = new Mail($foundUser->email, $foundUser->userName);
        $email->body('Reservation has been removed', 'resCancel', $foundUser);
        $email->send();
    }
}
