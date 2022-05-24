<div class="content-wrapper">

<?php
  if (isset($_GET['aksi'])){
    $aksi = $_GET['aksi'];

  switch ($aksi){
    case "tambahpracticedetail" :

    if(isset($_POST['save'])){
		$nmberkas  = $_FILES["gambar"]["name"];
		$lokberkas = $_FILES["gambar"]["tmp_name"];
    $nmfoto= date("YmdHis").$nmberkas;
    $valid    = array('jpg','png','gif','jpeg');
     $language = ($_POST['language']);
    list($txt, $ext) = explode(".",$nmfoto);
    if(in_array($ext,$valid)){
		if(!empty($lokberkas)){
			move_uploaded_file($lokberkas, "../../img/areapraktis/deskripsi/$nmfoto");
		}
		
    // $save=mysqli_query($con, "INSERT INTO practice_area VALUES ('','$_POST[judul]', '$judulseo', '$nmfoto', '$nmfoto2','$_POST[narasi]', '$_POST[language]' )");
           
	$save=mysqli_query($con, "INSERT INTO practice_area_detail VALUES ('','$_POST[kategori]', '$_POST[judul]', '$nmfoto', '$_POST[deskripsi]', '$_POST[language]' )");

	 if($save) {
        echo "<script>
            alert('Tambah Data Berhasil');
            window.location='?module=practice-area-detail';
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
        Practice Area Detail
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Tambah Practice Area Detail</li>
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
						<label for="language" class="col-sm-2 control-label">Pilih Bahasa </label>
						<select name="language">
                         <option>--Bahasa--</option>
                         <option value="en">Inggris</option>
                         <option value="bs">Indonesia</option>
                         </select>
				
					</div>

            <div class="form-group">
  						<label for="kdp" class="col-sm-2 control-label">Judul</label>
  					  <div class="col-sm-8">
  						<input type="text" name="judul" id="kdp" class="form-control">
  					  </div>
  					</div>

          <div class="form-group">
  					<label for="kategori" class="col-sm-2 control-label">Kategori</label>
  					 <div class="col-sm-4">
  						<select class="form-control" name="kategori">
                <option value="">-- Pilih Kategori --</option>
                <?php
                  $sql = mysqli_query($con, "SELECT * FROM practice_area");
                  while($r=mysqli_fetch_assoc($sql)){
                ?>
                <option value="<?= $r['id_practice'] ?>"><?= $r['judul_practice'] ?></option>
                <?php } ?>
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
						<label for="editor" class="col-sm-2 control-label">Deskripsi</label>
					  <div class="col-sm-8">
						<textarea name="deskripsi" id="editor" class="form-control"></textarea>
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
    case "editpracticedetail":
    if(isset($_GET['id'])){
      $sql = mysqli_query($con, "SELECT * FROM practice_area_detail where id_practice_detail='$_GET[id]'");
      $data=mysqli_fetch_assoc($sql);
    }
    if(isset($_POST['save'])){
		$nmberkas  = $_FILES['foto']["name"];
		$lokberkas = $_FILES["foto"]["tmp_name"];
		$nmfoto= date("YmdHis").$nmberkas;
    $valid    = array('jpg','png','gif','jpeg');
    if(empty($lokberkas)){
        $save=mysqli_query($con, "UPDATE practice_area_detail set judul_detail='$_POST[judul]', id_practice='$_POST[kategori]', deskripsi_detail='$_POST[deskripsi]' where id_practice_detail='$_GET[id]'");

        if($save) {
          echo "<script>
              alert('Edit Data Berhasil');
              window.location='?module=practice-area-detail';
                </script>";
          }else{
            echo "<script>alert('Gagal');
                </script>";
         }

		}else if(!empty($lokberkas)){
      list($txt, $ext) = explode(".",$nmfoto);
      if(in_array($ext,$valid)){
			   move_uploaded_file($lokberkas, "../../img/areapraktis/deskripsi/$nmfoto");
         $lihat = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM practice_area_detail where id_practice_detail='$_GET[id]'"));

         unlink("../../img/areapraktis/deskripsi/".$lihat['gambar_practice_detail']);

        $save=mysqli_query($con, "UPDATE practice_area_detail set judul_detail='$_POST[judul]', id_practice='$_POST[kategori]', deskripsi_detail='$_POST[deskripsi]', gambar_practice_detail='$nmfoto' where id_practice_detail='$_GET[id]'");

      if($save) {
        echo "<script>
            alert('Edit Data Berhasil');
            window.location='?module=practice-area-detail';
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

                <div class="form-group">
      						<label for="kdp" class="col-sm-2 control-label">Judul</label>
      					  <div class="col-sm-8">
      						<input type="text" name="judul" id="kdp" class="form-control" value="<?= $data['judul_detail'] ?>">
      					  </div>
      					</div>

                <div class="form-group">
        					<label for="kategori" class="col-sm-2 control-label">Kategori</label>
        					 <div class="col-sm-4">
        						<select class="form-control" name="kategori">
                      <option value="">-- Pilih Kategori --</option>
                      <?php
                        $sql = mysqli_query($con, "SELECT * FROM practice_area");
                        while($r=mysqli_fetch_assoc($sql)){
                            if($r['id_practice']==$data['id_practice']){
                              $selected = "selected";
                            }else{
                              $selected = "";
                            }
                      ?>
                      <option <?= $selected ?> value="<?= $r['id_practice'] ?>"><?= $r['judul_practice'] ?></option>
                      <?php } ?>
                    </select>
        					 </div>
        				</div>

				        <div class="form-group" >
                  <label for="des" class="col-sm-2 control-label">Deskripsi</label>
                  <div class="col-sm-10">
                    <textarea type="text" name="deskripsi" id="editor" class="form-control" rows="15" cols="80"><?= $data['deskripsi_detail']; ?></textarea>
                  </div>
                </div>

				        <div class="form-group" >
                  <label for="gam" class="col-sm-2 control-label">Gambar</label>
                  <div class="col-sm-4">
                    <input type="file" name="foto" id="gam" class="form-control">
					          <input type="hidden" name="gambarlama" id="jdl" class="form-control"  value="<?= $data['gambar_practice_detail']; ?>">
                  </div>
                </div>

				       <div class="form-group" >
                  <label for="gam" class="col-sm-2 control-label">&nbsp;</label>
				          <div class="col-sm-4">
                    <img src="../../img/areapraktis/deskripsi/<?= $data['gambar_practice_detail']; ?>" style="width:250px;">
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
    case "hapuspracticedetail" :

    if(isset($_GET['id'])){
      $lihat = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM practice_area_detail where id_practice_detail='$_GET[id]'"));

      unlink("../../img/areapraktis/deskripsi/".$lihat['gambar_practice_detail']);

      $del = mysqli_query($con, "DELETE FROM practice_area_detail where id_practice_detail='$_GET[id]'");
      if($del){
    	  echo "<script>
                 alert('Data Berhasil Dihapus');
    					   window.location='index.php?module=practice-area-detail';
    				  </script>";
      }else{
        echo "<script>
                alert('Data Gagal Dihapus');
                window.location='index.php?module=practice-area-detail';
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
        Practice Area Detail
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Practice Area Detail</li>
      </ol>
</section>
<section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-info">
            <form method='POST' action=''>
                 <h5>Pilih Bahasa :</h5>
                <select name="lang">
                <option value="en">Bahasa Inggris</option>
                <option value="bs">Bahasa Indonesia</option>
                </select>
                <input type="submit" name="submit" value="Submit"/>
            </form>
            <!-- /.box-header -->
           
            <div class="box-header with-border">
              <a href="?module=practice-area-detail&aksi=tambahpracticedetail" class="btn btn-flat btn-primary">Tambah Practice Area Detail</a>
            </div>
            <div class="box-body">
              <div class="table table-responsive">
              <table  class="table table-bordered table-striped" id="example1">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Gambar</th>
                    <th>Kategori</th>
                    <th>Judul</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  
                    if(isset($_POST['lang'])){
                       $be = mysqli_query($con, "SELECT * FROM practice_area_detail, practice_area WHERE  practice_area_detail.id_practice=practice_area.id_practice AND practice_area.language = '$_POST[lang]'");
                    }else{
                       $be = mysqli_query($con, "SELECT * FROM practice_area_detail, practice_area WHERE  practice_area_detail.id_practice=practice_area.id_practice AND practice_area.language = 'en'");
                    }
                  
                //   $be = mysqli_query($con, "SELECT * FROM , practice_area_detail, practice_area where language = '$_POST[lang]'");
                // $be = mysqli_query($con, "SELECT * FROM practice_area_detail, practice_area WHERE  practice_area_detail.id_practice=practice_area.id_practice language = '$_POST[lang]'");
                  $no=1;
                  while($r=mysqli_fetch_assoc($be)){
                    ?>
                    <tr>
                      <td><?= $no; ?></td>
                      <td><img src="../../img/areapraktis/deskripsi/<?= $r["gambar_practice_detail"];?>" style="width:100px;"></td>
                      <td><?= $r["judul_practice"];?></td>
                      <td><?= $r["judul_detail"];?></td>
                      <td><?= $r['deskripsi_detail'] ?></td>
                      <td>
                        <a  href="?module=practice-area-detail&aksi=editpracticedetail&id=<?= $r['id_practice_detail'];?>"  class="btn btn-success btn-flat">Edit</a>

                        <a href="?module=practice-area-detail&aksi=hapuspracticedetail&id=<?= $r['id_practice_detail'];?>"  class="btn btn-danger btn-flat" onclick="return confirm('Yakin Akan Menghapus Data Ini ... ?')">Hapus</a>
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
