<?php
session_start();
ob_start();

// Panggil koneksi database.php untuk koneksi database
include "../../config/koneksi.php";
//include "../config/fungsi_tanggal.php";
	  if(isset($_GET['awal'])){
     $hari_ini = date("d-m-Y");

// ambil data hasil submit dari form
$awal     = $_GET['awal'];
$akhir    = $_GET['akhir'];

	  $pengacara = $_GET['pengacara'];  

      $no=1; 
	 
					$be = mysqli_query($con, "SELECT * FROM tbl_jlibur where tanggal_libur between '$awal' and '$akhir' and id_pengacara like '%$pengacara%'order by id_libur desc");
     
    }else{
   
		$be = mysqli_query($con, "SELECT * FROM tbl_office,tbl_pengacara where tbl_office.nama=tbl_pengacara.id_pengacara  order by tbl_office.idkegiatan desc");
    }
?>

<body onLoad="javascript:print()"> 
<html xmlns="http://www.w3.org/1999/xhtml"> <!-- Bagian halaman HTML yang akan konvert -->
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>LAPORAN DATA JADWAL LIBUR</title>
        <link rel="stylesheet" type="text/css" href="../assets/laporan.css" />
    </head>
    <body>
        <div id="title" align="center">
		<h2>MIKO KAMAL & ASSOCIATES</h2>
            LAPORAN DATA JADWAL LIBUR<br/> 
             <h5>Periode Tanggal <?php echo $awal.' s/d '.$akhir ?> </h5>
        </div>
       
        <hr><br>
        <div id="isi">
              <table id="example1" class="table table-bordered table-striped" border="1" width="100%">
                <thead>
                <tr>
					<th rowspan="2">No</th>
          <th colspan="2" style="text-align: center;">Tanggal Jadwal</th>
		  <th rowspan="2">Kategori Libur</th>
		  <th rowspan="2">Nama </th>
					<th rowspan="2">Keterangan</th>
                </tr>
                <tr>
                  <th>Mulai</th>
                  <th>Akhir</th>
                </tr>
                </thead>
                <tbody>
				<?php
					$no=1;
					while($r=mysqli_fetch_assoc($be)){
				?>

				<tr>
					<td><?= $no; ?></td>
          <td><?= $r["tanggal_libur"];?></td>
          <td><?= $r["tanggal_liburakhir"];?></td>
		  <td><?= $r["kategori"];?></td>
		  <td><?= $r["id_pengacara"];?></td>
					<td><?= $r["keterangan"];?></td>
					
				</tr>
					<?php $no++; } ?>
				</tfoot>
              </table>

           