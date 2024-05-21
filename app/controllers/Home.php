<?php
Class Home extends controller 
{

    public function __construct() {

    }
    
    public function index() {

        $this->view('Home/Index');
    }
}