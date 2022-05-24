<div class="content-wrapper">
<?php
  if (isset($_GET['aksi'])){
    $aksi = $_GET['aksi'];

  switch ($aksi){
    case "editlogo" :

    if(isset($_GET['id'])){
      $sql = mysqli_query($con, "SELECT * FROM logo l LEFT JOIN slider s ON l.id_slider=s.id_slider WHERE id_logo='$_GET[id]'");
      $data=mysqli_fetch_assoc($sql);
    }
    if(isset($_POST['save'])){
    $nmberkas  = $_FILES['foto']["name"];
    $lokberkas = $_FILES["foto"]["tmp_name"];
    $nmfoto= date("YmdHis").$nmberkas;
    $valid    = array('jpg','png','gif','jpeg');

    if(empty($lokberkas)){
      $save=mysqli_query($con, "UPDATE logo set id_slider='$_POST[id_slider]', judul_button='$_POST[judul]', text='$_POST[text]', link_button='$_POST[link]' WHERE id_logo='$_GET[id]'");
        if($save) {
          echo "<script>
              alert('Edit Data Berhasil');
              window.location='?module=logo';
                </script>";
          }else{
            echo "<script>alert('Gagal');
                </script>";
         }
    }else if(!empty($lokberkas)){
      list($txt, $ext) = explode(".",$nmfoto);
      if(in_array($ext,$valid)){
      move_uploaded_file($lokberkas, "../../img/$nmfoto");
      $lihat = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM logo where id_logo='$_GET[id]'"));

      unlink("../../img/".$lihat['img_logo']);

    $save=mysqli_query($con, "UPDATE logo set id_slider='$_POST[id_slider]', judul_button='$_POST[judul]', img_logo='$nmfoto', text='$_POST[text]', link_button='$_POST[link]' WHERE id_logo='$_GET[id]'");
      if($save) {
        echo "<script>
            alert('Edit Data Berhasil');
            window.location='?module=logo';
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
        Logo
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit Logo</li>
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
      						<input type="text" name="judul" id="judul" class="form-control" value="<?= $data['judul_button'] ?>">
      					  </div>
      					</div>
      			
      			<div class="form-group" >
                  <label for="slider" class="col-sm-2 control-label">ID Slider</label>
                  <div class="col-sm-4">
                    <select class="form-control" name="id_slider">
                        <?php 
                            $sqlslider = mysqli_query($con, "SELECT * FROM slider");
                            while($dslider = mysqli_fetch_assoc($sqlslider)){
                                if($dslider['id_slider']==$data['id_slider']){
                                    $sel = "selected";
                                }else{
                                    $sel = "";
                                }
                        ?>
                        <option <?php echo $sel ?> value="<?php echo $dslider['id_slider'] ?>"><?php echo $dslider['id_slider'] ?></option>
                        <?php } ?>
                    </select>
                  </div>
                </div>

                <div class="form-group">
      						<label for="text" class="col-sm-2 control-label">Text</label>
      					  <div class="col-sm-6">
      						<input type="text" name="text" id="text" class="form-control" value="<?= $data['text'] ?>">
      					  </div>
      					</div>

				        <div class="form-group" >
                  <label for="foto" class="col-sm-2 control-label">Foto</label>
                  <div class="col-sm-4">
                    <input type="file" name="foto" id="foto" class="form-control">
          					<input type="hidden" name="fotolama" class="form-control"  value="<?= $data['img_logo']; ?>">
                  </div>
                </div>

				        <div class="form-group" >
                  <label for="gam" class="col-sm-2 control-label">&nbsp;</label>

				  <div class="col-sm-8">
                    <img src="../../img/<?= $data['img_logo']; ?>" style="width:250px;">
                    <a href="?module=logo&aksi=hapusgambar&id=<?= $_GET['id'];?>" class="btn btn-success" style="margin-left: 50px;">Hapus Foto</a>
                  </div>
                </div>
                
                <div class="form-group">
      						<label for="link" class="col-sm-2 control-label">Link</label>
      					  <div class="col-sm-4">
      						<input type="text" name="link" id="link" class="form-control" value="<?= $data['link_button'] ?>">
      					  </div>
      					</div>

                <div class="form-group">
                  <div class="col-sm-4 col-md-offset-2">
                    <button type="submit" name="save" class="btn btn-primary btn-flat">Simpan</button>
                    <a href="index.php?module=logo" class="btn btn-warning">Kembali</a>
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
    case "hapusgambar" :

    if(isset($_GET['id'])){
      $del = mysqli_query($con, "UPDATE logo SET img_logo='' WHERE id_logo='$_GET[id]'");
      
    	  echo "<META HTTP-EQUIV='Refresh' Content='1; URL=?module=logo&aksi=editlogo&id=$_GET[id]'>";
    }
}
}else{
?>

<section class="content-header">
      <h1>
        Logo
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Logo</li>
      </ol>
</section>
<section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-info">

            <!-- /.box-header -->
            <div class="box-body">
              <div class="table table-responsive">
              <table  class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Slider</th>
                    <th>Logo</th>
                    <th>Button</th>
                    <th>Text</th>
                    <th>Link</th>
                    <th>Id Slider</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
        			<?php
        				$be = mysqli_query($con, "SELECT * FROM logo l LEFT JOIN slider s ON l.id_slider=s.id_slider");
        				$no=1;
        				while($r=mysqli_fetch_assoc($be)){
        			?>
      				<tr>
      					<td><?= $no; ?></td>
      					<td><img src="../../img/homeslider/<?= $r['gambar'] ?>" width=150></td>
      					<td><img src="../../img/<?= $r['img_logo'] ?>" width=150></td>
      					<td><?= $r['judul_button'] ?></td>
                        <td><?= $r['text'] ?></td>
                        <td><?= $r['link_button'] ?></td>
                        <td><?php echo $r['id_slider'] ?></td>
      					<td><a href="?module=logo&aksi=editlogo&id=<?= $r['id_logo'];?>" class="btn btn-success btn-flat">Edit</a>
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
