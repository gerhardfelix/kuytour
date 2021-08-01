
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

    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"><?php echo $no_sim; ?></h3>
            </div>
            <div class="box-header">
              <h3 class="box-title">
                <a href="<?=base_url('supir/create'); ?>">
                <button type="button" class="btn btn-block btn-primary btn-sm">Tambah</button></a>
              </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Nama Supir</th>
                  <th>Nomor SIM</th>
                  <th>Nomor Handphone</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($supir as $supir_item): ?>
                  <tr>
                    <td><?php echo $supir_item['nama_supir']; ?></td>
                    <td><?php echo $supir_item['no_sim']; ?></td>
                    <td><?php echo $supir_item['hp_supir']; ?></td>
                    <td><a href="<?php echo site_url('supir/'.$supir_item['slug']); ?>">Detail</p>
                        <a href="<?php echo site_url('supir/edit_supir/'.$supir_item['slug']); ?>">Edit</p>
                        <a href="<?php echo site_url('supir/delete/'.$supir_item['slug']); ?>">Hapus</p>
                    </td>
                  </tr>
                <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>