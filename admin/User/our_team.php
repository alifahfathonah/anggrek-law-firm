<div class="content-wrapper">
<?php
  if (isset($_GET['aksi'])){
    $aksi = $_GET['aksi'];

  switch ($aksi){
    case "tambahteam" :

    if(isset($_POST['save'])){
    $nmseo = seo_title($_POST['nama']);
		$nmberkas  = $_FILES["foto"]["name"];
		$lokberkas = $_FILES["foto"]["tmp_name"];
		$nmfoto= date("YmdHis").$nmberkas;
		 $language = ($_POST['language']);
    $valid    = array('jpg','png','gif','jpeg');
    list($txt, $ext) = explode(".",$nmfoto);
    if(in_array($ext,$valid)){
  		if(!empty($lokberkas)){
  			move_uploaded_file($lokberkas, "../../img/team/$nmfoto");
  		}

	$save=mysqli_query($con, "INSERT INTO our_team VALUES('', '$_POST[nama]','$_POST[jabatan]','$_POST[biografi]','$_POST[keterangan]','$nmfoto', '$nmseo', '$_POST[language]')");

	 if($save) {
        echo "<script>
            alert('Tambah Data Berhasil');
            window.location='?module=our_team';
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
        Our Team
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Tambah Team</li>
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
						<label for="nama" class="col-sm-2 control-label">Nama Lengkap</label>
					  <div class="col-sm-4">
						<input type="text" name="nama" id="nama" class="form-control">
					  </div>
					</div>

          <div class="form-group">
						<label for="jabatan" class="col-sm-2 control-label">Jabatan</label>
					  <div class="col-sm-4">
						<input type="text" name="jabatan" id="jabatan" class="form-control">
					  </div>
					</div>

          <div class="form-group">
            <label for="des" class="col-sm-2 control-label">Biografi Team</label>
            <div class="col-sm-8">
            <textarea type="text" name="biografi" id="des" class="form-control textarea" rows="8" cols="80"></textarea>
            </div>
          </div>
		  <div class="form-group">
            <label for="des" class="col-sm-2 control-label">Deskripsi</label>
            <div class="col-sm-8">
			 <textarea type="text" name="keterangan" id="des" class="form-control textarea" rows="8" cols="80"></textarea>
            </div>
          </div>

					<div class="form-group">
						<label for="foto" class="col-sm-2 control-label">Foto</label>
					  <div class="col-sm-4">
						<input type="file" name="foto" id="foto" class="form-control">
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
    case "editteam":
    if(isset($_GET['id'])){
      $sql = mysqli_query($con, "SELECT * FROM our_team where id_team='$_GET[id]'");
      $data=mysqli_fetch_assoc($sql);
    }
    if(isset($_POST['save'])){
    $nmseo = seo_title($_POST['nama']);
		$nmberkas  = $_FILES['foto']["name"];
		$lokberkas = $_FILES["foto"]["tmp_name"];
		$nmfoto= date("YmdHis").$nmberkas;
    $valid    = array('jpg','png','gif','jpeg');

    if(empty($lokberkas)){
          $save=mysqli_query($con, "UPDATE our_team set nama_team='$_POST[nama]', jabatan_team='$_POST[jabatan]', biografi_team='$_POST[biografi]',keterangan='$_POST[keterangan]', nama_team_seo='$nmseo' where id_team='$_GET[id]'");

          if($save) {
            echo "<script>
                alert('Edit Data Berhasil');
                window.location='?module=our_team';
                  </script>";
            }else{
              echo "<script>alert('Gagal');
                  </script>";
           }

    }else if (!empty($lokberkas)){
      list($txt, $ext) = explode(".",$nmfoto);
        if(in_array($ext,$valid)){

        move_uploaded_file($lokberkas, "../../img/team/$nmfoto");
        $lihat = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM our_team where id_team='$_GET[id]'"));

        unlink("../../img/team/".$lihat['foto_team']);

        $save=mysqli_query($con, "UPDATE our_team set nama_team='$_POST[nama]', jabatan_team='$_POST[jabatan]', biografi_team='$_POST[biografi]', foto_team='$nmfoto', nama_team_seo='$nmseo' where id_team='$_GET[id]'");
      if($save) {
        echo "<script>
            alert('Edit Data Berhasil');
            window.location='?module=our_team';
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
      						<label for="nama" class="col-sm-2 control-label">Nama Lengkap</label>
      					  <div class="col-sm-4">
      						<input type="text" name="nama" id="nama" class="form-control" value="<?= $data['nama_team'] ?>">
      					  </div>
      					</div>

                <div class="form-group">
      						<label for="jabatan" class="col-sm-2 control-label">Jabatan</label>
      					  <div class="col-sm-4">
      						<input type="text" name="jabatan" id="jabatan" class="form-control" value="<?= $data['jabatan_team'] ?>">
      					  </div>
      					</div>

                <div class="form-group">
                  <label for="des" class="col-sm-2 control-label">Biografi Team</label>
                  <div class="col-sm-8">
                  <textarea type="text" name="biografi" id="editor" class="form-control" rows="15" cols="80"><?= $data['biografi_team'] ?></textarea>
                  </div>
                </div>
				<div class="form-group">
                  <label for="des" class="col-sm-2 control-label">Deskripsi</label>
                  <div class="col-sm-8">
				   <textarea type="text" name="keterangan" id="des" class="form-control textarea" rows="8" cols="80"><?= $data['keterangan'] ?></textarea>
                  </div>
                </div>

				        <div class="form-group" >
                  <label for="foto" class="col-sm-2 control-label">Foto</label>
                  <div class="col-sm-4">
                    <input type="file" name="foto" id="foto" class="form-control">
          					<input type="hidden" name="fotolama" class="form-control"  value="<?= $data['foto_team']; ?>">
                  </div>
                </div>

				        <div class="form-group" >
                  <label for="gam" class="col-sm-2 control-label">&nbsp;</label>

				        <div class="col-sm-4">
                    <img src="../../img/team/<?= $data['foto_team']; ?>" style="width:250px;">
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
    case "hapusteam" :

    if(isset($_GET['id'])){
      $lihat = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM our_team where id_team='$_GET[id]'"));

      unlink("../../img/team/".$lihat['foto_team']);
      $del = mysqli_query($con, "DELETE FROM our_team where id_team='$_GET[id]'");
      if($del){
    	  echo "<script>
                 alert('Data Berhasil Dihapus');
    					   window.location='index.php?module=our_team';
    				  </script>";
      }else{
        echo "<script>
                alert('Data Gagal Dihapus');
                window.location='index.php?module=our_team';
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
        Our Team
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Our Team</li>
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
              <a href="?module=our_team&aksi=tambahteam" class="btn btn-flat btn-primary">Tambah Team</a>
            </div>
            <div class="box-body">
              <div class="table table-responsive">
              <table  class="table table-bordered table-striped" id="example1">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Foto</th>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>Biografi</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  
                  if(isset($_POST['lang'])){
                        $no = 0;
                        $sql = mysqli_query($con, "SELECT * FROM our_team where language = '$_POST[lang]' ORDER BY nama_team ASC");

                    }else{
                         $no = 0;
                         $sql = mysqli_query($con, "SELECT * FROM our_team where language = 'en' ORDER BY nama_team ASC");
                    }
                  
                    // $no = 0;
                    // $sql = mysqli_query($con, "SELECT * FROM our_team where language = '$_POST[lang]' ORDER BY nama_team ASC");
                    while($r = mysqli_fetch_assoc($sql)){
                      $no++;
                  ?>
                  <tr>
                    <td><?= $no ?></td>
                    <td><img src="../../img/team/<?= $r['foto_team'] ?>" width=100 height=100></td>
                    <td><?= $r['nama_team'] ?></td>
                    <td><?= $r['jabatan_team'] ?></td>
                    <td><?= $r['biografi_team'] ?></td>
                    <td><a href="?module=our_team&aksi=editteam&id=<?= $r['id_team'];?>" class="btn btn-success btn-flat">Edit</a>
                      <a href="?module=our_team&aksi=hapusteam&id=<?= $r['id_team'];?>" class="btn btn-danger btn-flat" onclick="return confirm('Yakin Akan Menghapus Data Ini ... ?')">Hapus</a>
                    </td>
                  <?php } ?>
                  </tr>
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
