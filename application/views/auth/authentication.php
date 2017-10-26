<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Masuk atau Daftar - <?= $this->AwesomeApp ?></title>

    <!-- Bootstrap -->
    <link href="<?= base_url(); ?>vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?= base_url(); ?>vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?= base_url(); ?>vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="<?= base_url(); ?>vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?= base_url(); ?>build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <?php if ( $this->session->flashdata('sessionMessage')): ?>
            <div class="alert alert-success" role="alert">
              <?= $this->session->flashdata('sessionMessage'); ?>    
            </div>
            <?php endif; ?>
            <form action="<?= base_url() ?>auth?method=login" method="post">
              <h1>Masuk<br/><small>Masuk untuk melanjutkan.</small></h1>
              <div>
                <input type="text" class="form-control" placeholder="Username" name="username" required="" autocomplete="off" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" name="password" required="" autocomplete="off" />
              </div>
              <div>
                <button class="btn btn-default submit" type="submit">Masuk</button>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Belum mempunyai akun?
                  <a href="#signup" class="to_register"> Buat akun </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <p>© 2017 All Rights Reserved.</p>
                </div>
              </div>
            </form>
          </section>
        </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <form action="<?= base_url() ?>auth?method=register" method="post">
              <h1>Buat akun<br/><small>Buat akun untuk melanjutkan.</small></h1>
              <div>
                <input type="text" class="form-control" placeholder="Nama Lengkap" name="fullName" required="" autocomplete="off" />
              </div>
              <div>
                <input type="text" class="form-control" placeholder="Username" name="username" required="" autocomplete="off" />
              </div>
              <div>
                <input type="email" class="form-control" placeholder="Email" name="email" required="" autocomplete="off" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" name="password" required="" autocomplete="off" />
              </div>
              <div>
                 <button class="btn btn-default submit" type="submit">Masuk</button>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Sudah memliki akun ?
                  <a href="#signin" class="to_register"> Masuk sekarang </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <p>©2017 All Rights Reserved.</p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>
