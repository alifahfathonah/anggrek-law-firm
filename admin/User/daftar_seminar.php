<div class="content-wrapper">
<?php
  if (isset($_GET['aksi'])){
    $aksi = $_GET['aksi'];

  switch ($aksi){
    case "hapusseminar" :

    if(isset($_GET['id'])){
      $del = mysqli_query($con, "DELETE FROM daftar_seminar WHERE id_seminar='$_GET[id]'");
      if($del){
    	  echo "<script>
                 alert('Data Berhasil Dihapus');
    					   window.location='index.php?module=daftar_seminar';
    		    </script>";
      }else{
        echo "<script>
                alert('Data Gagal Dihapus');
                window.location='index.php?module=daftar_seminar';
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
        Daftar Seminar
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Daftar Seminar</li>
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
                    <th>Nama Lengkap</th>
                    <th>Email</th>
                    <th>Email Perusahaan</th>
                    <th>Perusahaan</th>
                    <th>No Telp</th>
                    <th>No Telp Perusahaan</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
        				<?php
        					$be = mysqli_query($con, "SELECT * FROM daftar_seminar");
        					$no=1;
        					while($r=mysqli_fetch_assoc($be)){
        					
        				?>
      				<tr>
      					<td><?= $no; ?></td>
      					<td><?= $r['nama'] ?></td>
      					<td><?= $r['email'] ?></td>
      					<td><?= $r['emailperu'] ?></td>
                        <td><?= $r['perusahaan'] ?></td>
                        <td><?= $r['no_telp'] ?></td>
                        <td><?= $r['no_telp_peru'] ?></td>
                        <td><?= $r['tgl_daftar'] ?></td>
      					<td><a href="?module=daftar_seminar&aksi=hapusseminar&id=<?= $r['id_seminar'];?>" class="btn btn-danger btn-flat" onclick="return confirm('Yakin Akan Menghapus Data Ini ... ?')">Hapus</a>
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
