<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Service extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('core_model');
    $this->load->model('service_model');
  }

  public function index(){
    $this->load->view('template', $this->service_model->content());
  }


  #API
  public function read()
  {
    echo $this->service_model->read();
  }

  public function readDetail()
  {
    echo $this->service_model->readDetail();
  }

  public function recover()
  {
    echo $this->service_model->recover();
  }

  public function create()
  {
    echo $this->service_model->create();
  }

  public function update()
  {
    echo $this->service_model->update();
  }

  public function delete()
  {
    echo $this->service_model->delete();
  }

}

 ?>
