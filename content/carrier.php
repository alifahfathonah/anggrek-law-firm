<?php
  $sql = mysqli_query($con, "SELECT * FROM cover WHERE id_cover='7'");
  $data1 = mysqli_fetch_assoc($sql);
?>
<section class="portfolio-header parallax parallax1" style="background:#000 url('<?= $base_url ?>img/cover/<?= $data1[gambar] ?>') 50% 0 no-repeat fixed;">
    <div class="yeye-overlay p-t-b-80" data-overlay-opacity="0.8">
        <div class="container">
            <div class="row">
                <p class="col-sm-12 text-light text-center" data-aos="fade-down" data-aos-delay="0"></p>
                <h2 class="text-light text-center emphasis" data-in-effect="fadeInUp">CAREER</h2>
                <p class="col-sm-12 text-light text-center" data-aos="fade-up" data-aos-delay="300"></p>
            </div>
        </div>
    </div>
</section>

<section class="single-post">
    <div class="container p-t-80">
        <div class="row">
            <?php
                $sql = mysqli_query($con, "SELECT * FROM carrier");
                while($data=mysqli_fetch_assoc($sql)){
                  $desk = strip_tags($data['deskripsi_carrier']);
                  $deskripsi = substr($desk,0,80);
            ?>
            <div class="col-md-9 col-xs-12" data-aos="fade">
              <article>
                <div class="col-md-2">
                  <a href="<?= $base_url ?>carrier/<?= $data['id_carrier']?>/<?= $data['judul_seo_carrier'] ?>"><img class="p-b-20" src="<?= $base_url ?>img/carrier/<?= $data['gambar_carrier'] ?>" alt="<?= $data['judul_seo_carrier'] ?>"></a>
                </div>
                <div class="col-md-10" >
                  <a href="<?= $base_url ?>karir-<?= $data['id_carrier']?>-<?= $data['judul_seo_carrier']?>"><h4 class="font-poppins emphasis"><?= $data['judul_carrier'] ?></h4></a>
                  <p>Kategori : <?= $data['kategori_carrier'] ?></p>
                  <p><?= $deskripsi ?></p>
                  <br>
                </div>
              </article>
            </div>
            <?php } ?>
            <?php
              include "sidebar.php";
            ?>
        </div>
    </div>
</section>
