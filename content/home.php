
<?php
    include "config/config_lang.php";
    if($_SESSION['lang'] == 'bs'){
      $tentang = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM tentangkami where language='bs'"));
      $recent = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM tbl_recent where language='bs' ORDER BY id_rec DESC"));
    } else if($_SESSION['lang'] == 'en'){
      $tentang = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM tentangkami where language='en'"));
      $recent = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM tbl_recent where language='en' ORDER BY id_rec DESC"));
    }
    $isi = $tentang['isi'];
    $isi_tentang = substr($isi,0,500)."...";
    $desk = $recent['deskripsi_rec'];
    $deskripsi = $desk;
    include "slider.php";
 ?>
 
 <section id="portfolio" class="bg-light-gray p-t-b-80">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 text-justify">
               
              <div class="row">
                <h3 style="background-color: #009B4C; padding: 5px; color: #fff; font-weight: bold;"><?php echo $bahasa['office-profile'] ?></h3>
                <br>
              </div>
              <?= $isi_tentang ?>
                <div class="row text-center">
                    <a class="text-center btn btn-lg btn-colored m-t-60" href="<?= $base_url ?>about-us/"><?php echo $bahasa['find-more'] ?></a>
                </div>
            </div>
            <div class="col-lg-6">
            <div class="row">
              <h3 style="background-color: #009B4C; padding: 5px; color: #fff; font-weight: bold;"><?php echo $bahasa['recent-success-story'] ?></h3>
            </div>
            <br>
              <?= $deskripsi ?>
              <div class="row text-center">
                  <a class="text-center btn btn-lg btn-colored m-t-10" href="<?= $base_url ?>recent-success-story/"><?php echo $bahasa['view-all'] ?></a>
              </div>
           </div>
        </div>
    </div>
 </section>

 <section id="portfolio" class="p-t-b-80">
     <div class="container">
         <h2 class="text-dark text-center" data-aos="fade"><?php echo $bahasa['practice-area'] ?></span></h2>
     </div>
    <br><br>
     <div class="container" id="filterizr">
         <div class="col-xs-12">
             <div class="filtr-container" data-aos="fade-up" data-aos-delay="0">
                <?php
                
                
                if($_SESSION['lang'] == 'bs'){
                        $sql = mysqli_query($con, "SELECT * FROM practice_area  where language='bs' ");
                       
                       
                      } else if($_SESSION['lang'] == 'en'){
                        $sql = mysqli_query($con, "SELECT * FROM practice_area  where language='en' ");
                        
                      }
				
                //   $sql = mysqli_query($con, "SELECT * FROM practice_area");
                  while($data=mysqli_fetch_assoc($sql)){
                ?>
                 <div class="col-xs-12 col-sm-6 col-md-4 filtr-item p-b-40" data-category="1, 3">
                     <a href="<?= $base_url ?>practice-area/<?= $data['judulseo_practice'] ?>">
                         <div class="portfolio-gallery">
                             <figure>
                                 <div class="image-wrap">
                                     <img src="<?= $base_url ?>img/areapraktis/<?= $data['gambar_practice'] ?>" alt="<?= $data['judulseo_practice'] ?>" />
                                     <div class="portfolio-dark-on-hover"></div>
                                     <p><?= $data['judul_practice'] ?></p>
                                 </div>
                                  <h4 class="text-center"><?= $data['judul_practice'] ?></h4>
                             </figure>
                         </div>
                     </a>
                 </div>
                <?php } ?>
             </div>
         </div>
     </div>
 </section>

<section class="bg-light-gray p-t-b-80 blogging blog">
    <div class="container">
      <div class="row">
          <div class="col-lg-6">
            <div class="row">
              <h3 style="background-color: #009B4C; padding: 5px; color: #fff; font-weight: bold;"><?php echo $bahasa['code-overview'] ?></h3>
            </div>
            <br><br>
            <ul class="bxslider">
              <?php
                $sql = mysqli_query($con, "SELECT * FROM code_overview ORDER BY id_code DESC LIMIT 2");
                while($data=mysqli_fetch_assoc($sql)){
                  $jud = strip_tags($data['judul']);
                  $judul = substr($jud,0,55)."...";

                  $desk = strip_tags($data['deskripsi']);
                  $deskripsi = substr($desk,0,300)."...";
              ?>
              <li>
              <a href="<?= $base_url ?>code-overview/<?= $data['judulseo'] ?>"><img src="<?= $base_url ?>img/codeoverview/<?= $data['gambar'] ?>" alt="<?= $data['judulseo'] ?>" class="img-responsive" style="width: 100%; height: 445px;"></a>
                  <a href="<?= $base_url ?>code-overview//<?= $data['judulseo'] ?>">
                    <h4 style="position : relative; top: -100px; margin-top: -115px; text-align: center; color: #fff; background-color: rgba(0, 0, 0, 0.50); padding: 5px;"><?= $judul ?></h4>
                  </a>
              </li>
            <?php } ?>
            </ul>
            <div class="row text-center">
                <a class="text-center btn btn-lg btn-colored m-t-40" href="<?= $base_url ?>code-overview//"><?php echo $bahasa['find-more'] ?></a>
            </div>
         </div>









          <div class="col-lg-6">
            <div class="row">
              <h3 style="background-color: #009B4C; padding: 5px; color: #fff; font-weight: bold;"><?php echo $bahasa['legal-info-&-news'] ?></h3>
            </div>
            <br><br>
            <ul class="bxslider">
              <?php
                $sql = mysqli_query($con, "SELECT * FROM tbl_berita ORDER BY tanggal_upload DESC LIMIT 5");
                while($data=mysqli_fetch_assoc($sql)){
                    $date = $data['tanggal_upload'];
                    $pecah = explode("-", $date);
                    $tgl = $pecah[2];
                    $blnthn = tgl_indo($data['tanggal_upload']);
                    $bulantahun = substr($blnthn,3,100);

                    $jud = strip_tags($data['judul']);
                    $judul = substr($jud,0,100);

                    $desk = strip_tags($data['deskripsi']);
                    $deskripsi = substr($desk,0,80);
              ?>
              <li>
                  <img src="<?= $base_url ?>img/berita/<?= $data['gambar'] ?>" style="width : 100%; height: 30em;"/>
                  <a href="<?= $base_url ?>news/<?= $data['judulseo'] ?>">
                    <h4 style="position : relative; top: -100px; margin-top: -115px; text-align: center; color: #fff; background-color: rgba(0, 0, 0, 0.50); padding: 5px;"><?= $judul ?></h4>
                  </a>
              </li>
            <?php } ?>
            </ul>
            <div class="row text-center">
                <a class="text-center btn btn-lg btn-colored m-t-40" href="<?= $base_url ?>news/"><?php echo $bahasa['find-more'] ?></a>
            </div>
         </div>
      </div>
    </div>
</section>

<section class="p-t-b-80">
  <div class="container p-b-40">
      <div>
          <h2 class="text-dark text-center" data-aos="fade"><?php echo $bahasa['our-client'] ?></h2>
      </div>
  </div>
    <div class="container">
        <div class="row logos-carousel owl-carousel owl-theme" style="margin:auto" data-aos="fade" data-aos-delay="0">
            <?php
              $sql = mysqli_query($con, "SELECT * FROM our_partner");
              while($data1 = mysqli_fetch_assoc($sql)){
            ?>
            <div class="item col-sm-12"><img src="img/partner/<?= $data1['foto_partner']?>" alt="client-image1" class="img-responsive" style="width: 200px; height: 75px;"></div>
            <?php } ?>
        </div>
    </div>
</section>
<section class="p-t-b-80 bg-colored">
     <div class="container">
         <div>
             <h2 class="text-light text-center"><span class="emphasis"><?php echo $bahasa['download'] ?></span></h2>
            
             <center><a class="btn btn-white btn-lg" href="img/MKAPP.apk">Download</a></center>
         </div>
     </div>
 </section>
 
<section class="p-t-b-80">
    <div class="container p-b-40">
          <div>
              <h2 class="text-dark text-center" data-aos="fade"><?php echo $bahasa['testimony'] ?></h2>
          </div>
      </div>
          <div class="container">
            <div class="row logos-carousel owl-carousel owl-theme" style="margin:auto" data-aos="fade" data-aos-delay="0">
               <?php
                  $sql = mysqli_query($con, "SELECT * FROM testimoni");
                  while($data=mysqli_fetch_assoc($sql)){
                ?>
                  
                  <p class="text-info" data-animation="animated fadeInUp"> 
                    <img src="img/testimoni/<?= $data['foto_testi']?>" alt="<?= $data['nama_testi'] ?>" class="img-responsive" style="width: 100px; height: px;"> 
                    <b><?= $data['nama_testi']  ?></b> <br>  <?= $data['profesi_testi'] ?>  <br><br> <?= $data['deskripsi_testi'] ?>  </p>
                                 
                <?php } ?>
            </div>
        </div>
 </section>

<section class="p-t-b-80 bg-colored">
     <div class="container">
         <div>
             <h2 class="text-light text-center"><span class="emphasis"><?php echo $bahasa['free-consultation'] ?></span></h2>
             <h2 class="text-light text-center"><?php echo $bahasa['what-on-your-mind'] ?></h2>
             <h3 class="text-light text-center"><?php echo $bahasa['get-your-free-consultation-today'] ?></h3>
             <center><a class="btn btn-white btn-lg" href="<?= $base_url ?>legal-rubric/"><?php echo $bahasa['make-it-now'] ?></a></center>
         </div>
     </div>
 </section>

<!-- Map -->
<section class="maps" id="maps">
    <h1 class="hide_me">Map</h1>
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.2745373753387!2d100.35658401413346!3d-0.9459731356149049!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2fd4b937b7b03a01%3A0xe4e6a279e63bf46b!2sMiko+Kamal+%26+Associates!5e0!3m2!1sen!2sid!4v1536121323264" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
</section>
<?php
  // Statistik user
  $ip      = $_SERVER['REMOTE_ADDR']; // Mendapatkan IP komputer user
  $tanggal = date("Ymd"); // Mendapatkan tanggal sekarang
  $waktu   = time(); // 

  // Mencek berdasarkan IPnya, apakah user sudah pernah mengakses hari ini 
  $s = mysqli_query($con,"SELECT * FROM statistik WHERE ip='$ip' AND tanggal='$tanggal'");
  // Kalau belum ada, simpan data user tersebut ke database
  if(mysqli_num_rows($s) == 0){
    mysqli_query($con,"INSERT INTO statistik(ip, tanggal, hits, online) VALUES('$ip','$tanggal','1','$waktu')");
  } 
  else{
    mysqli_query($con,"UPDATE statistik SET hits=hits+1, online='$waktu' WHERE ip='$ip' AND tanggal='$tanggal'");
  }

  $pengunjung       = mysqli_num_rows(mysqli_query($con,"SELECT * FROM statistik WHERE tanggal='$tanggal' GROUP BY ip"));
  // $totalpengunjung  = mysql_result(mysqli_query($con,"SELECT COUNT(hits) FROM statistik"), 0); 
  $hits             = mysqli_fetch_assoc(mysqli_query($con,"SELECT SUM(hits) as hitstoday FROM statistik WHERE tanggal='$tanggal' GROUP BY tanggal")); 
  // $totalhits        = mysql_result(mysqli_query($con,"SELECT SUM(hits) FROM statistik"), 0); 
  // $tothitsgbr       = mysql_result(mysqli_query($con,"SELECT SUM(hits) FROM statistik"), 0); 
  $bataswaktu       = time() - 300;
  $pengunjungonline = mysqli_num_rows(mysqli_query($con,"SELECT * FROM statistik WHERE online > '$bataswaktu'"));

  $path = "counter/";
  $ext = ".png";

  $hits = sprintf("%06d", $hits);
  for ( $i = 0; $i <= 9; $i++ ){
	   $hits = str_replace($i, "<img src='$path$i$ext' alt='$i'>", $hits);
  }

 
  ?>
