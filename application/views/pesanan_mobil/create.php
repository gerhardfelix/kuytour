<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $judul; ?>
      </h1>
    </section>
<?php echo validation_errors(); ?>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-warning">
            <div class="box-body">
              <form role="form" method="post" action="<?=base_url('pesanan/create_pesanan_mobil')  ?>">
                <!-- text input -->
                <div class="form-group">
                  <label>Mobil</label>
                   <select name='id_mobil' class="form-control">
                    <?php
                    foreach ($mobil as $mobil_item) {
                    echo '<option value="'.$mobil_item['id'].'">'.$mobil_item['tipe'].' / '.$mobil_item['nopol'].'</option>';
                    }
                    ?>
                  </select>
                </div>
                <div class="form-group">
                  <label>Sopir</label>
                  <select name='id_supir' class="form-control">
                    <?php
                    foreach ($supir as $supir_item) {
                    echo '<option value="'.$supir_item['id_supir'].'">'.$supir_item['nama_supir'].'</option>';
                    }
                    ?>
                  </select>
                </div>
                <div class="form-group">
                  <label>Pelanggan</label>
                   <select name='id_pelanggan' class="form-control">
                    <?php
                    foreach ($pelanggan as $pelanggan_item) {
                    echo '<option value="'.$pelanggan_item['id_pelanggan'].'">'.$pelanggan_item['nama'].'</option>';
                    }
                    ?>
                  </select>
                </div>
                <div class="form-group">
                  <label>Lokasi</label>
                  <input type="text" name="lokasi_jemput" class="form-control" placeholder="Lokasi Penjemputan">
                </div>
                <div class="form-group">
                  <label>Tanggal Berangkat</label>
                  <input type="text" id='datetimepicker1' name="tgl_berangkat" class="form-control" placeholder="Tanggal Berangkat">
                </div>
                
                <div class="form-group">
                  <label>Durasi Pesan</label>
                  <select name="durasi_pesan" class="form-control">
                      <option value="12">12 Jam</option>
                      <option value="24">24 Jam</option>
                      <option value="48">2 Hari</option>
                      <option value="72">3 Hari</option>
                      <option value="96">4 Hari</option>
                      <option value="120">5 Hari</option>
                      <option value="144">6 Hari</option>
                      <option value="168">7 Hari</option>
                      <option value="192">8 Hari</option>
                      <option value="216">9 Hari</option>
                      <option value="240">10 Hari</option>
                  </select>
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