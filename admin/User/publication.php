<div class="content-wrapper">
<?php
  if (isset($_GET['aksi'])){
    $aksi = $_GET['aksi'];

  switch ($aksi){
    case "tambahpub" :

    if(isset($_POST['save'])){
		$nmberkas  = $_FILES["doc"]["name"];
		$lokberkas = $_FILES["doc"]["tmp_name"];
		$nmdoc= date("YmdHis").$nmberkas;
    $valid    = array('pdf','doc','xls');
    list($txt, $ext) = explode(".",$nmdoc);
    if(in_array($ext,$valid)){

		if(!empty($lokberkas)){
			move_uploaded_file($lokberkas, "../../doc/$nmdoc");
		}

	$save=mysqli_query($con, "INSERT INTO publication VALUES('', '$_POST[judul]','$nmdoc')");

	 if($save) {
        echo "<script>
            alert('Tambah Data Berhasil');
            window.location='?module=publication';
            </script>";
            exit;
      }else{
        echo "<script>alert('Gagal');
            </script>";
      }
    }else{
      echo "<script>
              alert('Format File Tidak Mendukung, Upload Foto Dengan Format pdf/doc/xls');
            </script>";
    }
  }
?>
<section class="content-header">
      <h1>
        Publication
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Tambah Publication</li>
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
						<label for="judul" class="col-sm-2 control-label">Judul</label>
					  <div class="col-sm-4">
						<input type="text" name="judul" id="judul" class="form-control">
					  </div>
					</div>

					<div class="form-group">
						<label for="doc" class="col-sm-2 control-label">Document</label>
					  <div class="col-sm-4">
						<input type="file" name="doc" id="doc" class="form-control">
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
    case "editpub":
    if(isset($_GET['id'])){
      $sql = mysqli_query($con, "SELECT * FROM publication where id_publication='$_GET[id]'");
      $data=mysqli_fetch_assoc($sql);
    }
    if(isset($_POST['save'])){
		$nmberkas  = $_FILES['doc']["name"];
		$lokberkas = $_FILES["doc"]["tmp_name"];
		$nmdoc= date("YmdHis").$nmberkas;
    $valid    = array('pdf','doc','xls');

    if(empty($lokberkas)){
      $save=mysqli_query($con, "UPDATE publication set judul='$_POST[judul]' where id_publication='$_GET[id]'");
        if($save) {
          echo "<script>
              alert('Edit Data Berhasil');
              window.location='?module=publication';
                </script>";
          }else{
            echo "<script>alert('Gagal');
                </script>";
         }
		}else if(!empty($lokberkas)){
      list($txt, $ext) = explode(".",$nmdoc);
      if(in_array($ext,$valid)){
			move_uploaded_file($lokberkas, "../../doc/$nmdoc");
      $lihat = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM publication where id_publication='$_GET[id]'"));

      unlink("../../doc/".$lihat['document']);


    $save=mysqli_query($con, "UPDATE publication set judul='$_POST[judul]', document='$nmdoc' where id_publication='$_GET[id]'");
      if($save) {
        echo "<script>
            alert('Edit Data Berhasil');
            window.location='?module=publication';
              </script>";
        }else{
          echo "<script>alert('Gagal');
              </script>";
       }
     }else{
       echo "<script>
               alert('Format File Tidak Mendukung, Upload Foto Dengan Format pdf/doc/xls');
             </script>";
     }
   }
  }
?>
<section class="content-header">
      <h1>
        Publication
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit Publication</li>
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
      						<label for="judul" class="col-sm-2 control-label">Judul</label>
      					  <div class="col-sm-4">
      						<input type="text" name="judul" id="judul" class="form-control" value="<?= $data['judul'] ?>">
      					  </div>
      					</div>

				        <div class="form-group" >
                  <label for="doc" class="col-sm-2 control-label">Document</label>
                  <div class="col-sm-4">
                    <input type="file" name="doc" id="doc" class="form-control">
          					<input type="hidden" name="doclama" class="form-control"  value="<?= $data['document']; ?>">
                  </div>
                </div>

				        <div class="form-group" >
                  <label for="gam" class="col-sm-2 control-label">&nbsp;</label>

				        <div class="col-sm-4">
                    <a href="../../doc/<?= $data['document']; ?>"><?= $data['document']; ?></a>
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
    case "hapuspub" :

    if(isset($_GET['id'])){
      $lihat = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM publication where id_publication='$_GET[id]'"));

      unlink("../../doc/".$lihat['document']);
      $del = mysqli_query($con, "DELETE FROM publication where id_publication='$_GET[id]'");
      if($del){
    	  echo "<script>
                 alert('Data Berhasil Dihapus');
    					   window.location='index.php?module=publication';
    				  </script>";
      }else{
        echo "<script>
                alert('Data Gagal Dihapus');
                window.location='index.php?module=publication';
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
        Publication
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Publication</li>
      </ol>
</section>
<section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-info">
            <div class="box-header with-border">
              <a href="?module=publication&aksi=tambahpub" class="btn btn-flat btn-primary">Tambah Publication</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table table-responsive">
              <table  class="table table-bordered table-striped" id="example1">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Document</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $no = 0;
                    $sql = mysqli_query($con, "SELECT * FROM publication");
                    while($r = mysqli_fetch_assoc($sql)){
                      $no++;
                  ?>
                  <tr>
                    <td><?= $no ?></td>
                    <td><?= $r['judul']?></td>
                    <td><a href="../../doc/<?= $r['document'] ?>"><?= $r['document'] ?></a></td>
                    <td><a href="?module=publication&aksi=editpub&id=<?= $r['id_publication'];?>" class="btn btn-success btn-flat">Edit</a>
                      <a href="?module=publication&aksi=hapuspub&id=<?= $r['id_publication'];?>" class="btn btn-danger btn-flat" onclick="return confirm('Yakin Akan Menghapus Data Ini ... ?')">Hapus</a>
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
