        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Uniform Resource Locator</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <?php if ( ! $dataUrl['return']): ?>
                    <h3 class="text-center">Data URL masih kosong.</h3>
                    <h4 class="text-center">Tambah <a href="<?= base_url(); ?>url/submit" style="border-bottom: 1px dashed;">disini</a></h4>
                    <?php else: ?>
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th class="text-center">#</th>
                          <th class="text-center">Link</th>
                          <th class="text-center">Deskripsi</th>
                          <th class="text-center">Download Status <span class="fa fa-info-circle" data-toggle="modal" data-target="#myModal"></span></th>
                          <th class="text-center" colspan="3">Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach($dataUrl['data'] as $val => $row): ?>
                        <tr>
                          <th class="text-center" scope="row"><?= $val + 1; ?></th>
                          <td class="text-center"><?= $row['link'] ?></td>
                          <td class="text-center"><?= substr($row['description'], 0,65); ?></td>
                          <td class="text-center"><?= $row['download_status']; ?></td>
                          <td class="text-center" style="cursor: default;" onclick="doModal('<?= $val + 1; ?>','<?= $row['unique_id']; ?>','<?= $row['link']; ?>','<?= $row['description']; ?>','<?= $row['download_status']; ?>')">Detail</td>
                          <td class="text-center"><a href="<?= base_url().'url/edit?uid='.$row['unique_id'] ?>">Ubah</a></td>
                          <td class="text-center" style="cursor: default;" onclick="deleteUrl('<?= $row['unique_id'] ?>')"">Hapus</td>
                        </tr>
                        <?php endforeach; ?>
                      </tbody>
                      <?php endif; ?>
                    </table>

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