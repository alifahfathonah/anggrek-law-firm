<div class="content-wrapper">
<?php
  if (isset($_GET['aksi'])){
    $aksi = $_GET['aksi'];

  switch ($aksi){
    case "tambahrubrik" :

    if(isset($_POST['save'])){
    $tglskrg = date('Y-m-d');
    $jamskrg = date('H:i:s');
    $judulseo = seo_title($_POST['judul']);
		$nmberkas  = $_FILES["foto"]["name"];
		$lokberkas = $_FILES["foto"]["tmp_name"];
		$nmfoto= date("YmdHis").$nmberkas;
    $valid    = array('jpg','png','gif','jpeg');
    list($txt, $ext) = explode(".",$nmfoto);
    if(in_array($ext,$valid)){
		if(!empty($lokberkas)){
			move_uploaded_file($lokberkas, "../../img/rubrik/$nmfoto");
		}

	$save=mysqli_query($con, "INSERT INTO rubrik_hukum VALUES ('','$_POST[judul]', '$_POST[deskripsi]', '$_POST[jawab]', '$tglskrg', '$jamskrg', '$judulseo', '$nmfoto','Y')");

	 if($save) {
        echo "<script>
            alert('Tambah Data Berhasil');
            window.location='?module=rubrik_hukum';
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
        Rubrik Hukum
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Tambah Rubrik Hukum</li>
      </ol>
</section>

<section class="content">
  <div class="row">
      <div class="col-xs-12">
       <div class="box box-info">

            <!-- form start -->
            <form action="" method="POST" class="form-horizontal" enctype="multipart/form-data">
              <div class="box-body ">
                <div class="form-group" >
                  <label for="jdl" class="col-sm-2 control-label">Judul</label>
                  <div class="col-sm-10">
                    <input type="text" name="judul" id="jdl" class="form-control">
                  </div>
                </div>

				        <div class="form-group" >
                  <label for="des" class="col-sm-2 control-label">Pertanyaan</label>
                  <div class="col-sm-10">
                    <textarea type="text" name="deskripsi" class="form-control" rows="15" cols="80"></textarea>
                  </div>
                </div>

                <div class="form-group" >
                  <label for="jawab" class="col-sm-2 control-label">Jawaban</label>
                  <div class="col-sm-10">
                    <textarea type="text" name="jawab" id="editor" class="form-control" rows="15" cols="80"></textarea>
                  </div>
                </div>

                <div class="form-group" >
                  <label for="gam" class="col-sm-2 control-label">Gambar</label>
                  <div class="col-sm-4">
                    <input type="file" name="foto" id="gam" class="form-control">
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
    case "replyrubrik" :

    $sql = mysqli_query($con, "SELECT * FROM rubrik_hukum WHERE id_rubrik='$_GET[id]'");
    $data = mysqli_fetch_assoc($sql);

    if(isset($_POST['save'])){
    $nmberkas  = $_FILES['foto']["name"];
    $lokberkas = $_FILES["foto"]["tmp_name"];
    $nmfoto= date("YmdHis").$nmberkas;
    $valid    = array('jpg','png','gif','jpeg');
    if(empty($lokberkas)){
      $update = mysqli_query($con, "UPDATE rubrik_hukum SET reply_rubrik='$_POST[jawab]' WHERE id_rubrik='$_GET[id]'");

      if($update){
        echo "<script>
                 alert('Sukses');
                 window.location='index.php?module=rubrik_hukum';
              </script>";
      }else{
        echo "<script>
                alert('Gagal');
              </script>";
      }
    }else if(!empty($lokberkas)){
      list($txt, $ext) = explode(".",$nmfoto);
      if(in_array($ext,$valid)){
      move_uploaded_file($lokberkas, "../../img/rubrik/$nmfoto");
      $lihat = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM rubrik_hukum where id_rubrik='$_GET[id]'"));

      unlink("../../img/rubrik/".$lihat['gambar_rubrik']);

      $update = mysqli_query($con, "UPDATE rubrik_hukum SET reply_rubrik='$_POST[jawab]', gambar_rubrik='$nmfoto' WHERE id_rubrik='$_GET[id]'");

      if($update){
        echo "<script>
                 alert('Sukses');
                 window.location='index.php?module=rubrik_hukum';
              </script>";
      }else{
        echo "<script>
                alert('Gagal');
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
        Rubrik Hukum
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Rubrik Hukum</li>
      </ol>
</section>

<section class="content">
  <div class="row">
      <div class="col-xs-12">
       <div class="box box-info">
         <div class="box-header with-border">
            <a href="?module=rubrik_hukum&aksi=tambahrubrik" class="btn btn-flat btn-primary">Tambah Rubrik Hukum</a>
         </div>

            <!-- form start -->
            <form action="" method="POST" class="form-horizontal" enctype="multipart/form-data">
              <div class="box-body ">
                <div class="form-group" >
                  <label for="jdl" class="col-sm-2 control-label">Judul</label>
                  <div class="col-sm-10">
                    <input type="text" name="judul" id="jdl" class="form-control"  value="<?= $data['judul_rubrik']; ?>" readonly>
                  </div>
                </div>

				        <div class="form-group" >
                  <label for="des" class="col-sm-2 control-label">Pertanyaan</label>
                  <div class="col-sm-10">
                    <textarea type="text" name="deskripsi" class="form-control" rows="15" cols="80" readonly><?= $data['deskripsi_rubrik']; ?></textarea>
                  </div>
                </div>

                <div class="form-group" >
                  <label for="jawab" class="col-sm-2 control-label">Jawaban</label>
                  <div class="col-sm-10">
                    <textarea type="text" name="jawab" id="editor" class="form-control" rows="15" cols="80"><?= $data['reply_rubrik']; ?></textarea>
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
                     <img src="../../img/rubrik/<?= $data['gambar_rubrik']; ?>" style="width:250px;">
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
    case "hapusrubrik" :

    if(isset($_GET['id'])){
      $lihat = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM rubrik_hukum where id_rubrik='$_GET[id]'"));

      unlink("../../img/rubrik/".$lihat['gambar_rubrik']);

      $del = mysqli_query($con, "DELETE FROM rubrik_hukum where id_rubrik='$_GET[id]'");
      if($del){
    	  echo "<script>
                 alert('Data Berhasil Dihapus');
    					   window.location='index.php?module=rubrik_hukum';
    				  </script>";
      }else{
        echo "<script>
                alert('Data Gagal Dihapus');
                window.location='index.php?module=rubrik_hukum';
              </script>";
      }
    }
?>
<?php
    break;
    case "konfirmasi" :

    if(isset($_GET['id'])){
      $lihat = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM rubrik_hukum where id_rubrik='$_GET[id]'"));


      $del = mysqli_query($con, "UPDATE rubrik_hukum SET status='Y' where id_rubrik='$_GET[id]'");
      if($del){
    	  echo "<script>
                 alert('Data Berhasil Dikonfirmasi');
    					   window.location='index.php?module=rubrik_hukum';
    				  </script>";
      }else{
        echo "<script>
                alert('Data Gagal Dikonfirmasi');
                window.location='index.php?module=rubrik_hukum';
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
        Rubrik Hukum
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Rubrik Hukum</li>
      </ol>
</section>
<section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-info">
            <div class="box-header with-border">
               <a href="?module=rubrik_hukum&aksi=tambahrubrik" class="btn btn-flat btn-primary">Tambah Rubrik Hukum</a>
            </div>

            <!-- /.box-header -->
            <div class="box-body">
              <div class="table table-responsive">
              <table  class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Pertanyaan</th>
                    <th>Jawaban</th>
                    <th>Tanggal</th>
                    <th>Foto</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
        				<?php
        					$be = mysqli_query($con, "SELECT * FROM rubrik_hukum");
        					$no=1;
        					while($r=mysqli_fetch_assoc($be)){
        						$desk = substr($r['deskripsi_rubrik'],0,500)."...";
                    $jawab = substr($r['reply_rubrik'],0,500)."...";
        				?>
      				<tr>
      					<td><?= $no; ?></td>
      					<td><?= $r['judul_rubrik'] ?></td>
      					<td><?= $desk ?></td>
                <td><?= $jawab ?></td>
      					<td><?= tgl_indo($r['tgl_rubrik']) ?></td>
                <td><img src="../../img/rubrik/<?= $r['gambar_rubrik'] ?>" width="130"></td>
      					<td><a href="?module=rubrik_hukum&aksi=replyrubrik&id=<?= $r['id_rubrik'];?>" class="btn btn-success btn-flat">Preview</a>
						<?php
						if($r['status']=='N'){
						?>
						<a href="?module=rubrik_hukum&aksi=konfirmasi&id=<?= $r['id_rubrik'];?>" class="btn btn-primary btn-flat">Konfirmasi</a>
						<?php
						}
						?>
      						<a href="?module=rubrik_hukum&aksi=hapusrubrik&id=<?= $r['id_rubrik'];?>" class="btn btn-danger btn-flat" onclick="return confirm('Yakin Akan Menghapus Data Ini ... ?')">Hapus</a>
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
