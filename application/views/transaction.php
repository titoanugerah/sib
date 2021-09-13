<div class="panel-header bg-danger-gradient">
  <div class="page-inner py-5">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
      <div>
        <h2 class="text-white pb-2 fw-bold" >Transaksi</h2>
      </div>
      <div class="ml-md-auto py-2 py-md-0">
        <a href="#" class="btn btn-white btn-border btn-round mr-2" hidden>Manage</a>
        <button type="button" class="btn btn-white btn-border btn-round mr-2" onclick="addNewTransactionForm()">Tambah Transaksi Baru</button>
      </div>
    </div>
  </div>
</div>

<div class="page-inner mt--5" >
  <div class="row mt--2" id="transactionList">

  </div>
</div>


<div class="modal fade" id="addTransactionModal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <center>
          <h4>Tambah Transaksi</h4>
        </center>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <ul class="wizard-menu nav nav-pills nav-primary">
          <li class="step" style="width: 33%;">
            <a class="nav-link active" href="#addNewCustomerTab" data-toggle="tab" aria-expanded="true"> Pelanggan Baru</a>
          </li>
          <li class="step" style="width: 33%;">
            <a class="nav-link" href="#addOldCustomerTab" data-toggle="tab" aria-expanded="true"> Pelanggan Lama</a>
          </li>
          <li class="step" style="width: 33%;">
            <a class="nav-link" href="#recoverTab" data-toggle="tab"> Pulihkan </a>
          </li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane active" id="addNewCustomerTab">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Nama Pelanggan</label>
                  <input type="text" class="form-control" id="addName" required>
                </div>
              </div>              
              <div class="col-md-6">
                <div class="form-group">
                  <label>Email</label>
                  <input type="text" class="form-control" id="addEmail" required>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label>Catatan</label>
                  <textarea type="text" class="form-control" id="addRemark1" required></textarea>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" onclick="addTransactionNewCustomer()">Simpan</button>
              <button type="button" data-dismiss="modal" class="btn btn-secondary">Kembali</button>
            </div>
          </div>
          <div class="tab-pane" id="addOldCustomerTab">
          <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Nama Pelanggan</label>
                  <select class="form-control select2addmodal" id="addCustomerId" style="width:360px">

                  </select>
                </div> 
              </div>
              <div class="col-md-12">
                  <div class="form-group">
                    <label>Catatan</label>
                    <textarea type="text" class="form-control" id="addRemark2" required></textarea>
                  </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" onclick="addTransactionOldCustomer()">Simpan</button>
              <button type="button" data-dismiss="modal" class="btn btn-secondary">Kembali</button>
            </div>
          </div>
          <div class="tab-pane" id="recoverTab">
            <div class="form-group">
              <label>Nama Transaksi</label>
              &nbsp;&nbsp;&nbsp;&nbsp;
              <select class="form-control select2addmodal" id="recoverTransactionId" style="width:360px">

              </select>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" onclick="recoverTransaction()">Pulihkan</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="detailTransactionModal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <center>
          <h4>Detail Transaksi</h4>
        </center>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">        
      <ul class="wizard-menu nav nav-pills nav-primary">
          <li class="step" style="width: 50%;">
            <a class="nav-link active" href="#detailTab" data-toggle="tab" aria-expanded="true"> Detail</a>
          </li>
          <li class="step" style="width: 50%;">
            <a class="nav-link" href="#orderListTab" data-toggle="tab" aria-expanded="true"> Nota</a>
          </li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane active" id="detailTab">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Nama Pelanggan</label>
                  <input type="text" class="form-control" id="editCustomerName" readonly>
                  <input type="text" class="form-control" id="editId" hidden>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Tanggal</label>
                  <input type="text" class="form-control" id="editDate" readonly>
                </div>
              </div>
            
              <div class="col-md-12">
                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea type="text" class="form-control" id="editRemark" ></textarea>
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane" id="orderListTab">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Layanan</label>
                  <select class="form-control select2modal" id="addItemId" style="width:210px">

                </select>
                </div>
              </div>  
              <div class="col-md-3" style="padding-left: 0px;">
                <div class="form-group">
                  <label>Jumlah</label>
                  <input type="number" id="addQty" class="form-control" value="1">
                </div>
              </div>
              <div class="col-md-2" style="padding-left: 0px;">
                <div class="form-group" >
                  <label> </label>
                  <button class="btn btn-primary" onclick="addOrderDetail()">Tambah</button>  
                </div>
              </div>            
            </div>
            <div class="row" style="height:250px; overflow-y:scroll" >
              <table class="table table-striped mt-3">
                <thead>
                  <tr>
                    <th scope="col">Nama</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Total</th>
                    <th scope="col">Opsi</th>
                  </tr>
                </thead>
                <tbody id="orderList">

                </tbody>
              </table>
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-danger" onclick="deleteTransaction()">Hapus</button>
          <button type="button" class="btn btn-warning" onclick="processTransaction()">Proses Transaksi</button>
          <button type="button" class="btn btn-primary" onclick="updateTransaction()">Simpan</button>
          <button type="button" data-dismiss="modal" class="btn btn-secondary">Kembali</button>
        </div>
      </div>        
    </div>
  </div>
</div>
