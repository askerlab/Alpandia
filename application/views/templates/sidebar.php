            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a href="<?= base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
                  <li><a><i class="fa fa-link"></i> URL <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?= base_url() ?>url/manage">Kelola URL</a></li>
                      <li><a href="<?= base_url() ?>url/submit">Submit URL</a></li>
                    </ul>
                  </li>
                  <li><a href="<?= base_url(); ?>url/transkrip"><i class="fa fa-link"></i> Lihat Transkrip</a></li>
                  <?php if ( strtolower($this->__content['actor']->name) == 'admin'): ?>
                  <li><a><i class="fa fa-user"></i> Pengguna <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?= base_url() ?>user/add">Tambah User</a></li>
                      <li><a href="<?= base_url() ?>user/manage">Kelola User</a></li>
                    </ul>
                  </li>
                  <?php endif; ?>
                  <li><a href="<?= base_url(); ?>logout"><i class="fa fa-sign-out"></i> Keluar</a></li>
                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->