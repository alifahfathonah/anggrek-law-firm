<div id="myCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <?php
        $slide = mysqli_fetch_assoc(mysqli_query($con,"SELECT COUNT(*) AS jml FROM slider WHERE status='Y'"));
        
        $jml = $slide['jml'];
        for($i=0; $i < $jml; $i++){
    ?>
    <li data-target="#myCarousel" data-slide-to="<?php echo $i; ?>" <?php if($i== 0) { echo "class=active"; } ?>></li>
    <?php } ?>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
      	<?php  
	       $slider = mysqli_query($con, "SELECT * FROM slider WHERE status='Y' ORDER BY id_slider ASC");
	       $dslider = mysqli_fetch_assoc($slider);
		?>	
        <div class="item active">
          <img src="img/homeslider/<?= $dslider['gambar']?>"  alt="blog-post" class="image-responsive">
          
          <div class="carousel-caption">
            <?php
              $sql = mysqli_query($con, "SELECT * FROM logo WHERE id_slider='$dslider[id_slider]'");
              $data = mysqli_fetch_assoc($sql);
            ?>
               <?php if($data['img_logo'] != ''){?>
               <img src="<?= $base_url ?>img/<?= $data['img_logo'] ?>" alt="<?= $data['judul_button'] ?>" width=500 style="margin: 160px auto 60px; position: relative; top: -140px;">
               <?php } ?>
               <h3 class="text-light text-center" style="position: relative; top: -140px;"><?= $data['text'] ?></h3>
            
          <?php if($data['link_button']!=''){ ?>
            <a class="text-center btn btn-lg btn-colored m-t-40" href="<?= $base_url ?><?= $data['link_button'] ?>/" style="background: #a60202; position: relative; top: -140px;"><?= $data['judul_button'] ?></a>
          <?php } ?>
          </div>
        </div>
        
        <?php 
	        $slid = mysqli_query($con, "SELECT * FROM slider WHERE id_slider NOT IN ('$dslider[id_slider]') AND status='T'");
	        while($dslide = mysqli_fetch_assoc($slider)){
        ?>
        <div class="item">
          <img src="img/homeslider/<?= $dslide['gambar']?>"  alt="blog-post" class="image-responsive">
          
          <div class="carousel-caption">
                <?php
                    $sql1 = mysqli_query($con, "SELECT * FROM logo WHERE id_slider='$dslide[id_slider]'");
                    $data1 = mysqli_fetch_assoc($sql1);
                ?>
               <?php if($data1['img_logo'] != ''){?>
               <img src="<?= $base_url ?>img/<?= $data1['img_logo'] ?>" alt="<?= $data1['judul_button'] ?>" width=500 style="margin: 160px auto 60px; position: relative; top: -140px;">
               <?php } ?>
               <h3 class="text-light text-center" style="position: relative; top: -140px;"><?= $data1['text'] ?></h3>
            
          <?php if($data1['link_button']!=''){ ?>
            <a class="text-center btn btn-lg btn-colored m-t-40" href="<?= $base_url ?><?= $data1['link_button'] ?>/" style="background: #a60202; position: relative; top: -140px;"><?= $data1['judul_button'] ?></a>
          <?php } ?>
          </div>
        </div>
        <?php } ?>
        
  </div>

  <!-- Left and right controls -->
  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
