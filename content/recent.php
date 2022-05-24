<?php
include "config/config_lang.php";
?>
<section class="portfolio-header parallax parallax1" style="background: #000 url('<?= $base_url ?>img/backgrounds/bg-dark3.jpg') 50% 0 no-repeat fixed;">
    <div class="yeye-overlay p-t-b-80" data-overlay-opacity="0.8">
        <div class="container">
            <div class="row">
                <p class="col-sm-12 text-light text-center" data-aos="fade-down" data-aos-delay="0"></p>
                <h2 class="text-light text-center emphasis" data-in-effect="fadeInUp"><?php echo $lang['recent-success-story'] ?></h2>
                <p class="col-sm-12 text-light text-center" data-aos="fade-up" data-aos-delay="300"></p>
            </div>
        </div>
    </div>
</section>

<section class="single-post">
    <div class="container p-t-80">
        <div class="row">
          <div class="col-md-9 col-xs-12" data-aos="fade">
              <article>
                  <?php
                    $sql = mysqli_query($con, "SELECT * FROM tbl_recent order by id_rec desc");
                    while($recent=mysqli_fetch_array($sql)){
                  ?>
                  <p><?= $recent['deskripsi_rec'] ?></p>
                  <hr>
                  <?php } ?>
              </article>
          </div>
            <?php
              include "sidebar.php";
            ?>
        </div>
    </div>
</section>
