<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Service_model extends CI_Model
{

  function __construct()
  {
    parent::__construct();
  }

  public function content()
  {
    if ($this->session->userdata['role'] == "admin")
    {
      $data['viewName'] = 'service';
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
      $input['categoryId'] = $this->config->item('category_service_id');
      $result = $this->core_model->createData('item',  $input);
      return json_encode($result);
    }
    
  }
  public function read()
  {
    $data['service'] = $this->core_model->readSomeData('item', 'categoryId', $this->config->item('category_service_id'));
    return json_encode($data);
  }

  public function readDetail()
  {
    $data['detail'] = $this->core_model->readSingleData('item', 'id', $this->input->post('id'));
    return json_encode($data);
  }

  public function update()
  {
    if ($this->session->userdata('role')=="admin") {
      return json_encode($this->core_model->updateDataBatch('item',  'id', $this->input->post('id'), $this->input->post()));
    }
    
  }

  public function recover()
  {
    if ($this->session->userdata('role')=="admin") {
      return json_encode($this->core_model->recoverData('item', 'id', $this->input->post('id')));
    }
  }

  public function delete()
  {
    if ($this->session->userdata('role')=="admin") {
      return json_encode($this->core_model->deleteData('item', 'id', $this->input->post('id')));
    }
    
  }

}

?>
