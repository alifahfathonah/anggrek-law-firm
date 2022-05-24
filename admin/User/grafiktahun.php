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
      <div class="row">
        <div class="col-md-12">

          <div class="box-footer">
            <div class="form-group">
              <form action="" method="post" class="form-horizontal">
                <input type="submit" name="a" value="Dalam Kantor" class="btn btn-primary">
                <input type="submit" name="b" value="Luar Kantor" class="btn btn-primary">
                <input type="submit" name="c" value="Istirahat/pribadi" class="btn btn-primary">
                <input type="submit" name="d" value="Tidak Lapor" class="btn btn-primary">
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
              text: '<?php echo "$_POST[a]"."$_POST[b]"."$_POST[c]"."$_POST[d]";?>'
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
		 $sql = mysqli_query($con,"SELECT *, YEAR(tanggal_kegiatan) as hari, SUM(jumlah) as ttljam FROM kegiatan where jenis_kegiatan='Dalam Kantor' and nama='$_SESSION[id_client]' and YEAR(tanggal_kegiatan)=YEAR(NOW()) group by YEAR(tanggal_kegiatan)");
      }else if(isset($_POST['b'])){
        $sql = mysqli_query($con,"SELECT *, YEAR(tanggal_kegiatan) as hari, SUM(jumlah) as ttljam FROM kegiatan where jenis_kegiatan='Luar Kantor' and nama='$_SESSION[id_client]' and YEAR(tanggal_kegiatan)=YEAR(NOW()) group by YEAR(tanggal_kegiatan)");
      }else if(isset($_POST['c'])){
        $sql = mysqli_query($con,"SELECT *, YEAR(tanggal_kegiatan) as hari, SUM(jumlah) as ttljam FROM kegiatan where jenis_kegiatan='Istirahat/pribadi' and nama='$_SESSION[id_client]' and YEAR(tanggal_kegiatan)=YEAR(NOW()) group by YEAR(tanggal_kegiatan)");
      }else if(isset($_POST['d'])){
        $sql = mysqli_query($con,"SELECT *, YEAR(tanggal_kegiatan) as hari, '115200'-SUM(jumlah) as ttljam FROM kegiatan where  nama='$_SESSION[id_client]' and YEAR(tanggal_kegiatan)=YEAR(NOW()) group by YEAR(tanggal_kegiatan) ");
      }
		else{
        $sql = mysqli_query($con,"SELECT *, YEAR(tanggal_kegiatan) as hari, SUM(jumlah) as ttljam FROM kegiatan where jenis_kegiatan='Dalam Kantor' and nama='$_SESSION[id_client]' and YEAR(tanggal_kegiatan)=YEAR(NOW()) group by YEAR(tanggal_kegiatan)");
      }

        while ($data = mysqli_fetch_array($sql)) {
           $ttljam = $data['ttljam'];
          $hari = $data['hari'];
         /* $jam   = floor($diff / (60 * 60));
          $menit = $diff - $jam * (60 * 60);
          $jumlah = $jam.".".floor($menit / 60);*/

         

        ?>
          {
            name: '<?php echo $hari; ?>',
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
        <td>Tahun</td>
        <td>Dalam Kantor </td>
        <td>Luar Kantor </td>
        <td>Istirahat</td>
        <td>Tidak Lapor </td>
      </tr>
	 <?php
	 //DALAM KANTOR
	  $sql1 = mysqli_query($con,"SELECT *, YEAR(tanggal_kegiatan) as hari, SUM(jumlah) as ttljam FROM kegiatan where jenis_kegiatan='Dalam Kantor' and nama='$_SESSION[id_client]' and YEAR(tanggal_kegiatan)=YEAR(NOW()) group by YEAR(tanggal_kegiatan)");
	  $data1 = mysqli_fetch_array($sql1);
	  
	   
	   
	  //LUAR KANTOR 
	  	  $sql2 = mysqli_query($con,"SELECT *, YEAR(tanggal_kegiatan) as hari, SUM(jumlah) as ttljam FROM kegiatan where jenis_kegiatan='Luar Kantor' and nama='$_SESSION[id_client]' and YEAR(tanggal_kegiatan)=YEAR(NOW()) group by YEAR(tanggal_kegiatan)");
	  $data2 = mysqli_fetch_array($sql2);
	  
	  
	  //ISTIRAHAT
	    $sql3 = mysqli_query($con,"SELECT *, YEAR(tanggal_kegiatan) as hari, SUM(jumlah) as ttljam FROM kegiatan where jenis_kegiatan='Istirahat/pribadi' and nama='$_SESSION[id_client]' and YEAR(tanggal_kegiatan)=YEAR(NOW()) group by YEAR(tanggal_kegiatan)");
	  $data3 = mysqli_fetch_array($sql3);
	  
	  
	  
	  //TIDAK LAPOR
	   $sql4 = mysqli_query($con,"SELECT *, YEAR(tanggal_kegiatan) as hari, '115200'-SUM(jumlah) as ttljam FROM kegiatan where  nama='$_SESSION[id_client]' and YEAR(tanggal_kegiatan)=YEAR(NOW()) group by YEAR(tanggal_kegiatan) ");
	  $data4 = mysqli_fetch_array($sql4);
	  
	  $thn=date("Y");
	 ?>
      <tr>
        <td><?php echo $thn; ?></td>
        <td><?php echo sprintf('%02d jam %02d menit', floor($data1['ttljam']/60), $data1['ttljam']%60);?></td>
       <td><?php echo sprintf('%02d jam %02d menit', floor($data2['ttljam']/60), $data2['ttljam']%60);?></td>
        
       <td><?php echo sprintf('%02d jam %02d menit', floor($data3['ttljam']/60), $data3['ttljam']%60);?></td>
        <td><?php echo sprintf('%02d jam %02d menit', floor($data4['ttljam']/60), $data4['ttljam']%60);?></td>
      </tr>
	   
    </table>  
  </body>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

