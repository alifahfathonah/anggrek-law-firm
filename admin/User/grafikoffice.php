<div class="content-wrapper">
<section class="content-header">
      <h1>
    Grafik Office Hour
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Grafik Office Hour</li>
      </ol>
</section>
<section class="content">
      <div class="row">
        <div class="col-md-12">

          <div class="box-footer">
            <div class="form-group">
              <form action="" method="post" class="form-horizontal">
                <input type="submit" name="a" value="Dalam Kantor" class="btn btn-primary">
                <input type="submit" name="b" value="Luar Kantor" class="btn btn-primary">
              </form>
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
              text: '<?php echo "$_POST[a]"."$_POST[b]";?>'
          },
          xAxis: {
              categories: ['Hari']
          },
          yAxis: {
              title: {
              text: 'Jumlah'
            }
        },
    series:             
            
      [
        <?php 
        $tahun=date('m');
        if(isset($_POST['a'])){
        $sql = mysqli_query($con,"SELECT *, MONTHNAME(tanggal_kegiatan) as bulan, SUM(jumlah) as ttljam FROM tbl_office where jenis_kegiatan='Dalam Kantor' and nama='$_SESSION[id_client]' and YEAR(tanggal_kegiatan)=YEAR(NOW()) group by bulan ");
      }else if(isset($_POST['b'])){
        $sql = mysqli_query($con,"SELECT *, MONTHNAME(tanggal_kegiatan) as bulan, SUM(jumlah) as ttljam FROM tbl_office where jenis_kegiatan='Luar Kantor' and nama='$_SESSION[id_client]' and YEAR(tanggal_kegiatan)=YEAR(NOW()) group by bulan");
      }else{
        $sql = mysqli_query($con,"SELECT *, MONTHNAME(tanggal_kegiatan) as bulan, SUM(jumlah) as ttljam FROM tbl_office where jenis_kegiatan='Dalam Kantor' and nama='$_SESSION[id_client]' and YEAR(tanggal_kegiatan)=YEAR(NOW()) group by bulan");
      }

        while ($data = mysqli_fetch_array($sql)) {
           $ttljam = $data['ttljam'];
          $bulan = $data['bulan'];
         /* $jam   = floor($diff / (60 * 60));
          $menit = $diff - $jam * (60 * 60);
          $jumlah = $jam.".".floor($menit / 60);*/

          /*if($hari=='Monday'){
            $harii = 'Senin';
          }else if($hari == 'Tuesday'){
            $harii = 'Selasa';
          }else if($hari == 'Wednesday'){
            $harii = 'Rabu';
          }else if($hari == 'Thursday'){
            $harii = 'kamis';
          }else if($hari == 'Friday'){
            $harii = 'Jumat';
          }else if($hari == 'Saturday'){
            $harii = 'Sabtu';
          }else if($hari == 'Sunday'){
            $harii = 'Minggu';
          }*/

        ?>
          {
            name: '<?php echo $bulan; ?>',
            data: [<?php echo $ttljam; ?>]
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
    <table width="100%" border="1"  class="table table-bordered table-stripe">
      <tr class="info">
        <td>Hari</td>
        <td>Dalam Kantor </td>
        <td>Luar Kantor </td>
      </tr>
   <?php
   //DALAM KANTOR
    $sql1 = mysqli_query($con,"SELECT *, MONTHNAME(tanggal_kegiatan) as bulan, SUM(jumlah) as ttljam FROM tbl_office where jenis_kegiatan='Dalam Kantor' and nama='$_SESSION[id_client]' and YEAR(tanggal_kegiatan)=YEAR(NOW()) and MONTHNAME(tanggal_kegiatan)='January' group by bulan");
    $data1 = mysqli_fetch_array($sql1);
     $sql11 = mysqli_query($con,"SELECT *, MONTHNAME(tanggal_kegiatan) as bulan, SUM(jumlah) as ttljam FROM tbl_office where jenis_kegiatan='Dalam Kantor' and nama='$_SESSION[id_client]' and YEAR(tanggal_kegiatan)=YEAR(NOW()) and MONTHNAME(tanggal_kegiatan)='February' group by bulan");
    $data11 = mysqli_fetch_array($sql11);
    $sql12 = mysqli_query($con,"SELECT *, MONTHNAME(tanggal_kegiatan) as bulan, SUM(jumlah) as ttljam FROM tbl_office where jenis_kegiatan='Dalam Kantor' and nama='$_SESSION[id_client]' and YEAR(tanggal_kegiatan)=YEAR(NOW()) and MONTHNAME(tanggal_kegiatan)='March' group by bulan");
    $data12 = mysqli_fetch_array($sql12);
     $sql13 = mysqli_query($con,"SELECT *, MONTHNAME(tanggal_kegiatan) as bulan, SUM(jumlah) as ttljam FROM tbl_office where jenis_kegiatan='Dalam Kantor' and nama='$_SESSION[id_client]' and YEAR(tanggal_kegiatan)=YEAR(NOW()) and MONTHNAME(tanggal_kegiatan)='April' group by bulan");
    $data13 = mysqli_fetch_array($sql13);
     $sql14 = mysqli_query($con,"SELECT *, MONTHNAME(tanggal_kegiatan) as bulan, SUM(jumlah) as ttljam FROM tbl_office where jenis_kegiatan='Dalam Kantor' and nama='$_SESSION[id_client]' and YEAR(tanggal_kegiatan)=YEAR(NOW()) and MONTHNAME(tanggal_kegiatan)='May' group by bulan");
    $data14 = mysqli_fetch_array($sql14);
     $sql15 = mysqli_query($con,"SELECT *, MONTHNAME(tanggal_kegiatan) as bulan, SUM(jumlah) as ttljam FROM tbl_office where jenis_kegiatan='Dalam Kantor' and nama='$_SESSION[id_client]' and YEAR(tanggal_kegiatan)=YEAR(NOW()) and MONTHNAME(tanggal_kegiatan)='June' group by bulan");
    $data15 = mysqli_fetch_array($sql15);
     $sql16 = mysqli_query($con,"SELECT *, MONTHNAME(tanggal_kegiatan) as bulan, SUM(jumlah) as ttljam FROM tbl_office where jenis_kegiatan='Dalam Kantor' and nama='$_SESSION[id_client]' and YEAR(tanggal_kegiatan)=YEAR(NOW()) and MONTHNAME(tanggal_kegiatan)='July' group by bulan");
    $data16 = mysqli_fetch_array($sql16);
     $sql17 = mysqli_query($con,"SELECT *, MONTHNAME(tanggal_kegiatan) as bulan, SUM(jumlah) as ttljam FROM tbl_office where jenis_kegiatan='Dalam Kantor' and nama='$_SESSION[id_client]' and YEAR(tanggal_kegiatan)=YEAR(NOW()) and MONTHNAME(tanggal_kegiatan)='August' group by bulan");
    $data17 = mysqli_fetch_array($sql17);
     $sql18 = mysqli_query($con,"SELECT *, MONTHNAME(tanggal_kegiatan) as bulan, SUM(jumlah) as ttljam FROM tbl_office where jenis_kegiatan='Dalam Kantor' and nama='$_SESSION[id_client]' and YEAR(tanggal_kegiatan)=YEAR(NOW()) and MONTHNAME(tanggal_kegiatan)='September' group by bulan");
    $data18 = mysqli_fetch_array($sql18);
     $sql19 = mysqli_query($con,"SELECT *, MONTHNAME(tanggal_kegiatan) as bulan, SUM(jumlah) as ttljam FROM tbl_office where jenis_kegiatan='Dalam Kantor' and nama='$_SESSION[id_client]' and YEAR(tanggal_kegiatan)=YEAR(NOW()) and MONTHNAME(tanggal_kegiatan)='October' group by bulan");
    $data19 = mysqli_fetch_array($sql19);
     $sql110 = mysqli_query($con,"SELECT *, MONTHNAME(tanggal_kegiatan) as bulan, SUM(jumlah) as ttljam FROM tbl_office where jenis_kegiatan='Dalam Kantor' and nama='$_SESSION[id_client]' and YEAR(tanggal_kegiatan)=YEAR(NOW()) and MONTHNAME(tanggal_kegiatan)='November' group by bulan");
    $data110 = mysqli_fetch_array($sql110);
     $sql111 = mysqli_query($con,"SELECT *, MONTHNAME(tanggal_kegiatan) as bulan, SUM(jumlah) as ttljam FROM tbl_office where jenis_kegiatan='Dalam Kantor' and nama='$_SESSION[id_client]' and YEAR(tanggal_kegiatan)=YEAR(NOW()) and MONTHNAME(tanggal_kegiatan)='December' group by bulan");
    $data111 = mysqli_fetch_array($sql111);
     
     
    //LUAR KANTOR 
        $sql2 = mysqli_query($con,"SELECT *, MONTHNAME(tanggal_kegiatan) as bulan, SUM(jumlah) as ttljam FROM tbl_office where jenis_kegiatan='Luar Kantor' and nama='$_SESSION[id_client]' and YEAR(tanggal_kegiatan)=YEAR(NOW()) and MONTHNAME(tanggal_kegiatan)='January' group by bulan ");
    $data2 = mysqli_fetch_array($sql2);
     $sql21 = mysqli_query($con,"SELECT *, MONTHNAME(tanggal_kegiatan) as bulan, SUM(jumlah) as ttljam FROM tbl_office where jenis_kegiatan='Luar Kantor' and nama='$_SESSION[id_client]' and YEAR(tanggal_kegiatan)=YEAR(NOW()) and MONTHNAME(tanggal_kegiatan)='February' group by bulan");
    $data21 = mysqli_fetch_array($sql21);
    $sql22 = mysqli_query($con,"SELECT *, MONTHNAME(tanggal_kegiatan) as bulan, SUM(jumlah) as ttljam FROM tbl_office where jenis_kegiatan='Luar Kantor' and nama='$_SESSION[id_client]' and YEAR(tanggal_kegiatan)=YEAR(NOW()) and MONTHNAME(tanggal_kegiatan)='March' group by bulan");
    $data22 = mysqli_fetch_array($sql22);
     $sql23 = mysqli_query($con,"SELECT *, MONTHNAME(tanggal_kegiatan) as bulan, SUM(jumlah) as ttljam FROM tbl_office where jenis_kegiatan='Luar Kantor' and nama='$_SESSION[id_client]' and YEAR(tanggal_kegiatan)=YEAR(NOW()) and MONTHNAME(tanggal_kegiatan)='April' group by bulan");
    $data23 = mysqli_fetch_array($sql23);
     $sql24 = mysqli_query($con,"SELECT *, MONTHNAME(tanggal_kegiatan) as bulan, SUM(jumlah) as ttljam FROM tbl_office where jenis_kegiatan='Luar Kantor' and nama='$_SESSION[id_client]' and YEAR(tanggal_kegiatan)=YEAR(NOW()) and MONTHNAME(tanggal_kegiatan)='May' group by bulan");
    $data24 = mysqli_fetch_array($sql24);
     $sql25 = mysqli_query($con,"SELECT *, MONTHNAME(tanggal_kegiatan) as bulan, SUM(jumlah) as ttljam FROM tbl_office where jenis_kegiatan='Luar Kantor' and nama='$_SESSION[id_client]' and YEAR(tanggal_kegiatan)=YEAR(NOW()) and MONTHNAME(tanggal_kegiatan)='June' group by bulan");
    $data25 = mysqli_fetch_array($sql25);
     $sql26 = mysqli_query($con,"SELECT *, MONTHNAME(tanggal_kegiatan) as bulan, SUM(jumlah) as ttljam FROM tbl_office where jenis_kegiatan='Luar Kantor' and nama='$_SESSION[id_client]' and YEAR(tanggal_kegiatan)=YEAR(NOW()) and MONTHNAME(tanggal_kegiatan)='July' group by bulan");
    $data26 = mysqli_fetch_array($sql26);
     $sql27 = mysqli_query($con,"SELECT *, MONTHNAME(tanggal_kegiatan) as bulan, SUM(jumlah) as ttljam FROM tbl_office where jenis_kegiatan='Luar Kantor' and nama='$_SESSION[id_client]' and YEAR(tanggal_kegiatan)=YEAR(NOW()) and MONTHNAME(tanggal_kegiatan)='August' group by bulan");
    $data27 = mysqli_fetch_array($sql27);
     $sql28 = mysqli_query($con,"SELECT *, MONTHNAME(tanggal_kegiatan) as bulan, SUM(jumlah) as ttljam FROM tbl_office where jenis_kegiatan='Luar Kantor' and nama='$_SESSION[id_client]' and YEAR(tanggal_kegiatan)=YEAR(NOW()) and MONTHNAME(tanggal_kegiatan)='September' group by bulan");
    $data28 = mysqli_fetch_array($sql28);
     $sql29 = mysqli_query($con,"SELECT *, MONTHNAME(tanggal_kegiatan) as bulan, SUM(jumlah) as ttljam FROM tbl_office where jenis_kegiatan='Luar Kantor' and nama='$_SESSION[id_client]' and YEAR(tanggal_kegiatan)=YEAR(NOW()) and MONTHNAME(tanggal_kegiatan)='October' group by bulan");
    $data29 = mysqli_fetch_array($sql29);
     $sql210 = mysqli_query($con,"SELECT *, MONTHNAME(tanggal_kegiatan) as bulan, SUM(jumlah) as ttljam FROM tbl_office where jenis_kegiatan='Luar Kantor' and nama='$_SESSION[id_client]' and YEAR(tanggal_kegiatan)=YEAR(NOW()) and MONTHNAME(tanggal_kegiatan)='November' group by bulan");
    $data210 = mysqli_fetch_array($sql210);
     $sql211 = mysqli_query($con,"SELECT *, MONTHNAME(tanggal_kegiatan) as bulan, SUM(jumlah) as ttljam FROM tbl_office where jenis_kegiatan='Luar Kantor' and nama='$_SESSION[id_client]' and YEAR(tanggal_kegiatan)=YEAR(NOW()) and MONTHNAME(tanggal_kegiatan)='December' group by bulan");
    $data211 = mysqli_fetch_array($sql211);
    
    
    
   ?>
      <tr>
        <td>Januari</td>
        <td><?php echo sprintf('%02d jam %02d menit', floor($data1['ttljam']/60), $data1['ttljam']%60);?></td>
       <td><?php echo sprintf('%02d jam %02d menit', floor($data2['ttljam']/60), $data2['ttljam']%60);?></td>
      </tr>
     <tr>
        <td>Februari</td>
        <td><?php echo sprintf('%02d jam %02d menit', floor($data11['ttljam']/60), $data11['ttljam']%60);?></td>
          <td><?php echo sprintf('%02d jam %02d menit', floor($data21['ttljam']/60), $data21['ttljam']%60);?></td>
      </tr>
     <tr>
        <td>Maret</td>
        <td><?php echo sprintf('%02d jam %02d menit', floor($data12['ttljam']/60), $data12['ttljam']%60);?></td>
       <td><?php echo sprintf('%02d jam %02d menit', floor($data22['ttljam']/60), $data22['ttljam']%60);?></td>
      </tr>
     <tr>
        <td>April</td>
        <td><?php echo sprintf('%02d jam %02d menit', floor($data13['ttljam']/60), $data13['ttljam']%60);?></td>
        <td><?php echo sprintf('%02d jam %02d menit', floor($data23['ttljam']/60), $data23['ttljam']%60);?></td>
      </tr>
     <tr>
        <td>Mei</td>
        <td><?php echo sprintf('%02d jam %02d menit', floor($data14['ttljam']/60), $data14['ttljam']%60);?></td>
         <td><?php echo sprintf('%02d jam %02d menit', floor($data24['ttljam']/60), $data24['ttljam']%60);?></td>
      </tr>
     <tr>
        <td>Juni</td>
        <td><?php echo sprintf('%02d jam %02d menit', floor($data15['ttljam']/60), $data15['ttljam']%60);?></td>
        <td><?php echo sprintf('%02d jam %02d menit', floor($data25['ttljam']/60), $data25['ttljam']%60);?></td>
     <tr>
        <td>Juli</td>
        <td><?php echo sprintf('%02d jam %02d menit', floor($data16['ttljam']/60), $data16['ttljam']%60);?></td>
        <td><?php echo sprintf('%02d jam %02d menit', floor($data26['ttljam']/60), $data26['ttljam']%60);?></td>
      </tr>
     <tr>
        <td>Agustus</td>
        <td><?php echo sprintf('%02d jam %02d menit', floor($data17['ttljam']/60), $data17['ttljam']%60);?></td>
        <td><?php echo sprintf('%02d jam %02d menit', floor($data27['ttljam']/60), $data27['ttljam']%60);?></td>
      </tr>
     <tr>
        <td>September</td>
        <td><?php echo sprintf('%02d jam %02d menit', floor($data18['ttljam']/60), $data18['ttljam']%60);?></td>
        <td><?php echo sprintf('%02d jam %02d menit', floor($data28['ttljam']/60), $data28['ttljam']%60);?></td>
      </tr>
     <tr>
        <td>Oktober</td>
        <td><?php echo sprintf('%02d jam %02d menit', floor($data19['ttljam']/60), $data19['ttljam']%60);?></td>
        <td><?php echo sprintf('%02d jam %02d menit', floor($data29['ttljam']/60), $data29['ttljam']%60);?></td>
      </tr>
     <tr>
        <td>November</td>
        <td><?php echo sprintf('%02d jam %02d menit', floor($data110['ttljam']/60), $data110['ttljam']%60);?></td>
        <td><?php echo sprintf('%02d jam %02d menit', floor($data210['ttljam']/60), $data210['ttljam']%60);?></td>
      </tr>
     <tr>
        <td>Desember</td>
        <td><?php echo sprintf('%02d jam %02d menit', floor($data111['ttljam']/60), $data111['ttljam']%60);?></td>
        <td><?php echo sprintf('%02d jam %02d menit', floor($data211['ttljam']/60), $data211['ttljam']%60);?></td>
      </tr>
    </table>  
    
  </body>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

