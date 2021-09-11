<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock_model extends CI_Model
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('core_model');
  }

  public function content()
  {
    if ($this->session->userdata['role'] == "admin")
    {
      $data['viewName'] = 'stock';
      return $data;
    }
    else
    {
      notify("Tidak Ada Akses", "Mohon maaf anda tidak memiliki hak akses untuk dapat mengakses halaman ini, silahkan hubungi IT Admin atau Super Admin", "danger", "fas fa-ban", "dashboard" );
    }
  }

  public function create()
  {
    if ($this->session->userdata('role')=="admin") {
      $input = $this->input->post();
      $input['adminId'] = $this->session->userdata('id');
      $result = $this->core_model->createData('stock',  $input);
      return json_encode($result);
    }
    
  }
  public function read()
  {
    $data['stock'] = $this->core_model->readAllData('viewStock');
    return json_encode($data);
  }

  public function readDetail()
  {
    $data['detail'] = $this->core_model->readSingleData('viewStock', 'id', $this->input->post('id'));
    $data['history'] = $this->core_model->readSomedata('viewStockHistory', 'itemId', $this->input->post('id'));
    return json_encode($data);
  }

  public function update()
  {
    if ($this->session->userdata('role')=="admin") {
      return json_encode($this->core_model->updateDataBatch('stock',  'id', $this->input->post('id'), $this->input->post()));
    }
    
  }

  public function recover()
  {
    if ($this->session->userdata('role')=="admin") {
      return json_encode($this->core_model->recoverData('stock', 'id', $this->input->post('id')));
    }
  }

  public function delete()
  {
    if ($this->session->userdata('role')=="admin") {
      return json_encode($this->core_model->deleteData('stock', 'id', $this->input->post('id')));
    }    
  }

}

?>
