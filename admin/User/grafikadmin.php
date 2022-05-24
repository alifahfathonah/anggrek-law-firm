<div class="content-wrapper">
<section class="content-header">
      <h1>
        Grafik Kegiatan
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Grafik Kegiatan</li>
      </ol>
</section>
<section class="content">
<?php
 $sqlku = mysqli_query($con,"SELECT * FROM tbl_pengacara where id_pengacara='$_POST[nm]'");
	  $dataku= mysqli_fetch_array($sqlku);
?>
      <div class="row">
        <div class="col-md-12">

          <div class="box-footer">
            <div class="form-group">
              <form action="" method="post" class="form-horizontal">
                <div class="col-sm-4">
                <select name="nm" class="form-control">
                  <option value="">--Pilih Pengacara--</option>
                  <?php
                    $sql=mysqli_query($con,"SELECT * FROM tbl_pengacara");
                    while ($data=mysqli_fetch_array($sql)) {
                      echo "<option value='$data[id_pengacara]'>$data[nama_pengacara]</option>";
                    }
                  ?>
                </select></div>
                 <div class="col-sm-8">
                <input type="submit" name="a" value="Dalam Kantor" class="btn btn-primary">
                <input type="submit" name="b" value="Luar Kantor" class="btn btn-primary">
                <input type="submit" name="c" value="Istirahat/pribadi" class="btn btn-primary">
                <input type="submit" name="d" value="Tidak Lapor" class="btn btn-primary">
              </div>
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
              text: '<?php echo "$dataku[nama_pengacara]";?> Kegiatan <?php echo "$_POST[a]"."$_POST[b]"."$_POST[c]"."$_POST[d]";?>'
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
        $sql = mysqli_query($con,"SELECT *, DAYNAME(tanggal_kegiatan) as hari, SUM(jumlah) as ttljam FROM kegiatan where jenis_kegiatan='Dalam Kantor' and nama='$_POST[nm]' and YEARWEEK(tanggal_kegiatan)=YEARWEEK(NOW()) group by tanggal_kegiatan");
      }else if(isset($_POST['b'])){
        $sql = mysqli_query($con,"SELECT *, DAYNAME(tanggal_kegiatan) as hari, SUM(jumlah) as ttljam FROM kegiatan where jenis_kegiatan='Luar Kantor' and nama='$_POST[nm]' and YEARWEEK(tanggal_kegiatan)=YEARWEEK(NOW()) group by tanggal_kegiatan ");
      }else if(isset($_POST['c'])){
        $sql = mysqli_query($con,"SELECT *, DAYNAME(tanggal_kegiatan) as hari, SUM(jumlah) as ttljam FROM kegiatan where jenis_kegiatan='Istirahat/pribadi' and nama='$_POST[nm]' and YEARWEEK(tanggal_kegiatan)=YEARWEEK(NOW()) group by tanggal_kegiatan ");
      }else if(isset($_POST['d'])){
        $sql = mysqli_query($con,"SELECT *, DAYNAME(tanggal_kegiatan) as hari, '480'-SUM(jumlah) as ttljam FROM kegiatan where  nama='$_POST[nm]' and YEARWEEK(tanggal_kegiatan)=YEARWEEK(NOW()) group by tanggal_kegiatan ");
      }

        while ($data = mysqli_fetch_array($sql)) {
          $ttljam = $data['ttljam'];
          $hari = $data['hari'];
         

          if($hari=='Monday'){
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
          }

        ?>
          {
            name: '<?php echo $harii; ?>',
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
        <td>Istirahat</td>
        <td>Tidak Lapor </td>
      </tr>
	 <?php
	 //DALAM KANTOR
	  $sql1 = mysqli_query($con,"SELECT *, DAYNAME(tanggal_kegiatan) as hari, SUM(jumlah) as ttljam FROM kegiatan where jenis_kegiatan='Dalam Kantor' and nama='$_POST[nm]' and YEARWEEK(tanggal_kegiatan)=YEARWEEK(NOW()) and DAYNAME(tanggal_kegiatan)='Monday' group by tanggal_kegiatan ");
	  $data1 = mysqli_fetch_array($sql1);
	   $sql11 = mysqli_query($con,"SELECT *, DAYNAME(tanggal_kegiatan) as hari, SUM(jumlah) as ttljam FROM kegiatan where jenis_kegiatan='Dalam Kantor' and nama='$_POST[nm]' and YEARWEEK(tanggal_kegiatan)=YEARWEEK(NOW()) and DAYNAME(tanggal_kegiatan)='Tuesday' group by tanggal_kegiatan ");
	  $data11 = mysqli_fetch_array($sql11);
	  $sql12 = mysqli_query($con,"SELECT *, DAYNAME(tanggal_kegiatan) as hari, SUM(jumlah) as ttljam FROM kegiatan where jenis_kegiatan='Dalam Kantor' and nama='$_POST[nm]' and YEARWEEK(tanggal_kegiatan)=YEARWEEK(NOW()) and DAYNAME(tanggal_kegiatan)='Wednesday' group by tanggal_kegiatan ");
	  $data12 = mysqli_fetch_array($sql12);
	   $sql13 = mysqli_query($con,"SELECT *, DAYNAME(tanggal_kegiatan) as hari, SUM(jumlah) as ttljam FROM kegiatan where jenis_kegiatan='Dalam Kantor' and nama='$_POST[nm]' and YEARWEEK(tanggal_kegiatan)=YEARWEEK(NOW()) and DAYNAME(tanggal_kegiatan)='Thursday' group by tanggal_kegiatan ");
	  $data13 = mysqli_fetch_array($sql13);
	   $sql14 = mysqli_query($con,"SELECT *, DAYNAME(tanggal_kegiatan) as hari, SUM(jumlah) as ttljam FROM kegiatan where jenis_kegiatan='Dalam Kantor' and nama='$_POST[nm]' and YEARWEEK(tanggal_kegiatan)=YEARWEEK(NOW()) and DAYNAME(tanggal_kegiatan)='Friday' group by tanggal_kegiatan ");
	  $data14 = mysqli_fetch_array($sql14);
	   $sql15 = mysqli_query($con,"SELECT *, DAYNAME(tanggal_kegiatan) as hari, SUM(jumlah) as ttljam FROM kegiatan where jenis_kegiatan='Dalam Kantor' and nama='$_POST[nm]' and YEARWEEK(tanggal_kegiatan)=YEARWEEK(NOW()) and DAYNAME(tanggal_kegiatan)='Saturday' group by tanggal_kegiatan ");
	  $data15 = mysqli_fetch_array($sql15);
	   
	   
	  //LUAR KANTOR 
	  	  $sql2 = mysqli_query($con,"SELECT *, DAYNAME(tanggal_kegiatan) as hari, SUM(jumlah) as ttljam FROM kegiatan where jenis_kegiatan='Luar Kantor' and nama='$_POST[nm]' and YEARWEEK(tanggal_kegiatan)=YEARWEEK(NOW()) and DAYNAME(tanggal_kegiatan)='Monday' group by tanggal_kegiatan ");
	  $data2 = mysqli_fetch_array($sql2);
	   $sql21 = mysqli_query($con,"SELECT *, DAYNAME(tanggal_kegiatan) as hari, SUM(jumlah) as ttljam FROM kegiatan where jenis_kegiatan='Luar Kantor' and nama='$_POST[nm]' and YEARWEEK(tanggal_kegiatan)=YEARWEEK(NOW()) and DAYNAME(tanggal_kegiatan)='Tuesday' group by tanggal_kegiatan ");
	  $data21 = mysqli_fetch_array($sql21);
	  $sql22 = mysqli_query($con,"SELECT *, DAYNAME(tanggal_kegiatan) as hari, SUM(jumlah) as ttljam FROM kegiatan where jenis_kegiatan='Luar Kantor' and nama='$_POST[nm]' and YEARWEEK(tanggal_kegiatan)=YEARWEEK(NOW()) and DAYNAME(tanggal_kegiatan)='Wednesday' group by tanggal_kegiatan ");
	  $data22 = mysqli_fetch_array($sql22);
	   $sql23 = mysqli_query($con,"SELECT *, DAYNAME(tanggal_kegiatan) as hari, SUM(jumlah) as ttljam FROM kegiatan where jenis_kegiatan='Luar Kantor' and nama='$_POST[nm]' and YEARWEEK(tanggal_kegiatan)=YEARWEEK(NOW()) and DAYNAME(tanggal_kegiatan)='Thursday' group by tanggal_kegiatan ");
	  $data23 = mysqli_fetch_array($sql23);
	   $sql24 = mysqli_query($con,"SELECT *, DAYNAME(tanggal_kegiatan) as hari, SUM(jumlah) as ttljam FROM kegiatan where jenis_kegiatan='Luar Kantor' and nama='$_POST[nm]' and YEARWEEK(tanggal_kegiatan)=YEARWEEK(NOW()) and DAYNAME(tanggal_kegiatan)='Friday' group by tanggal_kegiatan ");
	  $data24 = mysqli_fetch_array($sql24);
	   $sql25 = mysqli_query($con,"SELECT *, DAYNAME(tanggal_kegiatan) as hari, SUM(jumlah) as ttljam FROM kegiatan where jenis_kegiatan='Luar Kantor' and nama='$_POST[nm]' and YEARWEEK(tanggal_kegiatan)=YEARWEEK(NOW()) and DAYNAME(tanggal_kegiatan)='Saturday' group by tanggal_kegiatan ");
	  $data25 = mysqli_fetch_array($sql25);
	  
	  //ISTIRAHAT
	    $sql3 = mysqli_query($con,"SELECT *, DAYNAME(tanggal_kegiatan) as hari, SUM(jumlah) as ttljam FROM kegiatan where jenis_kegiatan='Istirahat/pribadi' and nama='$_POST[nm]' and YEARWEEK(tanggal_kegiatan)=YEARWEEK(NOW()) and DAYNAME(tanggal_kegiatan)='Monday' group by tanggal_kegiatan ");
	  $data3 = mysqli_fetch_array($sql3);
	   $sql31 = mysqli_query($con,"SELECT *, DAYNAME(tanggal_kegiatan) as hari, SUM(jumlah) as ttljam FROM kegiatan where jenis_kegiatan='Istirahat/pribadi' and nama='$_POST[nm]' and YEARWEEK(tanggal_kegiatan)=YEARWEEK(NOW()) and DAYNAME(tanggal_kegiatan)='Tuesday' group by tanggal_kegiatan ");
	  $data31 = mysqli_fetch_array($sql31);
	  $sql32 = mysqli_query($con,"SELECT *, DAYNAME(tanggal_kegiatan) as hari, SUM(jumlah) as ttljam FROM kegiatan where jenis_kegiatan='Istirahat/pribadi' and nama='$_POST[nm]' and YEARWEEK(tanggal_kegiatan)=YEARWEEK(NOW()) and DAYNAME(tanggal_kegiatan)='Wednesday' group by tanggal_kegiatan ");
	  $data32 = mysqli_fetch_array($sql32);
	   $sql33 = mysqli_query($con,"SELECT *, DAYNAME(tanggal_kegiatan) as hari, SUM(jumlah) as ttljam FROM kegiatan where jenis_kegiatan='Istirahat/pribadi' and nama='$_POST[nm]' and YEARWEEK(tanggal_kegiatan)=YEARWEEK(NOW()) and DAYNAME(tanggal_kegiatan)='Thursday' group by tanggal_kegiatan ");
	  $data33 = mysqli_fetch_array($sql33);
	   $sql34 = mysqli_query($con,"SELECT *, DAYNAME(tanggal_kegiatan) as hari, SUM(jumlah) as ttljam FROM kegiatan where jenis_kegiatan='Istirahat/pribadi' and nama='$_POST[nm]' and YEARWEEK(tanggal_kegiatan)=YEARWEEK(NOW()) and DAYNAME(tanggal_kegiatan)='Friday' group by tanggal_kegiatan ");
	  $data34 = mysqli_fetch_array($sql34);
	   $sql35 = mysqli_query($con,"SELECT *, DAYNAME(tanggal_kegiatan) as hari, SUM(jumlah) as ttljam FROM kegiatan where jenis_kegiatan='Istirahat/pribadi' and nama='$_POST[nm]' and YEARWEEK(tanggal_kegiatan)=YEARWEEK(NOW()) and DAYNAME(tanggal_kegiatan)='Saturday' group by tanggal_kegiatan ");
	  $data35 = mysqli_fetch_array($sql35);
	  
	  
	  //TIDAK LAPOR
	   $sql4 = mysqli_query($con,"SELECT *, DAYNAME(tanggal_kegiatan) as hari, '480'-SUM(jumlah) as ttljam FROM kegiatan where nama='$_POST[nm]' and YEARWEEK(tanggal_kegiatan)=YEARWEEK(NOW()) and DAYNAME(tanggal_kegiatan)='Monday'  group by tanggal_kegiatan");
	  $data4 = mysqli_fetch_array($sql4);
	   $sql41 = mysqli_query($con,"SELECT *, DAYNAME(tanggal_kegiatan) as hari, '480'-SUM(jumlah) as ttljam FROM kegiatan where nama='$_POST[nm]' and YEARWEEK(tanggal_kegiatan)=YEARWEEK(NOW()) and DAYNAME(tanggal_kegiatan)='Tuesday'  group by tanggal_kegiatan");
	  $data41 = mysqli_fetch_array($sql41);
	  $sql42 = mysqli_query($con,"SELECT *, DAYNAME(tanggal_kegiatan) as hari, '480'-SUM(jumlah) as ttljam FROM kegiatan where nama='$_POST[nm]' and YEARWEEK(tanggal_kegiatan)=YEARWEEK(NOW()) and DAYNAME(tanggal_kegiatan)='Wednesday' group by tanggal_kegiatan");
	  $data42 = mysqli_fetch_array($sql42);
	   $sql43 = mysqli_query($con,"SELECT *, DAYNAME(tanggal_kegiatan) as hari, '480'-SUM(jumlah) as ttljam FROM kegiatan where nama='$_POST[nm]' and YEARWEEK(tanggal_kegiatan)=YEARWEEK(NOW()) and DAYNAME(tanggal_kegiatan)='Thursday' group by tanggal_kegiatan");
	  $data43 = mysqli_fetch_array($sql43);
	   $sql44 = mysqli_query($con,"SELECT *, DAYNAME(tanggal_kegiatan) as hari, '480'-SUM(jumlah) as ttljam FROM kegiatan where nama='$_POST[nm]' and YEARWEEK(tanggal_kegiatan)=YEARWEEK(NOW()) and DAYNAME(tanggal_kegiatan)='Friday' group by tanggal_kegiatan");
	  $data44 = mysqli_fetch_array($sql44);
	   $sql45 = mysqli_query($con,"SELECT *, DAYNAME(tanggal_kegiatan) as hari, '480'-SUM(jumlah) as ttljam FROM kegiatan where nama='$_POST[nm]' and YEARWEEK(tanggal_kegiatan)=YEARWEEK(NOW()) and DAYNAME(tanggal_kegiatan)='Saturday' group by tanggal_kegiatan");
	  $data45 = mysqli_fetch_array($sql45);
	  
	 ?>
      <tr>
        <td>Senin</td>
        <td><?php echo sprintf('%02d jam %02d menit', floor($data1['ttljam']/60), $data1['ttljam']%60);?></td>
       <td><?php echo sprintf('%02d jam %02d menit', floor($data2['ttljam']/60), $data2['ttljam']%60);?></td>
        
       <td><?php echo sprintf('%02d jam %02d menit', floor($data3['ttljam']/60), $data3['ttljam']%60);?></td>
        <td><?php echo sprintf('%02d jam %02d menit', floor($data4['ttljam']/60), $data4['ttljam']%60);?></td>
      </tr>
	   <tr>
        <td>Selasa</td>
        <td><?php echo sprintf('%02d jam %02d menit', floor($data11['ttljam']/60), $data11['ttljam']%60);?></td>
          <td><?php echo sprintf('%02d jam %02d menit', floor($data21['ttljam']/60), $data21['ttljam']%60);?></td>
         <td><?php echo sprintf('%02d jam %02d menit', floor($data31['ttljam']/60), $data31['ttljam']%60);?></td>
        <td><?php echo sprintf('%02d jam %02d menit', floor($data41['ttljam']/60), $data41['ttljam']%60);?></td>
      </tr>
	   <tr>
        <td>Rabu</td>
        <td><?php echo sprintf('%02d jam %02d menit', floor($data12['ttljam']/60), $data12['ttljam']%60);?></td>
       <td><?php echo sprintf('%02d jam %02d menit', floor($data22['ttljam']/60), $data22['ttljam']%60);?></td>
        <td><?php echo sprintf('%02d jam %02d menit', floor($data32['ttljam']/60), $data32['ttljam']%60);?></td>
        <td><?php echo sprintf('%02d jam %02d menit', floor($data42['ttljam']/60), $data42['ttljam']%60);?></td>
      </tr>
	   <tr>
        <td>Kamis</td>
        <td><?php echo sprintf('%02d jam %02d menit', floor($data13['ttljam']/60), $data13['ttljam']%60);?></td>
        <td><?php echo sprintf('%02d jam %02d menit', floor($data23['ttljam']/60), $data23['ttljam']%60);?></td>
       <td><?php echo sprintf('%02d jam %02d menit', floor($data33['ttljam']/60), $data33['ttljam']%60);?></td>
        <td><?php echo sprintf('%02d jam %02d menit', floor($data43['ttljam']/60), $data43['ttljam']%60);?></td>
      </tr>
	   <tr>
        <td>Jummat</td>
        <td><?php echo sprintf('%02d jam %02d menit', floor($data14['ttljam']/60), $data14['ttljam']%60);?></td>
         <td><?php echo sprintf('%02d jam %02d menit', floor($data24['ttljam']/60), $data24['ttljam']%60);?></td>
       <td><?php echo sprintf('%02d jam %02d menit', floor($data34['ttljam']/60), $data34['ttljam']%60);?></td>
        <td><?php echo sprintf('%02d jam %02d menit', floor($data44['ttljam']/60), $data44['ttljam']%60);?></td>
      </tr>
	   <tr>
        <td>Sabtu</td>
        <td><?php echo sprintf('%02d jam %02d menit', floor($data15['ttljam']/60), $data15['ttljam']%60);?></td>
        <td><?php echo sprintf('%02d jam %02d menit', floor($data25['ttljam']/60), $data25['ttljam']%60);?></td>
       <td><?php echo sprintf('%02d jam %02d menit', floor($data35['ttljam']/60), $data35['ttljam']%60);?></td>
        <td><?php echo sprintf('%02d jam %02d menit', floor($data45['ttljam']/60), $data45['ttljam']%60);?></td>
      </tr>
    </table>  
  </body>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

