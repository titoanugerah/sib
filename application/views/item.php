<div class="panel-header bg-danger-gradient">
  <div class="page-inner py-5">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
      <div>
        <h2 class="text-white pb-2 fw-bold" >Data Barang </h2>
      </div>
      <div class="ml-md-auto py-2 py-md-0">
        <a href="#" class="btn btn-white btn-border btn-round mr-2" hidden>Manage</a>
        <button type="button" class="btn btn-white btn-border btn-round mr-2" onclick="addNewItemForm()">Tambah Barang Baru</button>
      </div>
    </div>
  </div>
</div>

<div class="page-inner mt--5" >
  <div class="row mt--2" id="itemList">

  </div>
</div>


<div class="modal fade" id="addItemModal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <center>
          <h4>Tambah Barang</h4>
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
                  <label>Nama Barang</label>
                  <input type="text" class="form-control" id="addName" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                <label>Supplier</label>

                <select id="addSupplierId" class="form-control select2addmodal" style="width:180px"></select>
                </div>
              </div>              
              <div class="col-md-6">
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
              <button type="button" class="btn btn-primary" onclick="addItem()">Simpan</button>
              <button type="button" data-dismiss="modal" class="btn btn-secondary">Kembali</button>
            </div>

          </div>
          <div class="tab-pane" id="recoverTab">
            <div class="form-group">
              <label>Nama Barang</label>
              &nbsp;&nbsp;&nbsp;&nbsp;
              <select class="form-control select2addmodal" id="recoverItemId" style="width:360px">

              </select>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" onclick="recoverItem()">Pulihkan</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="detailItemModal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <center>
          <h4>Detail Barang</h4>
        </center>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">        
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label>Nama Barang</label>
              <input type="text" class="form-control" id="editName" required>
              <input type="text" class="form-control" id="editId" hidden>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
                <label>Nama Supplier</label>
                <select id="editSupplierId" class="form-control select2modal" style="width:180px"></select>
            </div>
          </div>              
          <div class="col-md-6">
           <div class="form-group">
                <label>Harga</label>
                <input type="text" class="form-control" id="editPrice" required>
            </div>
          </div>              
          <div class="col-md-12">
            <div class="form-group">
                <label>Deskripsi</label>
                <textarea type="text" class="form-control" id="editRemark" ></textarea>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" onclick="deleteItem()">Hapus</button>
          <button type="button" class="btn btn-primary" onclick="updateItem()">Simpan</button>
          <button type="button" data-dismiss="modal" class="btn btn-secondary">Kembali</button>
        </div>
      </div>        
    </div>
  </div>
</div>
