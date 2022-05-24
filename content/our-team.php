<?php
  include "config/config_lang.php";
  $sql = mysqli_query($con, "SELECT * FROM cover WHERE id_cover='3'");
  $data1 = mysqli_fetch_assoc($sql);

  if($_SESSION['lang'] == 'bs'){
    $sql = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM our_team where language='bs'"));
   
  } else if($_SESSION['lang'] == 'en'){
    $sql = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM our_team where language='en'"));
    
  }
?>
<section class="portfolio-header parallax parallax1" style='background:#000 url("<?= $base_url ?>img/cover/<?= $data['gambar'] ?>") 100% 0 no-repeat fixed;'>
    <div class="yeye-overlay p-t-b-80" data-overlay-opacity="0.8">
        <div class="container">
            <div class="row">
                <p class="col-sm-12 text-light text-center" data-aos="fade-down" data-aos-delay="0"></p>
                <h2 class="text-light text-center emphasis" data-in-effect="fadeInUp"><?php echo $bahasa['our-team'] ?></h2>
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
                  <div class="row">
                    <?php

                      if($_SESSION['lang'] == 'bs'){
                        $sql = mysqli_query($con, "SELECT * FROM our_team where language='bs'");
                       
                      } else if($_SESSION['lang'] == 'en'){
                        $sql = mysqli_query($con, "SELECT * FROM our_team where language='en'");
                        
                      }
                    
                      while ($data=mysqli_fetch_assoc($sql)) {
                    ?>
                    <div class="col-md-4">
                      <div class="team">
                          <div class="people-profile">
                              <div class="image-frame">
                                  <img src="<?= $base_url ?>img/team/<?= $data['foto_team'] ?>" class="img-responsive" alt="<?= $data['nama_team'] ?>">
                              </div>
                          </div>
                          <div>
                              <a href="<?= $base_url ?>our-team/<?= $data['nama_team_seo'] ?>">
                                <h3 class="text-colored"><?= $data['nama_team'] ?></h3>
                              </a>
                              <p class="rank"><?= $data['jabatan_team'] ?></p>
                          </div>
                      </div>
                    </div>
                    <?php
                      }
                    ?>
                  </div>
                </article>
            </div>
            <?php
              include "sidebar.php";
            ?>
        </div>
    </div>
</section>
