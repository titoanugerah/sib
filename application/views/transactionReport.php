<div class="panel-header bg-danger-gradient">
  <div class="page-inner py-5">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
      <div>
        <h2 class="text-white pb-2 fw-bold" >Laporan Transaksi</h2>
      </div>
    </div>
  </div>
</div>

<div class="page-inner mt--5">
  <div class="row mt--2">
    <div class="col-md-12">
      <div class="row">
        <div class="card full-height  col-md-12">
          <div class="card-header">
            <div class="card-title">Laporan Transaksi</div>
            <div class="d-flex flex-wrap justify-content-around pb-2 pt-4"></div>
            <div class="card-body">      
              <table id="example" class="display" style="width:100%">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Tanggal</th>
                    <th>Nama</th>
                    <th>Status</th>
                    <th>Subtotal</th>
                    <th>Kasir</th>
                    <th>Opsi</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>ID</th>
                    <th>Tanggal</th>
                    <th>Nama</th>
                    <th>Status</th>
                    <th>Subtotal</th>
                    <th>Kasir</th>
                    <th>Opsi</th>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="detailTransactionModal" role="dialog">
  <div class="modal-dialog modal-lg">
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
          <button type="button" data-dismiss="modal" class="btn btn-secondary">Kembali</button>
        </div>
      </div>        
    </div>
  </div>
</div>
