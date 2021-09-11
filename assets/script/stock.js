$(document).ready(function(){
  $('.select2modal').select2({
      dropdownParent: $('#detailStockModal')
  });
  $('.select2addmodal').select2({
      dropdownParent: $('#addStockModal')
  });
  getStock();
});

function detailStockForm(id) {
  $("#detailStockModal").modal('show');
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
       id : id,
    },
    url: "api/stock/readDetail",
    success: function(result) {
      var html = "";
      $('#editId').val(result.detail.id);
      $('#editName').val(result.detail.name);
      $('#editStock').val(result.detail.stock);
      result.history.forEach(history => {
        html =  "<tr><td>"+history.date+"</td><td>"+history.qty+"</td><td>"+history.stockType+"</td><td>"+history.admin+"</td></tr>" + html;
      });

      $("#stockHistory").html(html);
    },
    error: function(result) {
      console.log(result);
      notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');
    }
  });

}

$("#keyword").on('change', function(){
  getStock();
  $("#keyword").val();
})

function updateStock(){
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
       id : $("#editId").val(),
       name : $("#editName").val(),
       price : $("#editPrice").val(),
       remark : $("#editRemark").val(),       
    },
    url: "api/stock/update",
    success: function(result) {
      $("#detailStockModal").modal('hide');
      getStock();
      notify('fas fa-check', 'Berhasil', result.content, 'success');
    },
    error: function(result) {
      notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');
    }
  });
}

function addNewStockForm() {
  $('#keyword').val("");
  getStock();
  $("#addStockModal").modal('show');
}

function addStock() {
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
       name : $("#addName").val(),
       price : $("#addPrice").val(),
       remark : $("#addRemark").val(),       
    },
    url: "api/stock/create",
    success: function(result) {
      $("#addStockModal").modal('hide');
      notify('fas fa-check', 'Berhasil', result.content, 'success');
      getStock();
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

function  getStock(){
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
       keyword : $("#keyword").val(),
    },
    url: "api/stock/read",
    success: function(result) {
      var html = "";
     var html1 = '<option value="0"> Silahkan pilih </option>';
      result.stock.forEach(stock => {
        if(stock.isExist == 1){
          html = html +         
          '<div class="col-sm-6 col-md-3" onclick="detailStockForm('+stock.id+')">' +
            '<div class="card card-stats card-info card-round">' +
                '<div class="card-body">' +
                  '<div class="row">' +                    
                    '<div class="col-12 col-stats">' +
                      '<div class="numbers">' +
                        '<p class="card-stock"> ' + uppercase(stock.name) +' </p>' +
                        '<h4 class="card-title">' + stock.stock +' Buah </h4>' +
                      '</div>' +
                    '</div>' +
                  '</div>' +
                '</div>' +
              '</div>' +
            '</div>';             
        } else {
          html1 = html1 +
           '<option value="'+stock.id+'"> '+uppercase(stock.name)+' </option>';
        }
      });

      $('#stockList').html(html);
      $('#recoverStockId').html(html1);
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

function deleteStock() {
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
       id : $("#editId").val(),
    },
    url: "api/stock/delete",
    success: function(result) {
      $("#detailStockModal").modal('hide');
      notify('fas fa-check', 'Berhasil', result.content, 'success');
      getStock();
    },
    error: function(result) {
      console.log(result);
       notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');
    }
  });
}

function recoverStock() {
  if($('#recoverStockId').val()!=0)
  {
    $.ajax({
      type: "POST",
      dataType : "JSON",
      data : {
        id : $("#recoverStockId").val(),
      },
      url: "api/stock/recover",
      success: function(result) {
        $("#addStockModal").modal('hide');
        notify('fas fa-check', 'Berhasil', result.content, 'success');
        getStock();
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
