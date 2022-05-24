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

<section class="blogging blog p-t-b-80" id="section2">
    <div class="container">
        <div class="row">
          <?php
          $batas = 3; //jumlah data per halaman
							$pg = isset( $_GET['pg'] ) ? $_GET['pg'] : "";
							if (empty($pg)){
								$posisi=0;
								$pg=1;
							}else{
								$posisi= ($pg - 1) * $batas;
							}

          $jml_data = mysqli_query($con, "SELECT * FROM rubrik_hukum order by id_rubrik desc");
          $total = mysqli_num_rows($jml_data);
					$pages=ceil($total/$batas);

          $sql = mysqli_query($con,"SELECT * FROM rubrik_hukum where status='Y' order by id_rubrik desc LIMIT $posisi, $batas");
          while($data = mysqli_fetch_assoc($sql)){


              $jud = strip_tags($data['judul_rubrik']);
              $judul = substr($jud,0,1500);

              $desk = strip_tags($data['deskripsi_rubrik']);
              $deskripsi = substr($desk,0,180);
          ?>
            <div class="item col-sm-4 p-b-40">
                <div class="post row">
                    <div class="col-xs-12">
                        <a href="<?= $base_url ?>legal-rubric/<?= $data['judulseorubrik'] ?>"><img src="<?= $base_url ?>img/rubrik/<?= $data['gambar_rubrik'] ?>" alt="<?= $data['judulseorubrik'] ?>" class="img-responsive" style="width: 100%; height: 250px;"></a>
                        <br>
                        <div class="blog-info">
                            <span class="meta">
                            <span class="date-month"><?= tgl_indo($data['tgl_rubrik']) ?></span>
                            </span>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <h4 style="font-size: 18px;"><a href="<?= $base_url ?>legal-rubric/<?= $data['judulseorubrik'] ?>"><?= $judul ?></a></h4>
                        <p><?= $deskripsi ?></p>
                        <a class="read-more" href="<?= $base_url ?>legal-rubric/<?= $data['judulseorubrik'] ?>">Read More...</a>
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
                <div class="col-xs-3 p0 pull-left text-left"><a href="<?= $base_url ?>legal-rubric-hal-<?= ($pg - 1) ?>" class="ion-ios-arrow-thin-left icon-2x"></a></div>
                <?php
									}
 									?>
                <div class="col-xs-6 text-center">
                    <ul class="list-inline">
                      <?php
                      for($i=1; $i<=$pages; $i++){ ?>
                        <li class="blog-other-pages"><a class="text-light" href="<?= $base_url ?>legal-rubric-hal-<?= $i ?>"><?= $i ?></a></li>
                      <?php
  										 }
   									  ?>
                    </ul>
                </div>
                <?php
										if ($pg < $pages){
 									?>
                <div class="col-xs-3 p0 pull-right text-right"><a href="<?= $base_url ?>legal-rubric-hal-<?= ($pg + 1) ?>" class="ion-ios-arrow-thin-right icon-2x"></a></div>
                <?php } ?>
            </div>
        </div>
		 <article>
                  <div class="row">
                    <div class="col-md-12">
                      <br>
                      <h3><b>Have a question ?</b></h3>
                      <form method="POST" action="" data-toggle="validator">
                          <div class="row">
                              <div class="col-sm-12">
                                  <div class="form-group">
                                      <input type="text" class="form-control input-lg" id="judul" name="judul" placeholder="Judul*" required data-error="Judul tidak boleh kosong">
                                      <div class="help-block with-errors"></div>
                                  </div>
                              </div>
                              <div class="col-sm-12">
                                  <div class="form-group">
                                      <textarea id="editor" rows="10" class="form-control input-lg textarea" name="isi" placeholder="Isi*" required data-error="Isi tidak boleh kosong"></textarea>
                                      
									  <div class="help-block with-errors"></div>
                                  </div>
                              </div>
                          </div>
                          <div class="row">
                              <div class="form-submitted">
                                  <img class="svg-loader" src="<?= $base_url ?>img/assets/loader.svg" alt="loader message">
                              </div>
                          </div>
                          <button type="submit" name="kirim" class="btn btn-colored btn-lg center-block m-t-20">SEND</button>
                      </form>
                    </div>
                  </div>
                </article>
    </div>
</section>

<?php
  if (isset($_POST['kirim'])) {
    $tgl = date('Y-m-d');
    $jam = date('H:i:s');
    $judulseo = seo_title($_POST['judul']);
    $insert = mysqli_query($con, "INSERT INTO rubrik_hukum VALUES ('', '$_POST[judul]', '$_POST[isi]', '', '$tgl', '$jam', '$judulseo', '','N')");

    if($insert){ ?>
	 <script>
            alert('Data Berhasil Tersimpan');
            window.location='<?= $base_url ?>legal-rubric/';
              </script>
     
    <?php
    }
  }
 ?>
</div>
