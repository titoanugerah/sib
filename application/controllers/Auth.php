<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller{

    function __construct()
    {
        parent::__construct();
        $this->load->model('auth_model');        
    }

    function login()
    {
        $this->auth_model->login(); 
    }

    function validate()
    {
        $this->auth_model->validate(); 
    }

    public function Logout()
    {
        $this->auth_model->logout();
    }
}