<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction_model extends CI_Model
{

  function __construct()
  {
    parent::__construct();
  }

  public function content()
  {
    if ($this->session->userdata['role'] == "cashier")
    {
      $data['viewName'] = 'transaction';
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
      $result = $this->core_model->createData('transaction',  $input);
      return json_encode($result);
    }
    
  }
  public function read()
  {
    $data['transaction'] = $this->core_model->readAllData('transaction');
    return json_encode($data);
  }

  public function readDetail()
  {
    $data['detail'] = $this->core_model->readSingleData('transaction', 'id', $this->input->post('id'));
    return json_encode($data);
  }

  public function update()
  {
    if ($this->session->userdata('role')=="admin") {
      return json_encode($this->core_model->updateDataBatch('transaction',  'id', $this->input->post('id'), $this->input->post()));
    }
    
  }

  public function recover()
  {
    if ($this->session->userdata('role')=="admin") {
      return json_encode($this->core_model->recoverData('transaction', 'id', $this->input->post('id')));
    }
  }

  public function delete()
  {
    if ($this->session->userdata('role')=="admin") {
      return json_encode($this->core_model->deleteData('transaction', 'id', $this->input->post('id')));
    }
    
  }

}

?>
