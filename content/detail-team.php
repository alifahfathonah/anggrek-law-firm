<?php
  $team = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM our_team WHERE nama_team_seo='$_GET[id]'"));
 ?>
 <?php
  $sql = mysqli_query($con, "SELECT * FROM cover WHERE id_cover='3'");
  $data1 = mysqli_fetch_assoc($sql);
?>
<section class="portfolio-header parallax parallax1" style="background:#000 url('<?= $base_url ?>img/cover/<?= $data1[gambar] ?>') 50% 0 no-repeat fixed;">
    <div class="yeye-overlay p-t-b-80" data-overlay-opacity="0.8">
        <div class="container">
            <div class="row">
                <p class="col-sm-12 text-light text-center" data-aos="fade-down" data-aos-delay="0"></p>
                <h2 class="text-light text-center emphasis" data-in-effect="fadeInUp">OUR TEAM</h2>
                <p class="col-sm-12 text-light text-center" data-aos="fade-up" data-aos-delay="300"></p>
            </div>
        </div>
    </div>
</section>

<section class="single-post">
    <div class="container p-t-80">
        <div class="row">
          <div class="col-md-9 col-xs-12" data-aos="fade">
		  <table width="100%">
		  <tr>
		  <td width="30%"><img class="p-b-20" src="<?= $base_url ?>img/team/<?= $team['foto_team'] ?>" alt="Miko Kamal" width="90%"></td>
		  <td width="86%"> <p><?= $team['biografi_team'] ?></p></td>
		  </tr>
		  <tr>
		  <td><?= $team['keterangan'] ?></td><td></td>
		  </tr>
		  </table>
		  
             
          </div>
            <?php
              include "sidebar.php";
            ?>
        </div>
    </div>
</section>
