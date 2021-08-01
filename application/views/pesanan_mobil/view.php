<div class="content-wrapper" style="min-height: 1125.8px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Detail Pesanan Mobil
        <small></small>
      </h1>
      
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title"><strong><?=$detail_pesanan_mobil['kode_booking'] ?></strong></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
            <table class="table table-bordered">
                <tbody><tr>
                    <th>Kode Booking</th>
                    <td><?=$detail_pesanan_mobil['kode_booking'];?></td>
                </tr>
                <tbody><tr>
                    <th>Tanggal Booking</th>
                    <td><?=$detail_pesanan_mobil['tgl_booking'];?></td>
                </tr>
                <tbody><tr>
                    <th>Tanggal Berangkat</th>
                    <td><?=$detail_pesanan_mobil['tgl_berangkat'];?></td>
                </tr>
                <tr>
                    <th>Nama Pelanggan</th>
                    <td><?=$detail_pesanan_mobil['nama'];?></td>
                </tr>
                <tr>
                    <th>Mobil Dipesan</th>
                    <td><?=$detail_pesanan_mobil['merk'];?> <br/> <?=$detail_pesanan_mobil['tipe'];?> <br/> <?=$detail_pesanan_mobil['nopol'];?></td>
                </tr>
                <tr>
                    <th>Sopir</th>
                    <td><?=$detail_pesanan_mobil['nama_supir'];?></td>
                </tr>
                <tr>
                    <th>Durasi Pesan</th>
                    <td><?=$detail_pesanan_mobil['durasi_pesan'];?></td>
                </tr>
                <tr>
                    <th>Total Biaya</th>
                    <td><?=$detail_pesanan_mobil['total_biaya'];?></td>
                </tr>
                <tr>
                    <th>Status Bayar</th>
                    <td><?=$detail_pesanan_mobil['status_bayar'];?></td>
                </tr>
            </tbody></table>
        </div>
        <div class="box-footer">
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>