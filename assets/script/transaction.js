$(document).ready(function(){
  $('.select2modal').select2({
      dropdownParent: $('#detailTransactionModal')
  });
  $('.select2addmodal').select2({
      dropdownParent: $('#addTransactionModal')
  });
  getTransaction();
  getCustomer();
});

function detailTransactionForm(id) {
  $("#detailTransactionModal").modal('show');
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
       id : id,
    },
    url: "api/transaction/readDetail",
    success: function(result) {
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
      var form = "detailTransactionForm";
     var html1 = '<option value="0"> Silahkan pilih </option>';
      result.transaction.forEach(transaction => {
        if(transaction.isExist == 1){
          if(transaction.status == 1)
          {
             color = "info"
          }
          else if(transaction.status == 2)
          {
            color = "warning"
          }
          else if(transaction.status == 3)
          {
            color = "success"
          }          
          else if(transaction.status == 4)
          {
            color = "danger"
          }

          html = html +         
          '<div class="col-sm-6 col-md-4" onclick="detailTransactionForm('+transaction.id+')">' +
            '<div class="card card-stats card-'+color+' card-round">' +
                '<div class="card-body">' +
                  '<div class="row">' + 
                    '<div class="col-12 col-stats">' +
                      '<div class="numbers">' +
                        '<p class="card-transaction"> Transaction </p>' +
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
