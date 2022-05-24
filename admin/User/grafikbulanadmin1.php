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
                <div class="col-sm-6">
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
              categories: ['Minggu']
          },
          yAxis: {
              title: {
              text: 'Jumlah'
            }
        },
    series:             
            
      [
        <?php 
        //$tahun=date('m');

        function listMingguPerBulan($tahun = 0){
  //jan digadua dulu, wkwkwkwk
  
            global $con;
            $list = array();

            for($i = 1; $i <= 12 ; $i++){
              if($tahun == 0) 
                $tahun = date("Y");
              if($i < 10)
                $tgl = $tahun ."-0". $i ."-01";
              else
                $tgl = $tahun ."-". $i ."-01";    
              $data = $con->query("SELECT WEEK('$tgl') AS minggu FROM kegiatan");
              $hasil = $data->fetch_object();
              $list[$i] = $hasil->minggu;
            }
            //spesial untuk akhir tahun
            $data = $con->query("SELECT WEEK('$tahun-12-31') AS minggu FROM kegiatan");
            $hasil = $data->fetch_object();
            $list[13] = $hasil->minggu;

            return $list;
          }
          $list = listMingguPerBulan();

        if(isset($_POST['a'])){
       /* $sql = mysqli_query($con,"SELECT *,WEEK(tanggal_kegiatan) as minggu,SUM(jumlah) as ttljam FROM kegiatan WHERE WEEK(tanggal_kegiatan) >= $list[9] AND WEEK(tanggal_kegiatan) < $list[10]  and  jenis_kegiatan='Dalam Kantor' and nama='$_SESSION[id_client]'");*/
       $sql = mysqli_query($con,"SELECT * , WEEK(tanggal_kegiatan) as bulan, SUM(jumlah) as ttljam FROM kegiatan WHERE WEEK(tanggal_kegiatan) >= $list[9] AND WEEK(tanggal_kegiatan) < $list[10] AND nama='$_POST[nm]' and jenis_kegiatan='Dalam Kantor' and MONTH(tanggal_kegiatan)=MONTH(NOW()) group by bulan");
      }else if(isset($_POST['b'])){
        $sql = mysqli_query($con,"SELECT * , WEEK(tanggal_kegiatan) as bulan, SUM(jumlah) as ttljam FROM kegiatan WHERE WEEK(tanggal_kegiatan) >= $list[9] AND WEEK(tanggal_kegiatan) < $list[10] AND nama='$_POST[nm]' and jenis_kegiatan='Luar Kantor' and MONTH(tanggal_kegiatan)=MONTH(NOW()) group by bulan");
      }else if(isset($_POST['c'])){
        $sql = mysqli_query($con,"SELECT * , WEEK(tanggal_kegiatan) as bulan, SUM(jumlah) as ttljam FROM kegiatan WHERE WEEK(tanggal_kegiatan) >= $list[9] AND WEEK(tanggal_kegiatan) < $list[10] AND nama='$_POST[nm]' and jenis_kegiatan='Istirahat/pribadi' and MONTH(tanggal_kegiatan)=MONTH(NOW()) group by bulan");
      }else if(isset($_POST['d'])){
        $sql = mysqli_query($con,"SELECT * , WEEK(tanggal_kegiatan) as bulan, '2880'-SUM(jumlah) as ttljam FROM kegiatan WHERE WEEK(tanggal_kegiatan) >= $list[9] AND WEEK(tanggal_kegiatan) < $list[10] AND nama='$_POST[nm]' and MONTH(tanggal_kegiatan)=MONTH(NOW()) group by bulan ");
      }else{
         $sql = mysqli_query($con,"SELECT * , WEEK(tanggal_kegiatan) as bulan, SUM(jumlah) as ttljam FROM kegiatan WHERE WEEK(tanggal_kegiatan) >= $list[9] AND WEEK(tanggal_kegiatan) < $list[10] AND nama='$_POST[nm]' and jenis_kegiatan='Dalam Kantor' and MONTH(tanggal_kegiatan)=MONTH(NOW()) group by bulan");
      }
 $a = 1;
        while ($data = mysqli_fetch_array($sql)) {
          $ttljam = $data['ttljam'];
          $bulan = $data['bulan'];
         

    $mingguKe = "Minggu ". $a++;
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
            name: '<?php echo $mingguKe; ?>',
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
	<table width="100%" border="1"  class="table table-bordered table-striped">
      <tr class="info">
        <td></td>
        <td>Minggu</td>
        <td>Waktu</td>
      </tr>
	 <?php
	 //DALAM KANTOR
       $sql1 = mysqli_query($con,"SELECT * , WEEK(tanggal_kegiatan) as bulan, SUM(jumlah) as ttljam FROM kegiatan WHERE WEEK(tanggal_kegiatan) >= $list[9] AND WEEK(tanggal_kegiatan) < $list[10] AND nama='$_POST[nm]' and jenis_kegiatan='Dalam Kantor' and MONTH(tanggal_kegiatan)=MONTH(NOW()) group by bulan");
	   
	   
	  //LUAR KANTOR 
        $sql2 = mysqli_query($con,"SELECT * , WEEK(tanggal_kegiatan) as bulan, SUM(jumlah) as ttljam FROM kegiatan WHERE WEEK(tanggal_kegiatan) >= $list[9] AND WEEK(tanggal_kegiatan) < $list[10] AND nama='$_POST[nm]' and jenis_kegiatan='Luar Kantor' and MONTH(tanggal_kegiatan)=MONTH(NOW()) group by bulan");
	  
	  //ISTIRAHAT
        $sql3 = mysqli_query($con,"SELECT * , WEEK(tanggal_kegiatan) as bulan, SUM(jumlah) as ttljam FROM kegiatan WHERE WEEK(tanggal_kegiatan) >= $list[9] AND WEEK(tanggal_kegiatan) < $list[10] AND nama='$_POST[nm]' and jenis_kegiatan='Istirahat/pribadi' and MONTH(tanggal_kegiatan)=MONTH(NOW()) group by bulan");
	  
	  //TIDAK LAPOR
        $sql4 = mysqli_query($con,"SELECT * , WEEK(tanggal_kegiatan) as bulan, '2880'-SUM(jumlah) as ttljam FROM kegiatan WHERE WEEK(tanggal_kegiatan) >= $list[9] AND WEEK(tanggal_kegiatan) < $list[10] AND nama='$_POST[nm]' and MONTH(tanggal_kegiatan)=MONTH(NOW()) group by bulan ");
		
	?>
	
	<!-- Start Dalam Kantor -->
	<tr>
		<td colspan=3><b>Dalam Kantor</b></td>
	</tr>
	<?php
		$cek1 = mysqli_num_rows($sql1);
		if($cek1 < 1){
			echo "<tr><td colspan=3>Data Tidak Ditemukan</td></tr>";
		}else{
		while($data1=mysqli_fetch_array($sql1)){
			$ttljam1 = $data1['ttljam'];
            $bulan1 = $data1['bulan'];
	 ?>
	 
	  <tr>
		<td></td>
		<td>Minggu <?= $bulan1 ?></td>
        <td><?php echo sprintf('%02d jam %02d menit', floor($data1['ttljam']/60), $data1['ttljam']%60);?></td>
	  </tr>
		<?php } } ?>
	<!-- End Dalam Kantor -->
	
	<!-- Start Luar Kantor -->
	<tr>
		<td colspan=3><b>Luar Kantor</b></td>
	</tr>
	<?php
		$cek2 = mysqli_num_rows($sql2);
		if($cek2 < 1){
			echo "<tr><td colspan=3>Data Tidak Ditemukan</td></tr>";
		}else{
		while($data2=mysqli_fetch_array($sql2)){
			$ttljam2 = $data2['ttljam'];
            $bulan2 = $data2['bulan'];
	 ?>
	 
	  <tr>
		<td></td>
		<td>Minggu <?= $bulan2 ?></td>
        <td><?php echo sprintf('%02d jam %02d menit', floor($data2['ttljam']/60), $data2['ttljam']%60);?></td>
	  </tr>
		<?php }} ?>
	<!-- End Luar Kantor -->
	
	<!-- Start Istirahat -->
	<tr>
		<td colspan=3><b>Istirahat</b></td>
	</tr>
	<?php
		$cek3 = mysqli_num_rows($sql3);
		if($cek3 < 1){
			echo "<tr><td colspan=3>Data Tidak Ditemukan</td></tr>";
		}else{
		while($data3=mysqli_fetch_array($sql3)){
			$ttljam3 = $data3['ttljam'];
            $bulan3 = $data3['bulan'];
	 ?>
	 
	  <tr>
		<td></td>
		<td>Minggu <?= $bulan3 ?></td>
        <td><?php echo sprintf('%02d jam %02d menit', floor($data3['ttljam']/60), $data3['ttljam']%60);?></td>
	  </tr>
		<?php }} ?>
	<!-- End Istirahat -->
	
	<!-- Start Tidak Lapor -->
	<tr>
		<td colspan=3><b>Tidak Lapor</b></td>
	</tr>
	<?php
		$cek4 = mysqli_num_rows($sql4);
		if($cek4 < 1){
			echo "<tr><td colspan=3>Data Tidak Ditemukan</td></tr>";
		}else{
		while($data4=mysqli_fetch_array($sql4)){
			$ttljam4 = $data4['ttljam'];
            $bulan4 = $data4['bulan'];
	 ?>
	 
	  <tr>
		<td></td>
		<td>Minggu <?= $bulan4 ?></td>
        <td><?php echo sprintf('%02d jam %02d menit', floor($data4['ttljam']/60), $data4['ttljam']%60);?></td>
	  </tr>
		<?php }} ?>
	<!-- End Tidak Lapor -->
		
    </table>
  </body>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

