
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
            <div class="login-brand">
              <img src="<?= base_url('assets')?>/stisla/assets/img/stisla-fill.svg" alt="logo" width="100" class="shadow-light rounded-circle">
            </div>

            <div class="card card-primary">
              <div class="card-header"><h4>Register</h4></div>

              <div class="card-body">
                <form  id="registration-form" method="POST" action="<?= base_url('auth/regristrasi')?>">
                  <div class="form-group">
                    <label for="email">Nama Lengkap</label>
                    <input id="nama_lengkap" type="text" class="form-control" name="nama_lengkap"autofocus>
                    <?= form_error('nama_lengkap','<small class="text-danger pl-3">','</small>'); ?>
                    <div class="invalid-feedback">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control" name="email">
                     <?= form_error('email','<small class="text-danger pl-3">','</small>'); ?>
                    <div class="invalid-feedback">  
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="email">No Telepon</label>
                    <input id="no_tlpn" type="number" class="form-control" name="no_tlpn">
                    <?= form_error('no_tlpn','<small class="text-danger pl-3">','</small>'); ?>
                    <div class="invalid-feedback">
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-6">
                      <label for="password" class="d-block">Password</label>
                      <input id="password" type="password" class="form-control pwstrength" data-indicator="pwindicator" name="password1">
                      <div id="pwindicator" class="pwindicator">
                        <div class="bar"></div>
                        <div class="label"></div>
                      </div>
                     <?= form_error('password1','<small class="text-danger pl-3">','</small>'); ?>
                    </div>
                    <div class="form-group col-6">
                      <label for="password2" class="d-block">Password Confirmation</label>
                      <input id="password2" type="password" class="form-control" name="password2">
                       <?= form_error('password2','<small class="text-danger pl-3">','</small>
              '); ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="agree" class="custom-control-input" id="agree">
                      <label class="custom-control-label" for="agree">Setuju untuk melanjutkan</label>
                    </div>
                <?= form_error('agree','<small class="text-danger pl-3">','</small>
              '); ?>
                  </div>

                  <div class="form-group">
                    <button type="submit" id="kirim" class="btn btn-primary btn-lg btn-block">
                      Register
                    </button>
                  </div>
                   <div class="text-center mt-4 mb-3">
                  <div class="">  Sudah Punya Akun? <a href="<?= base_url('auth')?>">Login Sekarang</a></div>
                </div>
                </form>
              </div>
            </div>
            <div class="simple-footer">
              Copyright &copy; Stisla 2018
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- Sweetalert2 -->
