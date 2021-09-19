$(document).ready(function(){
  $('.select2modal').select2({
      dropdownParent: $('#detailGoodsModal')
  });
  $('.select2addmodal').select2({
      dropdownParent: $('#addGoodsModal')
  });
  getGoods();
  getSupplier();  
});

function detailGoodsForm(id) {
  $("#detailGoodsModal").modal('show');
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
       id : id,
    },
    url: "api/goods/readDetail",
    success: function(result) {
      $('#editId').val(result.detail.id);
      $('#editName').val(result.detail.name);
      $('#editRemark').val(result.detail.remark);
      $('#editSupplierId').val(result.detail.supplierId).change();
      $('#editPrice').val(result.detail.price);
    },
    error: function(result) {
      console.log(result);
      notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');
    }
  });

}

$("#keyword").on('change', function(){
  getGoods();
  $("#keyword").val();
})

function updateGoods(){
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
       id : $("#editId").val(),
       name : $("#editName").val(),
       price : $("#editPrice").val(),
       supplierId : $("#editSupplierId").val(),       
       remark : $("#editRemark").val(),       
    },
    url: "api/goods/update",
    success: function(result) {
      $("#detailGoodsModal").modal('hide');
      getGoods();
      notify('fas fa-check', 'Berhasil', result.content, 'success');
    },
    error: function(result) {
      notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');
    }
  });
}

function addNewGoodsForm() {
  $('#keyword').val("");
  getGoods();
  $("#addGoodsModal").modal('show');
}

function addGoods() {
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
       name : $("#addName").val(),
       price : $("#addPrice").val(),
       supplierId : $("#addSupplierId").val(),       
       remark : $("#addRemark").val(),       
    },
    url: "api/goods/create",
    success: function(result) {
      $("#addGoodsModal").modal('hide');
      notify('fas fa-check', 'Berhasil', result.content, 'success');
      getGoods();
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

function  getGoods(){
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
       keyword : $("#keyword").val(),
    },
    url: "api/goods/read",
    success: function(result) {
      var html = "";
     var html1 = '<option value="0"> Silahkan pilih </option>';
      result.goods.forEach(goods => {
        if(goods.isExist == 1){
          html = html +         
          '<div class="col-sm-6 col-md-3" onclick="detailGoodsForm('+goods.id+')">' +
            '<div class="card card-stats card-info card-round">' +
                '<div class="card-body">' +
                  '<div class="row">' +
                    '<div class="col-5">' +
                      '<div class="icon-big text-center">' +
                        '<i class="flaticon-user-5"></i>' +
                      '</div>' +
                    '</div>' +
                    '<div class="col-7 col-stats">' +
                      '<div class="numbers">' +
                        '<p class="card-goods"> Goods </p>' +
                        '<h4 class="card-title">' + uppercase(goods.name) +'</h4>' +
                      '</div>' +
                    '</div>' +
                  '</div>' +
                '</div>' +
              '</div>' +
            '</div>';             
        } else {
          html1 = html1 +
           '<option value="'+goods.id+'"> '+uppercase(goods.name)+' </option>';
        }
      });

      $('#goodsList').html(html);
      $('#recoverGoodsId').html(html1);
      console.log(html);
 
    },
    error: function(result) {
      console.log(result);
      notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');
    }
  });
}

function getSupplier(){
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
       keyword : $("#keyword").val(),
    },
    url: "api/supplier/read",
    success: function(result) {
      console.log(result);
      var html1 = '<option value="0"> Silahkan pilih </option>';
      result.supplier.forEach(supplier => {
        html1 = html1 +
        '<option value="'+supplier.id+'"> '+uppercase(supplier.name)+' </option>';
      });
      $('#addSupplierId').html(html1);
      $('#editSupplierId').html(html1);
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

function deleteGoods() {
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
       id : $("#editId").val(),
    },
    url: "api/goods/delete",
    success: function(result) {
      $("#detailGoodsModal").modal('hide');
      notify('fas fa-check', 'Berhasil', result.content, 'success');
      getGoods();
    },
    error: function(result) {
      console.log(result);
       notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');
    }
  });
}

function recoverGoods() {
  if($('#recoverGoodsId').val()!=0)
  {
    $.ajax({
      type: "POST",
      dataType : "JSON",
      data : {
        id : $("#recoverGoodsId").val(),
      },
      url: "api/goods/recover",
      success: function(result) {
        $("#addGoodsModal").modal('hide');
        notify('fas fa-check', 'Berhasil', result.content, 'success');
        getGoods();
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
