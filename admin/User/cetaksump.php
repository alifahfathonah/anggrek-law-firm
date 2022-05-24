<?php
session_start();
ob_start();

// Panggil koneksi database.php untuk koneksi database
include "../../config/koneksi.php";
//include "../config/fungsi_tanggal.php";
$hari_ini = date("d-m-Y");

// ambil data hasil submit dari form
$awal     = $_GET['awal'];
$akhir    = $_GET['akhir'];

	  $pengacara = $_GET['pengacara'];  



if ($_GET['awal'] != '' && $_GET['akhir'] && $_GET['pengacara']) {
    $no    = 1;
    // fungsi query untuk menampilkan data
    $query = mysqli_query($con,"SELECT * FROM tbl_lump p LEFT JOIN tbl_kasus k ON p.no_kasus=k.id_kasus LEFT JOIN tbl_client c On c.id_client=p.nama_client LEFT JOIN tbl_pengacara pe ON pe.id_pengacara=p.idpengacara where p.tanggal between '$awal' and '$akhir'  and p.idpengacara='$pengacara'");
    
}elseif($_GET['awal'] != '' && $_GET['akhir']){
    $no    = 1;
    // fungsi query untuk menampilkan data
    $query = mysqli_query($con,"SELECT * FROM tbl_lump p LEFT JOIN tbl_kasus k ON p.no_kasus=k.id_kasus LEFT JOIN tbl_client c On c.id_client=p.nama_client LEFT JOIN tbl_pengacara pe ON pe.id_pengacara=p.idpengacara where p.tanggal between '$awal' and '$akhir'");
}
?>

<body onLoad="javascript:print()"> 
<html xmlns="http://www.w3.org/1999/xhtml"> <!-- Bagian halaman HTML yang akan konvert -->
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>LAPORAN DATA LUMP SUM</title>
        <link rel="stylesheet" type="text/css" href="../assets/laporan.css" />
    </head>
    <body>
        <div id="title" align="center">
		<h2>MIKO KAMAL & ASSOCIATES</h2>
            LAPORAN DATA LUMP SUM<br/> 
             <h5>Periode Tanggal <?php echo $awal.' s/d '.$akhir ?> </h5>
        </div>
       
        <hr><br>
        <div id="isi">
            <table width="100%" border="1" cellpadding="0" cellspacing="0">
                <thead style="background:#e8ecee">
                    <tr class="tr-title">
                        <th height="20" align="center" valign="middle">NO.</th>
                        <th height="20" align="center" valign="middle">Tanggal</th>
                        <th height="20" align="center" valign="middle">Nama Client</th>
                        <th height="20" align="center" valign="middle">No Kasus</th>
                        <th height="20" align="center" valign="middle">Keterangan</th>
                        <th height="20" align="center" valign="middle">Nama Pengacara</th>
                    </tr>
                </thead>
                <tbody>
<?php
    
        // tampilkan data
        while ($data = mysqli_fetch_assoc($query)) {
            /*$tanggal       = $data['tanggal'];
            $exp           = explode('-',$tanggal);
            $tanggal_terima = $exp[2]."-".$exp[1]."-".$exp[0];*/

            // menampilkan isi tabel dari database ke tabel di aplikasi
            echo "  <tr>
                        <td width='30' height='13' align='center' valign='middle'>$no</td>
                         <td style='padding-left:5px;' height='13' valign='middle'> $data[tanggal]</td>
                        <td  height='13'  valign='middle'> $data[nama_client]</td>
                        <td  height='13'  valign='middle'> $data[no_kasus]</td>
                        <td  height='13'  valign='middle' > $data[keterangan]</td>
                        <td  height='13'  valign='middle' > $data[nama_pengacara]</td>

                    </tr>";
            $no++;
        }
    
?>
                </tbody>
            </table>

           