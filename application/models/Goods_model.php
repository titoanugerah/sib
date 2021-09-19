<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Goods_model extends CI_Model
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
      $data['viewName'] = 'goods';
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
      $input['categoryId'] = $this->config->item('category_goods_id');
      $result = $this->core_model->createData('item',  $input);
      $data = array(
        'itemId' => $this->db->insert_id(),
        'stockTypeId' => 0,
        'qty' => 0,      
        'adminId' => $this->session->userdata('id')
      );
      $result = $this->core_model->createData('stock',  $data);
      return json_encode($result);
    }
    
  }
  public function read()
  {
    $data['goods'] = $this->core_model->readSomeData('item', 'categoryId', $this->config->item('category_goods_id'));
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
