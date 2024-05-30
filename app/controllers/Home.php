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
        $this->view('Home/notVerified');
    }

    public function VerifyUser(string $code)
    {
        $newcode = substr($_GET['url'], -60);
        $user = $this->homeModel->isvalidCode($newcode);
        // prevents method from executing if user does not have a valid code.
        if (!isset($code) || !$user) {
            header("refresh:0, url=/home/index");
        }

        sleep(0.5);
        if ($this->USERLOG->userAction(6, $user) && $this->homeModel->Verifyuser()) {
            echo "account has been verified! Redirecting...";
            header("Refresh:0, url=/user/profile");
        }
    }
}
