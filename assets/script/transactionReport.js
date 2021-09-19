$(document).ready(function(){
  $('#example').DataTable( {
    "dom": 'Bfrtip',
    "buttons": [
        'copy', 'csv', 'excel', 'pdf', 'print'
    ],
    "order" : [[0, "desc"]],
    "ajax": '/sib/api/transaction/read/datatables',
    "columns": [
      { "data": "id" },
      { "data": "date" },
      { "data": "customer" },
      {
        "render": function (data, type, row) {
            if(row.status == 1){
              return "Menunggu antrian";
            } else if(row.status == 2){
              return "Sedang diproses";
            } else if(row.status == 3){
              return "Selesai";
            } else {
              return row.id;
            }
        }
      },
      { "data": "subtotal" },
      { "data": "cashier" },
      {
        "render": function (data, type, row) {
            return "<button type='button' class='btn btn-info' onclick=detailTransactionForm('" + row.id + "'); >Detail</button>";
        }
      },
    ]
  });

  $('.select2modal').select2({
      dropdownParent: $('#detailSupplierModal')
  });
  $('.select2addmodal').select2({
      dropdownParent: $('#addSupplierModal')
  });
});


function detailTransactionForm(id) {
  
  $("#detailTransactionModal").modal('show');
  $("#btnTransaction").hide();
  $("#btnFinish").show();
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
       id : id,
    },
    url: "/sib/api/transaction/readOrderDetail",
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

function unauthorized() {
  notify('fas fa-user', 'Tidak diijinkan', 'Anda tidak memiliki hak akses untuk mengedit kolom ini', 'danger');
}
