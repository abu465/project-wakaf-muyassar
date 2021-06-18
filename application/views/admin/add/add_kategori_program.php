

<!-- Main Content -->
<div class="main-content">
  <section class="section">
   <div class="section-header">
    <h1><?= $judul?></h1>
  </div>


  <!-- Content -->
  <div class="row">
    <div class="col-12">
        <div class="card">
                  <?php echo form_open_multipart('admin/dataprogram/insert_kategori_program')?>
                    <div class="card-body">
                      <div class="form-group">
                        <label>Nama kategori Program</label>
                        <input type="text" class="form-control" value="" name="nama_kategori" placeholder="Input Kategori Program">
                         <?= form_error('nama_kategori','<small class="text-danger pl-3">','</small>'); ?>
                      </div>
                      <div class="form-group">
                        <label>Status</label>
                        <select class="form-control select2" name="is_published" style="width: 100%;">
                          <option value="1">Publish</option>
                          <option value="0">Draft</option>
                        </select>
                      </div>
                    </div>
                    <div class="card-footer text-right">
                       <a href="<?= base_url('admin/dataprogram/kategori_program')?>" class="btn btn-danger" ><i class="fa fa-arrow-left"></i> Kembali</a>
                      <button class="btn btn-primary"><i class="fa fa-paper-plane"></i> Submit</button>
                    </div>
                  <?php echo form_close() ?>
                </div>
    </div>
  </div>
  <!-- End Content -->
</section>
</div>