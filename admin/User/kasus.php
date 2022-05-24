<div class="content-wrapper">
<?php
  if (isset($_GET['aksi'])){
    $aksi = $_GET['aksi'];

  switch ($aksi){
    case "tambahkasus" :

    if(isset($_POST['save'])){
    $status = 'unrunning';
    $tglexp = date('Y-m-d', strtotime("+1 month", strtotime($_POST['tgl_kasus'])));

    $save=mysqli_query($con, "INSERT INTO tbl_kasus VALUES('', '$_POST[nokasus]','$_POST[id_client]','$_POST[id_jeniskasus]','$_POST[judul_kasus]','$_POST[tgl_kasus]', '$tglexp', '$status')");
    
    $id = mysqli_insert_id($con);
    
    if($_POST['id_jeniskasus'] == 7){
        $simpan = mysqli_query($con, "INSERT INTO tbl_bayar VALUES ('', '$id', '$_POST[tgl_kasus]')");
    }

	 if($save) {
        echo "<script>
            alert('Tambah Data Berhasil');
            window.location='?module=kasus';
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
        Kasus
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Tambah Kasus</li>
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
            <label for="des" class="col-sm-2 control-label">No Kontrak</label>
            <div class="col-sm-8">
            <input name="nokasus" id="des" class="form-control">
            </div>
          </div>
					<div class="form-group">
						<label for="kdp" class="col-sm-2 control-label">Nama Client</label>
					  <div class="col-sm-4">
						<select type="text" name="id_client" id="kdp" class="form-control select2">
						<option value="">--Pilih Client--</option>
							<?php 
							$sql = mysqli_query($con, "SELECT * FROM tbl_client");
							while($cln=mysqli_fetch_assoc($sql)){
								echo "<option value='$cln[id_client]'> $cln[nama_client] </option>";
							}
							?>
						</select>
					  </div>
					</div>

					<div class="form-group">
						<label for="des" class="col-sm-2 control-label">Judul Kasus</label>
					  <div class="col-sm-8">
						<input name="judul_kasus" id="des" class="form-control">
					  </div>
					</div>
					
					<div class="form-group">
						<label for="nohp" class="col-sm-2 control-label">Jenis Kasus</label>
					  <div class="col-sm-8">
							<?php 
							$jnsk = mysqli_query($con, "SELECT * FROM tbl_jnskasus");
							while($jns=mysqli_fetch_assoc($jnsk)){
							?>
							<input type="radio" name="id_jeniskasus" value="<?= $jns['id_jeniskasus']?>" >&nbsp;<?= $jns["jenis_kasus"]?>&nbsp;&nbsp;
							<?php } ?>
					  </div>
					</div>

					<div class="form-group">
						<label for="des" class="col-sm-2 control-label">Tanggal Kasus</label>
					  <div class="col-sm-8">
						<input name="tgl_kasus" type='date' id="des" class="form-control col-sm-5">
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
    case "editkasus":
    if(isset($_GET['id_kasus'])){
      $sql = mysqli_query($con, "SELECT * FROM tbl_kasus where id_kasus='$_GET[id_kasus]'");
      $data=mysqli_fetch_assoc($sql);
    }
    if(isset($_POST['save'])){

      $save=mysqli_query($con, "UPDATE tbl_kasus set id_client='$_POST[id_client]', judul_kasus='$_POST[judul_kasus]', id_jeniskasus='$_POST[id_jeniskasus]' where id_kasus='$_GET[id_kasus]'");
      if($save) {
        echo "<script>
            alert('Edit Data Berhasil');
            window.location='?module=kasus';
              </script>";
        }else{
          echo "<script>alert('Gagal');
              </script>";
       }
    }
?>
<section class="content-header">
      <h1>
       Kasus
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit Kasus</li>
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
						<label for="kdp" class="col-sm-2 control-label">Nama Client</label>
					  <div class="col-sm-4">
						<select type="text" name="id_client" id="kdp" class="form-control">
						<option value="">--Pilih Client--</option>
							<?php 
							$sql = mysqli_query($con, "SELECT * FROM tbl_client");
							while($cln=mysqli_fetch_assoc($sql)){
								if($cln['id_client']== $data['id_client']){
									$cek = "selected";
									echo "<option value='$cln[id_client]' $cek> $cln[nama_client] </option>";
								}else {
								echo "<option value='$cln[id_client]'> $cln[nama_client] </option>";
								}
							}
							?>
						</select>
					  </div>
					</div>

					<div class="form-group">
						<label for="des" class="col-sm-2 control-label">Judul Kasus</label>
					  <div class="col-sm-8">
						<input name="judul_kasus" id="des" class="form-control" value="<?= $data['judul_kasus']?>">
					  </div>
					</div>
					
					<div class="form-group">
						<label for="nohp" class="col-sm-2 control-label">Jenis Kasus</label>
					  <div class="col-sm-8">
							<?php 
							$jnsk = mysqli_query($con, "SELECT * FROM tbl_jnskasus");
							while($jns=mysqli_fetch_assoc($jnsk)){
								if($jns['id_jeniskasus']== $data['id_jeniskasus']){
									$cek= "checked";
								}else{
									$cek= "";
								}
									?>
									<input type="radio" name="id_jeniskasus" value="<?= $jns['id_jeniskasus']?>" <?php echo $cek?>>&nbsp;<?= $jns["jenis_kasus"]?>&nbsp;&nbsp;
								
							<?php } ?>
					  </div>
					</div>

					
                <div class="form-group">
                  <div class="col-sm-4 col-md-offset-2">
                    <button type="submit" name="save" class="btn btn-primary btn-flat">Simpan</button>
					<a href="?module=kasus" class="btn btn-primary btn-flat">Kembali</a>
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
    case "editperkembangankasus":
    if(isset($_GET['id_kasus'])){
      $sql = mysqli_query($con, "SELECT * FROM tbl_detailkasus d LEFT JOIN tbl_kasus k ON d.id_kasus=k.id_kasus LEFT JOIN tbl_jnskasus j ON k.id_jeniskasus=j.id_jeniskasus LEFT JOIN tbl_client c ON k.id_client=c.id_client where d.id_perkembangan='$_GET[id_kasus]'");
	  
      $data=mysqli_fetch_assoc($sql);
    }
    if(isset($_POST['save'])){

      $save=mysqli_query($con, "UPDATE tbl_detailkasus set agenda='$_POST[agenda]', tindak_lanjut='$_POST[tindak_lanjut]', keterangan='$_POST[keterangan]', kesimpulan='$_POST[kesimpulan]', tgl_perkembangan='$_POST[tgl]' where id_perkembangan='$_GET[id_kasus]'");
      if($save) {
        echo "<script>
            alert('Edit Data Berhasil');
            window.location='?module=kasus';
              </script>";
        }else{
          echo "<script>alert('Gagal');
              </script>";
       }
    }
?>
<section class="content-header">
      <h1>
       Kasus
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit Perkembangan Kasus</li>
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
						<label for="des" class="col-sm-2 control-label">Agenda</label>
					  <div class="col-sm-8">
						<input name="agenda" id="des" class="form-control" value="<?= $data['agenda']?>" >
						<input name="id_kasus" id="des" type="hidden" class="form-control" value="<?= $_GET['id_perkembangan']?>">
					  </div>
					</div>
				
				<div class="form-group">
						<label for="des" class="col-sm-2 control-label">Tindak Lanjut</label>
					  <div class="col-sm-8">
						<input name="tindak_lanjut" id="des" class="form-control" value="<?= $data['tindak_lanjut']?>" >
					  </div>
				</div>
				
				<div class="form-group">
						<label for="des" class="col-sm-2 control-label">Tanggal Perkembangan Kasus</label>
					  <div class="col-sm-8">
						<input name="tgl" type='date' id="des" class="form-control col-md-5" value="<?= $data['tgl_perkembangan']?>">
					  </div>
					</div>
				
				<div class="form-group">
						<label for="des" class="col-sm-2 control-label">Keterangan</label>
					  <div class="col-sm-8">
						<textarea name="keterangan" id="des" class="form-control textarea" ><?= $data['keterangan']?></textarea>
					  </div>
				</div>
				
				<div class="form-group">
						<label for="des" class="col-sm-2 control-label">Kesimpulan/Hasil</label>
					  <div class="col-sm-8">
						<textarea name="kesimpulan" id="des" class="form-control textarea" ><?= $data['kesimpulan']?></textarea>
					  </div>
				</div>
					
                <div class="form-group">
                  <div class="col-sm-4 col-md-offset-2">
                    <button type="submit" name="save" class="btn btn-primary btn-flat">Simpan</button>
					<a href="?module=kasus" class="btn btn-primary btn-flat">Kembali</a>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
    </div>
</section>
<!-- info kasus -->
<?php
    break;
    case "detailperkembangankasus":
    if(isset($_GET['id_kasus'])){
      $sql = mysqli_query($con, "SELECT * FROM tbl_detailkasus d LEFT JOIN tbl_kasus k ON d.id_kasus=k.id_kasus LEFT JOIN tbl_jnskasus j ON k.id_jeniskasus=j.id_jeniskasus LEFT JOIN tbl_client c ON k.id_client=c.id_client where d.id_perkembangan='$_GET[id_kasus]'");
	  
      $data=mysqli_fetch_assoc($sql);
    }
   
   
?>
<section class="content-header">
      <h1>
       Kasus
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Detail Perkembangan Kasus</li>
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
						<label for="des" class="col-sm-2 control-label">Agenda</label>
					  <div class="col-sm-8">
						<?= $data['agenda']?>
						
					  </div>
					</div>
				
				<div class="form-group">
						<label for="des" class="col-sm-2 control-label">Tindak Lanjut</label>
					  <div class="col-sm-8">
						<?= $data['tindak_lanjut']?>
					  </div>
				</div>
				
				<div class="form-group">
						<label for="des" class="col-sm-2 control-label">Tanggal Perkembangan Kasus</label>
					  <div class="col-sm-8">
						<?= $data['tgl_perkembangan']?>
					  </div>
					</div>
				
				<div class="form-group">
						<label for="des" class="col-sm-2 control-label">Keterangan</label>
					  <div class="col-sm-8">
						<?= $data['keterangan']?>
					  </div>
				</div>
				
				<div class="form-group">
						<label for="des" class="col-sm-2 control-label">Kesimpulan/Hasil</label>
					  <div class="col-sm-8">
						<?= $data['kesimpulan']?>
					  </div>
				</div>
					
                <div class="form-group">
                  <div class="col-sm-4 col-md-offset-2">
					<a href="?module=kasus" class="btn btn-primary btn-flat">Kembali</a>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
    </div>
</section>
<!-- info kasus -->



<?php
    break;
    case "detailkasus":
    
?>

<section class="content-header">
      <h1>
      Kasus
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Kasus</li>
      </ol>
</section>
<section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-info">
            <div class="box-header with-border">
              <a href="?module=kasus" class="btn btn-flat btn-primary">Kembali</a>
			 <?php if($_SESSION['level']=='superadmin' OR $_SESSION['level']=='pengacara'){
						?> <a href="?module=kasus&aksi=infokasus&id_kasus=<?= $_GET['id_kasus']?>&id_client=<?= $_GET['id_client']?>" class="btn btn-flat btn-primary" style="border-radius:2px;">Update Perkembangan</a>
						<?php } ?>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table table-responsive">
              	<?php 
              		if($_SESSION['level']=='client'){
						$where = "d.id_kasus='$_GET[id_kasus]'";
					 }else if($_SESSION['level']=='superadmin'){
						$where = "d.id_kasus='$_GET[id_kasus]'";
					 }else if($_SESSION['level']=='pengacara'){
						$where ="d.id_kasus='$_GET[id_kasus]'";
					 }
              		$data=mysqli_fetch_array(mysqli_query($con,"SELECT * FROM tbl_kasus d LEFT JOIN tbl_jnskasus j ON d.id_jeniskasus=j.id_jeniskasus LEFT JOIN tbl_client c ON c.id_client=d.id_client WHERE $where"));
              	?>
              	<table  class="table table-bordered table-stripe" >
              		<tr>
              			<th>Nama Client</th>
              			<td><?= $data['nama_client'] ?></td>
              		</tr>
              		<tr>
              			<th>Judul Kasus</th>
              			<td><?= $data['judul_kasus']?></td>
              		</tr>
              		<tr>
              			<th>Jenis Kasus</th>
              			<td><?= $data['jenis_kasus'] ?></td>
              		</tr>
              	</table>
              <table  id="example1"  class="table table-bordered table-striped">
                <thead>
                <tr>
					<th>No</th>
					<th>Agenda</th>
					<th>Tindak Lanjut</th>
					<th>Keterangan</th>
					<th>Kesimpulan/Hasil</th>
					<th>Tanggal Perkembangan</th>
					
					<th>Penanggung Jawab</th>
					<th>Aksi</th>
                </tr>
                </thead>
                <tbody>
				<?php
				
					 if($_SESSION['level']=='client'){
						$where = "d.id_kasus='$_GET[id_kasus]'";
					 }else if($_SESSION['level']=='superadmin'){
						$where = "d.id_kasus='$_GET[id_kasus]'";
					 }else if($_SESSION['level']=='pengacara'){
						$where = "d.id_kasus='$_GET[id_kasus]'";
					 }
					$be = mysqli_query($con, "SELECT * FROM tbl_detailkasus d LEFT JOIN tbl_kasus k ON d.id_kasus=k.id_kasus LEFT JOIN tbl_jnskasus j ON k.id_jeniskasus=j.id_jeniskasus LEFT JOIN tbl_client c ON k.id_client=c.id_client WHERE $where");
					
					$no=1;
					while($r=mysqli_fetch_assoc($be)){
				?>

				<tr>
					<td><?= $no; ?></td>
					<td><?= $r["agenda"];?></td>
					<td><?= $r["tindak_lanjut"];?></td>
					<td><?= $r["keterangan"];?></td>
					<td><?= $r["kesimpulan"];?></td>
					<td><?= tgl_indo($r["tgl_perkembangan"]);?></td>
					<td><?= $r["user"];?></td>
					<td>
					<?php if($_SESSION['level']!="client"){ ?>
					<a href="?module=kasus&aksi=editperkembangankasus&id_kasus=<?= $r['id_perkembangan'];?>" class="btn btn-info">Edit</a>
					
					
						<a href="?module=kasus&aksi=hapusperkembangankasus&id_kasus=<?= $r['id_perkembangan'];?>" class="btn btn-warning">Hapus</a> 
<?php }else {?>
<a href="?module=kasus&aksi=detailperkembangankasus&id_kasus=<?= $r['id_perkembangan'];?>" class="btn btn-info">Detail</a></td>
<?php } ?>
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

<?php
    break;
    case "infokasus":
    if(isset($_GET['id_kasus'])){
      $sql = mysqli_query($con, "SELECT * FROM tbl_kasus where id_kasus='$_GET[id_kasus]'");
      $data=mysqli_fetch_assoc($sql);
    }
    if(isset($_POST['save'])){

      $save=mysqli_query($con, "INSERT INTO tbl_detailkasus values('','$_POST[id_kasus]','$_POST[agenda]','$_POST[tindak_lanjut]','$_POST[keterangan]','$_POST[kesimpulan]','$_POST[tgl_kasus]','$_SESSION[username]')");
      if($save) {
        echo "<script>
            alert('Sukses');
            window.location='index.php?module=kasus&aksi=detailkasus&id_kasus=$_GET[id_kasus]&id_client=$_GET[id_client]';
              </script>";
        }else{
          echo "<script>alert('Gagal');
              </script>";
       }
    }
?>
<section class="content-header">
      <h1>
       Info Kasus
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Info Kasus</li>
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
						<label for="des" class="col-sm-2 control-label">Agenda</label>
					  <div class="col-sm-8">
						<input name="agenda" id="des" class="form-control" >
						<input name="id_kasus" id="des" type="hidden" class="form-control" value="<?= $_GET['id_kasus']?>">
					  </div>
					</div>
				
				<div class="form-group">
						<label for="des" class="col-sm-2 control-label">Tindak Lanjut</label>
					  <div class="col-sm-8">
						<input name="tindak_lanjut" id="des" class="form-control" >
					  </div>
				</div>
				
				<div class="form-group">
						<label for="des" class="col-sm-2 control-label">Tanggal Perkembangan Kasus</label>
					  <div class="col-sm-8">
						<input name="tgl_kasus" type='date' id="des" class="form-control col-md-5">
					  </div>
					</div>
				
				<div class="form-group">
						<label for="des" class="col-sm-2 control-label">Keterangan</label>
					  <div class="col-sm-8">
						<textarea name="keterangan" id="des" class="form-control textarea" ></textarea>
					  </div>
				</div>
				
				<div class="form-group">
						<label for="des" class="col-sm-2 control-label">Kesimpulan/Hasil</label>
					  <div class="col-sm-8">
						<textarea name="kesimpulan" id="des" class="form-control textarea" ></textarea>
					  </div>
				</div>
				
                <div class="form-group">
                  <div class="col-sm-4 col-md-offset-2">
                    <button type="submit" name="save" class="btn btn-primary btn-flat">Simpan</button>
					<a href="?module=kasus" class="btn btn-primary btn-flat">Kembali</a>
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
    case "hapuskasus" :

    if(isset($_GET['id_kasus'])){
      $lihat = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM tbl_kasus where id_kasus='$_GET[id_kasus]'"));

      $del = mysqli_query($con, "DELETE FROM tbl_kasus where id_kasus='$_GET[id_kasus]'");
      if($del){
    	  echo "<script>
                 alert('Data Berhasil Dihapus');
    					   window.location='index.php?module=kasus';
    				  </script>";
      }else{
        echo "<script>
                alert('Data Gagal Dihapus');
                window.location='index.php?module=kasus';
              </script>";
      }
    }
?>
<?php
    break;
    case "hapusperkembangankasus" :

    if(isset($_GET['id_kasus'])){
      $lihat = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM tbl_detailkasus where id_perkembangan='$_GET[id_kasus]'"));

      $del = mysqli_query($con, "DELETE FROM tbl_detailkasus where id_perkembangan='$_GET[id_kasus]'");
      if($del){
    	  echo "<script>
                 alert('Data Berhasil Dihapus');
    					   window.location='index.php?module=kasus';
    				  </script>";
      }else{
        echo "<script>
                alert('Data Gagal Dihapus');
                window.location='index.php?module=kasus';
              </script>";
      }
    }
?>
<?php
    break;
    case "finished" :
        if(isset($_GET['id_kasus'])){
            $update = mysqli_query($con, "UPDATE tbl_kasus SET status='finished' WHERE id_kasus='$_GET[id_kasus]'");
            
            if($update){
                echo "<script>
                 alert('Kasus Selesai');
    					   window.location='index.php?module=kasus';
    				  </script>";
            }
        }
        
    break;
    case "continue" :
        if(isset($_GET['id_kasus'])){
            $update = mysqli_query($con, "UPDATE tbl_kasus SET status='unrunning' WHERE id_kasus='$_GET[id_kasus]'");
            
            if($update){
                echo "<script>
                 alert('Kasus Dilanjutkan');
    					   window.location='index.php?module=kasus';
    				  </script>";
            }
        }
}
}else{
    
?>

<section class="content-header">
      <h1>
      Kasus
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Kasus</li>
      </ol>
</section>
<section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-info">
            <div class="box-header with-border">
              <?php if($_SESSION['level']!="client"){ ?>
              <a href="?module=kasus&aksi=tambahkasus" class="btn btn-flat btn-primary">Tambah Kasus</a> 
           <?php } ?>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

              <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#running" aria-controls="running" role="tab" data-toggle="tab">Running Case</a></li>
                <li role="presentation"><a href="#finished" aria-controls="finished" role="tab" data-toggle="tab">Finished Case</a></li>
              </ul>

              <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="running">
                    <br>
                    <div class="table table-responsive">
                      <table  id="example1"  class="table table-bordered table-striped">
                        <thead>
                        <tr>
        					<th>No</th>
                            <th>No Kontrak</th>
        					<th>Nama Client</th>
        					<th>Judul Kasus</th>
        					<th>Jenis Kasus</th>
        					<th>Tanggal Kasus</th>
        					<?php
        					    if($_SESSION['level']=='superadmin'){ ?>
        					<th>Pemtar</th>
        					<?php } ?>
        					<th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
        				<?php
        					 if($_SESSION['level']=='client'){
        						$where = "AND tbl_kasus.id_client='$_SESSION[id_client]'";
        					 }else if($_SESSION['level']=='superadmin'){
        						$where = "";
        					 }else if($_SESSION['level']=='pengacara'){
        						$where = "";
        					 }
        					$be = mysqli_query($con, "SELECT * FROM tbl_kasus,tbl_client,tbl_jnskasus where tbl_kasus.status='unrunning' AND tbl_kasus.id_client=tbl_client.id_client AND tbl_kasus.id_jeniskasus=tbl_jnskasus.id_jeniskasus $where order by tgl_kasus DESC");
        					
        					$no=1;
        					while($r=mysqli_fetch_assoc($be)){
        					    
        					    $tglskr = date('Y-m-d');
        					    $bayar = mysqli_num_rows(mysqli_query($con, "SELECT id_kasus, tgl_bayar FROM tbl_bayar WHERE MONTH(tgl_bayar)= MONTH('$tglskrg') AND YEAR(tgl_bayar)= YEAR('$tglskr') AND id_kasus='$r[id_kasus]'"));
        					    
        					    
        					    $last = mysqli_fetch_assoc(mysqli_query($con, "SELECT DISTINCT tgl_perkembangan FROM tbl_detailkasus WHERE id_kasus='$r[id_kasus]' ORDER BY tgl_perkembangan DESC LIMIT 1"));
        				?>
        
        				<tr>
        					<td><?= $no; ?></td>
                            <td>
                                <?= $r["no_kasus"];?><br>
                                <?php
                                    if($r['id_jeniskasus'] == 7){
                                        if($bayar == 0 ){
                                            $tglexp = $r['tgl_exp'];
        	                                $tglnotif = date('Y-m-d', strtotime("-3 day", strtotime($tglexp)));
        	                               
        	                                
        	                                $satutahun = strtotime("+1 year", strtotime($r['tgl_kasus']));
        	                                
        	                                $expired = date('Y-m-d', strtotime("+1 year", strtotime($r['tgl_kasus'])));
        	                                
        	                                $exp1month = date('Y-m-d', strtotime("-1 month", $satutahun));
        	                                $exp15day = date('Y-m-d', strtotime("-15 day", $satutahun));
        	                                $exp1week = date('Y-m-d', strtotime("-1 week", $satutahun));
        	                                $exp6day = date('Y-m-d', strtotime("-6 day", $satutahun));
        	                                
        	                                if($tglskr < $expired){
            	                                if($tglskr > $tglexp){
            	                                    echo "<span style='color: red;'>Frozen</span>";
            	                                }elseif($tglskr >= $tglnotif){
            	                                    echo "<span style='color: red;'>Billing Period</span>";
            	                                }
        	                                }
        	                                
        	                                echo "<br>";
        	                                if($tglskr >= $exp1month AND $tglskr < $exp15day){
        	                                    echo "<span style='color: red;'>Expired in 1 month</span>";
        	                                }elseif($tglskr >= $exp15day AND $tglskr < $exp1week){
        	                                    echo "<span style='color: red;'>Expired in 15 days</span>";
        	                                }elseif($tglskr >= $exp1week AND $tglskr < $exp6day){
        	                                    echo "<span style='color: red'>Expired in a week</span>";
        	                                }elseif($tglskr >= $exp6day AND $tglskr < $expired){
        	                                    echo "<span style='color: red;'>Expired soon</span>";
        	                                }elseif($tglskr > $expired){
        	                                    echo "<span style='color: red'>Expired</span>";
        	                                }
        	                                
                                        }
                                        
                                    }
                                ?>
                            </td>
        					<td><?= $r["nama_client"];?></td>
        					<td><?= $r["judul_kasus"];?></td>
        					<td><?= $r["jenis_kasus"];?></td>
        					<td><?= tgl_indo($r["tgl_kasus"])?></td>
        					<?php 
        					    if($_SESSION['level']=='superadmin'){ ?>
        					<td><?= tgl_indo($last["tgl_perkembangan"])?></td>
        					<?php } ?>
        					<td>
        					<?php if($_SESSION['level']=='superadmin'){
        						?>
        					<a href="?module=kasus&aksi=editkasus&id_kasus=<?= $r['id_kasus'];?>" class="btn btn-sm btn-info">Edit</a>
        					
        					<a href="?module=kasus&aksi=detailkasus&id_kasus=<?= $r['id_kasus'];?>&id_client=<?= $r['id_client'] ?>" class="btn btn-sm btn-flat btn-primary" style="border-radius:2px;">Perkembangan Kasus</a>
        					
        						<a href="?module=kasus&aksi=hapuskasus&id_kasus=<?= $r['id_kasus'];?>" class="btn btn-sm btn-info">Hapus</a>
        						<?php
        						if($r['id_jeniskasus'] == 7){
        						    
        						   $satutahun = strtotime("+1 year", strtotime($r['tgl_kasus']));
        	                                
        	                       $expired = date('Y-m-d', strtotime("+1 year", strtotime($r['tgl_kasus'])));
        	                       
        	                       if($tglskr < $expired){
        						    
            						if($bayar == 0){
            						    $tglexp = $r['tgl_exp'];
            	                        $tglnotif = date('Y-m-d', strtotime("-3 day", strtotime($tglexp)));
            	                        
            	                        if($tglskr >= $tglnotif){
            						?>
            						    <button type="button" class="btn btn-success" id="insert" data-id="<?php echo $r['id_kasus'] ;?>">Bayar</button>
            					<?php 
            						    }
        						    }
        	                       }
        						}
        						?>
                                <a class='btn btn-warning btn-sm' title='Finished' href='?module=kasus&aksi=finished&id_kasus=<?= $r['id_kasus'];?>' onclick="return confirm('Apakah Kasus Ini Sudah Selesai ... ?')">Finished</a>
                                
        					<?php } ?>
        					<?php if($_SESSION['level']=='client' OR $_SESSION['level']=='pengacara'){ ?>
        					<?php
        					if($idjenis == 7){
        					    if($tglskr < $expired){
                	                if($tglskr > $tglexp){ ?>
                	                 <a href="" class="btn btn-sm btn-flat btn-primary" style="border-radius:2px;" disabled>Perkembangan Kasus</a>
                    	            <?php     
                    	                }else{ ?>
                    	                <a href="?module=kasus&aksi=detailkasus&id_kasus=<?= $r['id_kasus'];?>&id_client=<?= $r['id_client'] ?>" class="btn btn-sm btn-flat btn-primary" style="border-radius:2px;">Perkembangan Kasus</a>
                        	         <?php
                    	                }
        					    }else{ ?>
        					     <a href="" class="btn btn-sm btn-flat btn-primary" style="border-radius:2px;" disabled>Perkembangan Kasus</a>  
        					   <?php     
        					    }
        					}else{
        					?>
        					<a href="?module=kasus&aksi=detailkasus&id_kasus=<?= $r['id_kasus'];?>&id_client=<?= $r['id_client'] ?>" class="btn btn-sm btn-flat btn-primary" style="border-radius:2px;">Perkembangan Kasus</a>
        					<?php
        					}
        					?>
        					<?php } ?>
                          </td>
        				</tr>
        					<?php $no++; } ?>
        				</tbody>
                      </table>
                    </div>
                    
                </div>
                <div role="tabpanel" class="tab-pane" id="finished">
                    <br>
                    <div class="table table-responsive">
                      <table  id="example1"  class="table table-bordered table-striped">
                        <thead>
                        <tr>
        					<th>No</th>
                            <th>No Kontrak</th>
        					<th>Nama Client</th>
        					<th>Judul Kasus</th>
        					<th>Jenis Kasus</th>
        					<th>Tanggal Kasus</th>
        					<?php 
        					if($_SESSION['level']=='superadmin'){ ?>
        					<th>Pemtar</th>
        					<?php } ?>
        					<th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
        				<?php
        					 if($_SESSION['level']=='client'){
        						$where = "AND tbl_kasus.id_client='$_SESSION[id_client]'";
        					 }else if($_SESSION['level']=='superadmin'){
        						$where = "";
        					 }else if($_SESSION['level']=='pengacara'){
        						$where = "";
        					 }
        					$be = mysqli_query($con, "SELECT * FROM tbl_kasus,tbl_client,tbl_jnskasus where tbl_kasus.status='finished' AND tbl_kasus.id_client=tbl_client.id_client AND tbl_kasus.id_jeniskasus=tbl_jnskasus.id_jeniskasus $where order by tgl_kasus DESC");
        					
        					$no=1;
        					while($r=mysqli_fetch_assoc($be)){
        					    
        					    $tglskr = date('Y-m-d');
        					    $bayar = mysqli_num_rows(mysqli_query($con, "SELECT id_kasus, tgl_bayar FROM tbl_bayar WHERE MONTH(tgl_bayar)= MONTH('$tglskrg') AND YEAR(tgl_bayar)= YEAR('$tglskr') AND id_kasus='$r[id_kasus]'"));
        					    
        					    $last = mysqli_fetch_assoc(mysqli_query($con, "SELECT DISTINCT tgl_perkembangan FROM tbl_detailkasus WHERE id_kasus='$r[id_kasus]' ORDER BY tgl_perkembangan DESC LIMIT 1"));
        				?>
        
        				<tr>
        					<td><?= $no; ?></td>
                            <td><?= $r["no_kasus"];?></td>
        					<td><?= $r["nama_client"];?></td>
        					<td><?= $r["judul_kasus"];?></td>
        					<td><?= $r["jenis_kasus"];?></td>
        					<td><?= tgl_indo($r["tgl_kasus"])?></td>
        					<?php 
        					if($_SESSION['level']=='superadmin'){ ?>
        					<td><?= tgl_indo($last["tgl_perkembangan"])?></td>
        					<?php } ?>
        					<td>
        					<?php if($_SESSION['level']=='superadmin'){
        						?>
        					<a href="?module=kasus&aksi=editkasus&id_kasus=<?= $r['id_kasus'];?>" class="btn btn-sm btn-info">Edit</a>
        					
        					<a href="?module=kasus&aksi=detailkasus&id_kasus=<?= $r['id_kasus'];?>&id_client=<?= $r['id_client'] ?>" class="btn btn-sm btn-flat btn-primary" style="border-radius:2px;">Perkembangan Kasus</a>
        					
        						<a href="?module=kasus&aksi=hapuskasus&id_kasus=<?= $r['id_kasus'];?>" class="btn btn-sm btn-info">Hapus</a>
        						
        						<a class='btn btn-warning btn-sm' title='Continue' href='?module=kasus&aksi=continue&id_kasus=<?= $r['id_kasus'];?>' onclick="return confirm('Lanjutkan kasus ini ... ?')">Continue</a>
        						
        					<?php } ?>
        					<?php if($_SESSION['level']=='client' OR $_SESSION['level']=='pengacara'){ ?>
        					<?php
        					if($idjenis == 7){
        					    if($tglskr < $expired){
                	                if($tglskr > $tglexp){ ?>
                	                 <a href="" class="btn btn-sm btn-flat btn-primary" style="border-radius:2px;" disabled>Perkembangan Kasus</a>
                    	            <?php     
                    	                }else{ ?>
                    	                <a href="?module=kasus&aksi=detailkasus&id_kasus=<?= $r['id_kasus'];?>&id_client=<?= $r['id_client'] ?>" class="btn btn-sm btn-flat btn-primary" style="border-radius:2px;">Perkembangan Kasus</a>
                        	         <?php
                    	                }
        					    }else{ ?>
        					     <a href="" class="btn btn-sm btn-flat btn-primary" style="border-radius:2px;" disabled>Perkembangan Kasus</a>  
        					   <?php     
        					    }
        					}else{
        					?>
        					<a href="?module=kasus&aksi=detailkasus&id_kasus=<?= $r['id_kasus'];?>&id_client=<?= $r['id_client'] ?>" class="btn btn-sm btn-flat btn-primary" style="border-radius:2px;">Perkembangan Kasus</a>
        					<?php
        					}
        					?>
        					<?php } ?>
                          </td>
        				</tr>
        					<?php $no++; } ?>
        				</tbody>
                      </table>
                    </div>
                </div>
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
