<?php
   include "config/config_lang.php";

  $sql = mysqli_query($con, "SELECT * FROM cover WHERE id_cover='1'");
  $data = mysqli_fetch_assoc($sql);


if($_SESSION['lang'] == 'bs'){
    $tentang = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM tentangkami where language='bs'"));
   
  } else if($_SESSION['lang'] == 'en'){
    $tentang = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM tentangkami where language='en'"));
    
  }
 ?>
<section class="portfolio-header parallax parallax1" style='background:#000 url("<?= $base_url ?>img/cover/<?= $data['gambar'] ?>") 50% 0 no-repeat fixed;'>
    <div class="yeye-overlay p-t-b-70" data-overlay-opacity="0.8">
        <div class="container">
            <div class="row">
                <p class="col-sm-12 text-light text-center" data-aos="fade-down" data-aos-delay="0"></p>
                <h2 class="text-light text-center emphasis" data-in-effect="fadeInUp"><?php echo $bahasa['about-us'] ?></h2>
                <p class="col-sm-12 text-light text-center" data-aos="fade-up" data-aos-delay="300"></p>
            </div>
        </div>
    </div>
</section>
<section id="about" class="p-t-b-80">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-xs-12 m-t-b-30 text-center">
                <?= $tentang['isi'] ?>
				
				<a href="<?= $tentang['download'] ?>" target="_blank" class="btn btn-primary btn-flat">Download Company Profile</a>
            </div>
        </div>
    </div>
</section>
