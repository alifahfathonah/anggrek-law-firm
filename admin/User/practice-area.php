<div class="content-wrapper">

<?php
  if (isset($_GET['aksi'])){
    $aksi = $_GET['aksi'];

  switch ($aksi){
    case "tambahpractice" :

    if(isset($_POST['save'])){
    $judulseo = seo_title($_POST['judul']);
		$nmberkas  = $_FILES["gambar"]["name"];
		$lokberkas = $_FILES["gambar"]["tmp_name"];
    $tipe_file = $_FILES["gambar"]["type"];
    $nmfoto= date("YmdHis").$nmberkas;
    $direktori_file = "../../img/areapraktis/$nmfoto";
    $language = ($_POST['language']);

    $nmberkas2  = $_FILES["cover"]["name"];
    $lokberkas2 = $_FILES["cover"]["tmp_name"];
    $tipe_file2 = $_FILES["cover"]["type"];
    $nmfoto2= date("YmdHis").$nmberkas2;
    $direktori_file2 = "../../img/areapraktis/$nmfoto2";

    if(!empty($lokberkas) AND !empty($lokberkas2)){
        if($tipe_file != "image/jpg" AND $tipe_file != "image/png" AND $tipe_file != "image/jpeg" AND $tipe_file2 != "image/jpg" AND $tipe_file2 != "image/png" AND $tipe_file2 != "image/jpeg"){
          echo "<script>
                  window.alert('Tipe file tidak di ijinkan, harap upload dengan format jpg,png')
                </script>";
        }else{
            move_uploaded_file($lokberkas, "../../img/areapraktis/$nmfoto");
            move_uploaded_file($lokberkas2, "../../img/areapraktis/$nmfoto2");
            // var_dump($_POST['judul'],$judulseo,$nmfoto,$nmfoto2,$_POST['narasi']);
            //  var_dump($con);die();
            $save=mysqli_query($con, "INSERT INTO practice_area VALUES ('','$_POST[judul]', '$judulseo', '$nmfoto', '$nmfoto2','$_POST[narasi]', '$_POST[language]' )");
           
            if($save) {
                 echo "<script>
                     alert('Tambah Data Berhasil');
                     window.location='?module=practice-area';
                     </script>";
                     exit;
               }else{
                 echo "<script>alert('Gagal');
                     </script>";
               }
        }
    }else if(!empty($lokberkas) AND empty($lokberkas2)){
      if($tipe_file != "image/jpg" AND $tipe_file != "image/png" AND $tipe_file != "image/jpeg"){
        echo "<script>
                window.alert('Tipe file tidak di ijinkan, harap upload dengan format jpg,png')
              </script>";
      }else{
          move_uploaded_file($lokberkas, "../../img/areapraktis/$nmfoto");

          $save=mysqli_query($con, "INSERT INTO practice_area VALUES ('','$_POST[judul]', '$judulseo', '$nmfoto', '','$_POST[narasi]', '$_POST[language]')");

          if($save) {
               echo "<script>
                   alert('Tambah Data Berhasil');
                   window.location='?module=practice-area';
                   </script>";
                   exit;
             }else{
               echo "<script>alert('Gagal');
                   </script>";
             }
      }
    }else if(empty($lokberkas) AND !empty($lokberkas2)){
      if($tipe_file2 != "image/jpg" AND $tipe_file2 != "image/png" AND $tipe_file2 != "image/jpeg"){
        echo "<script>
                window.alert('Tipe file tidak di ijinkan, harap upload dengan format jpg,png')
              </script>";
      }else{
          move_uploaded_file($lokberkas2, "../../img/areapraktis/$nmfoto2");

          $save=mysqli_query($con, "INSERT INTO practice_area VALUES ('','$_POST[judul]', '$judulseo', '', '$nmfoto2','$_POST[narasi]', '$_POST[language]')");

          if($save) {
               echo "<script>
                   alert('Tambah Data Berhasil');
                   window.location='?module=practice-area';
                   </script>";
                   exit;
             }else{
               echo "<script>alert('Gagal');
                   </script>";
             }
      }
    }else{
        $save=mysqli_query($con, "INSERT INTO practice_area VALUES ('','$_POST[judul]', '$judulseo', '', '','$_POST[narasi]', '$_POST[language]')");

        if($save) {
             echo "<script>
                 alert('Tambah Data Berhasil');
                 window.location='?module=practice-area';
                 </script>";
                 exit;
           }else{
             echo "<script>alert('Gagal');
                 </script>";
           }
    }
  }
?>
<section class="content-header">
      <h1>
        Practice Area
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Tambah Practice Area</li>
      </ol>
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
						<label for="gam" class="col-sm-2 control-label">Gambar</label>
					  <div class="col-sm-4">
						<input type="file" name="gambar" id="gam" class="form-control">
					  </div>
					</div>

          <div class="form-group">
						<label for="cov" class="col-sm-2 control-label">Cover</label>
					  <div class="col-sm-4">
						<input type="file" name="cover" id="cov" class="form-control">
					  </div>
					</div>
 <div class="form-group">
            <label for="des" class="col-sm-2 control-label">Narasi</label>
            <div class="col-sm-8">
            <textarea type="text" name="narasi" id="des" class="form-control textarea" rows="8" cols="80"></textarea>
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
    case "editpractice":
    if(isset($_GET['id'])){
      $sql = mysqli_query($con, "SELECT * FROM practice_area where id_practice='$_GET[id]'");
      $data=mysqli_fetch_assoc($sql);
    }

    if(isset($_POST['save'])){
    $judulseo = seo_title($_POST['judul']);
		$nmberkas  = $_FILES["gambar"]["name"];
		$lokberkas = $_FILES["gambar"]["tmp_name"];
    $tipe_file = $_FILES["gambar"]["type"];
    $nmfoto= date("YmdHis").$nmberkas;
    $direktori_file = "../../img/areapraktis/$nmfoto";

    $nmberkas2  = $_FILES["cover"]["name"];
    $lokberkas2 = $_FILES["cover"]["tmp_name"];
    $tipe_file2 = $_FILES["cover"]["type"];
    $nmfoto2= date("YmdHis").$nmberkas2;
    $direktori_file2 = "../../img/areapraktis/$nmfoto2";

    if(!empty($lokberkas) AND !empty($lokberkas2)){
        if($tipe_file != "image/jpg" AND $tipe_file != "image/png" AND $tipe_file != "image/jpeg" AND $tipe_file2 != "image/jpg" AND $tipe_file2 != "image/png" AND $tipe_file2 != "image/jpeg"){
          echo "<script>
                  window.alert('Tipe file tidak di ijinkan, harap upload dengan format jpg,png')
                </script>";
        }else{
            move_uploaded_file($lokberkas, "../../img/areapraktis/$nmfoto");
            move_uploaded_file($lokberkas2, "../../img/areapraktis/$nmfoto2");

            $save=mysqli_query($con, "UPDATE practice_area SET judul_practice='$_POST[judul]', judulseo_practice='$judulseo', gambar_practice='$nmfoto', cover_practice='$nmfoto2',narasi='$_POST[narasi]' WHERE id_practice='$_GET[id]'");

            if($save) {
                 echo "<script>
                     alert('Edit Data Berhasil');
                     window.location='?module=practice-area';
                     </script>";
                     exit;
               }else{
                 echo "<script>alert('Gagal');
                     </script>";
               }
        }
    }else if(!empty($lokberkas) AND empty($lokberkas2)){
      if($tipe_file != "image/jpg" AND $tipe_file != "image/png" AND $tipe_file != "image/jpeg"){
        echo "<script>
                window.alert('Tipe file tidak di ijinkan, harap upload dengan format jpg,png')
              </script>";
      }else{
          move_uploaded_file($lokberkas, "../../img/areapraktis/$nmfoto");

          $save=mysqli_query($con, "UPDATE practice_area SET judul_practice='$_POST[judul]', judulseo_practice='$judulseo', gambar_practice='$nmfoto',narasi='$_POST[narasi]' WHERE id_practice='$_GET[id]'");

          if($save) {
               echo "<script>
                   alert('Edit Data Berhasil');
                   window.location='?module=practice-area';
                   </script>";
                   exit;
             }else{
               echo "<script>alert('Gagal');
                   </script>";
             }
      }
    }else if(empty($lokberkas) AND !empty($lokberkas2)){
      if($tipe_file2 != "image/jpg" AND $tipe_file2 != "image/png" AND $tipe_file2 != "image/jpeg"){
        echo "<script>
                window.alert('Tipe file tidak di ijinkan, harap upload dengan format jpg,png')
              </script>";
      }else{
          move_uploaded_file($lokberkas2, "../../img/areapraktis/$nmfoto2");

          $save=mysqli_query($con, "UPDATE practice_area SET judul_practice='$_POST[judul]', judulseo_practice='$judulseo', cover_practice='$nmfoto2',narasi='$_POST[narasi]' WHERE id_practice='$_GET[id]'");

          if($save) {
               echo "<script>
                   alert('Tambah Data Berhasil');
                   window.location='?module=practice-area';
                   </script>";
                   exit;
             }else{
               echo "<script>alert('Gagal');
                   </script>";
             }
      }
    }else{
        $save=mysqli_query($con, "UPDATE practice_area SET judul_practice='$_POST[judul]', judulseo_practice='$judulseo',narasi='$_POST[narasi]' WHERE id_practice='$_GET[id]'");

        if($save) {
             echo "<script>
                 alert('Tambah Data Berhasil');
                 window.location='?module=practice-area';
                 </script>";
                 exit;
           }else{
             echo "<script>alert('Gagal1');
                 </script>";
           }
    }
  }


?>

<section class="content-header">
      <h1>
        Practice Area
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit Practice Area</li>
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
						<input type="text" name="judul" id="kdp" class="form-control"  value="<?= $data['judul_practice'] ; ?>">
					  </div>
					</div>

					<div class="form-group">
						<label for="gam" class="col-sm-2 control-label">Gambar</label>
					  <div class="col-sm-4">
						<input type="file" name="gambar" id="gam" class="form-control">
					  </div>
					</div>

          <div class="form-group" >
             <label for="gam" class="col-sm-2 control-label">&nbsp;</label>
             <div class="col-sm-4">
               <img src="../../img/areapraktis/<?= $data['gambar_practice']; ?>" style="width:250px;">
             </div>
           </div>

          <div class="form-group">
						<label for="cov" class="col-sm-2 control-label">Cover</label>
					  <div class="col-sm-4">
						<input type="file" name="cover" id="cov" class="form-control">
					  </div>
					</div>
 <div class="form-group">
            <label for="des" class="col-sm-2 control-label">Narasi</label>
            <div class="col-sm-8">
            <textarea type="text" name="narasi" id="des" class="form-control textarea" rows="8" cols="80"><?= $data['narasi']; ?></textarea>
            </div>
          </div>
          <div class="form-group" >
             <label for="gam" class="col-sm-2 control-label">&nbsp;</label>
             <div class="col-sm-4">
               <img src="../../img/areapraktis/<?= $data['cover_practice']; ?>" style="width:250px;">
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
    case "hapuspractice" :

    if(isset($_GET['id'])){
      $lihat = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM practice_area where id_practice='$_GET[id]'"));

      unlink("../../img/areapraktis/".$lihat['gambar_practice']);
      unlink("../../img/areapraktis/".$lihat['cover_practice']);
      unlink("../../img/areapraktis/".$lihat['deskripsi']);

      $del = mysqli_query($con, "DELETE FROM practice_area where id_practice='$_GET[id]'");
      if($del){
    	  echo "<script>
                 alert('Data Berhasil Dihapus');
    					   window.location='index.php?module=practice-area';
    				  </script>";
      }else{
        echo "<script>
                alert('Data Gagal Dihapus');
                window.location='index.php?module=practice-area';
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
        Practice Area
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Practice Area</li>
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
              <a href="?module=practice-area&aksi=tambahpractice" class="btn btn-flat btn-primary">Tambah Practice Area</a>
            </div>
            <div class="box-body">
              <div class="table table-responsive">
              <table  class="table table-bordered table-striped" id="example1">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Gambar</th>
                    <th>Cover</th>
                    <th>Judul</th>
					<th>Narasi</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  
                    if(isset($_POST['lang'])){
                        $be = mysqli_query($con, "SELECT * FROM practice_area where language = '$_POST[lang]'");
                    }else{
                        $be = mysqli_query($con, "SELECT * FROM practice_area where language = 'en'");
                    }
                  
                  $no=1;
                  while($r=mysqli_fetch_assoc($be)){
                    ?>

                    <tr>
                      <td><?= $no; ?></td>
                      <td><img src="../../img/areapraktis/<?= $r["gambar_practice"];?>" style="width:100px;"></td>
                      <td><img src="../../img/areapraktis/<?= $r["cover_practice"];?>" style="width:100px;"></td>
                      <td><?= $r["judul_practice"];?></td>
					  <td><?= $r["narasi"];?></td>
                      <td>
                        <a href="?module=practice-area&aksi=editpractice&id=<?= $r['id_practice'];?>" class="btn btn-success btn-flat">Edit</a>
                        <a href="?module=practice-area&aksi=hapuspractice&id=<?= $r['id_practice'];?>" class="btn btn-danger btn-flat" onclick="return confirm('Yakin Akan Menghapus Data Ini ... ?')">Hapus</a>
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