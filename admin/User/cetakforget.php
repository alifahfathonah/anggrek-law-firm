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
	 
     
		$be = mysqli_query($con, "SELECT * FROM tbl_forget,tbl_pengacara where tbl_forget.nama=tbl_pengacara.id_pengacara and tbl_forget.tanggal_kegiatan between '$awal' and '$akhir' and tbl_forget.nama like '%$pengacara%'  order by tbl_forget.idkegiatan desc");
    }else{
   
		$be = mysqli_query($con, "SELECT * FROM tbl_forget,tbl_pengacara where tbl_forget.nama=tbl_pengacara.id_pengacara  order by tbl_forget.idkegiatan desc");
    }
?>

<body onLoad="javascript:print()"> 
<html xmlns="http://www.w3.org/1999/xhtml"> <!-- Bagian halaman HTML yang akan konvert -->
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>LAPORAN DATA</title>
        <link rel="stylesheet" type="text/css" href="../assets/laporan.css" />
    </head>
    <body>
        <div id="title" align="center">
		<h2>MIKO KAMAL & ASSOCIATES</h2>
            Laporan Data Forgotten Activities<br/> 
             <h5>Periode Tanggal <?php echo $awal.' s/d '.$akhir ?> </h5>
        </div>
       
        <hr><br>
        <div id="isi">
             <table id="example1" class="table table-bordered table-striped" border="1" width="100%">
                <thead>
                <tr>
					<th rowspan="2">No</th>
					<th rowspan="2">Jenis Kegiatan</th>
					<th rowspan="2">Kegiatan</th>
          <th rowspan="2">Tanggal Kegiatan</th>
					<th colspan="2" style="text-align: center;">Jadwal</th>
          <th rowspan="2">Keterangan</th>
		  <th rowspan="2">Nama Pengacara </th>
                </tr>
                <tr>
                  <th>Mulai</th>
                  <th>Akhir</th>
                </tr>
                </thead>
                <tbody>
				<?php
			
					
					while($r=mysqli_fetch_assoc($be)){
				?>

				<tr>
					<td><?= $no; ?></td>
					<td><?= $r["jenis_kegiatan"];?></td>
					<td><?= $r["kegiatan"];?></td>
					<td><?= $r["tanggal_kegiatan"];?></td>
					<td><?= $r["jam_mulai"];?></td>
					
          <td><?= $r["jam_akhir"];?></td>
          <td><?= $r["keterangan"];?></td>
          <td><?= $r["nama_pengacara"];?></td>
		 
					
				</tr>
					<?php $no++; } ?>
				</tfoot>
              </table>

           