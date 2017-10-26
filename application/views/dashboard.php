        
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="row top_tiles">
              <?php if ( strtolower($this->__content['actor']->name) == 'admin'): ?>
              <div class="animated flipInY col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-users"></i></div>
                  <div class="count"><?= $showdata['TotalUser'] - 1 ; ?></div>
                  <h3>Total User</h3>
                  <p>Pengguna sejauh ini.</p>
                </div>
              </div>
              <?php endif; ?>
              <div class="animated flipInY col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-link"></i></div>
                  <div class="count"><?= $showdata['TotalURL']; ?></div>
                  <h3>Total URL</h3>
                  <p>URL yang telah disubmit.</p>
                </div>
              </div>
              <div class="animated flipInY col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-link"></i></div>
                  <div class="count"><?= $showdata['URLSubmitToday']; ?></div>
                  <h3>URL Submit Today</h3>
                  <p>URL yang telah disubmit hari ini.</p>
                </div>
              </div>
              <div class="animated flipInY col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-link"></i></div>
                  <div class="count"><?= $showdata['URLRecorded']; ?></div>
                  <h3>URL Recorded</h3>
                  <p>URL yang sudah di submit sudah masuk ke database dan akan di proses oleh admin.</p>
                </div>
              </div>
              <div class="animated flipInY col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-link"></i></div>
                  <div class="count"><?= $showdata['URLProgress']; ?></div>
                  <h3>Download In Progress</h3>
                  <p>URL yang sudah di submit sedang di download oleh admin.</p>
                </div>
              </div>
              <div class="animated flipInY col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-link"></i></div>
                  <div class="count"><?= $showdata['URLSuccess']; ?></div>
                  <h3>URL Success</h3>
                  <p>URL yang sudah di submit sudah selesai dan berhasil di download.</p>
                </div>
              </div>
              <div class="animated flipInY col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-link"></i></div>
                  <div class="count"><?= $showdata['URLFailed']; ?></div>
                  <h3>URL Failed</h3>
                  <p>URL yang sudah di submit sudah selesai dan gagal untuk di download.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->