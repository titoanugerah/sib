<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier extends CI_Controller
{
    function __construct()
    {  
        parent::__construct();
        $this->load->model('core_model');
        $this->load->model('supplier_model');
    }

    function index()
    {
        $this->load->view('template', $this->supplier_model->contentSupplier());
    }

    public function read()
    {
      echo $this->supplier_model->read();
    }

    public function readDetail()
    {
      echo $this->supplier_model->readDetail();
    }
  
    public function recover()
    {
      echo $this->supplier_model->recover();
    }
  
    public function create()
    {
      echo $this->supplier_model->create();
    }
  
    public function update()
    {
      echo $this->supplier_model->update();
    }
  
    public function delete()
    {
      echo $this->supplier_model->delete();
    }
}
