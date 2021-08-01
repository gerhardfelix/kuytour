<div class="content-wrapper" style="min-height: 1125.8px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Detail Mobil
        <small></small>
      </h1>
      
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title"><strong><?=$mobil_item['nopol'] ?></strong></h3>

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
                    <th>No Kendaraan</th>
                    <td><?=$mobil_item['nopol'];?></td>
                </tr>
                <tr>
                    <th>Merk Kendaraan</th>
                    <td><?=$mobil_item['merk'];?></td>
                </tr>
                <tr>
                    <th>Tipe Kendaraan</th>
                    <td><?=$mobil_item['tipe'];?></td>
                </tr>
                <tr>
                    <th>Harga Sewa 12 Jam</th>
                    <td><span class="pull-right">Rp. <?=$mobil_item['harga12'];?></span></td>
                </tr>
                <tr>
                    <th>Harga Sewa 24 Jam</th>
                    <td><span class="pull-right">Rp. <?=$mobil_item['harga24'];?></span></td>
                </tr>
                <tr>
                    <th>Harga Sewa Dengan Supir</th>
                    <td><span class="pull-right">Rp. <?=$mobil_item['dengansupir'];?></span></td>
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