<?php
class User extends controller
{
    public function __construct(){
        session_start();
    }

    public function profile(){

        $this->view("user/profile");
    }

    // this function is used to dynamically load pages into profile while keeping server side safe.
    public function test(){
        if(file_exists(APPROOT . '/views/components/profilePages/'. $_POST['type'] . '.html')) {
            echo json_encode(file_get_contents(APPROOT . '/views/components/profilePages/'. $_POST['type'] . '.html'));
        } else {
            echo false;
        }
    }
}