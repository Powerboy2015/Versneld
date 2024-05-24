<?php
Class Home extends controller 
{
    private $homeModel;


    public function __construct() {
        $this->homeModel = $this->model("Login");
        session_start();
    }
    
    public function index() {

        
        $data = [];
        if(isset($_SESSION['user'])) {
            $data['userName'] = $_SESSION['user'];
        } 
        $this->view('Home/Index',$data);
    }

    // will check username and password and logs in the user. then redirects to page.
    public function login() {
        $userData = $this->homeModel->getUser($_POST['username']);

        if ($userData != false && $userData->wachtwoord == $_POST["password"]) {
            $_SESSION['username'] = $userData->username;
            $res = true;
        } else {
            $res = "wrong password or username";
        }

        echo json_encode($res);
    }

    public function test() {
        if(isset($_SESSION['username'])) {
            $this->view("Home/test");
        } else {
            header("refresh:0, url=/home/index");
        }
    }

    public function clear() {
        session_destroy();
        header("refresh:0, url=/home/index");
    }
}