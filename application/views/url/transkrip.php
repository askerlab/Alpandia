        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Daftar Transkrip</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <?php if ( ! count($transkrip) > 0 || ! $transkrip): ?>
                    <h3 class="text-center">Data Transkrip masih kosong.</h3>
                    <?php else: ?>
                  	<?php 
                    foreach($transkrip as $i => $row): 
                    $thumbnail = $row->thumbnail ? 
                      $row->thumbnail : base_url().'images/no_image.png';
                    $mp4 = $row->file_video ?
                      $row->file_video : '#';
                    $mp3 = $row->file_audio ?
                      $row->file_audio : '#';
                    $text = $row->file_video ?
                      $row->file_text : '#';
                    ?>
                  		<div class="col-md-4 text-center" style="margin-top: 15px;">
                  			<img src="<?= $thumbnail ?>" class="img-responsive img-thumbnail">
                  			<p><?= $row->title; ?></p>
                  			<span><a href="<?= $mp4; ?>">File MP4</a></span><br/>
                  			<span><a href="<?= $mp3; ?>">File MP3</a></span><br/>
                  			<span><a href="<?= $text; ?>">File TXT</a></span><br/>
                  		</div>
              		<?php endforeach; ?>
                  <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->