
        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Developed by <a href="https://github.com/askerlab" style="border-bottom: 1px dashed #000;" target="_blank">askerlab</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="<?= $base_url ?>vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?= $base_url ?>vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="<?= base_url() ?>vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="<?= $base_url ?>build/js/custom.min.js"></script>
    <!-- Sweetalert theme -->
    <script src="<?= base_url(); ?>build/js/sweetalert.min.js" type="text/javascript"></script>
    <?php if ( $this->uri->segment(1) == 'user'): ?>
    <!-- validator -->
    <script src="<?= base_url(); ?>vendors/validator/validator.js"></script>
    <?php endif; ?>

    <script type="text/javascript">
    <?php if ( $this->uri->segment(1) == 'url'): ?>
        function sweetAlertShow()
        {
            swal("Good job!", "You clicked the button!", "success");
        }

        function deleteUrl(uniqueId)
        {
            swal({
              title: "Yakin ingin menghapus data?",
              text: "Setelah dihapus tidak dapat dikembalikan!",
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "Ya, hapus!",
              cancelButtonText: "Batal",
              closeOnConfirm: false
            },
            function(){
                window.location.href = '<?= base_url() ?>do_action?method=url_delete&uid=' + uniqueId
            });
        }

        function doModal(id,uid,link,desc,status)
        {
          /* a = id , b = nama , x = pesan , y = tanggal_waktu */
              html =  '<div id="dynamicModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="confirm-modal" aria-hidden="true">';
              html += '<div class="modal-dialog">';
              html += '<div class="modal-content">';
              html += '<div class="modal-header">';
              html += '<a class="close" data-dismiss="modal">×</a>';
              html += '<h4 class="modal-title pull-left">Detail #'+ id +'<br/>'
              html += '<small><a href="<?= base_url(); ?>url/transkrip?uid=' + uid + '" style="border-bottom:1px dashed;">Lihat Transkrip</a></small></h4>'
              html += '</div>';
              html += '<div class="modal-body">';
              html += '<h6>Link</h6><h5>' + link + '</h5>';
              html += '<hr/>';
              html += '<h6>Deskripsi</h6><h5>' + desc + '</h5>';
              html += '<hr/>';
              html += '<h6>Status</h6><h5>' + status + '</h5>';
              html += '</div>';
              html += '<div class="modal-footer">';
              html += '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>';
              html += '</div>';  // content
              html += '</div>';  // dialog
              html += '</div>';  // footer
              html += '</div>';  // modalWindow
              $('body').append(html);
              $("#dynamicModal").modal();
              $("#dynamicModal").modal('show');

              $('#dynamicModal').on('hidden.bs.modal', function (e) {
                  $(this).remove();
              });
        }

        function backToManage()
        {
            window.location.href = '<?= base_url().'url/manage' ?>'
        }

        function redirectTo(uri) 
        {
            if ( uri != null ) window.open('' + uri,'_blank');
        }
    <?php endif; ?>
    </script>
  </body>
</html>
