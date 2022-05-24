<?php
  $carrier = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM carrier WHERE id_carrier='$_GET[id]'"));
 ?>
<section class="portfolio-header parallax parallax1" style="background:#000 url('<?= $base_url ?>img/backgrounds/bg-dark3.jpg') 50% 0 no-repeat fixed;">
    <div class="yeye-overlay p-t-b-80" data-overlay-opacity="0.8">
        <div class="container">
            <div class="row">
                <p class="col-sm-12 text-light text-center" data-aos="fade-down" data-aos-delay="0"></p>
                <h1 class="text-light text-center emphasis" data-in-effect="fadeInUp">CAREER</h1>
                <p class="col-sm-12 text-light text-center" data-aos="fade-up" data-aos-delay="300"></p>
            </div>
        </div>
    </div>
</section>

<section class="single-post">
    <div class="container p-t-80">
        <div class="row">
          <div class="col-md-9 col-xs-12" data-aos="fade">
              <article><img class="p-b-20" src="<?= $base_url ?>img/carrier/<?= $carrier['gambar_carrier'] ?>" alt="<?= $carrier['judul_seo_carrier'] ?>" width=400>
                  <h2 class="font-poppins emphasis"><?= $carrier['judul_carrier'] ?></h2>
                  <p><i class="fa fa-clock-o"></i> <?= tgl_indo($carrier['tgl_upload_carrier'] )?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  Kategori : <?= $carrier['kategori_carrier'] ?></p>
                  <p><?= $carrier['deskripsi_carrier'] ?></p>
                  <br>
              </article>
          </div>
            <?php
              include "sidebar.php";
            ?>
        </div>
    </div>
</section>
