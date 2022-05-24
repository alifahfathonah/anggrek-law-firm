<div class="content-wrapper">
<?php
  if (isset($_GET['aksi'])){
    $aksi = $_GET['aksi'];

  switch ($aksi){
    case "tambahpartner" :

    if(isset($_POST['save'])){
		$nmberkas  = $_FILES["foto"]["name"];
		$lokberkas = $_FILES["foto"]["tmp_name"];
		$nmfoto= date("YmdHis").$nmberkas;
    $valid    = array('jpg','png','gif','jpeg');
    list($txt, $ext) = explode(".",$nmfoto);
    if(in_array($ext,$valid)){
		if(!empty($lokberkas)){
			move_uploaded_file($lokberkas, "../../img/partner/$nmfoto");
		}

	$save=mysqli_query($con, "INSERT INTO our_partner VALUES('', '$_POST[nama]', '$nmfoto')");

	 if($save) {
        echo "<script>
            alert('Tambah Data Berhasil');
            window.location='?module=our_partner';
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
						<label for="nama" class="col-sm-2 control-label">Nama Partner</label>
					  <div class="col-sm-4">
						<input type="text" name="nama" id="nama" class="form-control">
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
    case "hapuspartner" :

    if(isset($_GET['id'])){
      $lihat = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM our_partner where id_partner='$_GET[id]'"));

      unlink("../../img/partner/".$lihat['foto_partner']);
      $del = mysqli_query($con, "DELETE FROM our_partner where id_partner='$_GET[id]'");
      if($del){
    	  echo "<script>
                 alert('Data Berhasil Dihapus');
    					   window.location='index.php?module=our_partner';
    				  </script>";
      }else{
        echo "<script>
                alert('Data Gagal Dihapus');
                window.location='index.php?module=our_partner';
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
        Our Partner
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Our Partner</li>
      </ol>
</section>
<section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-info">
            <div class="box-header with-border">
              <a href="?module=our_partner&aksi=tambahpartner" class="btn btn-flat btn-primary">Tambah Partner</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table table-responsive">
              <table  class="table table-bordered table-striped" id="example1">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Foto</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $no = 0;
                    $sql = mysqli_query($con, "SELECT * FROM our_partner");
                    while($r = mysqli_fetch_assoc($sql)){
                      $no++;
                  ?>
                  <tr>
                    <td><?= $no ?></td>
                    <td><img src="../../img/partner/<?= $r['foto_partner'] ?>" width=100 height=100></td>
                    <td>
                      <a href="?module=our_partner&aksi=hapuspartner&id=<?= $r['id_partner'];?>" class="btn btn-danger btn-flat" onclick="return confirm('Yakin Akan Menghapus Data Ini ... ?')">Hapus</a>
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
