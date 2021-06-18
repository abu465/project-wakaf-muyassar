

<!-- Main Content -->
<div class="main-content">
  <section class="section">
   <div class="section-header">
    <h1><?= $judul?></h1>
  </div>

  <div class="row">
    <div class="col-md-12 mb-2">
       <a href="<?= base_url('admin/dataprogram')?>" class="btn btn-danger" ><i class="fa fa-arrow-left"></i> Kembali</a>
    </div>
  </div>
  <!-- Content -->
  <div class="row">
    <div class="col-12">
        <div class="card">
                    <div class="card-body">
                      <div class="form-group">
                        <label>Kategori</label>
                        <input type="text" class="form-control" value="<?= $a[0]->kategori; ?>" readonly >
                      </div>
                      <div class="form-group">
                        <label>Detail</label>
                        <textarea name="detail" id="editor1" class="form-control" cols="10" rows="10" readonly ><?= $a[0]->detail; ?></textarea>
                      </div>
                      <div class="form-group">
                        <label>Update</label>
                        <textarea name="update" id="editor2" class="form-control" cols="10" rows="10" readonly><?= $a[0]->update; ?></textarea>
                      </div>
                      <div class="form-group">
                        <img alt="image" src="<?= base_url('uploads/'.$a[0]->gambar)?>" class="img-thumbnail" width="300">
                      </div>
                    </div>
                    <div class="card-footer text-left">
                     
                    </div>
                </div>
    </div>
  </div>
  <!-- End Content -->
</section>
</div>