        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><span class="fa fa-chevron-left" onclick="backToManage()"></span>&nbsp;Uniform Resource Locator</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <?php if ( ! $detail['return']): ?>
                    <h3 class="text-center">Data Transkrip URL tidak ditemukan.</h3>
                    <h4 class="text-center"> <a href="<?= base_url(); ?>url/manage" style="border-bottom: 1px dashed;">kembali</a></h4>
                    <?php else: ?>
                    <form class="form-horizontal form-label-left" novalidate method="post" action="<?= base_url() ?>do_action?method=url_edit">
                      <?php if ( $this->session->flashdata('sessionMessage')): ?>
                      <h5 class="text-center"><?= $this->session->flashdata('sessionMessage') ?></h5>
                      <?php endif; ?>
                      <span class="section">Formulir perubahan data.</span>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">URL
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="url" placeholder="https://youtube.com/watch?v=<?= generate_string(10); ?>" required="required" type="text" autocomplete="off" value="<?= $detail['data']['link']; ?>">
                        </div>
                      </div>
                      <input type="hidden" name="__uuid" value="<?= $this->input->get('uid'); ?>">
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="textarea">Deskripsi</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea id="textarea" name="description" placeholder="Deskripsi untuk URL yang disubmit." class="form-control col-md-7 col-xs-12"><?= $detail['data']['description']; ?></textarea>
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          <button id="send" type="submit" class="btn btn-success">Ubah Data</button>
                        </div>
                      </div>
                    </form>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->