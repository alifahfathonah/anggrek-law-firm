<div class="content-wrapper">
<?php
  if (isset($_GET['aksi'])){
    $aksi = $_GET['aksi'];

  switch ($aksi){
    case "editslider" :
 if(isset($_GET['id'])){
      $sql = mysqli_query($con, "SELECT * FROM slider where id_slider='$_GET[id]'");
      $data=mysqli_fetch_assoc($sql);
    }
    if(isset($_POST['save'])){
		$nmberkas  = $_FILES["foto"]["name"];
		$lokberkas = $_FILES["foto"]["tmp_name"];
		$nmfoto= date("YmdHis").$nmberkas;
    $valid    = array('jpg','png','gif','jpeg');
    list($txt, $ext) = explode(".",$nmfoto);
    if(in_array($ext,$valid)){
		if(!empty($lokberkas)){
			move_uploaded_file($lokberkas, "../../img/homeslider/$nmfoto");
		}

 $save=mysqli_query($con, "UPDATE slider SET gambar='$nmfoto' WHERE id_slider='$_GET[id]'");
	 if($save) {
        echo "<script>
            alert('Edit Data Berhasil');
            window.location='?module=slider';
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
       Slider Menu
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit Slider</li>
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
					
 <div class="form-group" >
             <label for="gam" class="col-sm-2 control-label">&nbsp;</label>
             <div class="col-sm-4">
               <img src="../../img/homeslider/<?= $data['gambar']; ?>" style="width:250px;">
             </div>
           </div>
					<div class="form-group">
						<label for="foto" class="col-sm-2 control-label">Foto</label>
					  <div class="col-sm-4">
						<input type="file" name="foto" id="foto" class="form-control">
					  </div>
					</div>
					
					<div class="form-group">
					  <label for="foto" class="col-sm-2 control-label"></label>
					  <div class="col-sm-4">
						*) Ukuran Foto 1935 x 927
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
    case "aktif" :

    if(isset($_GET['id'])){
      $update = mysqli_query($con, "UPDATE slider SET status='Y' WHERE id_slider='$_GET[id]'");
      
    	  echo "<script>window.location.href='index.php?module=slider';</script>";
    }
?>
<?php
break;
    case "nonaktif" :
      $del = mysqli_query($con, "UPDATE slider SET status='T' WHERE id_slider='$_GET[id]'");
      
    	  echo "<script>window.location.href='index.php?module=slider';</script>";
?>
<?php
}
}else{
?>

<section class="content-header">
      <h1>
        Slider
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Slider Menu</li>
      </ol>
</section>
<section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-info">
            <div class="box-header with-border">
             <!-- <a href="?module=our_partner&aksi=tambahpartner" class="btn btn-flat btn-primary">Tambah Partner</a>-->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table table-responsive">
              <table  class="table table-bordered table-striped" id="example1">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Gambar</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $no = 0;
                    $sql = mysqli_query($con, "SELECT * FROM slider");
                    while($r = mysqli_fetch_assoc($sql)){
                      $no++;
                  ?>
                  <tr>
                    <td><?= $no ?></td>
                    <td><img src="../../img/homeslider/<?= $r['gambar'] ?>" width=150 height=100></td>
                    <td><?php echo $r['status'] ?></td>
                    <td>
                      <a href="?module=slider&aksi=editslider&id=<?= $r['id_slider'];?>" class="btn btn-danger btn-flat">Edit</a>
                      <?php if($r['status']=='T'){?>
                      <a href="?module=slider&aksi=aktif&id=<?= $r['id_slider'];?>" class="btn btn-info btn-flat">Aktif</a>
                      <?php } ?>
                      <?php if($r['status']=='Y'){ ?>
      				  <a href="?module=slider&aksi=nonaktif&id=<?= $r['id_slider'];?>" class="btn btn-warning btn-flat">Tidak Aktif</a>
      				  <?php } ?>
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
