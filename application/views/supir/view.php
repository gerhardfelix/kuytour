<div class="content-wrapper" style="min-height: 1125.8px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Detail Sopir
        <small></small>
      </h1>
      
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title"><strong><?=$supir_item['no_sim'] ?></strong></h3>

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
                    <th>Nama Sopir</th>
                    <td><?=$supir_item['nama_supir'];?></td>
                </tr>
                <tr>
                    <th>Nomor SIM</th>
                    <td><?=$supir_item['no_sim'];?></td>
                </tr>
                <tr>
                    <th>Nomor Handphone</th>
                    <td><?=$supir_item['hp_supir'];?></td>
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