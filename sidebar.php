<div class="col-md-3 col-xs-12 widgets" data-aos="fade">
    <ul>
        <form action="<?= $base_url ?>search" method="GET">
        <li class="search">
            <input type="text" class="form-control" name="s">
            <button class="ion-search" type="submit"></button>
        </li>
        </form>
    </ul>
    <ul class="blog-widget">
        <li>
            <h5 class="widget-title">Recent Posts</h5></li>
        <li>
            <?php
              $sql = mysqli_query($con, "SELECT * FROM tbl_berita ORDER BY RAND() LIMIT 3");
              while($data = mysqli_fetch_assoc($sql)){
                $jud = strip_tags($data['judul']);
                $judul = substr($jud,0,40);
            ?>
            <div class="row">
                <a href="<?= $base_url ?>berita/<?= $data['judulseo'] ?>">
            <span class="col-xs-6"><img src="<?= $base_url ?>img/berita/<?= $data['gambar'] ?>" alt="<?= $data['judulseo'] ?>"></span>
            <div class="col-xs-6">
                <h6><?= $judul."..." ?></h6>
                <p class="text-light-gray"><small><?= tgl_indo($data['tanggal_upload']) ?></small></p>
            </div>
            </a>
            </div>
            <?php } ?>
        </li>
    </ul>
</div>
