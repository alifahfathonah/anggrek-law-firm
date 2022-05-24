<div class="content-wrapper">
        <!-- Content Header (Page header) -->


<?php
  if (isset($_GET['aksi'])){
    $aksi = $_GET['aksi'];

  switch ($aksi){
    case "tambahpengacara" :

    if(isset($_POST['save'])){
    $tglskrg = date('Y-m-d');
	 $password = md5($_POST['password']);
   $level='pengacara';

	$save=mysqli_query($con, "INSERT INTO tbl_pengacara VALUES('', '$_POST[nama_pengacara]','$_POST[alamat_pengacara]','$_POST[nohp_pengacara]','$_POST[email_pengacara]')");
  $id=mysqli_insert_id($con);
  $save=mysqli_query($con,"INSERT INTO tbl_admin VALUES('','$_POST[username]','$password','$id','$level')");

	 if($save) {
        echo "<script>
            alert('Tambah Data Berhasil');
            window.location='?module=pengacara';
            </script>";
            exit;
      }else{
        echo "<script>alert('Gagal');
            </script>";
      }
    }
?>
<section class="content-header">
      <h1>
        Pengacara/Staff
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Tambah Data Pengacara/Staff</li>
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
						<label for="kdp" class="col-sm-2 control-label">Nama Lengkap</label>
					  <div class="col-sm-4">
						<input type="text" name="nama_pengacara" id="kdp" class="form-control">
					  </div>
					</div>

					<div class="form-group">
						<label for="des" class="col-sm-2 control-label">Alamat </label>
					  <div class="col-sm-8">
						<textarea name="alamat_pengacara" id="des" class="form-control textarea" rows="8" cols="80"></textarea>
					  </div>
					</div>
					
					<div class="form-group">
						<label for="nohp" class="col-sm-2 control-label">No Handphone</label>
					  <div class="col-sm-8">
						<input name="nohp_pengacara" id="nohp" class="form-control ">
					  </div>
					</div>

					<div class="form-group">
						<label for="email" class="col-sm-2 control-label">Email</label>
					  <div class="col-sm-8">
						<input name="email_pengacara" id="email" class="form-control">
					  </div>
					</div>
					
					<div class="form-group">
						<label for="des" class="col-sm-2 control-label">Username</label>
					  <div class="col-sm-8">
						<input name="username" id="des" class="form-control " >
					  </div>
					</div>
					
					<div class="form-group">
						<label for="des" class="col-sm-2 control-label">Password</label>
					  <div class="col-sm-8">
						<input name="password" id="des" class="form-control " >
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
    case "editpengacara":
    if(isset($_GET['id_pengacara'])){
      $sql = mysqli_query($con, "SELECT * FROM tbl_pengacara where id_pengacara='$_GET[id_pengacara]'");
      $data=mysqli_fetch_assoc($sql);
	   $sql1 = mysqli_query($con, "SELECT * FROM tbl_admin where namalengkap='$_GET[id_pengacara]' and level='pengacara'");
      $data1=mysqli_fetch_assoc($sql1);
    }
    if(isset($_POST['save'])){

	 $password = md5($_POST['password']);
      $save=mysqli_query($con, "UPDATE tbl_pengacara set nama_pengacara='$_POST[nama_pengacara]', alamat_pengacara='$_POST[alamat_pengacara]', nohp_pengacara='$_POST[nohp_pengacara]', email_pengacara='$_POST[email_pengacara]' where id_pengacara='$_GET[id_pengacara]'");
	  
	  $save1=mysqli_query($con, "UPDATE tbl_admin set username='$_POST[username]', password='$password' where namalengkap='$_GET[id_pengacara]' and level='pengacara'");
      if($save) {
        echo "<script>
            alert('Edit Data Berhasil');
            window.location='?module=pengacara';
              </script>";
        }else{
          echo "<script>alert('Gagal');
              </script>";
       }
    }
?>
<section class="content-header">
      <h1>
       Client
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit Pengacara/Staff</li>
      </ol>
</section>

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
						<label for="kdp" class="col-sm-2 control-label">Nama Lengkap</label>
					  <div class="col-sm-4">
						<input type="text" name="nama_pengacara" id="kdp" class="form-control" value="<?= $data['nama_pengacara']?>">
					  </div>
					</div>

					<div class="form-group">
						<label for="des" class="col-sm-2 control-label">Alamat</label>
					  <div class="col-sm-8">
						<textarea name="alamat_pengacara" id="des" class="form-control textarea" rows="8" cols="80"><?= $data['alamat_pengacara']?></textarea>
					  </div>
					</div>
					
					<div class="form-group">
						<label for="nohp" class="col-sm-2 control-label">No Handphone</label>
					  <div class="col-sm-8">
						<input name="nohp_pengacara" id="nohp" class="form-control " value="<?= $data['nohp_pengacara']?>">
					  </div>
					</div>

					<div class="form-group">
						<label for="email" class="col-sm-2 control-label">Email</label>
					  <div class="col-sm-8">
						<input name="email_pengacara" id="email" class="form-control" value="<?= $data['email_pengacara']?>">
					  </div>
					</div>
					<div class="form-group">
						<label for="des" class="col-sm-2 control-label">Username</label>
					  <div class="col-sm-8">
						<input name="username" id="des" class="form-control " value="<?= $data1['username']?>">
					  </div>
					</div>
					
					<div class="form-group">
						<label for="des" class="col-sm-2 control-label">Password</label>
					  <div class="col-sm-8">
						<input type='password' name="password" id="des" class="form-control " value="<?= $data1['password']?>">
					  </div>
					</div>

					
                <div class="form-group">
                  <div class="col-sm-4 col-md-offset-2">
                    <button type="submit" name="save" class="btn btn-primary btn-flat">Simpan</button>
					<a href="?module=client" class="btn btn-primary btn-flat">Kembali</a>
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
    case "hapuspengacara" :

    if(isset($_GET['id_pengacara'])){
      $lihat = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM tbl_pengacara where id_pengacara='$_GET[id_pengacara]'"));

      $del = mysqli_query($con, "DELETE FROM tbl_pengacara where id_pengacara='$_GET[id_pengacara]'");
      if($del){
    	  echo "<script>
                 alert('Data Berhasil Dihapus');
    					   window.location='index.php?module=pengacara';
    				  </script>";
      }else{
        echo "<script>
                alert('Data Gagal Dihapus');
                window.location='index.php?module=pengacara';
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
      Pengacara
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Pengacara</li>
      </ol>
</section>
<section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-info">
            <div class="box-header with-border">
              <a href="?module=pengacara&aksi=tambahpengacara" class="btn btn-flat btn-primary">Tambah Pengacara</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
					<th>No</th>
					<th>Nama</th>
					<th>Alamat</th>
					<th>No Handphone</th>
					<th>Email</th>
					<th>Aksi</th>
                </tr>
                </thead>
                <tbody>
				<?php
					$be = mysqli_query($con, "SELECT * FROM tbl_pengacara");
					$no=1;
					while($r=mysqli_fetch_assoc($be)){
				?>

				<tr>
					<td><?= $no; ?></td>
					<td><?= $r["nama_pengacara"];?></td>
					<td><?= $r["alamat_pengacara"];?></td>
					<td><?= $r["nohp_pengacara"];?></td>
					<td><?= $r["email_pengacara"];?></td>
					<td><a href="?module=pengacara&aksi=editpengacara&id_pengacara=<?= $r['id_pengacara'];?>" class="btn btn-info">Edit</a>
						<a href="?module=pengacara&aksi=hapuspengacara&id_pengacara=<?= $r['id_pengacara'];?>" class="btn btn-info">Hapus</a>
					</td>
				</tr>
					<?php $no++; } ?>
				</tfoot>
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
