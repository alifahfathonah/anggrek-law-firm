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
              text: '<?php echo "$dataku[nama_pengacara]";?> Kegiatan <?php echo "$_POST[a]"."$_POST[b]"."$_POST[c]"."$_POST[d]";?> '
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
        $tahun=date('m');
        if(isset($_POST['a'])){
        $sql = mysqli_query($con,"SELECT *, MONTHNAME(tanggal_kegiatan) as bulan, SUM(jumlah) as ttljam FROM kegiatan where jenis_kegiatan='Dalam Kantor' and nama='$_POST[nm]' and YEAR(tanggal_kegiatan)=YEAR(NOW()) group by bulan");
      }else if(isset($_POST['b'])){
        $sql = mysqli_query($con,"SELECT *, MONTHNAME(tanggal_kegiatan) as bulan, SUM(jumlah) as ttljam FROM kegiatan where jenis_kegiatan='Luar Kantor' and nama='$_POST[nm]' and YEAR(tanggal_kegiatan)=YEAR(NOW()) group by bulan");
      }else if(isset($_POST['c'])){
        $sql = mysqli_query($con,"SELECT *, MONTHNAME(tanggal_kegiatan) as bulan, SUM(jumlah) as ttljam FROM kegiatan where jenis_kegiatan='Istirahat/pribadi' and nama='$_POST[nm]' and YEAR(tanggal_kegiatan)=YEAR(NOW()) group by bulan ");
      }else if(isset($_POST['d'])){
        $sql = mysqli_query($con,"SELECT *, MONTHNAME(tanggal_kegiatan) as bulan, '9600'-SUM(jumlah) as ttljam FROM kegiatan where  nama='$_POST[nm]' and YEAR(tanggal_kegiatan)=YEAR(NOW()) group by bulan ");
      }

        while ($data = mysqli_fetch_array($sql)) {
          $ttljam = $data['ttljam'];
          $bulan = $data['bulan'];
         
/*
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
*/
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
        <td>Bulan</td>
        <td>Dalam Kantor </td>
        <td>Luar Kantor </td>
        <td>Istirahat</td>
        <td>Tidak Lapor </td>
      </tr>
	 <?php
	 //DALAM KANTOR
	  $sql1 = mysqli_query($con,"SELECT *, MONTHNAME(tanggal_kegiatan) as bulan, SUM(jumlah) as ttljam FROM kegiatan where jenis_kegiatan='Dalam Kantor' and nama='$_POST[nm]' and YEAR(tanggal_kegiatan)=YEAR(NOW()) and MONTHNAME(tanggal_kegiatan)='January' group by bulan");
	  $data1 = mysqli_fetch_array($sql1);
	   $sql11 = mysqli_query($con,"SELECT *, MONTHNAME(tanggal_kegiatan) as bulan, SUM(jumlah) as ttljam FROM kegiatan where jenis_kegiatan='Dalam Kantor' and nama='$_POST[nm]' and YEAR(tanggal_kegiatan)=YEAR(NOW()) and MONTHNAME(tanggal_kegiatan)='February' group by bulan");
	  $data11 = mysqli_fetch_array($sql11);
	  $sql12 = mysqli_query($con,"SELECT *, MONTHNAME(tanggal_kegiatan) as bulan, SUM(jumlah) as ttljam FROM kegiatan where jenis_kegiatan='Dalam Kantor' and nama='$_POST[nm]' and YEAR(tanggal_kegiatan)=YEAR(NOW()) and MONTHNAME(tanggal_kegiatan)='March' group by bulan");
	  $data12 = mysqli_fetch_array($sql12);
	   $sql13 = mysqli_query($con,"SELECT *, MONTHNAME(tanggal_kegiatan) as bulan, SUM(jumlah) as ttljam FROM kegiatan where jenis_kegiatan='Dalam Kantor' and nama='$_POST[nm]' and YEAR(tanggal_kegiatan)=YEAR(NOW()) and MONTHNAME(tanggal_kegiatan)='April' group by bulan");
	  $data13 = mysqli_fetch_array($sql13);
	   $sql14 = mysqli_query($con,"SELECT *, MONTHNAME(tanggal_kegiatan) as bulan, SUM(jumlah) as ttljam FROM kegiatan where jenis_kegiatan='Dalam Kantor' and nama='$_POST[nm]' and YEAR(tanggal_kegiatan)=YEAR(NOW()) and MONTHNAME(tanggal_kegiatan)='May' group by bulan");
	  $data14 = mysqli_fetch_array($sql14);
	   $sql15 = mysqli_query($con,"SELECT *, MONTHNAME(tanggal_kegiatan) as bulan, SUM(jumlah) as ttljam FROM kegiatan where jenis_kegiatan='Dalam Kantor' and nama='$_POST[nm]' and YEAR(tanggal_kegiatan)=YEAR(NOW()) and MONTHNAME(tanggal_kegiatan)='June' group by bulan");
	  $data15 = mysqli_fetch_array($sql15);
	   $sql16 = mysqli_query($con,"SELECT *, MONTHNAME(tanggal_kegiatan) as bulan, SUM(jumlah) as ttljam FROM kegiatan where jenis_kegiatan='Dalam Kantor' and nama='$_POST[nm]' and YEAR(tanggal_kegiatan)=YEAR(NOW()) and MONTHNAME(tanggal_kegiatan)='July' group by bulan");
	  $data16 = mysqli_fetch_array($sql16);
	   $sql17 = mysqli_query($con,"SELECT *, MONTHNAME(tanggal_kegiatan) as bulan, SUM(jumlah) as ttljam FROM kegiatan where jenis_kegiatan='Dalam Kantor' and nama='$_POST[nm]' and YEAR(tanggal_kegiatan)=YEAR(NOW()) and MONTHNAME(tanggal_kegiatan)='August' group by bulan");
	  $data17 = mysqli_fetch_array($sql17);
	   $sql18 = mysqli_query($con,"SELECT *, MONTHNAME(tanggal_kegiatan) as bulan, SUM(jumlah) as ttljam FROM kegiatan where jenis_kegiatan='Dalam Kantor' and nama='$_POST[nm]' and YEAR(tanggal_kegiatan)=YEAR(NOW()) and MONTHNAME(tanggal_kegiatan)='September' group by bulan");
	  $data18 = mysqli_fetch_array($sql18);
	   $sql19 = mysqli_query($con,"SELECT *, MONTHNAME(tanggal_kegiatan) as bulan, SUM(jumlah) as ttljam FROM kegiatan where jenis_kegiatan='Dalam Kantor' and nama='$_POST[nm]' and YEAR(tanggal_kegiatan)=YEAR(NOW()) and MONTHNAME(tanggal_kegiatan)='October' group by bulan");
	  $data19 = mysqli_fetch_array($sql19);
	   $sql110 = mysqli_query($con,"SELECT *, MONTHNAME(tanggal_kegiatan) as bulan, SUM(jumlah) as ttljam FROM kegiatan where jenis_kegiatan='Dalam Kantor' and nama='$_POST[nm]' and YEAR(tanggal_kegiatan)=YEAR(NOW()) and MONTHNAME(tanggal_kegiatan)='November' group by bulan");
	  $data110 = mysqli_fetch_array($sql110);
	   $sql111 = mysqli_query($con,"SELECT *, MONTHNAME(tanggal_kegiatan) as bulan, SUM(jumlah) as ttljam FROM kegiatan where jenis_kegiatan='Dalam Kantor' and nama='$_POST[nm]' and YEAR(tanggal_kegiatan)=YEAR(NOW()) and MONTHNAME(tanggal_kegiatan)='December' group by bulan");
	  $data111 = mysqli_fetch_array($sql111);
	   
	   
	  //LUAR KANTOR 
	  	  $sql2 = mysqli_query($con,"SELECT *, MONTHNAME(tanggal_kegiatan) as bulan, SUM(jumlah) as ttljam FROM kegiatan where jenis_kegiatan='Luar Kantor' and nama='$_POST[nm]' and YEAR(tanggal_kegiatan)=YEAR(NOW()) and MONTHNAME(tanggal_kegiatan)='January' group by bulan ");
	  $data2 = mysqli_fetch_array($sql2);
	   $sql21 = mysqli_query($con,"SELECT *, MONTHNAME(tanggal_kegiatan) as bulan, SUM(jumlah) as ttljam FROM kegiatan where jenis_kegiatan='Luar Kantor' and nama='$_POST[nm]' and YEAR(tanggal_kegiatan)=YEAR(NOW()) and MONTHNAME(tanggal_kegiatan)='February' group by bulan");
	  $data21 = mysqli_fetch_array($sql21);
	  $sql22 = mysqli_query($con,"SELECT *, MONTHNAME(tanggal_kegiatan) as bulan, SUM(jumlah) as ttljam FROM kegiatan where jenis_kegiatan='Luar Kantor' and nama='$_POST[nm]' and YEAR(tanggal_kegiatan)=YEAR(NOW()) and MONTHNAME(tanggal_kegiatan)='March' group by bulan");
	  $data22 = mysqli_fetch_array($sql22);
	   $sql23 = mysqli_query($con,"SELECT *, MONTHNAME(tanggal_kegiatan) as bulan, SUM(jumlah) as ttljam FROM kegiatan where jenis_kegiatan='Luar Kantor' and nama='$_POST[nm]' and YEAR(tanggal_kegiatan)=YEAR(NOW()) and MONTHNAME(tanggal_kegiatan)='April' group by bulan");
	  $data23 = mysqli_fetch_array($sql23);
	   $sql24 = mysqli_query($con,"SELECT *, MONTHNAME(tanggal_kegiatan) as bulan, SUM(jumlah) as ttljam FROM kegiatan where jenis_kegiatan='Luar Kantor' and nama='$_POST[nm]' and YEAR(tanggal_kegiatan)=YEAR(NOW()) and MONTHNAME(tanggal_kegiatan)='May' group by bulan");
	  $data24 = mysqli_fetch_array($sql24);
	   $sql25 = mysqli_query($con,"SELECT *, MONTHNAME(tanggal_kegiatan) as bulan, SUM(jumlah) as ttljam FROM kegiatan where jenis_kegiatan='Luar Kantor' and nama='$_POST[nm]' and YEAR(tanggal_kegiatan)=YEAR(NOW()) and MONTHNAME(tanggal_kegiatan)='June' group by bulan");
	  $data25 = mysqli_fetch_array($sql25);
	   $sql26 = mysqli_query($con,"SELECT *, MONTHNAME(tanggal_kegiatan) as bulan, SUM(jumlah) as ttljam FROM kegiatan where jenis_kegiatan='Luar Kantor' and nama='$_POST[nm]' and YEAR(tanggal_kegiatan)=YEAR(NOW()) and MONTHNAME(tanggal_kegiatan)='July' group by bulan");
	  $data26 = mysqli_fetch_array($sql26);
	   $sql27 = mysqli_query($con,"SELECT *, MONTHNAME(tanggal_kegiatan) as bulan, SUM(jumlah) as ttljam FROM kegiatan where jenis_kegiatan='Luar Kantor' and nama='$_POST[nm]' and YEAR(tanggal_kegiatan)=YEAR(NOW()) and MONTHNAME(tanggal_kegiatan)='August' group by bulan");
	  $data27 = mysqli_fetch_array($sql27);
	   $sql28 = mysqli_query($con,"SELECT *, MONTHNAME(tanggal_kegiatan) as bulan, SUM(jumlah) as ttljam FROM kegiatan where jenis_kegiatan='Luar Kantor' and nama='$_POST[nm]' and YEAR(tanggal_kegiatan)=YEAR(NOW()) and MONTHNAME(tanggal_kegiatan)='September' group by bulan");
	  $data28 = mysqli_fetch_array($sql28);
	   $sql29 = mysqli_query($con,"SELECT *, MONTHNAME(tanggal_kegiatan) as bulan, SUM(jumlah) as ttljam FROM kegiatan where jenis_kegiatan='Luar Kantor' and nama='$_POST[nm]' and YEAR(tanggal_kegiatan)=YEAR(NOW()) and MONTHNAME(tanggal_kegiatan)='October' group by bulan");
	  $data29 = mysqli_fetch_array($sql29);
	   $sql210 = mysqli_query($con,"SELECT *, MONTHNAME(tanggal_kegiatan) as bulan, SUM(jumlah) as ttljam FROM kegiatan where jenis_kegiatan='Luar Kantor' and nama='$_POST[nm]' and YEAR(tanggal_kegiatan)=YEAR(NOW()) and MONTHNAME(tanggal_kegiatan)='November' group by bulan");
	  $data210 = mysqli_fetch_array($sql210);
	   $sql211 = mysqli_query($con,"SELECT *, MONTHNAME(tanggal_kegiatan) as bulan, SUM(jumlah) as ttljam FROM kegiatan where jenis_kegiatan='Luar Kantor' and nama='$_POST[nm]' and YEAR(tanggal_kegiatan)=YEAR(NOW()) and MONTHNAME(tanggal_kegiatan)='December' group by bulan");
	  $data211 = mysqli_fetch_array($sql211);
	  
	  //ISTIRAHAT
	    $sql3 = mysqli_query($con,"SELECT *, MONTHNAME(tanggal_kegiatan) as bulan, SUM(jumlah) as ttljam FROM kegiatan where jenis_kegiatan='Istirahat/pribadi' and nama='$_POST[nm]' and YEAR(tanggal_kegiatan)=MONTHNAME(NOW()) and MONTHNAME(tanggal_kegiatan)='January' group by bulan ");
	  $data3 = mysqli_fetch_array($sql3);
	   $sql31 = mysqli_query($con,"SELECT *, MONTHNAME(tanggal_kegiatan) as bulan, SUM(jumlah) as ttljam FROM kegiatan where jenis_kegiatan='Istirahat/pribadi' and nama='$_POST[nm]' and YEAR(tanggal_kegiatan)=MONTHNAME(NOW()) and MONTHNAME(tanggal_kegiatan)='February' group by bulan ");
	  $data31 = mysqli_fetch_array($sql31);
	  $sql32 = mysqli_query($con,"SELECT *, MONTHNAME(tanggal_kegiatan) as bulan, SUM(jumlah) as ttljam FROM kegiatan where jenis_kegiatan='Istirahat/pribadi' and nama='$_POST[nm]' and YEAR(tanggal_kegiatan)=MONTHNAME(NOW()) and MONTHNAME(tanggal_kegiatan)='March' group by bulan ");
	  $data32 = mysqli_fetch_array($sql32);
	   $sql33 = mysqli_query($con,"SELECT *, MONTHNAME(tanggal_kegiatan) as bulan, SUM(jumlah) as ttljam FROM kegiatan where jenis_kegiatan='Istirahat/pribadi' and nama='$_POST[nm]' and YEAR(tanggal_kegiatan)=MONTHNAME(NOW()) and MONTHNAME(tanggal_kegiatan)='April' group by bulan ");
	  $data33 = mysqli_fetch_array($sql33);
	   $sql34 = mysqli_query($con,"SELECT *, MONTHNAME(tanggal_kegiatan) as bulan, SUM(jumlah) as ttljam FROM kegiatan where jenis_kegiatan='Istirahat/pribadi' and nama='$_POST[nm]' and YEAR(tanggal_kegiatan)=MONTHNAME(NOW()) and MONTHNAME(tanggal_kegiatan)='May' group by bulan ");
	  $data34 = mysqli_fetch_array($sql34);
	   $sql35 = mysqli_query($con,"SELECT *, MONTHNAME(tanggal_kegiatan) as bulan, SUM(jumlah) as ttljam FROM kegiatan where jenis_kegiatan='Istirahat/pribadi' and nama='$_POST[nm]' and YEAR(tanggal_kegiatan)=MONTHNAME(NOW()) and MONTHNAME(tanggal_kegiatan)='June' group by bulan ");
	  $data35 = mysqli_fetch_array($sql35);
	   $sql36 = mysqli_query($con,"SELECT *, MONTHNAME(tanggal_kegiatan) as bulan, SUM(jumlah) as ttljam FROM kegiatan where jenis_kegiatan='Istirahat/pribadi' and nama='$_POST[nm]' and YEAR(tanggal_kegiatan)=YEAR(NOW()) and MONTHNAME(tanggal_kegiatan)='July' group by bulan");
	  $data36 = mysqli_fetch_array($sql36);
	   $sql37 = mysqli_query($con,"SELECT *, MONTHNAME(tanggal_kegiatan) as bulan, SUM(jumlah) as ttljam FROM kegiatan where jenis_kegiatan='Istirahat/pribadi' and nama='$_POST[nm]' and YEAR(tanggal_kegiatan)=YEAR(NOW()) and MONTHNAME(tanggal_kegiatan)='August' group by bulan");
	  $data37 = mysqli_fetch_array($sql37);
	   $sql38 = mysqli_query($con,"SELECT *, MONTHNAME(tanggal_kegiatan) as bulan, SUM(jumlah) as ttljam FROM kegiatan where jenis_kegiatan='Istirahat/pribadi' and nama='$_POST[nm]' and YEAR(tanggal_kegiatan)=YEAR(NOW()) and MONTHNAME(tanggal_kegiatan)='September' group by bulan");
	  $data38 = mysqli_fetch_array($sql38);
	   $sql39 = mysqli_query($con,"SELECT *, MONTHNAME(tanggal_kegiatan) as bulan, SUM(jumlah) as ttljam FROM kegiatan where jenis_kegiatan='Istirahat/pribadi' and nama='$_POST[nm]' and YEAR(tanggal_kegiatan)=YEAR(NOW()) and MONTHNAME(tanggal_kegiatan)='October' group by bulan");
	  $data39 = mysqli_fetch_array($sql39);
	   $sql310 = mysqli_query($con,"SELECT *, MONTHNAME(tanggal_kegiatan) as bulan, SUM(jumlah) as ttljam FROM kegiatan where jenis_kegiatan='Istirahat/pribadi' and nama='$_POST[nm]' and YEAR(tanggal_kegiatan)=YEAR(NOW()) and MONTHNAME(tanggal_kegiatan)='November' group by bulan");
	  $data310 = mysqli_fetch_array($sql310);
	   $sql311 = mysqli_query($con,"SELECT *, MONTHNAME(tanggal_kegiatan) as bulan, SUM(jumlah) as ttljam FROM kegiatan where jenis_kegiatan='Istirahat/pribadi' and nama='$_POST[nm]' and YEAR(tanggal_kegiatan)=YEAR(NOW()) and MONTHNAME(tanggal_kegiatan)='December' group by bulan");
	  $data311 = mysqli_fetch_array($sql311);
	  
	  //TIDAK LAPOR
	   $sql4 = mysqli_query($con,"SELECT *, MONTHNAME(tanggal_kegiatan) as bulan, '11520'-SUM(jumlah) as ttljam FROM kegiatan where nama='$_POST[nm]' and YEAR(tanggal_kegiatan)=YEAR(NOW()) and MONTHNAME(tanggal_kegiatan)='January' group by bulan ");
	  $data4 = mysqli_fetch_array($sql4);
	   $sql41 = mysqli_query($con,"SELECT *, MONTHNAME(tanggal_kegiatan) as bulan, '11520'-SUM(jumlah) as ttljam FROM kegiatan where nama='$_POST[nm]' and YEAR(tanggal_kegiatan)=YEAR(NOW()) and MONTHNAME(tanggal_kegiatan)='February' group by bulan ");
	  $data41 = mysqli_fetch_array($sql41);
	  $sql42 = mysqli_query($con,"SELECT *, MONTHNAME(tanggal_kegiatan) as bulan, '11520'-SUM(jumlah) as ttljam FROM kegiatan where nama='$_POST[nm]' and YEAR(tanggal_kegiatan)=YEAR(NOW()) and MONTHNAME(tanggal_kegiatan)='March' group by bulan ");
	  $data42 = mysqli_fetch_array($sql42);
	   $sql43 = mysqli_query($con,"SELECT *, MONTHNAME(tanggal_kegiatan) as bulan, '11520'-SUM(jumlah) as ttljam FROM kegiatan where nama='$_POST[nm]' and YEAR(tanggal_kegiatan)=YEAR(NOW()) and MONTHNAME(tanggal_kegiatan)='April' group by bulan ");
	  $data43 = mysqli_fetch_array($sql43);
	   $sql44 = mysqli_query($con,"SELECT *, MONTHNAME(tanggal_kegiatan) as bulan, '11520'-SUM(jumlah) as ttljam FROM kegiatan where nama='$_POST[nm]' and YEAR(tanggal_kegiatan)=YEAR(NOW()) and MONTHNAME(tanggal_kegiatan)='May' group by bulan ");
	  $data44 = mysqli_fetch_array($sql44);
	   $sql45 = mysqli_query($con,"SELECT *, MONTHNAME(tanggal_kegiatan) as bulan, '11520'-SUM(jumlah) as ttljam FROM kegiatan where nama='$_POST[nm]' and YEAR(tanggal_kegiatan)=YEAR(NOW()) and MONTHNAME(tanggal_kegiatan)='June' group by bulan ");
	  $data45 = mysqli_fetch_array($sql45);
	    $sql46 = mysqli_query($con,"SELECT *, MONTHNAME(tanggal_kegiatan) as bulan, '11520'-SUM(jumlah) as ttljam FROM kegiatan where nama='$_POST[nm]' and YEAR(tanggal_kegiatan)=YEAR(NOW()) and MONTHNAME(tanggal_kegiatan)='July' group by bulan ");
	  $data46 = mysqli_fetch_array($sql46);
	    $sql47 = mysqli_query($con,"SELECT *, MONTHNAME(tanggal_kegiatan) as bulan, '11520'-SUM(jumlah) as ttljam FROM kegiatan where nama='$_POST[nm]' and YEAR(tanggal_kegiatan)=YEAR(NOW()) and MONTHNAME(tanggal_kegiatan)='August' group by bulan ");
	  $data47 = mysqli_fetch_array($sql47);
	    $sql48 = mysqli_query($con,"SELECT *, MONTHNAME(tanggal_kegiatan) as bulan, '11520'-SUM(jumlah) as ttljam FROM kegiatan where nama='$_POST[nm]' and YEAR(tanggal_kegiatan)=YEAR(NOW()) and MONTHNAME(tanggal_kegiatan)='September' group by bulan ");
	  $data48 = mysqli_fetch_array($sql48);
	    $sql49 = mysqli_query($con,"SELECT *, MONTHNAME(tanggal_kegiatan) as bulan, '11520'-SUM(jumlah) as ttljam FROM kegiatan where nama='$_POST[nm]' and YEAR(tanggal_kegiatan)=YEAR(NOW()) and MONTHNAME(tanggal_kegiatan)='October' group by bulan ");
	  $data49 = mysqli_fetch_array($sql49);
	    $sql410 = mysqli_query($con,"SELECT *, MONTHNAME(tanggal_kegiatan) as bulan, '11520'-SUM(jumlah) as ttljam FROM kegiatan where nama='$_POST[nm]' and YEAR(tanggal_kegiatan)=YEAR(NOW()) and MONTHNAME(tanggal_kegiatan)='November' group by bulan ");
	  $data410 = mysqli_fetch_array($sql410);
	    $sql411 = mysqli_query($con,"SELECT *, MONTHNAME(tanggal_kegiatan) as bulan, '11520'-SUM(jumlah) as ttljam FROM kegiatan where nama='$_POST[nm]' and YEAR(tanggal_kegiatan)=YEAR(NOW()) and MONTHNAME(tanggal_kegiatan)='December' group by bulan ");
	  $data411 = mysqli_fetch_array($sql411);
	  
	 ?>
      <tr>
        <td>Januari</td>
        <td><?php echo sprintf('%02d jam %02d menit', floor($data1['ttljam']/60), $data1['ttljam']%60);?></td>
       <td><?php echo sprintf('%02d jam %02d menit', floor($data2['ttljam']/60), $data2['ttljam']%60);?></td>
        
       <td><?php echo sprintf('%02d jam %02d menit', floor($data3['ttljam']/60), $data3['ttljam']%60);?></td>
        <td><?php echo sprintf('%02d jam %02d menit', floor($data4['ttljam']/60), $data4['ttljam']%60);?></td>
      </tr>
	   <tr>
        <td>Februari</td>
        <td><?php echo sprintf('%02d jam %02d menit', floor($data11['ttljam']/60), $data11['ttljam']%60);?></td>
          <td><?php echo sprintf('%02d jam %02d menit', floor($data21['ttljam']/60), $data21['ttljam']%60);?></td>
         <td><?php echo sprintf('%02d jam %02d menit', floor($data31['ttljam']/60), $data31['ttljam']%60);?></td>
        <td><?php echo sprintf('%02d jam %02d menit', floor($data41['ttljam']/60), $data41['ttljam']%60);?></td>
      </tr>
	   <tr>
        <td>Maret</td>
        <td><?php echo sprintf('%02d jam %02d menit', floor($data12['ttljam']/60), $data12['ttljam']%60);?></td>
       <td><?php echo sprintf('%02d jam %02d menit', floor($data22['ttljam']/60), $data22['ttljam']%60);?></td>
        <td><?php echo sprintf('%02d jam %02d menit', floor($data32['ttljam']/60), $data32['ttljam']%60);?></td>
        <td><?php echo sprintf('%02d jam %02d menit', floor($data42['ttljam']/60), $data42['ttljam']%60);?></td>
      </tr>
	   <tr>
        <td>April</td>
        <td><?php echo sprintf('%02d jam %02d menit', floor($data13['ttljam']/60), $data13['ttljam']%60);?></td>
        <td><?php echo sprintf('%02d jam %02d menit', floor($data23['ttljam']/60), $data23['ttljam']%60);?></td>
       <td><?php echo sprintf('%02d jam %02d menit', floor($data33['ttljam']/60), $data33['ttljam']%60);?></td>
        <td><?php echo sprintf('%02d jam %02d menit', floor($data43['ttljam']/60), $data43['ttljam']%60);?></td>
      </tr>
	   <tr>
        <td>Mei</td>
        <td><?php echo sprintf('%02d jam %02d menit', floor($data14['ttljam']/60), $data14['ttljam']%60);?></td>
         <td><?php echo sprintf('%02d jam %02d menit', floor($data24['ttljam']/60), $data24['ttljam']%60);?></td>
       <td><?php echo sprintf('%02d jam %02d menit', floor($data34['ttljam']/60), $data34['ttljam']%60);?></td>
        <td><?php echo sprintf('%02d jam %02d menit', floor($data44['ttljam']/60), $data44['ttljam']%60);?></td>
      </tr>
	   <tr>
        <td>Juni</td>
        <td><?php echo sprintf('%02d jam %02d menit', floor($data15['ttljam']/60), $data15['ttljam']%60);?></td>
        <td><?php echo sprintf('%02d jam %02d menit', floor($data25['ttljam']/60), $data25['ttljam']%60);?></td>
       <td><?php echo sprintf('%02d jam %02d menit', floor($data35['ttljam']/60), $data35['ttljam']%60);?></td>
        <td><?php echo sprintf('%02d jam %02d menit', floor($data45['ttljam']/60), $data45['ttljam']%60);?></td>
      </tr>
	   <tr>
        <td>Juli</td>
        <td><?php echo sprintf('%02d jam %02d menit', floor($data16['ttljam']/60), $data16['ttljam']%60);?></td>
        <td><?php echo sprintf('%02d jam %02d menit', floor($data26['ttljam']/60), $data26['ttljam']%60);?></td>
       <td><?php echo sprintf('%02d jam %02d menit', floor($data36['ttljam']/60), $data36['ttljam']%60);?></td>
        <td><?php echo sprintf('%02d jam %02d menit', floor($data46['ttljam']/60), $data46['ttljam']%60);?></td>
      </tr>
	   <tr>
        <td>Agustus</td>
        <td><?php echo sprintf('%02d jam %02d menit', floor($data17['ttljam']/60), $data17['ttljam']%60);?></td>
        <td><?php echo sprintf('%02d jam %02d menit', floor($data27['ttljam']/60), $data27['ttljam']%60);?></td>
       <td><?php echo sprintf('%02d jam %02d menit', floor($data37['ttljam']/60), $data37['ttljam']%60);?></td>
        <td><?php echo sprintf('%02d jam %02d menit', floor($data47['ttljam']/60), $data47['ttljam']%60);?></td>
      </tr>
	   <tr>
        <td>September</td>
        <td><?php echo sprintf('%02d jam %02d menit', floor($data18['ttljam']/60), $data18['ttljam']%60);?></td>
        <td><?php echo sprintf('%02d jam %02d menit', floor($data28['ttljam']/60), $data28['ttljam']%60);?></td>
       <td><?php echo sprintf('%02d jam %02d menit', floor($data38['ttljam']/60), $data38['ttljam']%60);?></td>
        <td><?php echo sprintf('%02d jam %02d menit', floor($data48['ttljam']/60), $data48['ttljam']%60);?></td>
      </tr>
	   <tr>
        <td>Oktober</td>
        <td><?php echo sprintf('%02d jam %02d menit', floor($data19['ttljam']/60), $data19['ttljam']%60);?></td>
        <td><?php echo sprintf('%02d jam %02d menit', floor($data29['ttljam']/60), $data29['ttljam']%60);?></td>
       <td><?php echo sprintf('%02d jam %02d menit', floor($data39['ttljam']/60), $data39['ttljam']%60);?></td>
        <td><?php echo sprintf('%02d jam %02d menit', floor($data49['ttljam']/60), $data49['ttljam']%60);?></td>
      </tr>
	   <tr>
        <td>November</td>
        <td><?php echo sprintf('%02d jam %02d menit', floor($data110['ttljam']/60), $data110['ttljam']%60);?></td>
        <td><?php echo sprintf('%02d jam %02d menit', floor($data210['ttljam']/60), $data210['ttljam']%60);?></td>
       <td><?php echo sprintf('%02d jam %02d menit', floor($data310['ttljam']/60), $data310['ttljam']%60);?></td>
        <td><?php echo sprintf('%02d jam %02d menit', floor($data410['ttljam']/60), $data410['ttljam']%60);?></td>
      </tr>
	   <tr>
        <td>Desember</td>
        <td><?php echo sprintf('%02d jam %02d menit', floor($data111['ttljam']/60), $data111['ttljam']%60);?></td>
        <td><?php echo sprintf('%02d jam %02d menit', floor($data211['ttljam']/60), $data211['ttljam']%60);?></td>
       <td><?php echo sprintf('%02d jam %02d menit', floor($data311['ttljam']/60), $data311['ttljam']%60);?></td>
        <td><?php echo sprintf('%02d jam %02d menit', floor($data411['ttljam']/60), $data411['ttljam']%60);?></td>
      </tr>
    </table>  
  </body>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

