

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
                  <?php echo form_open_multipart('admin/dataprogram/insert')?>
                    <div class="card-body">
                      <div class="form-group">
                        <label>Nama Program</label>
                        <input type="hidden" name="penulis" value="<?= $user['nama_lengkap']?>">
                        <input type="text" class="form-control" value="" name="nama_program" placeholder="Input Nama Program">
                         <?= form_error('nama_program','<small class="text-danger pl-3">','</small>'); ?>
                      </div>
                      <div class="form-group">
                        <label>Wilayah</label>
                        <input type="text" class="form-control" value="" name="wilayah" placeholder="Input Wilayah">
                         <?= form_error('wilayah','<small class="text-danger pl-3">','</small>'); ?>
                      </div>
                      <div class="form-group">
                        <label>Kategori</label>
                        <select name="kategori" class="form-control" id="kategori">
                          <option value="">Pilih Kategori</option>
                          <?php foreach ($kategori as $data):?>
                            <option value="<?= $data->nama_kategori?>"><?= $data->nama_kategori?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Jumlah Penggalangan</label>
                        <input type="text" id="rupiah" name="jumlah_penggalangan" class="form-control" placeholder="Masukan Jumlah">
                         <?= form_error('jumlah_penggalangan','<small class="text-danger pl-3">','</small>'); ?>
                      </div>
                      <div class="form-group">
                        <label>Waktu Penggalangan</label>
                        <input type="datetime-local" id="rupiah" name="waktu_penggalangan" class="form-control">
                         <?= form_error('waktu_penggalangan','<small class="text-danger pl-3">','</small>'); ?>
                      </div>
                      <div class="form-group">
                        <label>Detail</label>
                        <textarea name="detail" id="editor1" class="form-control" cols="10" rows="10" placeholder="Input Detail"></textarea>
                      </div>
                      <div class="form-group">
                        <label>Update</label>
                        <textarea name="update" id="editor2" class="form-control" cols="10" rows="10" placeholder="Input Update"></textarea>
                      </div>
                      <div class="form-group">
                        <label>Gambar</label>
                        <input type="file" class="form-control-file" name="gambar" style="background-color:#64b5f6; color:#f5f5f5; border-radius:3px;">
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
                       <a href="<?= base_url('admin/dataprogram')?>" class="btn btn-danger" ><i class="fa fa-arrow-left"></i> Kembali</a>
                      <button class="btn btn-primary"><i class="fa fa-paper-plane"></i> Submit</button>
                    </div>
                  <?php echo form_close() ?>
                </div>
    </div>
  </div>
  <!-- End Content -->
</section>
</div>