<div class="content-wrapper">
        <!-- Content Header (Page header) -->


<?php
  if (isset($_GET['aksi'])){
    $aksi = $_GET['aksi'];

  switch ($aksi){
    case "tambahlump" :

    if(isset($_POST['save'])){
      $tgl=date('Y-m-d');

    $data=mysqli_query($con,"SELECT * FROM kegiatan WHERE nama='$_SESSION[id_client]' and tanggal_kegiatan='$tgl'");

    if(mysqli_num_rows($data) > 0){
  $save=mysqli_query($con, "INSERT INTO tbl_lump 
    VALUES('','$_POST[tanggal]', '$_POST[nama]','$_POST[no_kasus]','$_POST[keterangan]','$_SESSION[id_client]')");

   if($save) {
        echo "<script>
            alert('Tambah Data Berhasil');
            window.location='?module=lump';
            </script>";
            exit;
      }else{
        echo "<script>alert('Gagal');
            </script>";
      }
    }else{
      echo "<script>
            alert('Data Kegiatan belum diisi !!');
            window.location='?module=lump';
            </script>";
            exit;
    }
    }
?>
<section class="content-header">
      <h1>
         Agenda Lump Sum
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Tambah Agenda Lump Sum</li>
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
            <label for="des" class="col-sm-2 control-label">Tanggal</label>
            <div class="col-sm-8">
            <input type="date" name="tanggal" id="nohp" class="form-control ">
            </div>
          </div>
          
          <div class="form-group">
            <label for="nohp" class="col-sm-2 control-label">Nama Client</label>
            <div class="col-sm-8">
            <select name="nama" class="form-control" id="nmc">
              <option value=""></option>
              <?php $sql=mysqli_query($con,"SELECT * from tbl_client");
                    while($t=mysqli_fetch_array($sql)){
                      echo "<option value='$t[id_client]'>$t[nama_client]</option>";
                    }
              ?>
            </select>
            </div>
          </div>

            <div class="form-group">
            <label for="nohp" class="col-sm-2 control-label">Judul Kasus</label>
            <div class="col-sm-8">
            <select name="no_kasus" id="nok" class="form-control ">
              <option value=""></option>
            </select>
            </div>
          </div>

          <div class="form-group">
            <label for="des" class="col-sm-2 control-label">Keterangan</label>
            <div class="col-sm-8">
            <textarea type="text" name="keterangan" id="des" class="form-control textarea" rows="8" cols="80"></textarea>
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
    case "editlump":
    if(isset($_GET['id'])){
      $sql = mysqli_query($con, "SELECT * FROM tbl_lump where idlump='$_GET[id]'");
      $data=mysqli_fetch_assoc($sql);
    }
    if(isset($_POST['save'])){
    
      $save=mysqli_query($con, "UPDATE tbl_lump set tanggal='$_POST[tanggal]', nama_client='$_POST[nama]', no_kasus='$_POST[no_kasus]', keterangan='$_POST[keterangan]' where idlump='$_GET[id]'");
      if($save) {
        echo "<script>
            alert('Edit Data Berhasil');
            window.location='?module=lump';
              </script>";
        }else{
          echo "<script>alert('Gagal');
              </script>";
       }
    }
?>
<section class="content-header">
      <h1>
        Agenda Lump Sum
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit Agenda Lump Sum</li>
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
            <label for="des" class="col-sm-2 control-label">Tanggal</label>
            <div class="col-sm-8">
            <input type="date" name="tanggal" id="nohp" class="form-control" value="<?= $data[tanggal] ?>">
            </div>
          </div>
          
          <div class="form-group">
            <label for="nohp" class="col-sm-2 control-label">Nama Client</label>
            <div class="col-sm-8">
            <select name="nama" class="form-control" id="nmc">
              <option value=""></option>
              <?php $sql=mysqli_query($con,"SELECT * from tbl_client");
                    while($t=mysqli_fetch_array($sql)){
                      if($data['nama_client']==$t['id_client']){
                        $sel="selected";
                      }else{
                        $sel="";
                      }
                      echo "<option value='$t[id_client]'' $sel>$t[nama_client]</option>";
                    }
              ?>
            </select>
            </div>
          </div>

            <div class="form-group">
            <label for="nohp" class="col-sm-2 control-label">Judul Kasus</label>
            <div class="col-sm-8">
            <select name="no_kasus" id="nok" class="form-control ">
              <option value=""></option>
              <?php $sql=mysqli_query($con,"SELECT * from tbl_kasus");
                    while($t=mysqli_fetch_array($sql)){
                      if($data['no_kasus']==$t['id_kasus']){
                        $sel="selected";
                      }else{
                        $sel="";
                      }
                      echo "<option value='$t[id_kasus]'' $sel>$t[judul_kasus]</option>";
                    }
              ?>
            </select>
            </div>
          </div>

          <div class="form-group">
            <label for="des" class="col-sm-2 control-label">Keterangan</label>
            <div class="col-sm-8">
            <textarea type="text" name="keterangan" id="des" class="form-control textarea" rows="8" cols="80"><?= $data[keterangan] ?></textarea>
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
    case "hapuslump" :

    if(isset($_GET['id'])){
      $lihat = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM tbl_lump where idlump='$_GET[id]'"));

      $del = mysqli_query($con, "DELETE FROM tbl_lump where idlump='$_GET[id]'");
      if($del){
        echo "<script>
                 alert('Data Berhasil Dihapus');
                 window.location='index.php?module=lump';
              </script>";
      }else{
        echo "<script>
                alert('Data Gagal Dihapus');
                window.location='index.php?module=lump';
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
       Agenda Lump Sum
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"> Agenda Lump Sum</li>
      </ol>
</section>
<section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-info">
            <div class="box-header with-border">
                <?php
                 if($_SESSION['level']=="superadmin"){
                 }else{
                 ?>
              <a href="?module=lump&aksi=tambahlump" class="btn btn-flat btn-primary">Tambah  Agenda Lump Sum </a>
              <?php
                 }
              ?>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
          <th>No</th>
          <th>Tanggal</th>
          <th>Nama Client</th>
          <th>No Kasus</th>
          <th>Keterangan</th>
           <th>Pengacara</th>
          <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
        <?php
        if($_SESSION['level']=="superadmin"){
          $be = mysqli_query($con, "SELECT * FROM tbl_lump p LEFT JOIN tbl_kasus k ON p.no_kasus=k.id_kasus LEFT JOIN tbl_client c On c.id_client=p.nama_client LEFT JOIN tbl_pengacara pe ON pe.id_pengacara=p.idpengacara");
        }elseif($_SESSION['level']=="pengacara"){
          $be = mysqli_query($con, "SELECT * FROM tbl_lump p LEFT JOIN tbl_kasus k ON p.no_kasus=k.id_kasus LEFT JOIN tbl_client c On c.id_client=p.nama_client LEFT JOIN tbl_pengacara pe ON pe.id_pengacara=p.idpengacara WHERE p.idpengacara='$_SESSION[id_client]'");
        }
          $no=1;
          while($r=mysqli_fetch_assoc($be)){
        ?>

        <tr>
          <td><?= $no; ?></td>
          <td><?=  tgl_indo($r["tanggal"]);?></td>
          <td><?= $r["nama_client"];?></td>
          <td><?= $r["no_kasus"];?></td>
          <td><?= $r["keterangan"];?></td>
          
      <td><?php echo $r['nama_pengacara']; ?></td>
          
          <td><a href="?module=lump&aksi=editlump&id=<?= $r['idlump'];?>" class="btn btn-info">Edit</a>
        
            <a onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data Ini ?');" href="?module=lump&aksi=hapuslump&id=<?= $r['idlump'];?>" class="btn btn-info">Hapus</a>
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
