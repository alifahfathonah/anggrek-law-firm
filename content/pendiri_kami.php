<?php
    include "config/config_lang.php";
  $sql = mysqli_query($con, "SELECT * FROM cover WHERE id_cover='2'");
  $data = mysqli_fetch_assoc($sql);
?>
<?php

if($_SESSION['lang'] == 'bs'){
    $pendiri = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM pendiri_kami where language='bs'"));
   
  } else if($_SESSION['lang'] == 'en'){
    $pendiri = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM pendiri_kami where language='en'"));
    
  }
  
 ?>                                                  
<section class="portfolio-header parallax parallax1" style='background:#000 url("<?= $base_url ?>img/cover/<?= $data['gambar'] ?>") 50% 0 no-repeat fixed;'>
    <div class="yeye-overlay p-t-b-80" data-overlay-opacity="0.8">
        <div class="container">
            <div class="row">
                <p class="col-sm-12 text-light text-center" data-aos="fade-down" data-aos-delay="0"></p>
                <h2 class="text-light text-center emphasis" data-in-effect="fadeInUp"><?php echo $bahasa['our-founder'] ?></h2>
                <p class="col-sm-12 text-light text-center" data-aos="fade-up" data-aos-delay="300"></p>
            </div>
        </div>
    </div>
</section>

<section class="single-post">
    <div class="container p-t-80">
        <div class="row">
          <div class="col-md-9 col-xs-12" data-aos="fade">
              <article><img class="p-b-20" src="<?= $base_url ?>img/team/<?= $pendiri['foto_pendiri'] ?>" alt="Miko Kamal">
                  <h2 class="font-poppins emphasis"><?= $pendiri['nama_pendiri'] ?></h2>
                  <br>
                  <p><?= $pendiri['deskripsi_pendiri'] ?></p>
                  <br>
              </article>
          </div>
            <?php
              include "sidebar.php";
            ?>
        </div>
    </div>
</section>
