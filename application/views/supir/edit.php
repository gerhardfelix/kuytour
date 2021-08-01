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
        <!-- left column -->

        <!--/.col (left) -->
        <!-- right column -->
        <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-warning">
            <!-- /.box-header -->
            <div class="box-body">
              <form role="form" method="post" action="<?=base_url('supir/edit_supir')  ?>">
                <!-- text input -->
                <div class="form-group">
                  <label>Nama Supir</label>
                  <input type="hidden" name="slug" value="<?=$supir['slug'] ?>">
                  <input type="text" name="nama_supir" class="form-control" placeholder="Enter ..." value="<?=$supir['nama_supir'] ?>">
                </div>               
                <div class="form-group">
                  <label>Nomor SIM</label>
                  <input type="text" name="no_sim" class="form-control" placeholder="Enter ..." value="<?=$supir['no_sim'] ?>">
                </div>
                <div class="form-group">
                  <label>Nomor Handphone</label>
                  <input type="text" name="hp_supir" class="form-control" placeholder="Enter ..." value="<?=$supir['hp_supir'] ?>">
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