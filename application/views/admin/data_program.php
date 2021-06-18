

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
      <a href="<?= base_url('admin/dataprogram/add_program')?>" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</a>
      <a href="<?= base_url('admin/dataprogram/kategori_program')?>" class="btn btn-warning"><i class="fa fa-folder"></i> Kategori</a>
    </div>
  </div>
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4>Program Wakaf</h4>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-striped" id="table-1">
              <thead>
                <tr>
                  <th class="text-center">
                    #
                  </th>
                  <th>Nama Program</th>
                  <th>Waktu</th>
                  <th>Gambar</th>
                  <th>Jumlah Penggalangan</th>
                  <th>Status</th>
                  <th>Detail</th>
                  <th>Date Created</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                foreach ($program as $data) {
                  ?>
                <tr>
                  <td>
                    <?= $no; ?>
                  </td>
                  <td><?= $data->nama_program; ?></td>
                  <td><?php

                  $tgl = new DateTime();
                  $tgl2 = new DateTime($data->waktu_penggalangan);
                  $d =$tgl2->diff($tgl)->days;
                  echo $d." Hari lagi";

                ?>  </td>
                  <td>
                    <img alt="image" src="<?= base_url('uploads/'.$data->gambar)?>" class="img-thumbnail" width="100">
                  </td>
                  <td>Rp. <?= number_format($data->jumlah_penggalangan, '0','','.') ?></td>
                  <td><?php if($data->is_published == 1){ ?>
                  <div class="badge badge-success">Publish</div>
                <?php }else{ ?>
                  <div class="badge badge-warning">Draf</div>
                <?php }?></td>
                  <td><a href="<?= base_url('admin/dataprogram/detail/'.$data->id) ?>" class="badge badge-success"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                  <td class="text-danger"><?= tgl_indo($data->date_created) ?></td>
                  <td>
                    <a href="<?= base_url('admin/dataprogram/edit_data/'.$data->id) ?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                    <a href="<?= base_url('admin/dataprogram/hapus_data/'.$data->id) ?>" class="btn btn-danger"  onclick="return confirm('Anda yakin menghapus Data ini?');"><i class="fa fa-trash"></i></a>
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


