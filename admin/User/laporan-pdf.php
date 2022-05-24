<?php
session_start();
ob_start();

// Panggil koneksi database.php untuk koneksi database
require_once "../../config/koneksi.php";
//include "../config/fungsi_tanggal.php";
$hari_ini = date("d-m-Y");

// ambil data hasil submit dari form
$pengacara     = $_GET['pengacara'];
$tanggal      =$_GET['tgl'];



if (isset($_GET['tgl'])) {
    $no    = 1;
    // fungsi query untuk menampilkan data
    $query = mysqli_query($con,"SELECT * FROM tbl_jadwal j LEFT JOIN tbl_pengacara p ON j.idpengacara=p.id_pengacara where j.tgl_jadwal like '%$tanggal%' and p.id_pengacara like '%$pengacara%'");
    $count  = mysqli_num_rows($query);
}
?>
<html xmlns="http://www.w3.org/1999/xhtml"> <!-- Bagian halaman HTML yang akan konvert -->
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>LAPORAN DATA JADWAL</title>
        <link rel="stylesheet" type="text/css" href="../assets/laporan.css" />
    </head>
    <body>
        <div id="title">
            LAPORAN DATA JADWAL
        </div>

        <hr><br>
        <div id="isi">
            <table width="100%" border="0.3" cellpadding="0" cellspacing="0">
                <thead style="background:#e8ecee">
                    <tr class="tr-title">
                        <th rowspan="2" height="20" align="center" valign="middle">NO.</th>
                        <th rowspan="2" height="20" align="center" valign="middle">Nama Pengacara</th>
                        <th colspan="2" height="20" align="center" valign="middle">Jadwal</th>
                        <th rowspan="2" height="20" align="center" valign="middle">Tanggal</th>
                        <th rowspan="2" height="20" align="center" valign="middle">Keterangan</th>
                    </tr>
                    <tr>
                        <th align="center" valign="middle">Awal</th>
                        <th align="center" valign="middle">Akhir</th>
                    </tr>

                </thead>
                <tbody>
<?php
    // jika data ada
    if($count == 0) {
        echo "  <tr>
                    <td width='30' height='13' align='center' valign='middle'></td>
                    <td width='150' height='13' align='center' valign='middle'></td>
                    <td width='80' height='13' align='center' valign='middle'></td>
                    <td width='110' height='13' align='center' valign='middle'></td>
                    <td style='padding-left:5px;' width='190' height='13' valign='middle'></td>
                </tr>";
    }
    // jika data tidak ada
    else {
        // tampilkan data
        while ($data = mysqli_fetch_assoc($query)) {
            /*$tanggal       = $data['tanggal'];
            $exp           = explode('-',$tanggal);
            $tanggal_terima = $exp[2]."-".$exp[1]."-".$exp[0];*/

            // menampilkan isi tabel dari database ke tabel di aplikasi
            echo "  <tr>
                        <td width='30' height='13' align='center' valign='middle'>$no</td>
                         <td style='padding-left:5px;' width='150' height='13' valign='middle'>$data[nama_pengacara]</td>
                        <td width='90' height='13' align='center' valign='middle'>$data[jadwal_awal]</td>
                        <td width='90' height='13' align='center' valign='middle'>$data[jadwal_akhir]</td>
                        <td style='padding-left:5px;' width='110' align='center' height='13' valign='middle'>$data[tgl_jadwal]</td>
                        <td style='padding-right:10px;' width='190' height='13'  valign='middle'>$data[keterangan]</td>

                    </tr>";
            $no++;
        }
    }
?>
                </tbody>
            </table>

            <div id="footer-tanggal">

            </div>
        </div>
    </body>
</html><!-- Akhir halaman HTML yang akan di konvert -->
<?php
$filename="LAPORAN DATA JADWAL.pdf"; //ubah untuk menentukan nama file pdf yang dihasilkan nantinya
//==========================================================================================================
$content = ob_get_clean();
$content = '<page style="font-family: freeserif">'.($content).'</page>';
// panggil library html2pdf
require_once('../assets/html2pdf_v4.03/html2pdf.class.php');
try
{
    $html2pdf = new HTML2PDF('P','F4','en', false, 'ISO-8859-15',array(5, 10, 5, 10));
    $html2pdf->setDefaultFont('Arial');
    $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output($filename);
}
catch(HTML2PDF_exception $e) { echo $e; }
?>
