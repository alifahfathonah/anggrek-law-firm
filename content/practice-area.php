<?php
  $sql = mysqli_query($con, "SELECT * FROM practice_area WHERE judulseo_practice='$_GET[seo]'");
  $data = mysqli_fetch_assoc($sql);
    $id_practice = $data['id_practice'];
?>
<section class="portfolio-header parallax parallax1" style="background:#000 url('<?= $base_url ?>img/areapraktis/<?= $data[cover_practice] ?>') 50% 0 no-repeat fixed;">
    <div class="yeye-overlay p-t-b-80" >
        <div class="container">
            <div class="row">
                <p class="col-sm-12 text-light text-center" data-aos="fade-down" data-aos-delay="0"></p>
                <h2 class="text-light text-center emphasis" data-in-effect="fadeInUp"><?= strtoupper($data['judul_practice']) ?></h2>
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
				<p> <?= $data['narasi'] ?></p><br>
				<?php
				
				if($_SESSION['lang'] == 'bs'){
                        $sql1 = mysqli_query($con, "SELECT * FROM practice_area_detail  where id_practice='$id_practice' AND language='bs' ");
                       
                       
                      } else if($_SESSION['lang'] == 'en'){
                        $sql1 = mysqli_query($con, "SELECT * FROM practice_area_detail  where id_practice='$id_practice' AND language='en' ");
                        
                      }
				
                    // $sql1= mysqli_query($con, "SELECT * FROM practice_area_detail WHERE id_practice='$id_practice'");
                    while($data1=mysqli_fetch_assoc($sql1)){
                         
                  ?>
                  
				 
                  
                  <div class="row">
				 
                    <div class="col-lg-3">
                      <img src="<?= $base_url ?>img/areapraktis/deskripsi/<?= $data1['gambar_practice_detail'] ?>">
                    </div>
                    <div class="col-lg-8 col-md-offset-1" style="border-left: 3px solid #009B4C;">
					
                        <?= $data1['deskripsi_detail'] ?>
                    </div>
                  </div>
                  <br><br><br><br>
                  <?php } ?>
                </article>
            </div>
            <?php
              include "sidebar.php";
            ?>
        </div>
    </div>
</section>
