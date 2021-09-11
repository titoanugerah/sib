<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('stock_model');
  }

  public function index(){
    $this->load->view('template', $this->stock_model->content());
  }


  #API
  public function read()
  {
    echo $this->stock_model->read();
  }

  public function readDetail()
  {
    echo $this->stock_model->readDetail();
  }

  public function recover()
  {
    echo $this->stock_model->recover();
  }

  public function create()
  {
    echo $this->stock_model->create();
  }

  public function update()
  {
    echo $this->stock_model->update();
  }

  public function delete()
  {
    echo $this->stock_model->delete();
  }

}

 ?>
