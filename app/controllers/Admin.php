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

        // returns everyone that is not atleast instructor clearance
        if ($this->user->UserType < 2) {
            header('refresh:0, url=/user/profile');
        }
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


        // #TODO finish woroking on the edit reservation panel.

        $innerForm = '<label for=""';


        $this->view('admin/editRes', $data = ['resData' => $innerForm]);
    }

    public function deleteRes(int $resId)
    {
    }


    // private function cleanObj(object $record)
    // {
    //     $cleanData = [];

    //     foreach ($record as $key => $value) {
    //         if ($key == "instructorId") {
    //             $cleanData[$key] = $this->apiModel->getInstructorName($value);
    //         } else if ($key == 'pakketType') {
    //             switch ($value) {
    //                 case 1:
    //                     $resData->pakketType = "Privéles 2,5 uur";
    //                     break;
    //                 case 2:
    //                     $type = "Losse Duo Kiteles 3,5 uur";
    //                     break;
    //                 case 3:
    //                     $type = "Kitesurf Duo lespakket 3 lessen 10,5 uur";
    //                     break;
    //                 case 4:
    //                     $type = "Kitesurf Duo lespakket 5 lessen 17,5 uur";
    //                     break;
    //                 default:
    //                     $type = "Geen gekozen, error?";
    //                     break;
    //             }
    //         } else {
    //             $cleanData[$key] = $value;
    //         }
    //     }

    //     return $cleanData;
    // }

}
