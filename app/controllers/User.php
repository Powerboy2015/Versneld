<?php
class User extends controller
{
    public function __construct(){
        session_start();
    }

    public function profile(){

        $this->view("user/profile");
    }

    public function test(){
        if(file_exists(APPROOT . '/views/components/profilePages/'. $_POST['type'] . '.html')) {
            echo json_encode(file_get_contents(APPROOT . '/views/components/profilePages/'. $_POST['type'] . '.html'));
        } else {
            echo false;
        }
    }
}