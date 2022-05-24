<?php
  $berita = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) AS jberita FROM tbl_berita"));
  $message = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) AS jmessage FROM contact_person"));
  $rubrik = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) AS jrubrik FROM rubrik_hukum"));
  $pub = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) AS jpub FROM publication"));
  $carrier = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) AS jcarrier FROM carrier"));
  $testimoni = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) AS jtestimoni FROM testimoni"));

 ?>
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Dashboard
            <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"> Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <?php
              if($_SESSION['level']=='superadmin'){
            ?>
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">

                <div class="inner">
                  <h3><?= $rubrik['jrubrik'] ?></h3>
                  <p>Rubrik Hukum</p>
                </div>
                <div class="icon">
                  <i class="fa fa-question-circle"></i>
                </div>
                <a href="?module=rubrik_hukum" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->

            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3><?= $berita['jberita'] ?></h3>
                  <p>Berita</p>
                </div>
                <div class="icon">
                  <i class="fa fa-list"></i>
                </div>
                <a href="?module=berita" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->

            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">

                <div class="inner">
                  <h3><?= $pub['jpub'] ?></h3>
                  <p>Publication</p>
                </div>
                <div class="icon">
                  <i class="fa fa-book"></i>
                </div>
                <a href="?module=publication" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">

                <div class="inner">
                  <h3><?= $carrier['jcarrier'] ?></h3>
                  <p>Carrier</p>
                </div>
                <div class="icon">
                  <i class="fa fa-newspaper-o"></i>
                </div>
                <a href="?module=carrier" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <h3><?= $message['jmessage'] ?></h3>
                  <p>Message</p>
                </div>
                <div class="icon">
                  <i class="fa fa-envelope"></i>
                </div>
                <a href="?module=message" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->

            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3><?= $testimoni['jtestimoni'] ?></h3>
                  <p>Testimoni</p>
                </div>
                <div class="icon">
                  <i class="fa fa-envelope"></i>
                </div>
                <a href="?module=testimoni" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>

                    <div class="box-footer">
            <div class="form-group">

  <script src="../assets/a/jquery.min.js" type="text/javascript"></script>
  <script src="../assets/a/highcharts.js" type="text/javascript"></script>
  <script type="text/javascript">
  
  var chart1;
  $(document).ready(function() {
    chart1 = new Highcharts.Chart({
      chart: {
              renderTo: 'container',
              type: 'column'
          },   
          title: {
              text: 'Data Pengunjung'
          },
          xAxis: {
              categories: ['Bulan']
          },
          yAxis: {
              title: {
              text: 'Jumlah'
            }
        },
    series:             
            
      [
        <?php 
        $tahun=date('Y');
        $sql = mysqli_query($con,"SELECT *,COUNT(ip) as jumlah , MONTH(tanggal) as bulan FROM statistik where year(tanggal)='$tahun' group by MONTH(tanggal)");
        while ($data = mysqli_fetch_array($sql)) {
          $penerima = $data['bulan'];
          $jumlah = $data['jumlah'];

          if($penerima=='1'){
            $penerimaa = 'Januari';
          }else if($penerima == '2'){
            $penerimaa = 'Februari';
          }else if($penerima == '3'){
            $penerimaa = 'Maret';
          }else if($penerima == '4'){
            $penerimaa = 'April';
          }else if($penerima == '5'){
            $penerimaa = 'Mei';
          }else if($penerima == '6'){
            $penerimaa = 'Juni';
          }else if($penerima == '7'){
            $penerimaa = 'Juli';
          }else if($penerima == '8'){
            $penerimaa = 'Agustus';
          }else if($penerima == '9'){
            $penerimaa = 'September';
          }else if($penerima == '10'){
            $penerimaa = 'Oktober';
          }else if($penerima == '11'){
            $penerimaa = 'November';
          }else if($penerima == '12'){
            $penerimaa = 'Desember';
          }
      
        ?>
          {
            name: '<?php echo $penerimaa; ?>',
            data: [<?php echo $jumlah; ?>]
          },
        <?php
        }
      
        ?>
            ]
    });
  }); 
</script>
  <body>
    <div id='container'> </div>   
  </body>
            </div>
          </div>

            <?php }  if($_SESSION['level']=='pengacara'){ 
                $data=mysqli_fetch_array(mysqli_query($con,"SELECT * FROM tbl_pengacara WHERE id_pengacara='$_SESSION[id_client]'"));
              ?>

        <div class="col-md-12">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="../assets/images/user.png" alt="User profile picture">

              <h3 class="profile-username text-center"><?= $data['nama_pengacara']?></h3>

              <p class="text-muted text-center"><?= $_SESSION['level'] ?></p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>No Hp </b> <a class="pull-right"><?= $data['nohp_pengacara'] ?></a>
                </li>
                <li class="list-group-item">
                  <b>Alamat</b> <a class="pull-right"><?= $data['alamat_pengacara']?></a>
                </li>
                <li class="list-group-item">
                  <b>Email</b> <a class="pull-right"><?= $data['email_pengacara']?></a>
                </li>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>

          </div><!-- /.row -->
		  <?php }  if($_SESSION['level']=='client'){ 
                $data=mysqli_fetch_array(mysqli_query($con,"SELECT * FROM tbl_client WHERE id_client='$_SESSION[id_client]'"));
              ?>

        <div class="col-md-12">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="../assets/images/user.png" alt="User profile picture">

              <h3 class="profile-username text-center"><?= $data['nama_client']?></h3>

              <p class="text-muted text-center"><?= $_SESSION['level'] ?></p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>No Hp </b> <a class="pull-right"><?= $data['nohp_client'] ?></a>
                </li>
                <li class="list-group-item">
                  <b>Alamat</b> <a class="pull-right"><?= $data['alamat_client']?></a>
                </li>
                <li class="list-group-item">
                  <b>Email</b> <a class="pull-right"><?= $data['email_client']?></a>
                </li>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>

          </div><!-- /.row -->
          
          <?php } ?>
        </div>
        </section><!-- /.content -->
      </div>
