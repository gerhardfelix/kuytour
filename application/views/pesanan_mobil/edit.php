<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <?php echo $kode_booking; ?>
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
                            <form role="form" method="post" action="<?=base_url('pesanan/edit_pesanan_mobil')  ?>">
                                <!-- text input -->
                             <div class="form-group">
                                    <label>Mobil</label>
                                     <select name='id_mobil' class="form-control">
                                        <?php
                                        foreach ($mobil as $mobil_item) {
                                            if ($mobil_item['id']==$pesanan_mobil_item['id_mobil']) {
                                                $selected='selected="selected"';
                                            }

                                            else {
                                                $selected='';
                                            }
                                        echo '<option '.$selected.' value="'.$mobil_item['id'].'"> '.$mobil_item['tipe'].' / '.$mobil_item['nopol'].'</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Sopir</label>
                                    <select name='id_supir' class="form-control">
                                        <?php
                                        foreach ($supir as $supir_item) {
                                            if ($supir_item['id_supir']==$pesanan_mobil_item['id_sopir']) {
                                                $selected='selected="selected"';
                                            }

                                            else {
                                                $selected='';
                                            }
                                        echo '<option value="'.$supir_item['id_supir'].'" '.$selected.' >'.$supir_item['nama_supir'].'</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Pelanggan</label>
                                     <select name='id_pelanggan' class="form-control">
                                        <?php
                                        foreach ($pelanggan as $pelanggan_item) {
                                            if ($pelanggan_item['id_pelanggan']==$pesanan_mobil_item['id_pelanggan']) {
                                                $selected='selected="selected"';
                                            }

                                            else {
                                                $selected='';
                                            }
                                        echo '<option value="'.$pelanggan_item['id_pelanggan'].'" '.$selected.'>'.$pelanggan_item['nama'].'</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Lokasi</label>
                                    <input type="text" name="lokasi_jemput" class="form-control" placeholder="Lokasi Penjemputan" value="<?=$pesanan_mobil_item['lokasi_jemput'] ?>">
                                    <input type="hidden" name="kode_booking" class="form-control" value="<?=$pesanan_mobil_item['kode_booking'] ?>">
                                </div>
                                <div class="form-group">
                                    <label>Status Bayar</label>
                                    <select name="status_bayar" class="form-control">
                                        <option <?php echo $pesanan_mobil_item['status_bayar']=="Belum Bayar" ? "selected='selected'" : "";?> value="Belum Bayar">Belum Bayar</option>
                                        <option <?php echo $pesanan_mobil_item['status_bayar']=="Sudah Konfirmasi" ? "selected='selected'" : "";?> value="Sudah Konfirmasi">Sudah Konfirmasi</option>
                                        <option <?php echo $pesanan_mobil_item['status_bayar']=="Sudah Bayar" ? "selected='selected'" : "";?> value="Sudah Bayar">Sudah Bayar</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Refund Status</label>
                                    <select name="refund" class="form-control">
                                        <option <?php echo $pesanan_mobil_item['refund']=="Request" ? "selected='selected'" : "";?> value="Request">Permintaan Refund</option>
                                        <option <?php echo $pesanan_mobil_item['refund']=="Done" ? "selected='selected'" : "";?> value="Done">Sudah Ditansfer</option>
                                        <option <?php echo $pesanan_mobil_item['refund']=="Invalid" ? "selected='selected'" : "";?> value="Invalid">Ditolak</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Bukti Bayar</label>
                                    <a href="<?=$pesanan_mobil_item['bukti_bayar'] ?>" target="_blank" title=""><?=$pesanan_mobil_item['bukti_bayar'] ?></a>
                                    
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Berangkat</label>
                                    <input type="datetime" name="tgl_berangkat" class="form-control" placeholder="Tanggal Berangkat" value="<?=$pesanan_mobil_item['tgl_berangkat'] ?>">
                                </div>
                                <div class="form-group">
                                    <label>Durasi Pesan</label>
                                    <select name="durasi_pesan" class="form-control">
                                            <option <?php if ($pesanan_mobil_item['durasi_pesan']==120) {
                                                echo 'selected="selected"';
                                            } ?> value="12">12 Jam</option>
                                            <option <?php if ($pesanan_mobil_item['durasi_pesan']==240) {
                                                echo 'selected="selected"';
                                            } ?> value="24">24 Jam</option>
                                            <option <?php if ($pesanan_mobil_item['durasi_pesan']==480) {
                                                echo 'selected="selected"';
                                            } ?> value="48">2 Hari</option>
                                            <option <?php if ($pesanan_mobil_item['durasi_pesan']==720) {
                                                echo 'selected="selected"';
                                            } ?> value="72">3 Hari</option>
                                            <option <?php if ($pesanan_mobil_item['durasi_pesan']==960) {
                                                echo 'selected="selected"';
                                            } ?> value="96">4 Hari</option>
                                            <option <?php if ($pesanan_mobil_item['durasi_pesan']==1200) {
                                                echo 'selected="selected"';
                                            } ?> value="120">5 Hari</option>
                                            <option <?php if ($pesanan_mobil_item['durasi_pesan']==1440) {
                                                echo 'selected="selected"';
                                            } ?> value="144">6 Hari</option>
                                            <option <?php if ($pesanan_mobil_item['durasi_pesan']==1680) {
                                                echo 'selected="selected"';
                                            } ?> value="168">7 Hari</option>
                                            <option <?php if ($pesanan_mobil_item['durasi_pesan']==1920) {
                                                echo 'selected="selected"';
                                            } ?> value="192">8 Hari</option>
                                            <option <?php if ($pesanan_mobil_item['durasi_pesan']==2160) {
                                                echo 'selected="selected"';
                                            } ?> value="216">9 Hari</option>
                                            <option <?php if ($pesanan_mobil_item['durasi_pesan']==2400) {
                                                echo 'selected="selected"';
                                            } ?> value="240">10 Hari</option>
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