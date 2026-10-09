<?php

require 'Model.php';
require 'View.php';

class UserController {
    private UserModel $model;
    private UserView $view;

    public function __construct() {
        $this->model = new UserModel();
        $this->view  = new UserView();
    }

   
    public function showUsers(): void {
        $users = $this->model->getAllUsers();
        $this->view->render($users);
    }
}