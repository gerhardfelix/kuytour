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
        <!-- left column -->

        <!--/.col (left) -->
        <!-- right column -->
        <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-warning">
            <!-- /.box-header -->
            <div class="box-body">
              <form role="form" method="post" action="<?=base_url('mobil/edit_mobil')  ?>">
                <!-- text input -->
                <div class="form-group">
                  <label>Nomor Polisi Kendaraan</label>
                  <input type="hidden" name="slug" value="<?=$mobil['slug'] ?>">
                  <input type="text" name="nopol" class="form-control" placeholder="Enter ..." value="<?=$mobil['nopol'] ?>">
                </div>               
                <div class="form-group">
                  <label>Merk Kendaraan</label>
                  <input type="text" name="merk" class="form-control" placeholder="Enter ..." value="<?=$mobil['merk'] ?>">
                </div>
                <div class="form-group">
                  <label>Tipe Kendaraan</label>
                  <input type="text" name="tipe" class="form-control" placeholder="Enter ..." value="<?=$mobil['tipe'] ?>">
                </div>
                <div class="form-group">
                  <label>Harga Sewa 12 Jam</label>
                  <input type="text" name="harga12" class="form-control" placeholder="Enter ..." value="<?=$mobil['harga12'] ?>">
                </div>
                <div class="form-group">
                  <label>Harga Sewa 24 Jam</label>
                  <input type="text" name="harga24" class="form-control" placeholder="Enter ..." value="<?=$mobil['harga24'] ?>">
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