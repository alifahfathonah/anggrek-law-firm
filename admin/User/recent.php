<div class="content-wrapper">

<?php
  if (isset($_GET['aksi'])){
    $aksi = $_GET['aksi'];
    $language = ($_POST['language']);

  switch ($aksi){
    case "tambahrecent" :

    if(isset($_POST['save'])){

	$save=mysqli_query($con, "INSERT INTO tbl_recent VALUES ('','$_POST[desk]', '$_POST[language]' )");

	 if($save) {
        echo "<script>
            alert('Tambah Data Berhasil');
            window.location='?module=recent';
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
        Recent Success Story
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Tambah Recent Succes Story</li>
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
						<label for="des" class="col-sm-2 control-label">Deskripsi</label>
					  <div class="col-sm-8">
						<textarea type="text" name="desk" id="editor" class="form-control" rows="15" cols="80"></textarea>
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
    case "editrecent":
    if(isset($_GET['id'])){
      $sql = mysqli_query($con, "SELECT * FROM tbl_recent where id_rec='$_GET[id]'");
      $data=mysqli_fetch_assoc($sql);
    }
    if(isset($_POST['save'])){
      $save=mysqli_query($con, "UPDATE tbl_recent set deskripsi_rec='$_POST[desk]' where id_rec='$_GET[id]'");
      if($save) {
        echo "<script>
            alert('Edit Data Berhasil');
            window.location='?module=recent';
              </script>";
        }else{
          echo "<script>alert('Gagal');
              </script>";
       }
    }
?>
<section class="content-header">
      <h1>
        Recent Success Story
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Recent Success Story</li>
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
                  <label for="desk" class="col-sm-2 control-label">Deskripsi</label>
                  <div class="col-sm-10">
                    <textarea type="text" name="desk" id="editor" class="form-control" rows="15" cols="80"><?= $data['deskripsi_rec']; ?></textarea>
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
    case "hapusrecent" :

    if(isset($_GET['id'])){
   
      $del = mysqli_query($con, "DELETE FROM tbl_recent where id_rec='$_GET[id]'");
      if($del){
    	  echo "<script>
                 alert('Data Berhasil Dihapus');
    					   window.location='index.php?module=recent';
    				  </script>";
      }else{
        echo "<script>
                alert('Data Gagal Dihapus');
                window.location='index.php?module=recent';
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
        Recent Success Story
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Recent Success Story</li>
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
              <a href="?module=recent&aksi=tambahrecent" class="btn btn-flat btn-primary">Tambah Recent Success Story</a>
            </div>
            <div class="box-body">
              <div class="table table-responsive">
              <table  class="table table-bordered table-striped" id="example1">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  
                     if(isset($_POST['lang'])){
                         $be = mysqli_query($con, "SELECT * FROM tbl_recent where language = '$_POST[lang]'");
                         $no=1;
                    }else{
                         $be = mysqli_query($con, "SELECT * FROM tbl_recent where language = 'en'");
                         $no=1;
                    }
                  
                 
                  while($r=mysqli_fetch_assoc($be)){
                    ?>
                    <tr>
                      <td><?= $no; ?></td>
                      <td><?= $r["deskripsi_rec"];?></td>
                      <td><a href="?module=recent&aksi=editrecent&id=<?= $r['id_rec'];?>" class="btn btn-success btn-flat">Edit</a>
                        <a href="?module=recent&aksi=hapusrecent&id=<?= $r['id_rec'];?>" class="btn btn-danger btn-flat" onclick="return confirm('Yakin Akan Menghapus Data Ini ... ?')">Hapus</a>
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
