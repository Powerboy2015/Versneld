<?php
class Home extends controller
{
    private $homeModel;
    private $USERLOG;


    public function __construct()
    {
        $this->homeModel = $this->model("Verify");
        $this->USERLOG = $this->model("userlog");
        session_start();
    }

    public function index(): void
    {
        $data = [];
        if (isset($_SESSION['user'])) {
            $data['userName'] = $_SESSION['user'];
        }
        $this->view('Home/Index', $data);
    }

    public function test(): void
    {
        if (isset($_SESSION['username'])) {
            $this->view("Home/test");
        } else {
            header("refresh:0, url=/home/index");
        }
    }

    public function notVerified()
    {
        //#TODO make this page not available if the user is already verified.
        $this->view('Home/notVerified');
    }

    public function VerifyUser(string $code)
    {
        $newcode = substr($_GET['url'], -60);
        $user = $this->homeModel->isvalidCode($newcode);

        // if user is already verified, it just goes to profile page.
        if ($this->homeModel->isUserVerified($user)) {
            header("refresh:0, url =/user/profile");
        }

        // prevents method from executing verification without having the required or any code.
        if (!isset($code) || $user != false) {
            header("refresh:0, url=/home/index");
        }

        // if both my useraction loggin and user verify methods return true we redirect
        sleep(1);
        if ($this->USERLOG->userAction(6, $user) && $this->homeModel->Verifyuser($user)) {
            echo "account has been verified! Redirecting...";
            header("Refresh:0, url=/user/profile");
        }
    }
}
