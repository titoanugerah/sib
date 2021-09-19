$(document).ready(function(){
  $('.select2modal').select2({
      dropdownParent: $('#detailTransactionModal')
  });
  $('.select2addmodal').select2({
      dropdownParent: $('#addTransactionModal')
  });
  getTransaction();
  getCustomer();
  getItem();
});

function detailTransactionForm(id) {
  $("#detailTransactionModal").modal('show');
  $("#btnTransaction").show();
  $("#btnFinish").hide();

  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
       id : id,
    },
    url: "api/transaction/readDetail",
    success: function(result) {
      var html= "";
      $('#editId').val(result.detail.id);
      $('#editCustomerName').val(result.detail.customer);
      $('#editRemark').val(result.detail.remark);
      $('#editPrice').val(result.detail.price);
      $('#editDate').val(result.detail.date);

    },
    error: function(result) {
      console.log(result);
      notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');
    }
  });
}


function detailTransactionForm2(id) {
  
  $("#detailTransactionModal").modal('show');
  $("#btnTransaction").hide();
  $("#btnFinish").show();
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
       id : id,
    },
    url: "api/transaction/readOrderDetail",
    success: function(result) {
      var html="";
      console.log(result);
      $('#editId').val(result.detail.id);
      $('#editCustomerName').val(result.detail.customer);
      $('#editRemark').val(result.detail.remark);
      $('#editDate').val(result.detail.date);
      result.order.forEach(order => {
        if(order.isExist == 1)
        {
          html =  "<tr><td>"+order.item+"</td><td>"+order.qty+"</td><td>"+order.price+"</td><td>"+order.total+"</td><td><button class='btn btn-danger' onclick='deleteOrder("+order.id+")'>Hapus</button></td></tr>" + html;
        }
      });
      $("#orderList").html(html);

    },
    error: function(result) {
      console.log(result);
      notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');
    }
  });
}

$("#keyword").on('change', function(){
  getTransaction();
  $("#keyword").val();
})

function updateTransaction(){
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
       id : $("#editId").val(),
       date : $("#editDate").val(),
       remark : $("#editRemark").val(),       
    },
    url: "api/transaction/update",
    success: function(result) {
      $("#detailTransactionModal").modal('hide');
      getTransaction();
      notify('fas fa-check', 'Berhasil', result.content, 'success');
    },
    error: function(result) {
      notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');
    }
  });
}

function addNewTransactionForm() {
  $('#keyword').val("");
  getTransaction();
  $("#addTransactionModal").modal('show');
}

function addTransactionNewCustomer() {
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
       name : $("#addName").val(),
       email : $("#addEmail").val(),
       remark : $("#addRemark1").val(),       
    },
    url: "api/transaction/create/new",
    success: function(result) {
      $("#addTransactionModal").modal('hide');
      notify('fas fa-check', 'Berhasil', result.content, 'success');
      getTransaction();
    },
    error: function(result) {
      console.log(result);
      notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');
    }
  });
}

function addTransactionOldCustomer() {
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
       customerId : $("#addCustomerId").val(),
       remark : $("#addRemark2").val(),       
    },
    url: "api/transaction/create/old",
    success: function(result) {
      console.log(result);
      $("#addTransactionModal").modal('hide');
      notify('fas fa-check', 'Berhasil', result.content, 'success');
      getTransaction();
    },
    error: function(result) {
      console.log(result);
      notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');
    }
  });
}

function getCustomer(){
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
       keyword : "customer",
    },
    url: "api/user/read",
    success: function(result) {
      console.log(result);
      var html1 = '<option value="0"> Silahkan pilih </option>';
      result.user.forEach(customer => {
        html1 = html1 +
        '<option value="'+customer.id+'"> '+uppercase(customer.name)+' </option>';
      });
      $('#addCustomerId').html(html1);
    },
    error: function(result) {
      console.log(result);
      notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');
    }
  });
}

function getItem(){
  var html1 = '<option value="0"> Silahkan pilih </option>';
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
       keyword : "",
    },
    url: "api/goods/read",
    success: function(result) {
      console.log(result);
      result.goods.forEach(goods => {
        html1 = html1 +
        '<option value="'+goods.id+'"> '+uppercase("Pembelian " + goods.name)+' </option>';
      });
    },
    error: function(result) {
      console.log(result);
      notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');
    }
  });
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
       keyword : "",
    },
    url: "api/service/read",
    success: function(result) {
      console.log(result);
      result.service.forEach(service => {
        html1 = html1 +
        '<option value="'+service.id+'"> '+uppercase("Layanan " + service.name)+' </option>';
      });
      $('#addItemId').html(html1);

    },
    error: function(result) {
      console.log(result);
      notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');
    }
  });
}

function addOrderDetail(){
  var transactionId = $('#editId').val();
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
       itemId : $("#addItemId").val(),
       qty : $("#addQty").val(),      
       transactionId : transactionId 
    },
    url: "api/transaction/create/order",
    success: function(result) {
      console.log(result);
      notify('fas fa-check', 'Berhasil', result.content, 'success');
      detailTransactionForm2(transactionId);
    },
    error: function(result) {
      console.log(result);
      notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');
    }
  });
}


function getErrorMsg(result){
  var responseInArray = result.split('\n');
  for(var i=0; i < responseInArray.length; i++) {
    responseInArray[i] = responseInArray[i].replace(/ +(?= )/g,'');
    responseInArray[i] = responseInArray[i].replace('\t','');
    responseInArray[i] = responseInArray[i].replace('\t','');
    responseInArray[i] = responseInArray[i].replace('<h1>','');
    responseInArray[i] = responseInArray[i].replace('</h1>','');
    responseInArray[i] = responseInArray[i].replace('<div>','');
    responseInArray[i] = responseInArray[i].replace('</div>','');
    responseInArray[i] = responseInArray[i].replace('<p>','');
    responseInArray[i] = responseInArray[i].replace('</p>','');
    responseInArray[i] = responseInArray[i].replace('<p>','');
    responseInArray[i] = responseInArray[i].replace('</p>','');
    responseInArray[i] = responseInArray[i].replace('<p>','');
    responseInArray[i] = responseInArray[i].replace('</p>','');
    responseInArray[i] = responseInArray[i].replace('<p>','');
    responseInArray[i] = responseInArray[i].replace('</p>','');
    responseInArray[i] = responseInArray[i].replace('<p>','');
    responseInArray[i] = responseInArray[i].replace('</p>','');
   }

   var error = responseInArray.filter(x => (x.includes("Message")));
   if(error.length == 0){
     error = responseInArray.filter(x => (x.includes("Error ")));
   }
  return error.toString();  
}

function getTransaction(){
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
       keyword : $("#keyword").val(),
    },
    url: "api/transaction/read",
    success: function(result) {
      var html = "";
      var color = "info";
      var status = "Checkin";
      var form = "detailTransactionForm";
     var html1 = '<option value="0"> Silahkan pilih </option>';
      result.transaction.forEach(transaction => {
        if(transaction.isExist == 1){
          if(transaction.status == 1)
          {
             form = "detailTransactionForm";
             color = "info";
             status = "Menunggu giliran";
            
          }
          else if(transaction.status == 2)
          {
            form = "detailTransactionForm2";
            color = "warning";
            status = "Diproses";
          }
          else if(transaction.status == 3)
          {
            form = "history";
            color = "success";
            status = "Selesai";
          }          

          html = html +         
          '<div class="col-sm-6 col-md-4" onclick="'+form+'('+transaction.id+')">' +
            '<div class="card card-stats card-'+color+' card-round">' +
                '<div class="card-body">' +
                  '<div class="row">' + 
                    '<div class="col-12 col-stats">' +
                      '<div class="numbers">' +
                        '<p class="card-transaction"> '+status+' </p>' +
                        '<h4 class="card-title">' + uppercase(transaction.customer) +'</h4>' +
                      '</div>' +
                    '</div>' +
                  '</div>' +
                '</div>' +
              '</div>' +
            '</div>';             
        } else {
          html1 = html1 +
           '<option value="'+transaction.id+'"> '+uppercase(transaction.customer)+' </option>';
        }
      });

      $('#transactionList').html(html);
      $('#recoverTransactionId').html(html1);
    },
    error: function(result) {
      console.log(result);
      notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');
    }
  });
}

function uppercase(string){
  return string.charAt(0).toUpperCase() + string.slice(1);
}

function deleteTransaction() {
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
       id : $("#editId").val(),
    },
    url: "api/transaction/delete",
    success: function(result) {
      $("#detailTransactionModal").modal('hide');
      notify('fas fa-check', 'Berhasil', result.content, 'success');
      getTransaction();
    },
    error: function(result) {
      console.log(result);
       notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');
    }
  });
}

function deleteOrder(id) {
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
       id : id,
    },
    url: "api/transaction/delete/order",
    success: function(result) {
      notify('fas fa-check', 'Sukses', "Data berhasil terhapus", 'success');
      detailTransactionForm2($("#editId").val());

    },
    error: function(result) {
      console.log(result);
       notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');
    }
  });
}

function processTransaction() {
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
       id : $("#editId").val(),
       status : 2
    },
    url: "api/transaction/update",
    success: function(result) {
      $("#detailTransactionModal").modal('hide');
      notify('fas fa-check', 'Berhasil', result.content, 'success');
      getTransaction();
    },
    error: function(result) {
      console.log(result);
       notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');
    }
  });
}

function finishTransaction() {
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
       id : $("#editId").val(),
       status : 3
    },
    url: "api/transaction/update",
    success: function(result) {
      $("#detailTransactionModal").modal('hide');
      notify('fas fa-check', 'Berhasil', result.content, 'success');
      getTransaction();
    },
    error: function(result) {
      console.log(result);
       notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');
    }
  });
}

function recoverTransaction() {
  if($('#recoverTransactionId').val()!=0)
  {
    $.ajax({
      type: "POST",
      dataType : "JSON",
      data : {
        id : $("#recoverTransactionId").val(),
      },
      url: "api/transaction/recover",
      success: function(result) {
        $("#addTransactionModal").modal('hide');
        notify('fas fa-check', 'Berhasil', result.content, 'success');
        getTransaction();
      },
      error: function(result) {
        notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');
      }
    });

  } else {
    notify('fas fa-bell', 'Gagal', 'Mohon pilih dengan benar', 'danger');
  }
}



function unauthorized() {
  notify('fas fa-user', 'Tidak diijinkan', 'Anda tidak memiliki hak akses untuk mengedit kolom ini', 'danger');
}
