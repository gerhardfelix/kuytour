<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $nopol; ?>
      </h1>
    </section>
<?php echo validation_errors(); ?>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-warning">
            <div class="box-body">
              <form role="form" method="post" action="<?=base_url('mobil/create')  ?>">
                <!-- text input -->
                <div class="form-group">
                  <label>Nomor Polisi</label>
                  <input type="text" name="nopol" class="form-control" placeholder="Nomor Polisi Kendaraan">
                </div>
                <div class="form-group">
                  <label>Merk</label>
                  <input type="text" name="merk" class="form-control" placeholder="Merk Kendaraan">
                </div>
                <div class="form-group">
                  <label>Tipe</label>
                  <input type="text" name="tipe" class="form-control" placeholder="Tipe Kendaraan">
                </div>
                <div class="form-group">
                  <label>Harga 12 Jam</label>
                  <input type="text" name="harga12" class="form-control" placeholder="Harga Sewa Kendaraan 12 Jam">
                </div>
                <div class="form-group">
                  <label>Harga 24 jam</label>
                  <input type="text" name="harga24" class="form-control" placeholder="Harga Sewa Kendaraan 24 Jam">
                </div>
                <div class="form-group">
                  <label>Harga Dengan Supir</label>
                  <input type="text" name="dengansupir" class="form-control" placeholder="Harga Sewa Kendaraan Dengan Supir">
                </div>
               <div class="box-footer">
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
              </div>
              </form>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>