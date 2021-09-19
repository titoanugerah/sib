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
  public function contentReport()
  {
    $data['viewName'] = 'transactionReport';
    return $data;
  }

  public function datatables()
  {
    $data['draw'] = 1;
    $data['recordsTotal'] = 57;
    $data['recordsFilterd'] = 57;
    if($this->session->userdata('role')=="customer")
    {
      $data['data'] = $this->core_model->readSomeData('viewTransaction', 'customerId', $this->session->userdata('id'));
    }
    else 
    {
      $data['data'] = $this->core_model->readAllData('viewTransaction');
    }
    return json_encode($data);
  }

  public function createNew()
  {
    if ($this->session->userdata('role')=="cashier") {
      if($this->core_model->getNumRows('user', 'email' ,$this->input->post('email'))== 0)
      {        
        $newUser = array(
          'email' => $this->input->post('email'),
          'name' => $this->input->post('name'),
        );
        $this->core_model->createData('user', $newUser);
      }
      $user = $this->core_model->readSingleData('user', 'email' ,$this->input->post('email'));
      $input = array(
        'cashierId' => $this->session->userdata('id'),
        'customerId' => $user->id,
        'date' => date("Y-m-d")
      );
      $result = $this->core_model->createData('transaction', $input);
      return json_encode($result);
    }
  }

  public function readOrderDetail()
  {
    $result['detail'] = $this->core_model->readSingleData('viewTransactionDetail', 'id', $this->input->post('id'));
    $result['order'] = $this->core_model->readSomeData('viewDetailTransaction', 'transactionId', $this->input->post('id'));
    return json_encode($result);
  }

  public function createOrder()
  {
    $input = $this->input->post();
    $input["price"] = ($this->core_model->readSingleData('item', 'id', $input['itemId']))->price;
    $input["total"] = $input['price'] * $input['qty'];
    $result = $this->core_model->createData('detailtransaction', $input );
    return json_encode($result);
  }

  public function createOld()
  {
    if ($this->session->userdata('role')=="cashier") {
      $input = $this->input->post();
      $input['cashierId'] = $this->session->userdata('id');
      $input['date'] = date("Y-m-d");
      $result = $this->core_model->createData('transaction',  $input);
      return json_encode($result);
    }
  }

  public function read()
  {
    $data['transaction'] = $this->core_model->readAllData('viewTransaction');
    return json_encode($data);
  }

  public function readDetail()
  {
    $data['detail'] = $this->core_model->readSingleData('viewTransaction', 'id', $this->input->post('id'));
    return json_encode($data);
  }

  public function update()
  {
    if ($this->session->userdata('role')=="cashier") 
    {
      if($this->input->post('status')==3)
      {
        $transactionDetail = $this->core_model->readSomeData('viewDetailTransaction', 'transactionId', $this->input->post('id'));
        foreach ($transactionDetail as $transactionDetail) {
          if($transactionDetail->categoryId == 2)
          {
            $stock = array(
              'itemId' => $transactionDetail->itemId,
              'qty' => $transactionDetail->qty,
              'stockTypeId' => -3,
              'adminId' => $this->session->userdata('id') 
            );
            $this->core_model->createData('stock', $stock);
          }
        }
        
      }
      return json_encode($this->core_model->updateDataBatch('transaction',  'id', $this->input->post('id'), $this->input->post()));
    }

  }

  public function recover()
  {
    if ($this->session->userdata('role')=="cashier") {
      return json_encode($this->core_model->recoverData('transaction', 'id', $this->input->post('id')));
    }
  }

  public function delete()
  {
    if ($this->session->userdata('role')=="cashier") {
      return json_encode($this->core_model->deleteData('transaction', 'id', $this->input->post('id')));
    }
  }

  public function deleteOrder()
  {
    if ($this->session->userdata('role')=="cashier") {
      return json_encode($this->core_model->deleteData('detailtransaction', 'id', $this->input->post('id')));
    }
  }

}

?>
