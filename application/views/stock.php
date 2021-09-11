<div class="panel-header bg-danger-gradient">
  <div class="page-inner py-5">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
      <div>
        <h2 class="text-white pb-2 fw-bold" >Stok Barang </h2>
      </div>
      <div class="ml-md-auto py-2 py-md-0">
        <a href="#" class="btn btn-white btn-border btn-round mr-2" hidden>Manage</a>
        <button type="button" class="btn btn-white btn-border btn-round mr-2" onclick="addNewStockForm()">Tambah Stok Baru</button>
      </div>
    </div>
  </div>
</div>

<div class="page-inner mt--5" >
  <div class="row mt--2" id="stockList">

  </div>
</div>


<div class="modal fade" id="addStockModal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <center>
          <h4>Tambah Stok</h4>
        </center>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <ul class="wizard-menu nav nav-pills nav-primary">
          <li class="step" style="width: 50%;">
            <a class="nav-link active" href="#addNewTab" data-toggle="tab" aria-expanded="true"><i class="fa fa-user-plus mr-0"></i> Tambah Baru</a>
          </li>
          <li class="step" style="width: 50%;">
            <a class="nav-link" href="#recoverTab" data-toggle="tab"><i class="fas fa-undo mr-2"></i> Pulihkan </a>
          </li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane active" id="addNewTab">

            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Nama Stok</label>
                  <input type="text" class="form-control" id="addName" required>
                </div>
              </div>
              
              <div class="col-md-12">
                <div class="form-group">
                  <label>Harga</label>
                  <input type="text" class="form-control" id="addPrice" required>
                </div>
              </div>              
              <div class="col-md-12">
                <div class="form-group">
                  <label>Deskripsi</label>
                  <textarea type="text" class="form-control" id="addRemark" ></textarea>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" onclick="addStock()">Simpan</button>
              <button type="button" data-dismiss="modal" class="btn btn-secondary">Kembali</button>
            </div>

          </div>
          <div class="tab-pane" id="recoverTab">
            <div class="form-group">
              <label>Nama Stok</label>
              &nbsp;&nbsp;&nbsp;&nbsp;
              <select class="form-control select2addmodal" id="recoverStockId" style="width:360px">

              </select>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" onclick="recoverStock()">Pulihkan</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="detailStockModal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <center>
          <h4>Detail Stok</h4>
        </center>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">        
        <div class="row">
          <div class="col-md-8">
            <div class="form-group">
              <label>Nama Barang</label>
              <input type="text" class="form-control" id="editName" readonly>
              <input type="text" class="form-control" id="editId" hidden>
            </div>
          </div>
                   
          <div class="col-md-4">
           <div class="form-group">
                <label>Stok Terakhir</label>
                <input type="text" class="form-control" id="editStock" readonly>
            </div>
          </div>              
        </div>
        <div class="row" style="height:250px; overflow-y:scroll" >
          <table class="table table-striped mt-3">
            <thead>
              <tr>
                <th scope="col">Tanggal</th>
                <th scope="col">Qty</th>
                <th scope="col">Keterangan</th>
                <th scope="col">PIC</th>
              </tr>
            </thead>
            <tbody id="stockHistory">

            </tbody>
          </table>
        </div>

        <div class="modal-footer">
          <!-- <button type="button" class="btn btn-danger" onclick="deleteStock()">Hapus</button> -->
          <!-- <button type="button" class="btn btn-primary" onclick="updateStock()">Simpan</button> -->
          <button type="button" data-dismiss="modal" class="btn btn-secondary">Kembali</button>
        </div>
      </div>        
    </div>
  </div>
</div>
