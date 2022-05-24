<?php
  $sql = mysqli_query($con, "SELECT * FROM cover WHERE id_cover='6'");
  $data1 = mysqli_fetch_assoc($sql);
?>
<section class="portfolio-header parallax parallax1" style="background:#000 url('<?= $base_url ?>img/cover/<?= $data1[gambar] ?>') 50% 0 no-repeat fixed;">
    <div class="yeye-overlay p-t-b-80" data-overlay-opacity="0.8">
        <div class="container">
            <div class="row">
                <p class="col-sm-12 text-light text-center" data-aos="fade-down" data-aos-delay="0"></p>
                <h2 class="text-light text-center emphasis" data-in-effect="fadeInUp">JOURNALS</h2>
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
                      $no = 0;
                      $sql = mysqli_query($con, "SELECT * FROM publication ORDER BY judul ASC");
                      while($data=mysqli_fetch_assoc($sql)){
                        $no++;
                    ?>
                    <div class="col-md-1">
                      <h5><?= $no."."; ?></h5>
                    </div>
                    <div class="col-md-7">
                      <h5><?= $data['judul'] ?></h5>
                    </div>
                    <div class="col-md-4">
                      <h5><a href="<?= $base_url ?>doc/<?= $data['document'] ?>" style="color: #009B4C"><i class="fa fa-download"></i> Download</a></h5>
                    </div>
                    <?php } ?>
                  </div>
                </article>
            </div>
            <?php
              include "sidebar.php";
            ?>
        </div>
    </div>
</section>
