<?php
include "config/config_lang.php";

  $sql = mysqli_query($con, "SELECT * FROM cover WHERE id_cover='4'");
  $data1 = mysqli_fetch_assoc($sql);
?>
<section class="portfolio-header parallax parallax1" style="background:#000 url('<?= $base_url ?>img/cover/<?= $data1[gambar] ?>') 50% 0 no-repeat fixed;">
    <div class="yeye-overlay p-t-b-80" data-overlay-opacity="0.8">
        <div class="container">
            <div class="row">
                <p class="col-sm-12 text-light text-center" data-aos="fade-down" data-aos-delay="0"></p>
                <h2 class="text-light text-center emphasis" data-in-effect="fadeInUp"><?php echo $bahasa['legal-info-&-news'] ?></h2>
                <p class="col-sm-12 text-light text-center" data-aos="fade-up" data-aos-delay="300"></p>
            </div>
        </div>
    </div>
</section>

<section class="blogging blog p-t-b-80" id="section2">
    <div class="container">
        <div class="row">
          <?php
          $batas = 9; //jumlah data per halaman
							$pg = isset( $_GET['pg'] ) ? $_GET['pg'] : "";
							if (empty($pg)){
								$posisi=0;
								$pg=1;
							}else{
								$posisi= ($pg - 1) * $batas;
							}

          $jml_data = mysqli_query($con, "SELECT * FROM tbl_berita");
          $total = mysqli_num_rows($jml_data);
					$pages=ceil($total/$batas);

          $sql = mysqli_query($con,"SELECT * FROM tbl_berita ORDER BY tanggal_upload DESC LIMIT $posisi, $batas");
          while($data = mysqli_fetch_assoc($sql)){


              $jud = strip_tags($data['judul']);
              $judul = substr($jud,0,70)."...";

              $desk = strip_tags($data['deskripsi']);
              $deskripsi = substr($desk,0,180);
          ?>
            <div class="item col-sm-4 p-b-40">
                <div class="post row">
                    <div class="col-xs-12">
                        <a href="<?= $base_url ?>news/<?= $data['judulseo'] ?>"><img src="<?= $base_url ?>img/berita/<?= $data['gambar'] ?>" alt="<?= $data['judulseo'] ?>" class="img-responsive" style="width: 100%; height: 250px;"></a>
                        <br>
                        <div class="blog-info">
                            <span class="meta">
                            <span class="date-month"><?= tgl_indo($data['tanggal_upload']) ?></span>
                            </span>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <h4 style="font-size: 18px;"><a href="<?= $base_url ?>news/<?= $data['judulseo'] ?>"><?= $judul ?></a></h4>
                        <p><?= $deskripsi ?></p>
                        <a class="read-more" href="<?= $base_url ?>news/<?= $data['judulseo'] ?>"><?php echo $bahasa['view-all'] ?></a>
                    </div>
                </div>
            </div>
           <?php } ?>
        </div>
        <div class="row">
            <div class="blog-nav p-t-b-80">
                <?php
                  if($pg > 1) {
                ?>
                <div class="col-xs-3 p0 pull-left text-left"><a href="<?= $base_url ?>news-hal-<?= ($pg - 1) ?>" class="ion-ios-arrow-thin-left icon-2x"></a></div>
                <?php
									}
 									?>
                <div class="col-xs-6 text-center">
                    <ul class="list-inline">
                      <?php
                      for($i=1; $i<=$pages; $i++){ ?>
                        <li class="blog-other-pages"><a class="text-light" href="<?= $base_url ?>news-hal-<?= $i ?>"><?= $i ?></a></li>
                      <?php
  										 }
   									  ?>
                    </ul>
                </div>
                <?php
										if ($pg < $pages){
 									?>
                <div class="col-xs-3 p0 pull-right text-right"><a href="<?= $base_url ?>news-hal-<?= ($pg + 1) ?>" class="ion-ios-arrow-thin-right icon-2x"></a></div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>
