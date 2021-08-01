
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Tables
        <small>advanced tables</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Tables</a></li>
        <li class="active">Data tables</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"><?php echo $judul; ?></h3>
            </div>
            <div class="box-header">
              <h3 class="box-title">
                <a href="<?=base_url('pesanan/create_pesanan_mobil'); ?>">
                <button type="button" class="btn btn-block btn-primary btn-sm">Tambah</button></a>
              </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover table-responsive">
                <thead>
                <tr>
                  <th>Kode Booking</th>
                  <th>Id Pelanggan</th>
                  <th>Id Mobil</th>
                  <th>Bukti Pembayaran</th>
                  <th>Status Pembayaran</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($pesanan_m as $pesanan_m_item): ?>
                  <tr>
                    <td><?php echo $pesanan_m_item['kode_booking']; ?></td>
                    <td><?php echo $pesanan_m_item['nama']; ?></td>
                    <td><?php echo $pesanan_m_item['nopol'].' ('.$pesanan_m_item['tipe'].')'; ?></td>
                    <td><a href="<?php echo $pesanan_m_item['bukti_bayar']; ?>" target="_blank" title=""><?php echo $pesanan_m_item['bukti_bayar']; ?></a> </td>
                    <td><?php echo $pesanan_m_item['status_bayar']; ?></td>
                    <td><p><a href="<?php echo site_url('pesanan_mobil/'.$pesanan_m_item['kode_booking']); ?>">Detail</a></p>
                        <p><a href="<?php echo site_url('pesanan_mobil/edit_pesanan_mobil/'.$pesanan_m_item['kode_booking']); ?>">Edit</a></p>
                        <p><a href="<?php echo site_url('pesanan_mobil/delete_pesanan_mobil/'.$pesanan_m_item['kode_booking']); ?>">Hapus</a></p>
                    </td>
                  </tr>
                <?php endforeach; ?>
                </tbody>
                
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
