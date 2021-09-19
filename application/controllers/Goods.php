<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Goods extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('core_model');
    $this->load->model('goods_model');
  }

  public function index(){
    $this->load->view('template', $this->goods_model->content());
  }


  #API
  public function read()
  {
    echo $this->goods_model->read();
  }

  public function readDetail()
  {
    echo $this->goods_model->readDetail();
  }

  public function recover()
  {
    echo $this->goods_model->recover();
  }

  public function create()
  {
    echo $this->goods_model->create();
  }

  public function update()
  {
    echo $this->goods_model->update();
  }

  public function delete()
  {
    echo $this->goods_model->delete();
  }

}

 ?>
