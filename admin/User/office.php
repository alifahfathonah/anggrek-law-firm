<div class="content-wrapper">
        <!-- Content Header (Page header) -->


<?php
  if (isset($_GET['aksi'])){
    $aksi = $_GET['aksi'];

  switch ($aksi){
    case "tambahoffice" :

    if(isset($_POST['save'])){
      $tglkegiatan=date('Y-m-d H:i:s');
      $awal  = strtotime($_POST['jam_mulai']);
      $akhir = strtotime($_POST['jam_akhir']);
        if($awal < $akhir){
          $diff  = $akhir - $awal;
        }else {
           $diff  = $awal - $akhir;
        }

         /* $jam   = floor($diff / (60 * 60));
          $menit = $diff - $jam * (60 * 60);
          $jumlah = $jam.".".floor($menit / 60);*/
          $jam   = floor($diff / (60 * 60));
          $menit = $diff - $jam * (60 * 60);
          $a=floor($menit / 60);
          $jumlah = ($jam*60)+$a;
 $t=date('H:i:s');
  if($_POST['jam_mulai'] >= $t ){
  echo "<script>
            alert('Maaf Silahkan masukkan data pada waktu yang tepat');
            window.location='?module=kegiatan';
            </script>";
  }else{
	$save=mysqli_query($con, "INSERT INTO tbl_office 
    VALUES('', '$_SESSION[id_client]','$_POST[jenis_kegiatan]','$_POST[kegiatan]','$tglkegiatan','$_POST[jam_mulai]','$_POST[jam_akhir]','$_POST[keterangan]','$jumlah')");
}
	 if($save) {
        echo "<script>
            alert('Tambah Data Berhasil');
            window.location='?module=office';
            </script>";
            exit;
      }else{
        echo "<script>alert('Gagal');
            </script>";
      }
    }
?>
<section class="content-header">
      <h1>
       Beyond Office Hour
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Tambah Beyond Office Hour</li>
      </ol>
</section>
<!-- Content Header (Page header) -->
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
                <option value=""></option>      
                <option value="Dalam Kantor">Dalam Kantor</option>
                <option value="Luar Kantor">Luar Kantor</option>
            </select>
					  </div>
					</div>

					<div class="form-group">
						<label for="des" class="col-sm-2 control-label">Kegiatan</label>
					  <div class="col-sm-8">
						<textarea type="text" name="kegiatan" id="des" class="form-control textarea" rows="8" cols="80"></textarea>
					  </div>
					</div>
					
					<div class="form-group">
						<label for="nohp" class="col-sm-2 control-label">Jam Mulai</label>
					  <div class="col-sm-8">
						<input type="time" name="jam_mulai" id="nohp" class="form-control ">
					  </div>
					</div>

            <div class="form-group">
            <label for="nohp" class="col-sm-2 control-label">Jam Akhir</label>
            <div class="col-sm-8">
            <input type="time" name="jam_akhir" id="nohp" class="form-control ">
            </div>
          </div>

          <div class="form-group">
            <label for="des" class="col-sm-2 control-label">Keterangan</label>
            <div class="col-sm-8">
            <textarea type="text" name="keterangan" id="des" class="form-control textarea" rows="8" cols="80"></textarea>
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
    case "editoffice":
    if(isset($_GET['id'])){
      $sql = mysqli_query($con, "SELECT * FROM tbl_office where idkegiatan='$_GET[id]'");
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

      $save=mysqli_query($con, "UPDATE tbl_office set jenis_kegiatan='$_POST[jenis_kegiatan]', kegiatan='$_POST[kegiatan]', jam_mulai='$_POST[jam_mulai]', jam_akhir='$_POST[jam_akhir]',keterangan='$_POST[keterangan]',jumlah='$jumlah' where idkegiatan='$_GET[id]'");
      if($save) {
        echo "<script>
            alert('Edit Data Berhasil');
            window.location='?module=office';
              </script>";
        }else{
          echo "<script>alert('Gagal');
              </script>";
       }
    }
?>
<section class="content-header">
      <h1>
       Beyond Office Hour
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit Beyond Office Hour</li>
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
                <?php } else { ?>
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
    case "hapusoffice" :

    if(isset($_GET['id'])){
      $lihat = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM tbl_office where idkegiatan='$_GET[id]'"));

      $del = mysqli_query($con, "DELETE FROM tbl_office where idkegiatan='$_GET[id]'");
      if($del){
    	  echo "<script>
                 alert('Data Berhasil Dihapus');
    					   window.location='index.php?module=office';
    				  </script>";
      }else{
        echo "<script>
                alert('Data Gagal Dihapus');
                window.location='index.php?module=office';
              </script>";
      }
    }
?>
<?php
break;
}
}else{
?>

<section class="content-header">
      <h1>
      Beyond Office Hour
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Beyond Office Hour</li>
      </ol>
</section>
<section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-info">
            <div class="box-header with-border">
              <a href="?module=office&aksi=tambahoffice" class="btn btn-flat btn-primary">Tambah </a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
					<th rowspan="2">No</th>
					<th rowspan="2">Jenis Kegiatan</th>
					<th rowspan="2">Kegiatan</th>
          <th rowspan="2">Tanggal Kegiatan</th>
					<th colspan="2" style="text-align: center;">Jadwal</th>
          <th rowspan="2">Keterangan</th>
					<th rowspan="2">Aksi</th>
                </tr>
                <tr>
                  <th>Mulai</th>
                  <th>Akhir</th>
                </tr>
                </thead>
                <tbody>
				<?php
					$be = mysqli_query($con, "SELECT * FROM tbl_office WHERE nama='$_SESSION[id_client]' order by idkegiatan desc");
					$no=1;
					while($r=mysqli_fetch_assoc($be)){
				?>

				<tr>
					<td><?= $no; ?></td>
					<td><?= $r["jenis_kegiatan"];?></td>
					<td><?= $r["kegiatan"];?></td>
					<td><?=  tgl_indo($r["tanggal_kegiatan"]);?></td>
					<td><?= $r["jam_mulai"];?></td>
          <td><?= $r["jam_akhir"];?></td>
          <td><?= $r["keterangan"];?></td>
		  <?php
		  $tgl=date("Y-m-d");
		  if($r["tanggal_kegiatan"]<$tgl){
		  ?>
					<td><a onclick="return confirm('Maaf, Data Tidak Bisa di Edit');" href="index.php?module=office" class="btn btn-info">Edit</a>
					<?php
					}else{
					?>
					<td><a href="?module=office&aksi=editoffice&id=<?= $r['idkegiatan'];?>" class="btn btn-info">Edit</a>
					<?php
					}
					?>
						<a onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data Ini ?');" href="?module=office&aksi=hapusoffice&id=<?= $r['idkegiatan'];?>" class="btn btn-info">Hapus</a>
					</td>
				</tr>
					<?php $no++; } ?>
				</tfoot>
              </table>
            </div>
            </div>
            <!-- /.box-body -->
          </div>
          </div>
          </div>
          <!-- /.box -->
     </section>
<?php } ?>

      </div>
