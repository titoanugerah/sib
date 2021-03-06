<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('core_model');
    $this->load->model('transaction_model');
  }

  public function index()
  {
    $this->load->view('template', $this->transaction_model->content());
  }

  public function report()
  {
    $this->load->view('template', $this->transaction_model->contentReport());
  }
  #API
  public function read()
  {
    echo $this->transaction_model->read();
  }

  public function datatables()
  {
    echo $this->transaction_model->datatables();
  }

  public function readDetail()
  {
    echo $this->transaction_model->readDetail();
  }

  public function createOrder()
  {
    echo $this->transaction_model->createOrder();
  }

  public function readOrderDetail()
  {
    echo $this->transaction_model->readOrderDetail();
  }

  public function recover()
  {
    echo $this->transaction_model->recover();
  }

  public function createNew()
  {
    echo $this->transaction_model->createNew();
  }

  public function createOld()
  {
    echo $this->transaction_model->createOld();
  }

  public function update()
  {
    echo $this->transaction_model->update();
  }

  public function delete()
  {
    echo $this->transaction_model->delete();
  }

  public function deleteOrder()
  {
    echo $this->transaction_model->deleteOrder();
  }

}

 ?>
