<?php
  $recent = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM tbl_recent WHERE judulseo_rec='$_GET[id]'"));
 ?>
<section class="portfolio-header parallax parallax1" style="background:#000 url('<?= $base_url ?>img/backgrounds/bg-dark3.jpg') 50% 0 no-repeat fixed;">
    <div class="yeye-overlay p-t-b-80" data-overlay-opacity="0.8">
        <div class="container">
            <div class="row">
                <p class="col-sm-12 text-light text-center" data-aos="fade-down" data-aos-delay="0"></p>
                <h1 class="text-light text-center emphasis" data-in-effect="fadeInUp">NEWS</h1>
                <p class="col-sm-12 text-light text-center" data-aos="fade-up" data-aos-delay="300"></p>
            </div>
        </div>
    </div>
</section>

<section class="single-post">
    <div class="container p-t-80">
        <div class="row">
          <div class="col-md-9 col-xs-12" data-aos="fade">
              <article><img class="p-b-20" src="<?= $base_url ?>img/recent/<?= $recent['gambar_rec'] ?>" alt="<?= $recent['judul_rec'] ?>">
                  <h3 class="font-poppins emphasis"><?= $recent['judul_rec'] ?></h3>
                  <p><i class="fa fa-clock-o"></i> <?= tgl_indo($recent['tanggal_upload_rec'] )?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
                  <p><?= $recent['deskripsi_rec'] ?></p>
                  <br>
              </article>
          </div>
            <?php
              include "sidebar.php";
            ?>
        </div>
    </div>
</section>
