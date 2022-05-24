<div class="content-wrapper">
<?php
  if (isset($_GET['aksi'])){
    $aksi = $_GET['aksi'];

  switch ($aksi){
    case "tambahtestimoni" :

    if(isset($_POST['save'])){
    $judulseo = seo_title($_POST['judul']);
		$nmberkas  = $_FILES["gambar"]["name"];
		$lokberkas = $_FILES["gambar"]["tmp_name"];
    $nmfoto= date("YmdHis").$nmberkas;
    $valid    = array('jpg','png','gif','jpeg');
    list($txt, $ext) = explode(".",$nmfoto);
    if(in_array($ext,$valid)){
		if(!empty($lokberkas)){
			move_uploaded_file($lokberkas, "../../img/testimoni/$nmfoto");
		}

	$save=mysqli_query($con, "INSERT INTO testimoni VALUES ('', '$_POST[nama]', '$_POST[testi]', '$_POST[profesi]','$nmfoto')");

	 if($save) {
        echo "<script>
            alert('Tambah Data Berhasil');
            window.location='?module=testimoni';
            </script>";
            exit;
      }else{
        echo "<script>alert('Gagal');
            </script>";
      }
    }else{
      echo "<script>
              alert('Format Foto Tidak Mendukung, Upload Foto Dengan Format png/jpg/gif/jpeg');
            </script>";
    }
  }
?>
<section class="content-header">
      <h1>
        Testimoni
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Tambah Testimoni</li>
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
						<label for="nama" class="col-sm-2 control-label">Nama</label>
					  <div class="col-sm-8">
						<input type="text" name="nama" id="nama" class="form-control">
					  </div>
					</div>

          <div class="form-group">
						<label for="profesi" class="col-sm-2 control-label">Profesi</label>
					  <div class="col-sm-8">
						<input type="text" name="profesi" id="profesi" class="form-control">
					  </div>
					</div>

          <div class="form-group">
						<label for="testi" class="col-sm-2 control-label">Testimoni</label>
					  <div class="col-sm-8">
						<textarea type="text" name="testi" id="testi" class="form-control" rows="15" cols="80"></textarea>
					  </div>
					</div>

					<div class="form-group">
						<label for="gam" class="col-sm-2 control-label">Foto</label>
					  <div class="col-sm-4">
						<input type="file" name="gambar" id="gam" class="form-control">
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
    case "edittesti" :

    if(isset($_GET['id'])){
      $sql = mysqli_query($con, "SELECT * FROM testimoni where id_testi='$_GET[id]'");
      $data=mysqli_fetch_assoc($sql);
    }
    if(isset($_POST['save'])){
		$nmberkas  = $_FILES['gambar']["name"];
		$lokberkas = $_FILES["gambar"]["tmp_name"];
		$nmfoto= date("YmdHis").$nmberkas;
    $valid    = array('jpg','png','gif','jpeg');
    list($txt, $ext) = explode(".",$nmfoto);

    if(empty($lokberkas)){
      $save=mysqli_query($con, "UPDATE testimoni set nama_testi='$_POST[nama]', profesi_testi='$_POST[profesi]', deskripsi_testi='$_POST[testi]' where id_testi='$_GET[id]'");
      if($save) {
        echo "<script>
            alert('Edit Data Berhasil');
            window.location='?module=testimoni';
              </script>";
        }else{
          echo "<script>alert('Gagal');
              </script>";
       }
		}else if(!empty($lokberkas)){
      list($txt, $ext) = explode(".",$nmfoto);
      if(in_array($ext,$valid)){
			move_uploaded_file($lokberkas, "../../img/testimoni/$nmfoto");
      $lihat = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM testimoni where id_testi='$_GET[id]'"));

      unlink("../../img/testimoni/".$lihat['foto_testi']);
      $save=mysqli_query($con, "UPDATE testimoni set nama_testi='$_POST[nama]', profesi_testi='$_POST[profesi]', foto_testi='$nmfoto', deskripsi_testi='$_POST[testi]' where id_testi='$_GET[id]'");
      if($save) {
        echo "<script>
            alert('Edit Data Berhasil');
            window.location='?module=testimoni';
              </script>";
        }else{
          echo "<script>alert('Gagal');
              </script>";
       }
     }else{
       echo "<script>
               alert('Format Foto Tidak Mendukung, Upload Foto Dengan Format png/jpg/gif/jpeg');
               </script>";
     }
    }
}

?>

<section class="content-header">
      <h1>
        Testimoni
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit Testimoni</li>
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
						<label for="nama" class="col-sm-2 control-label">Nama</label>
					  <div class="col-sm-8">
						<input type="text" name="nama" id="nama" class="form-control" value="<?= $data['nama_testi'] ?>">
					  </div>
					</div>

          <div class="form-group">
						<label for="profesi" class="col-sm-2 control-label">Profesi</label>
					  <div class="col-sm-8">
						<input type="text" name="profesi" id="profesi" class="form-control" value="<?= $data['profesi_testi'] ?>">
					  </div>
					</div>

          <div class="form-group">
						<label for="testi" class="col-sm-2 control-label">Testimoni</label>
					  <div class="col-sm-8">
						<textarea type="text" name="testi" id="testi" class="form-control" rows="15" cols="80"><?= $data['deskripsi_testi'] ?></textarea>
					  </div>
					</div>

					<div class="form-group">
						<label for="gam" class="col-sm-2 control-label">Foto</label>
					  <div class="col-sm-4">
						<input type="file" name="gambar" id="gam" class="form-control">
            <input type="hidden" name="gambarlama" id="jdl" class="form-control"  value="<?= $data['foto_testi']; ?>">
					  </div>
					</div>

          <div class="form-group" >
             <label for="gam" class="col-sm-2 control-label">&nbsp;</label>
             <div class="col-sm-4">
               <img src="../../img/testimoni/<?= $data['foto_testi']; ?>" style="width:250px;">
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
    case "hapustesti" :

    if(isset($_GET['id'])){
      $del = mysqli_query($con, "DELETE FROM testimoni where id_testi='$_GET[id]'");
      if($del){
    	  echo "<script>
                 alert('Data Berhasil Dihapus');
    					   window.location='index.php?module=testimoni';
    				  </script>";
      }else{
        echo "<script>
                alert('Data Gagal Dihapus');
                window.location='index.php?module=testimoni';
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
        Testimoni
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Testimoni</li>
      </ol>
</section>
<section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-info">
            <!-- /.box-header -->
            <div class="box-header with-border">
              <a href="?module=testimoni&aksi=tambahtestimoni" class="btn btn-flat btn-primary">Tambah Testimoni</a>
            </div>
            <div class="box-body">
              <div class="table table-responsive">
              <table  class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Foto</th>
                    <th>Nama</th>
                    <th>Profesi</th>
                    <th>Testimoni</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
        				<?php
        					$be = mysqli_query($con, "SELECT * FROM testimoni");
        					$no=1;
        					while($r=mysqli_fetch_assoc($be)){
        				?>
      				<tr>
      					<td><?= $no; ?></td>
                <td><img src="../../img/testimoni/<?= $r['foto_testi'] ?>" width='150'></td>
      					<td><?= $r['nama_testi'] ?></td>
      					<td><?= $r['profesi_testi'] ?></td>
      					<td><?= $r['deskripsi_testi'] ?></td>
      					<td><a href="?module=testimoni&aksi=edittesti&id=<?= $r['id_testi'];?>" class="btn btn-success btn-flat">Edit</a>
      						<a href="?module=testimoni&aksi=hapustesti&id=<?= $r['id_testi'];?>" class="btn btn-danger btn-flat" onclick="return confirm('Yakin Akan Menghapus Data Ini ... ?')">Hapus</a>
      					</td>
      				</tr>
					     <?php $no++; } ?>
				        </tbody>
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
