      <footer class="main-footer">
        <div class="footer-left">
          Copyright &copy; 2018 <div class="bullet"></div> Design By <a href="https://nauval.in/">Muhamad Nauval Azhar</a>
        </div>
        <div class="footer-right">
          2.3.0
        </div>
      </footer>
    </div>
  </div>

  <!-- General JS Scripts -->

  <script src="<?= base_url('assets')?>/bootstrap/js/jquery-3.5.1.min.js"></script>
  <script src="<?= base_url('assets')?>/bootstrap/js/popper.min.js"></script>
  <script src="<?= base_url('assets')?>/bootstrap/js/bootstrap.min.js"></script>
     <script>
    $('.custom-file-input').on('change', function() {
      let fileName = $(this).val().split('\\').pop(); 
      $(this).next('.custom-file-label').addClass('selected').html(fileName);
    });

  </script>
 <!--  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script> -->
  <script src="<?= base_url('assets')?>/bootstrap/js/jquery.nicescroll.min.js"></script>
 <!--  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script> -->
  <script src="<?= base_url('assets')?>/bootstrap/js/moment.min.js"></script>
  <script src="<?= base_url('assets')?>/stisla/assets/js/stisla.js"></script>
  <!-- Template JS File -->
  <script src="<?= base_url('assets')?>/stisla/assets/js/scripts.js"></script>
  <script src="<?= base_url('assets')?>/stisla/assets/js/custom.js"></script>
  <!-- JS Libraies -->
  <script type="text/javascript" src="<?= base_url('assets')?>/datatables/datatables.min.js"></script>
  <script src="<?= base_url('assets')?>/stisla/assets/js/page/modules-datatables.js"></script>

   <script src="<?= base_url('assets'); ?>/ckeditor/ckeditor.js"></script>
 <script>
  
    CKEDITOR.replace('editor1');

</script>
 <script>
  
    CKEDITOR.replace('editor2');

</script>
<script>
  $(function(){
    $('textarea').ckeditor({
      toolbar: 'Full',
      enterMode: CKEDITOR.ENTER_BR
    });
  });
</script>
</body>
</html>