<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('stock_model');
  }

  public function index()
  {
    $this->load->view('template', $this->stock_model->content());
  }

  public function report()
  {
    $this->load->view('template', $this->stock_model->contentReport());
  }

  #API
  public function read()
  {
    echo $this->stock_model->read();
  }

  public function datatables()
  {
    echo $this->stock_model->datatables();
  }

  public function readDetail()
  {
    echo $this->stock_model->readDetail();
  }

  public function create()
  {
    echo $this->stock_model->create();
  }

}

 ?>
