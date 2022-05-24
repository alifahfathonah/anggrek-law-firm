<?php
  $carrier = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM rubrik_hukum WHERE judulseorubrik='$_GET[id]'"));
 ?>
 <?php
  $sql = mysqli_query($con, "SELECT * FROM cover WHERE id_cover='5'");
  $data1 = mysqli_fetch_assoc($sql);
?>
<section class="portfolio-header parallax parallax1" style="background:#000 url('<?= $base_url ?>img/cover/<?= $data1[gambar] ?>') 50% 0 no-repeat fixed;">
    <div class="yeye-overlay p-t-b-80" data-overlay-opacity="0.8">
        <div class="container">
            <div class="row">
                <p class="col-sm-12 text-light text-center" data-aos="fade-down" data-aos-delay="0"></p>
                <h2 class="text-light text-center emphasis" data-in-effect="fadeInUp">LEGAL RUBRIC</h2>
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
                     if($carrier['gambar_rubrik']==''){
                        echo "";
                    }else{
                  ?>
                  <img src="<?= $base_url ?>img/rubrik/<?= $carrier['gambar_rubrik'] ?>" alt="<?= $carrier['judul_rubrik'] ?>" width="400">
                  <?php
                    }
                  ?>
                  <h3 class="font-poppins emphasis"><?= $carrier['judul_rubrik'] ?></h3>
                  <br>
                  <p style="color: #009B4C; font-weight: bold;">Pertanyaan : </p>
                  <p><?= $carrier['deskripsi_rubrik'] ?></p>
                  <br>
                  <p style="color: #009B4C; font-weight: bold;">Jawaban : </p>
                  <p><?= @$carrier['reply_rubrik'] ?></p>
                  <br>
              </article>
              <br>
          </div>
            <?php
              include "sidebar.php";
            ?>
        </div>
    </div>
</section>
