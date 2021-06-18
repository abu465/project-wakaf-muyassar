

<!-- Main Content -->
<div class="main-content">
  <section class="section">
   <div class="section-header">
    <h1><?= $judul?></h1>
  </div>


  <!-- Content -->
  <div class="row mb-2">
    <div class="col-md-12">
      <?php if( $this->session->flashdata('message') ) : ?>
        <?= $this->session->flashdata('message') ?>
      <?php endif; ?>
    </div>
    <div class="col-md-12">
      <a href="<?= base_url('admin/dataprogram/add_kategori_program')?>" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</a>
       <a href="<?= base_url('admin/dataprogram')?>" class="btn btn-danger"><i class="fa fa-arrow-left"></i> Kembali</a>
    </div>
  </div>
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4>Table Kategori Program</h4>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-striped" id="table-1">
              <thead>
                <tr>
                  <th class="text-center">
                    #
                  </th>
                  <th>Nama Kategori</th>
                  <th>Status</th>
                  <th>Date Created</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                foreach ($kategori as $data) {
                  ?>
                <tr>
                  <td>
                    <?= $no; ?>
                  </td>
                  <td><?= $data->nama_kategori; ?></td>
                  <td><?php if($data->is_published == 1){ ?>
                  <div class="badge badge-success">Publish</div>
                <?php }else{ ?>
                  <div class="badge badge-warning">Draf</div>
                <?php }?></td>
                  <td class="text-danger"><?= tgl_indo($data->date_created) ?></td>
                  <td>
                    <a href="<?= base_url('admin/dataprogram/edit_kategori_program/'.$data->id) ?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                    <a href="<?= base_url('admin/dataprogram/hapus_kategori_program/'.$data->id) ?>" class="btn btn-danger"  onclick="return confirm('Anda yakin menghapus Data ini?');"><i class="fa fa-trash"></i></a>
                  </td>
                </tr>
                <?php $no++;?>
                <?php

               }
                ?>

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End Content -->
</section>
</div>


