        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Pengguna</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <?php if ( ! count($users) > 0): ?>
                    <h3 class="text-center">Data User masih kosong.</h3>
                    <h4 class="text-center">Tambah <a href="<?= base_url(); ?>user/add" style="border-bottom: 1px dashed;">disini</a></h4>
                    <?php else: ?>
                      <?php if ( $this->session->flashdata('sessionMessage')): ?>
                      <h5 class="text-center"><?= $this->session->flashdata('sessionMessage') ?></h5>
                      <?php endif; ?>
                      <table class="table table-hover">
                      <thead>
                        <tr>
                          <th class="text-center">#</th>
                          <th class="text-center">Nama Lengkap</th>
                          <th class="text-center">Username</th>
                          <th class="text-center">Email</th>
                          <th class="text-center">Tipe</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach($users as $val => $row): ?>
                        <tr>
                          <td class="text-center" scope="row"><?= $val + 1; ?></td>
                          <td class="text-center" scope="row"><?= $row['full_name']; ?></td>
                          <td class="text-center" scope="row"><?= $row['username']; ?></td>
                          <td class="text-center" scope="row"><?= $row['email']; ?></td>
                          <td class="text-center" scope="row"><?= ucwords($row['actor']['name']); ?></td>
                        </tr>
                        <?php endforeach; ?>
                      </tbody>  
                      </table>
                    <?php endif; ?>

                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <div id="myModal" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Infomasi download status</h4>
              </div>
              <div class="modal-body">
                <h6>1. URL_RECORDED</h6>
                <h5>URL yang sudah di submit sudah masuk ke database dan akan di proses oleh admin.</h5>
                <hr/>
                <h6>2. DOWNLOAD_IN_PROGRESS</h6>
                <h5>URL yang sudah di submit sedang di download oleh admin.</h5>
                <hr/>
                <h6>3. DOWNLOAD_COMPLETED</h6>
                <h5>URL yang sudah di submit sudah selesai dan berhasil di download.</h5>
                <hr/>
                <h6>4. DOWNLOAD_FAILED</h6>
                <h5>URL yang sudah di submit sudah selesai dan gagal untuk di download.</h5>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
              </div>
            </div>

          </div>
        </div>
        </div>
        <!-- /page content -->