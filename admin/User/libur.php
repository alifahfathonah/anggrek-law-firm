<div class="content-wrapper">
        <!-- Content Header (Page header) -->


<?php
  if (isset($_GET['aksi'])){
    $aksi = $_GET['aksi'];

  switch ($aksi){
    case "tambahlibur" :

  if(isset($_POST['save'])){

	$save=mysqli_query($con, "INSERT INTO tbl_jlibur 
    VALUES('','$_POST[tgl_awal]','$_POST[tgl_akhir]','$_POST[kategori]','$_POST[keterangan]','$_POST[id_pengacara]')");

	 if($save) {
        echo "<script>
            alert('Tambah Data Berhasil');
            window.location='?module=libur';
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
        Jadwal Libur
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Tambah Libur</li>
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
						<label for="kdp" class="col-sm-2 control-label">Tanggal Mulai</label>
					  <div class="col-sm-4">
						  <input type="date" name="tgl_awal" class="form-control">
					  </div>
					</div>

					<div class="form-group">
						<label for="des" class="col-sm-2 control-label">Tanggal Akhir</label>
					  <div class="col-sm-4">
						<input type="date" name="tgl_akhir" class="form-control">
					  </div>
					</div>
					<div class="form-group">
						<label for="kdp" class="col-sm-2 control-label">Nama Pengacara</label>
					  <div class="col-sm-4">
						<select type="text" name="id_pengacara" id="kdp" class="form-control">
						<option value="">--Pilih Pengacara--</option>
						<option value="Semua">Semua</option>
							<?php 
							$sql = mysqli_query($con, "SELECT * FROM tbl_pengacara");
							while($cln=mysqli_fetch_assoc($sql)){
								echo "<option value='$cln[nama_pengacara]'> $cln[nama_pengacara] </option>";
							}
							?>
						</select>
					  </div>
					</div>
					<div class="form-group">
						<label for="nohp" class="col-sm-2 control-label">Kategori Libur</label>
					  <div class="col-sm-8">
							
							<input type="radio" name="kategori" value="Sakit" >&nbsp;Sakit&nbsp;&nbsp;
							<input type="radio" name="kategori" value="Cuti" >&nbsp;Cuti&nbsp;&nbsp;
							<input type="radio" name="kategori" value="Izin" >&nbsp;Izin&nbsp;&nbsp;
							<input type="radio" name="kategori" value="Libur Nasional" >&nbsp;Libur Nasional&nbsp;&nbsp;
							<input type="radio" name="kategori" value="Cuti Bersama" >&nbsp;Cuti Bersama&nbsp;&nbsp;
					  </div>
					</div>
            <div class="form-group">
            <label for="nohp" class="col-sm-2 control-label">Keterangan</label>
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
    case "editlibur":
    if(isset($_GET['id'])){
      $sql = mysqli_query($con, "SELECT * FROM tbl_jlibur where id_libur='$_GET[id]'");
      $data=mysqli_fetch_assoc($sql);
    }
    if(isset($_POST['save'])){

      $save=mysqli_query($con, "UPDATE tbl_jlibur set tanggal_libur='$_POST[tgl_awal]', tanggal_liburakhir='$_POST[tgl_akhir]',kategori='$_POST[kategori]', keterangan='$_POST[keterangan]' where id_libur='$_GET[id]'");
      if($save) {
        echo "<script>
            alert('Edit Data Berhasil');
            window.location='?module=libur';
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
        <li class="active">Edit Libur</li>
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
            <label for="kdp" class="col-sm-2 control-label">Tanggal Mulai</label>
            <div class="col-sm-4">
              <input type="date" name="tgl_awal" class="form-control" value="<?= $data[tanggal_libur] ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="des" class="col-sm-2 control-label">Tanggal Akhir</label>
            <div class="col-sm-4">
            <input type="date" name="tgl_akhir" class="form-control" value="<?= $data[tanggal_liburakhir] ?>">
            </div>
          </div>
          <div class="form-group">
						<label for="nohp" class="col-sm-2 control-label">Kategori Libur</label>
					  <div class="col-sm-8">
							<?php
								if($data['kategori']=='Sakit'){
									$cek1= "checked";
								}else{
									$cek1= "";
								}
								
								if($data['kategori']=='Cuti'){
									$cek2= "checked";
								}else{
									$cek2= "";
								}
								
								if($data['kategori']=='Izin'){
									$cek3= "checked";
								}else{
									$cek3= "";
								}
								
								if($data['kategori']=='Libur Nasional'){
									$cek4= "checked";
								}else{
									$cek4= "";
								}
								
								if($data['kategori']=='Cuti Bersama'){
									$cek5= "checked";
								}else{
									$cek5= "";
								}
									?>
									<input type="radio" name="kategori" value="Sakit" <?php echo $cek1?>>&nbsp;Sakit&nbsp;&nbsp;
							<input type="radio" name="kategori" value="Cuti" <?php echo $cek2?>>&nbsp;Cuti&nbsp;&nbsp;
							<input type="radio" name="kategori" value="Izin" <?php echo $cek3?>>&nbsp;Izin&nbsp;&nbsp;
							<input type="radio" name="kategori" value="Libur Nasional" <?php echo $cek4?>>&nbsp;Libur Nasional&nbsp;&nbsp;
							<input type="radio" name="kategori" value="Cuti Bersama" <?php echo $cek5?> >&nbsp;Cuti Bersama&nbsp;&nbsp;
									
							
					  </div>
					</div>

            <div class="form-group">
            <label for="nohp" class="col-sm-2 control-label">Keterangan</label>
            <div class="col-sm-8">
           <textarea type="text" name="keterangan" id="des" class="form-control textarea" rows="8" cols="80"><?= $data[keterangan] ?></textarea>
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
    case "hapuslibur" :

    if(isset($_GET['id'])){
      $lihat = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM tbl_jlibur where id_libur='$_GET[id]'"));

      $del = mysqli_query($con, "DELETE FROM tbl_jlibur where id_libur='$_GET[id]'");
      if($del){
    	  echo "<script>
                 alert('Data Berhasil Dihapus');
    					   window.location='index.php?module=libur';
    				  </script>";
      }else{
        echo "<script>
                alert('Data Gagal Dihapus');
                window.location='index.php?module=libur';
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
      Jadwal Libur
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Jadwal Libur</li>
      </ol>
</section>
<section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-info">
            <div class="box-header with-border">
              <a href="?module=libur&aksi=tambahlibur" class="btn btn-flat btn-primary">Tambah Libur </a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
					<th rowspan="2">No</th>
          <th colspan="2" style="text-align: center;">Tanggal Jadwal</th>
		  <th rowspan="2">Kategori Libur</th>
		  <th rowspan="2">Nama </th>
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
				$sql	= mysqli_query($con,"SELECT * from tbl_pengacara where id_pengacara='$_SESSION[id_client]'");
	$data	= mysqli_fetch_array($sql);
					$be = mysqli_query($con, "SELECT * FROM tbl_jlibur order by id_libur desc");
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
				<?php if($r["id_pengacara"]==$data["nama_pengacara"]){ ?>
					<td><a href="?module=libur&aksi=editlibur&id=<?= $r['id_libur'];?>" class="btn btn-info">Edit</a>
					<a onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data Ini ?');" href="?module=libur&aksi=hapuslibur&id=<?= $r['id_libur'];?>" class="btn btn-info">Hapus</a>
					</td>
					<?php
					}
					?>
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
