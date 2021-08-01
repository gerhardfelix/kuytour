<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $no_sim; ?>
      </h1>
    </section>
<?php echo validation_errors(); ?>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-warning">
            <div class="box-body">
              <form role="form" method="post" action="<?=base_url('supir/create')  ?>">
                <!-- text input -->
                <div class="form-group">
                  <label>Nama</label>
                  <input type="text" name="nama_supir" class="form-control" placeholder="Nama Supir">
                </div>
                <div class="form-group">
                  <label>Nomor SIM</label>
                  <input type="text" name="no_sim" class="form-control" placeholder="Nomor SIM Supir">
                </div>
                <div class="form-group">
                  <label>Nomor Handphone</label>
                  <input type="text" name="hp_supir" class="form-control" placeholder="Nomor Handphone Supir">
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
