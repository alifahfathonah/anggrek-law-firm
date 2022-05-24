<div class="content-wrapper">

<?php
  if (isset($_GET['aksi'])){
    $aksi = $_GET['aksi'];

  switch ($aksi){
    case "tambahberita" :

    if(isset($_POST['save'])){
    $tglskrg = date('Y-m-d');
    $judulseo = seo_title($_POST['judul']);
		$nmberkas  = $_FILES["gambar"]["name"];
		$lokberkas = $_FILES["gambar"]["tmp_name"];
		$nmfoto= date("YmdHis").$nmberkas;
    $valid    = array('jpg','png','gif','jpeg');
    list($txt, $ext) = explode(".",$nmfoto);
    if(in_array($ext,$valid)){
		if(!empty($lokberkas)){
			move_uploaded_file($lokberkas, "../../img/berita/$nmfoto");
		}

	$save=mysqli_query($con, "INSERT INTO tbl_berita VALUES ('','$_POST[judul]', '$_POST[deskripsi]', '$nmfoto', '$tglskrg', '$_POST[upload_by]', '', '$judulseo')");

	 if($save) {
        echo "<script>
            alert('Tambah Data Berhasil');
            window.location='?module=berita';
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
        Berita
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Tambah Berita</li>
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
						<label for="kdp" class="col-sm-2 control-label">Judul</label>
					  <div class="col-sm-8">
						<input type="text" name="judul" id="kdp" class="form-control">
					  </div>
					</div>

					<div class="form-group">
						<label for="des" class="col-sm-2 control-label">Deskripsi</label>
					  <div class="col-sm-8">
						<textarea type="text" name="deskripsi" id="editor" class="form-control" rows="15" cols="80"></textarea>

					  </div>
					</div>

					<div class="form-group">
						<label for="up" class="col-sm-2 control-label">Upload By</label>
					  <div class="col-sm-4">
						<input type="text" name="upload_by" id="up" class="form-control">
					  </div>
					</div>

					<div class="form-group">
						<label for="gam" class="col-sm-2 control-label">Gambar</label>
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
    case "editberita":
    if(isset($_GET['id'])){
      $sql = mysqli_query($con, "SELECT * FROM tbl_berita where id_berita='$_GET[id]'");
      $data=mysqli_fetch_assoc($sql);
    }
    if(isset($_POST['save'])){
    $judulseo = seo_title($_POST['judul']);
		$nmberkas  = $_FILES['foto']["name"];
		$lokberkas = $_FILES["foto"]["tmp_name"];
		$nmfoto= date("YmdHis").$nmberkas;
    $valid    = array('jpg','png','gif','jpeg');
    if(empty($lokberkas)){
        $save=mysqli_query($con, "UPDATE tbl_berita set judul='$_POST[judul]', deskripsi='$_POST[deskripsi]', upload_by='$_POST[upload]', judulseo='$judulseo' where id_berita='$_GET[id]'");
        if($save) {
          echo "<script>
              alert('Edit Data Berhasil');
              window.location='?module=berita';
                </script>";
          }else{
            echo "<script>alert('Gagal');
                </script>";
         }

    }else if(!empty($lokberkas)){
      list($txt, $ext) = explode(".",$nmfoto);
        if(in_array($ext,$valid)){

			move_uploaded_file($lokberkas, "../../img/berita/$nmfoto");
      $lihat = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM tbl_berita where id_berita='$_GET[id]'"));

      unlink("../../img/berita/".$lihat['gambar']);

      $save=mysqli_query($con, "UPDATE tbl_berita set judul='$_POST[judul]', deskripsi='$_POST[deskripsi]', gambar='$nmfoto', upload_by='$_POST[upload]', judulseo='$judulseo' where id_berita='$_GET[id]'");
      if($save) {
        echo "<script>
            alert('Edit Data Berhasil');
            window.location='?module=berita';
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
        Berita
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit Berita</li>
      </ol>
</section>

<section class="content">
  <div class="row">
      <div class="col-xs-12">
       <div class="box box-info">
         <div class="box-header with-border">

         </div>

            <!-- form start -->
            <form action="" method="POST" class="form-horizontal" enctype="multipart/form-data">
              <div class="box-body ">
                <div class="form-group" >
                  <label for="jdl" class="col-sm-2 control-label">Judul</label>
                  <div class="col-sm-10">
                    <input type="text" name="judul" id="jdl" class="form-control"  value="<?= $data['judul']; ?>">
                  </div>
                </div>

				        <div class="form-group" >
                  <label for="des" class="col-sm-2 control-label">Deskripsi</label>
                  <div class="col-sm-10">
                    <textarea type="text" name="deskripsi" id="editor" class="form-control" rows="15" cols="80"><?= $data['deskripsi']; ?></textarea>
                  </div>
                </div>

                <div class="form-group" >
                  <label for="upload" class="col-sm-2 control-label">Upload By</label>
                  <div class="col-sm-10">
                    <input type="text" name="upload" id="upload" class="form-control"  value="<?= $data['upload_by']; ?>">
                  </div>
                </div>

				        <div class="form-group" >
                  <label for="gam" class="col-sm-2 control-label">Gambar</label>
                  <div class="col-sm-4">
                    <input type="file" name="foto" id="gam" class="form-control">
					          <input type="hidden" name="gambarlama" id="jdl" class="form-control"  value="<?= $data['gambar']; ?>">
                  </div>
                </div>

				       <div class="form-group" >
                  <label for="gam" class="col-sm-2 control-label">&nbsp;</label>
				          <div class="col-sm-4">
                    <img src="../../img/berita/<?= $data['gambar']; ?>" style="width:250px;">
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
    case "hapusberita" :

    if(isset($_GET['id'])){
      $lihat = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM tbl_berita where id_berita='$_GET[id]'"));

      unlink("../../img/berita/".$lihat['gambar']);
      $del = mysqli_query($con, "DELETE FROM tbl_berita where id_berita='$_GET[id]'");
      if($del){
    	  echo "<script>
                 alert('Data Berhasil Dihapus');
    					   window.location='index.php?module=berita';
    				  </script>";
      }else{
        echo "<script>
                alert('Data Gagal Dihapus');
                window.location='index.php?module=berita';
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
        Berita
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Berita</li>
      </ol>
</section>
<section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-info">
            <div class="box-header with-border">
              <a href="?module=berita&aksi=tambahberita" class="btn btn-flat btn-primary">Tambah Berita</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table table-responsive">
              <table  class="table table-bordered table-striped" id="example1">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Gambar</th>
                    <th>Judul</th>
                    <th>Deskripsi</th>
                    <th>Viewer</th>
                    <th>Upload By</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $be = mysqli_query($con, "SELECT * FROM tbl_berita ORDER BY tanggal_upload DESC");
                  $no=1;
                  while($r=mysqli_fetch_assoc($be)){
                    $des = substr($r['deskripsi'],0,50)."...";
                    ?>

                    <tr>
                      <td><?= $no; ?></td>
                      <td><img src="../../img/berita/<?= $r["gambar"];?>" style="width:100px;"></td>
                      <td><?= $r["judul"];?></td>
                      <td><?= $des;?></td>
                      <td><?= $r["viewer"];?></td>
                      <td><?= $r["upload_by"];?></td>
                      <td><a href="?module=berita&aksi=editberita&id=<?= $r['id_berita'];?>" class="btn btn-success btn-flat">Edit</a>
                        <a href="?module=berita&aksi=hapusberita&id=<?= $r['id_berita'];?>" class="btn btn-danger btn-flat" onclick="return confirm('Yakin Akan Menghapus Data Ini ... ?')">Hapus</a>
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
