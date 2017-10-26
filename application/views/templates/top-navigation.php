        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="<?= $this->avatar[strtolower($this->__content['actor']->name)]; ?>" alt=""><?= $this->__userdata->full_name; ?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="<?= base_Url(); ?>edit-profile"><i class="fa fa-edit pull-right"></i> Ubah Profil</a></li>
                    <li><a href="<?= base_Url(); ?>ubah-password"><i class="fa fa-lock pull-right"></i> Ganti Password</a></li>
                    <li><a href="<?= base_url() ?>logout"><i class="fa fa-sign-out pull-right"></i> Keluar</a></li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->