<?php

class Controller {
    public function model($model) {
        require_once(APPROOT . '/models/' . $model . '.php');
        return new $model();
    }

    public function view($view, $data = []) {
        if (file_exists('../app/views/' . $view . '.php')) {
            require_once('../app/views/'. $view . '.php');
        } else {
            die('View not available');
        }
    }
}