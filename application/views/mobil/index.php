
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
              <h3 class="box-title"><?php echo $nopol; ?></h3>
            </div>
            <div class="box-header">
              <h3 class="box-title">
                <a href="<?=base_url('mobil/create'); ?>">
                <button type="button" class="btn btn-block btn-primary btn-sm">Tambah</button></a>
              </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover table-responsive">
                <thead>
                <tr>
                  <th>Nopol</th>
                  <th>Merk</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($mobil as $mobil_item): ?>
                  <tr>
                    <td><?php echo $mobil_item['nopol']; ?></td>
                    <td><?php echo $mobil_item['merk']; ?></td>
                    <td><a href="<?php echo site_url('mobil/'.$mobil_item['slug']); ?>">Detail</p>
                        <a href="<?php echo site_url('mobil/edit_mobil/'.$mobil_item['slug']); ?>">Edit</p>
                        <a href="<?php echo site_url('mobil/delete/'.$mobil_item['slug']); ?>">Hapus</p>
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
