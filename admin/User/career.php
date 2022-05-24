<div class="content-wrapper">

<?php
  if (isset($_GET['aksi'])){
    $aksi = $_GET['aksi'];

  switch ($aksi){
    case "tambahcarrier" :

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
			move_uploaded_file($lokberkas, "../../img/carrier/$nmfoto");
		}

	$save=mysqli_query($con, "INSERT INTO carrier VALUES ('','$_POST[judul]', '$_POST[deskripsi]', '$_POST[kategori]', '$nmfoto', '$judulseo', '$tglskrg')");

	 if($save) {
        echo "<script>
            alert('Tambah Data Berhasil');
            window.location='?module=career';
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
        Career
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Tambah Career</li>
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
					  <div class="col-sm-4">
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
						<label for="kategori" class="col-sm-2 control-label">Kategori</label>
					  <div class="col-sm-4">
						  <select class="form-control" id="kategori" name="kategori">
                <option value="">Pilih Kategori</option>
                <option value="Lawyer">Lawyer</option>
                <option value="Asistant Lawyer">Asistant Lawyer</option>
                <option value="Internal Staff">Internal Staff</option>
                <option value="Magang">Magang</option>
              </select>
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
  case "previewcarrier" :

  $sql = mysqli_query($con, "SELECT * FROM carrier WHERE id_carrier='$_GET[id]'");
  $data = mysqli_fetch_assoc($sql);

?>
<section class="content-header">
  <h1>
    Career
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Preview Career</li>
  </ol>
</section>
<!-- Content Header (Page header) -->
<section class="content">
<div class="row">
  <div class="col-xs-12">
   <div class="box box-info">
     <div class="box-header with-border">
       <div class="col-sm-10">
         <h3><?= $data['judul_carrier'] ?></h3>
         <hr>
       </div>
       <div class="col-sm-4">
         <img src="../../img/carrier/<?= $data['gambar_carrier'] ?>" width=300>
      </div>
      <div class="col-sm-8">
         Kategori : <?= $data['kategori_carrier'] ?>
         <p>
          <?= $data['deskripsi_carrier'] ?>
         </p>
         <br>
       </div>
     </div>
    </div>
  </div>
</div>
</section>
<?php
    break;
    case "editcarrier":
    if(isset($_GET['id'])){
      $sql = mysqli_query($con, "SELECT * FROM carrier where id_carrier='$_GET[id]'");
      $data=mysqli_fetch_assoc($sql);
    }
    if(isset($_POST['save'])){
    $judulseo = seo_title($_POST['judul']);
		$nmberkas  = $_FILES['foto']["name"];
		$lokberkas = $_FILES["foto"]["tmp_name"];
		$nmfoto= date("YmdHis").$nmberkas;
    $valid    = array('jpg','png','gif','jpeg');

    if(empty($lokberkas)){
      $save=mysqli_query($con, "UPDATE carrier set judul_carrier='$_POST[judul]', deskripsi_carrier='$_POST[deskripsi]', kategori_carrier='$_POST[kategori]',  judul_seo_carrier='$judulseo' where id_carrier='$_GET[id]'");

      if($save) {
        echo "<script>
            alert('Edit Data Berhasil');
            window.location='?module=career';
              </script>";
        }else{
          echo "<script>alert('Gagal');
              </script>";
       }

		}else if(!empty($lokberkas)){
      list($txt, $ext) = explode(".",$nmfoto);
      if(in_array($ext,$valid)){
			move_uploaded_file($lokberkas, "../../img/carrier/$nmfoto");
      $lihat = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM carrier where id_carrier='$_GET[id]'"));

      unlink("../../img/carrier/".$lihat['gambar_carrier']);

      $save=mysqli_query($con, "UPDATE carrier set judul_carrier='$_POST[judul]', deskripsi_carrier='$_POST[deskripsi]', kategori_carrier='$_POST[kategori]', gambar_carrier='$nmfoto', judul_seo_carrier='$judulseo' where id_carrier='$_GET[id]'");
      if($save) {
        echo "<script>
            alert('Edit Data Berhasil');
            window.location='?module=career';
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
        Career
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit Career</li>
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
                    <input type="text" name="judul" id="jdl" class="form-control"  value="<?= $data['judul_carrier']; ?>">
                  </div>
                </div>

				        <div class="form-group" >
                  <label for="des" class="col-sm-2 control-label">Deskripsi</label>
                  <div class="col-sm-10">
                    <textarea type="text" name="deskripsi" id="editor" class="form-control" rows="15" cols="80"><?= $data['deskripsi_carrier']; ?></textarea>
                  </div>
                </div>

                <div class="form-group" >
                  <label for="kategori" class="col-sm-2 control-label">Kategori</label>
                  <div class="col-sm-10">
                    <select class="form-control" name="kategori" id="kategori">
                      <?php
                        if($data['kategori_carrier']=='Lawyer'){
                      ?>
                        <option value="Lawyer" selected>Lawyer</option>
                        <option value="Asistant Lawyer">Asistant Lawyer</option>
                        <option value="Internal Staff">Internal Staff</option>
                        <option value="Magang">Magang</option>
                      <?php }else if($data['kategori_carrier']=='Asistant Lawyer'){ ?>
                        <option value="Lawyer">Lawyer</option>
                        <option value="Asistant Lawyer" selected>Asistant Lawyer</option>
                        <option value="Internal Staff">Internal Staff</option>
                        <option value="Magang">Magang</option>
                      <?php }else if($data['kategori_carrier']=='Internal Staff'){ ?>
                        <option value="Lawyer">Lawyer</option>
                        <option value="Asistant Lawyer">Asistant Lawyer</option>
                        <option value="Internal Staff" selected>Internal Staff</option>
                        <option value="Magang">Magang</option>
                      <?php }else{ ?>
                        <option value="Lawyer">Lawyer</option>
                        <option value="Asistant Lawyer">Asistant Lawyer</option>
                        <option value="Internal Staff">Internal Staff</option>
                        <option value="Magang" selected>Magang</option>
                      <?php } ?>
                    </select>
                  </div>
                </div>

				        <div class="form-group" >
                  <label for="gam" class="col-sm-2 control-label">Gambar</label>
                  <div class="col-sm-4">
                    <input type="file" name="foto" id="gam" class="form-control">
					          <input type="hidden" name="gambarlama" id="jdl" class="form-control"  value="<?= $data['gambar_carrier']; ?>">
                  </div>
                </div>

				       <div class="form-group" >
                  <label for="gam" class="col-sm-2 control-label">&nbsp;</label>
				          <div class="col-sm-4">
                    <img src="../../img/carrier/<?= $data['gambar_carrier']; ?>" style="width:250px;">
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
    case "hapuscarrier" :

    if(isset($_GET['id'])){
      $lihat = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM carrier where id_carrier='$_GET[id]'"));

      unlink("../../img/carrier/".$lihat['gambar_carrier']);
      $del = mysqli_query($con, "DELETE FROM carrier where id_carrier='$_GET[id]'");
      if($del){
    	  echo "<script>
                 alert('Data Berhasil Dihapus');
    					   window.location='index.php?module=career';
    				  </script>";
      }else{
        echo "<script>
                alert('Data Gagal Dihapus');
                window.location='index.php?module=career';
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
        Career
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Career</li>
      </ol>
</section>
<section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-info">
            <div class="box-header with-border">
              <a href="?module=career&aksi=tambahcarrier" class="btn btn-flat btn-primary">Tambah Career </a>
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
                    <th>Kategori</th>
                    <th>Tanggal Upload</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $be = mysqli_query($con, "SELECT * FROM carrier");
                  $no=1;
                  while($r=mysqli_fetch_assoc($be)){
                    $des = substr($r['deskripsi_carrier'],0,50)."...";
                    ?>

                    <tr>
                      <td><?= $no; ?></td>
                      <td><img src="../../img/carrier/<?= $r["gambar_carrier"];?>" style="width:100px;"></td>
                      <td><?= $r["judul_carrier"];?></td>
                      <td><?= $des;?></td>
                      <td><?= $r["kategori_carrier"];?></td>
                      <td><?= $r["tgl_upload_carrier"];?></td>
                      <td>
                        <a href="?module=career&aksi=previewcarrier&id=<?= $r['id_carrier'];?>" class="btn btn-info btn-flat">Preview</a>
                        <a href="?module=career&aksi=editcarrier&id=<?= $r['id_carrier'];?>" class="btn btn-success btn-flat">Edit</a>
                        <a href="?module=career&aksi=hapuscarrier&id=<?= $r['id_carrier'];?>" class="btn btn-danger btn-flat" onclick="return confirm('Yakin Akan Menghapus Data Ini ... ?')">Hapus</a>
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
