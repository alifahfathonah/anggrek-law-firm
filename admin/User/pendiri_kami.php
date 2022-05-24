<div class="content-wrapper">
<?php
  $pendiri = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM pendiri_kami"));

  if(isset($_POST['save'])){
  $nmberkas  = $_FILES['foto']["name"];
  $lokberkas = $_FILES["foto"]["tmp_name"];
  $nmfoto= date("YmdHis").$nmberkas;
  $valid    = array('jpg','png','gif','jpeg');

  if(empty($lokberkas)){
    mysqli_query($con, "UPDATE pendiri_kami set nama_pendiri='$_POST[nama]', deskripsi_pendiri='$_POST[deskripsi]'");
    echo "<META HTTP-EQUIV='Refresh' Content='0; URL=?module=pendiri_kami'>";
  }else if (!empty($lokberkas)){
    list($txt, $ext) = explode(".",$nmfoto);
      if(in_array($ext,$valid)){
        move_uploaded_file($lokberkas, "../../img/team/$nmfoto");
        $lihat = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM pendiri_kami"));
        unlink("../../img/team/".$lihat['foto_pendiri']);

        mysqli_query($con, "UPDATE pendiri_kami set nama_pendiri='$_POST[nama]', deskripsi_pendiri='$_POST[deskripsi]', foto_pendiri='$nmfoto'");
        echo "<META HTTP-EQUIV='Refresh' Content='0; URL=?module=pendiri_kami'>";

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
        Our Founder
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Our Founder</li>
      </ol>
</section>
<section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-info">
            <div class="box-header with-border">
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form method="POST" class="form-horizontal" action="" enctype="multipart/form-data">
                <div class="box-body">
                  <div class="col-sm-12">
                    <div class="form-group" >
                      <label for="nama" class="col-sm-2 control-label">Nama Lengkap</label>
                      <div class="col-sm-4">
                        <input type="text" name="nama" id="nama" class="form-control" value="<?= $pendiri['nama_pendiri'] ?>">
                      </div>
                    </div>

                      <div class="form-group" >
                        <label for="gam" class="col-sm-2 control-label">Gambar</label>
                        <div class="col-sm-4">
                          <input type="file" name="foto" id="gam" class="form-control">
      					          <input type="hidden" name="gambarlama" id="jdl" class="form-control"  value="<?= $pendiri['foto_pendiri']; ?>">
                        </div>
                      </div>

      				       <div class="form-group" >
                        <label for="gam" class="col-sm-2 control-label">&nbsp;</label>
      				          <div class="col-sm-4">
                          <img src="../../img/team/<?= $pendiri['foto_pendiri']; ?>" style="width:250px;">
                        </div>
                      </div>

                    <div class="form-group">
                      <div class="col-sm-12">
                        <textarea type="text" name="deskripsi" id="editor" class="form-control"><?= $pendiri['deskripsi_pendiri'] ?></textarea>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-sm-4">
                        <button type="submit" name="save" class="btn btn-primary btn-flat">Simpan</button>
                      </div>
                    </div>
                  </div>
                </form>
            </div>
            <!-- /.box-body -->
          </div>
          </div>
          </div>
          <!-- /.box -->
     </section>
      </div>
