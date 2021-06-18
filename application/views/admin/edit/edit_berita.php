

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
                  <?php echo form_open_multipart('admin/databerita/update')?>
                    <div class="card-body">
                      <div class="form-group">
                        <label>Judul Berita</label>
                        <input type="hidden" name="penulis" value="<?= $user['nama_lengkap']?>">
                        <input type="hidden" name="id" value="<?= $a[0]->id; ?>">
                        <input type="text" class="form-control" value="<?= $a[0]->judul; ?>" name="judul" placeholder="Input Judul Berita">
                         <?= form_error('judul','<small class="text-danger pl-3">','</small>'); ?>
                      </div>
                      <div class="form-group">
                        <label>Kategori</label>
                        <select name="kategori" class="form-control" id="kategori">
                          <option value="<?= $a[0]->kategori; ?>"><?= $a[0]->kategori; ?></option>
                          <?php foreach ($kategori as $data):?>
                            <option value="<?= $data->nama_kategori?>"><?= $data->nama_kategori?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea name="deskripsi" id="editor1" class="form-control" cols="10" rows="10" placeholder="Input Detail"><?= $a[0]->deskripsi; ?></textarea>
                      </div>
                      <div class="form-group row">
                        <div class="col-sm-1">gambar</div>
                        <div class="col-sm-10">
                          <div class="row">
                            <div class="col-sm-4">
                              <img src="<?= base_url('uploads/'.$a[0]->gambar)?>" class="img-thumbnail">
                            </div>
                            <div class="col-sm-8">
                              <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image" name="gambar" value="<?= $a[0]->gambar; ?>">
                                <label class="custom-file-label" for="gambar"><?= $a[0]->gambar; ?></label>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label>Status</label>
                        <select class="form-control select2" name="is_published" style="width: 100%;">
                          <option value="<?= $a[0]->is_published; ?>">
                            <?php if($a[0]->is_published == 1)
                              echo "Publish";
                              else{
                                echo "Draft";
                              }
                            ?>
                          </option>
                          <option value="1">Publish</option>
                          <option value="0">Draft</option>
                        </select>
                      </div>
                    </div>
                    <div class="card-footer text-right">
                       <a href="<?= base_url('admin/databerita')?>" class="btn btn-danger" ><i class="fa fa-arrow-left"></i> Kembali</a>
                      <button class="btn btn-primary"><i class="fa fa-paper-plane"></i> Submit</button>
                    </div>
                  <?php echo form_close() ?>
                </div>
    </div>
  </div>
  <!-- End Content -->
</section>
</div>