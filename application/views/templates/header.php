<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= $this->AwesomeApp; ?></title>

    <!-- Bootstrap -->
    <link href="<?= $base_url ?>vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?= $base_url ?>vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="<?= $base_url ?>build/css/custom.min.css" rel="stylesheet">

    <!-- Sweetalert -->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>build/css/sweetalert.css">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="<?= base_url(); ?>" class="site_title text-center"><span><?= $this->AwesomeApp ?></span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="<?= $this->avatar[strtolower($this->__content['actor']->name)]; ?>" alt="<?= $this->__content['actor']->name; ?>" class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Selamat Datang,</span>
                <h2><?= $this->__userdata->full_name; ?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <?php include "sidebar.php"; ?>

          </div>
        </div>

        <?php include "top-navigation.php"; ?>