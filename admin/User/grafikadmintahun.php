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
                <div class="col-sm-3">
                <select name="nm" class="form-control">
                  <option value="">--Pilih Pengacara--</option>
                  <?php
                    $sql=mysqli_query($con,"SELECT * FROM tbl_pengacara");
                    while ($data=mysqli_fetch_array($sql)) {
                      echo "<option value='$data[id_pengacara]'>$data[nama_pengacara]</option>";
                    }
                  ?>
                </select></div>
                <div class="col-sm-2">
                <select name="tahun" class="form-control" id="tahun">
                  <option value="">--Pilih Tahun--</option>
                  <option value="2018">2018</option>
                  <option value="2019">2019</option>
                  <option value="2020">2020</option>
                  <option value="2021">2021</option>
                </select></div>
                <div class="col-sm-2">
                    <input type="hidden" name="thn" id="thn">
                </div>
                 <div class="col-sm-7">
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
      
      $('#tahun').on('change', function() {
          var tahun = $("#tahun").val();
          document.getElementById("thn").value=tahun;
      });
    
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
        
        if($_POST['thn'] == ''){
            $th = date('Y');
        }else{
            $th = $_POST['thn'];
        }
        if(isset($_POST['a'])){
        $sql = mysqli_query($con,"SELECT *, YEAR(tanggal_kegiatan) as hari, SUM(jumlah) as ttljam FROM kegiatan where jenis_kegiatan='Dalam Kantor' and nama='$_POST[nm]' and YEAR(tanggal_kegiatan)='$th' group by YEAR(tanggal_kegiatan)");
      }else if(isset($_POST['b'])){
        $sql = mysqli_query($con,"SELECT *, YEAR(tanggal_kegiatan) as hari, SUM(jumlah) as ttljam FROM kegiatan where jenis_kegiatan='Luar Kantor' and nama='$_POST[nm]' and YEAR(tanggal_kegiatan)='$th' group by YEAR(tanggal_kegiatan)");
      }else if(isset($_POST['c'])){
        $sql = mysqli_query($con,"SELECT *, YEAR(tanggal_kegiatan) as hari, SUM(jumlah) as ttljam FROM kegiatan where jenis_kegiatan='Istirahat/pribadi' and nama='$_POST[nm]' and YEAR(tanggal_kegiatan)='$th' group by YEAR(tanggal_kegiatan)");
      }else if(isset($_POST['d'])){
        $sql = mysqli_query($con,"SELECT *, YEAR(tanggal_kegiatan) as hari, '115200'-SUM(jumlah) as ttljam FROM kegiatan where  nama='$_POST[nm]' and YEAR(tanggal_kegiatan)='$th' group by YEAR(tanggal_kegiatan) ");
      }

        while ($data = mysqli_fetch_array($sql)) {
          $ttljam = $data['ttljam'];
          $hari = $data['hari'];
         

         

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
	  $sql1 = mysqli_query($con,"SELECT *, YEAR(tanggal_kegiatan) as hari, SUM(jumlah) as ttljam FROM kegiatan where jenis_kegiatan='Dalam Kantor' and nama='$_POST[nm]' and YEAR(tanggal_kegiatan)='$th' group by YEAR(tanggal_kegiatan)");
	  $data1 = mysqli_fetch_array($sql1);
	  
	   
	   
	  //LUAR KANTOR 
	  	  $sql2 = mysqli_query($con,"SELECT *, YEAR(tanggal_kegiatan) as hari, SUM(jumlah) as ttljam FROM kegiatan where jenis_kegiatan='Luar Kantor' and nama='$_POST[nm]' and YEAR(tanggal_kegiatan)='$th' group by YEAR(tanggal_kegiatan)");
	  $data2 = mysqli_fetch_array($sql2);
	  
	  
	  //ISTIRAHAT
	    $sql3 = mysqli_query($con,"SELECT *, YEAR(tanggal_kegiatan) as hari, SUM(jumlah) as ttljam FROM kegiatan where jenis_kegiatan='Istirahat/pribadi' and nama='$_POST[nm]' and YEAR(tanggal_kegiatan)='$th' group by YEAR(tanggal_kegiatan)");
	  $data3 = mysqli_fetch_array($sql3);
	  
	  
	  
	  //TIDAK LAPOR
	   $sql4 = mysqli_query($con,"SELECT *, YEAR(tanggal_kegiatan) as hari, '115200'-SUM(jumlah) as ttljam FROM kegiatan where  nama='$_POST[nm]' and YEAR(tanggal_kegiatan)='$th' group by YEAR(tanggal_kegiatan) ");
	  $data4 = mysqli_fetch_array($sql4);
	  
	  $thn=date("Y");
	 ?>
      <tr>
        <td><?php echo $th; ?></td>
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

