<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller{

    function __construct()
    {
        parent::__construct();
        $this->load->model('profile_model');        
    }

    function index()
    {
        $this->load->view('template', $this->profile_model->content());  
    }

}