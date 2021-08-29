<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Item extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('core_model');
    $this->load->model('item_model');
  }

  public function index(){
    $this->load->view('template', $this->item_model->content());
  }


  #API
  public function read()
  {
    echo $this->item_model->read();
  }

  public function readDetail()
  {
    echo $this->item_model->readDetail();
  }

  public function recover()
  {
    echo $this->item_model->recover();
  }

  public function create()
  {
    echo $this->item_model->create();
  }

  public function update()
  {
    echo $this->item_model->update();
  }

  public function delete()
  {
    echo $this->item_model->delete();
  }

}

 ?>
