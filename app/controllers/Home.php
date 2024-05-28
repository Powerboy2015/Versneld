<?php
class Home extends controller
{
    private $homeModel;
    private $USERLOG;


    public function __construct()
    {
        $this->homeModel = $this->model("Login");
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
}
