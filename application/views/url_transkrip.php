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
                    <form class="form-horizontal form-label-left" novalidate method="post" action="<?= base_url() ?>do_action?method=url_submit">
                      <p>Detail transkrip status.</p>
                      <?php if ( $this->session->flashdata('sessionMessage')): ?>
                      <h5 class="text-center"><?= $this->session->flashdata('sessionMessage') ?></h5>
                      <?php endif; 
                      $data = $detail['data'];
                      ?>
                      <span class="section">Status</span>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">URL
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         	<?= $data['link']; ?>&nbsp;
                         	<span class="fa fa-link" onclick="redirectTo('<?= $data['link']; ?>')"></span>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="textarea">Video URL</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        	<?= $data['transkrip']['video'] != null ? $data['transkrip']['video']."&nbsp;<span class=\"fa fa-link\" onclick=\"redirectTo('".$data['transkrip']['video']."')\"></span>" : 'Belum ada URL'; ?>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="textarea">Audio URL</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          	<?= $data['transkrip']['audio'] != null ? $data['transkrip']['audio']."&nbsp;<span class=\"fa fa-link\" onclick=\"redirectTo('".$data['transkrip']['audio']."')\"></span>" : 'Belum ada URL'; ?>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="textarea">Text URL</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          	<?= $data['transkrip']['text'] != null ? $data['transkrip']['text']."&nbsp;<span class=\"fa fa-link\" onclick=\"redirectTo('".$data['transkrip']['text']."')\"></span>" : 'Belum ada URL'; ?>
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