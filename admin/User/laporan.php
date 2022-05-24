<!-- Content Header (Page header) -->
<div class="content-wrapper">
<?php
if (isset($_GET['aksi'])){
    $aksi = $_GET['aksi'];

  switch ($aksi){
   case "editkegiatan":
    if(isset($_GET['id'])){
      $sql = mysqli_query($con, "SELECT * FROM kegiatan where idkegiatan='$_GET[id]'");
      $data=mysqli_fetch_assoc($sql);
    }
    if(isset($_POST['save'])){
      $awal  = strtotime($_POST['jam_mulai']);
      $akhir = strtotime($_POST['jam_akhir']);
        if($awal < $akhir){
          $diff  = $akhir - $awal;
        }else {
           $diff  = $awal - $akhir;
        }

          $jam   = floor($diff / (60 * 60));
          $menit = $diff - $jam * (60 * 60);
          $a=floor($menit / 60);
          $jumlah = ($jam*60)+$a;

      $save=mysqli_query($con, "UPDATE kegiatan set jenis_kegiatan='$_POST[jenis_kegiatan]', kegiatan='$_POST[kegiatan]', jam_mulai='$_POST[jam_mulai]', jam_akhir='$_POST[jam_akhir]',keterangan='$_POST[keterangan]',jumlah='$jumlah' where idkegiatan='$_GET[id]'");
      if($save) {
        echo "<script>
            alert('Edit Data Berhasil');
            window.location='?module=laporan';
              </script>";
        }else{
          echo "<script>alert('Gagal');
              </script>";
       }
    }
?>
<section class="content-header">
      <h1>
       Client
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit Kegiatan</li>
      </ol>
</section>

<section class="content">
  <div class="row">
      <div class="col-xs-12">
       <div class="box box-info">
         <div class="box-header with-border">

         </div>
            <!-- form start -->
            <form method="POST" class="form-horizontal" action="" enctype="multipart/form-data">
              <div class="box-body">
          <div class="col-sm-12">
          <div class="form-group">
            <label for="kdp" class="col-sm-2 control-label">Jenis kegiatan</label>
            <div class="col-sm-4">
            <select name="jenis_kegiatan" class="form-control">
              
                <?php if($data['jenis_kegiatan']=="Dalam Kantor"){ ?>      
                <option value="Dalam Kantor" selected>Dalam Kantor</option>
                <option value="Luar Kantor">Luar Kantor</option>
                <option value="Istirahat/pribadi">Istirahat/pribadi</option>
                <option value="Tidak lapor">Tidak Lapor</option>
                <?php } else if($data['jenis_kegiatan']=="Luar Kantor") { ?>
                <option value="Dalam Kantor">Dalam Kantor</option>
                <option value="Luar Kantor" selected>Luar Kantor</option>
                <option value="Istirahat/pribadi">Istirahat/pribadi</option>
                <option value="Tidak lapor">Tidak Lapor</option>
                <?php } elseif ($data['jenis_kegiatan']=="Istitahat/pribadi") { ?>
                <option value="Dalam Kantor">Dalam Kantor</option>
                <option value="Luar Kantor">Luar Kantor</option>
                <option value="Istirahat/pribadi" selected>Istirahat/pribadi</option>
                <option value="Tidak lapor">Tidak Lapor</option>
                <?php }else { ?>
                <option value="Dalam Kantor">Dalam Kantor</option>
                <option value="Luar Kantor">Luar Kantor</option>
                <option value="Istirahat/pribadi">Istirahat/pribadi</option>
                <option value="Tidak lapor" selected>Tidak Lapor</option>
                <?php } ?>
            </select>
            </div>
          </div>

          <div class="form-group">
            <label for="des" class="col-sm-2 control-label">Kegiatan</label>
            <div class="col-sm-8">
            <textarea type="text" name="kegiatan" id="des" class="form-control textarea" rows="8" cols="80"><?= $data['kegiatan'] ?></textarea>
            </div>
          </div>
          
          <div class="form-group">
            <label for="nohp" class="col-sm-2 control-label">Jam Mulai</label>
            <div class="col-sm-8">
            <input type="time" name="jam_mulai" id="nohp" class="form-control" value="<?= $data[jam_mulai] ?>">
            </div>
          </div>

            <div class="form-group">
            <label for="nohp" class="col-sm-2 control-label">Jam Akhir</label>
            <div class="col-sm-8">
            <input type="time" name="jam_akhir" id="nohp" class="form-control" value="<?= $data[jam_akhir] ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="des" class="col-sm-2 control-label">Keterangan</label>
            <div class="col-sm-8">
            <textarea type="text" name="keterangan" id="des" class="form-control textarea" rows="8" cols="80"><?= $data['keterangan'] ?></textarea>
            </div>
          </div>

            <div class="form-group">
            <div class="col-sm-4 col-md-offset-2">
            <button type="submit" name="save" class="btn btn-primary btn-flat">Simpan</button>
            </div>
          </div>
          </div>
          </form>
        </div>
      </div>
    </div>
</section>
  
  <?php
break;
}
}else{
?>
<section class="content-header">
      <h1>
        Jadwal
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Laporan Jadwal</li>
      </ol>
</section>
<!-- Content Header (Page header) -->
  <section class="content">
      <div class="box box-primary">
        <!-- form start -->
        <form role="form" class="form-horizontal" method="POST" action="">
          <div class="box-body">

            <div class="form-group">
              <label class="col-sm-1">Tanggal</label>
              <div class="col-sm-2">
                <input type="text" name="tgl" class="form-control" id="datepicker" data-date-format="yyyy-mm-dd">
              </div>

              <label class="col-sm-1">Pengacara</label>
              <div class="col-sm-2">
                <select class="form-control select2" name="pengacara">
                  <option value=""></option>
                  <?php
                    $sql=mysqli_query($con,"SELECT * from tbl_pengacara");
                    while ($data=mysqli_fetch_array($sql)) {
                      echo "<option value='$data[id_pengacara]'> $data[nama_pengacara]</option>" ;
                    }
                  ?>
                </select>
              </div>
              <div class="col-sm-2">
                 <button type="submit" name="tampil" class="btn btn-success btn-social btn-submit">
                  <i class="fa fa-search"></i> Tampil
                </button>
              </div>
                <div class="col-sm-1">
               <!-- <a href="laporan-pdf.php?pengacara=<?= $_POST['pengacara'] ?>&tgl=<?= $_POST['tgl'] ?>" class="btn btn-primary btn-social btn-submit" target="_blank">
                  <i class="fa fa-print"></i> Cetak
                </a>-->

              </div>
            </div>
          </div>

        </form>

        <div class="box-body">
              <div class="table table-responsive">
              <table  class="table table-bordered table-striped" style="background-color: #EFF2FB">
                <thead>
                <tr>
                  <th rowspan="2">No</th>
                  <th colspan="2" style="text-align: center;">Jadwal</th>
				          <th rowspan="2">Pengacara</th>
                  <th rowspan="2">Tanggal</th>
                  <th rowspan="2">Kegiatan</th>

                </tr>
                <tr>
                  <th style="text-align: center;">Awal</th>
                  <th style="text-align: center;">Akhir</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                    $tgll=date('Y-m-d');
                    if(isset($_POST['tampil'])) {
                       $be = mysqli_query($con, "SELECT * FROM kegiatan j LEFT JOIN tbl_pengacara p ON j.nama=p.id_pengacara WHERE j.tanggal_kegiatan='$_POST[tgl]' and j.nama='$_POST[pengacara]'");
                    }else{
                    $be = mysqli_query($con, "SELECT * FROM kegiatan j LEFT JOIN tbl_pengacara p ON j.nama=p.id_pengacara WHERE j.tanggal_kegiatan='$tgll'");
                  }
                    $no=1;
                    while($r=mysqli_fetch_assoc($be)){
                  ?>

                  <tr>
                    <td><?= $no; ?></td>
                    <td><?= $r["jam_mulai"];?></td>
                    <td><?= $r["jam_akhir"];?></td>
					           <td><?= $r["nama_pengacara"];?></td>
                    <td><?= tgl_indo($r["tanggal_kegiatan"]);?></td>
                    <td><?= $r["kegiatan"];?></td>
					<td><a href="?module=laporan&aksi=editkegiatan&id=<?= $r['idkegiatan'];?>" class="btn btn-info">Edit</a></td>
                  </tr>
                  <?php $no++; } ?>
                          </tbody>
                        </table>
                      </div>
                    </div>


      </div><!-- /.box -->
    </section>
	<?php } ?>
  </div>
