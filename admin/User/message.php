<div class="content-wrapper">
<?php
  if (isset($_GET['aksi'])){
    $aksi = $_GET['aksi'];

  switch ($aksi){
    case "previewmessage" :

    $sql = mysqli_query($con, "SELECT * FROM contact_person WHERE id_con_per='$_GET[id]'");
    $data = mysqli_fetch_assoc($sql);
    $jam_komen = substr($data['tgl_masuk'],11,18);

?>
<section class="content-header">
      <h1>
        Message
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Preview Message</li>
      </ol>
</section>
<!-- Content Header (Page header) -->
  <section class="content">
  <div class="row">
      <div class="col-xs-12">
       <div class="box box-info">
         <div class="box-header with-border">
           <div class="col-sm-10">
             <br>
             <h4><?= $data['nama_con'] ?></h4>
           </div>
           <div class="col-sm-10">
             <em><i class="fa fa-clock-o"></i> <?= tgl_indo($data['tgl_masuk'])." ". $jam_komen ?></em>
             &nbsp;&nbsp;&nbsp;&nbsp;<em><?= $data['email_con']?></em>
             &nbsp;&nbsp;&nbsp;&nbsp;<em><?= $data['tel_con']?></em>
             <h4><?= $data['message_con'] ?></h4>
             <br>
           </div>
         </div>
        </div>
      </div>
    </div>
</section>

<?php
    break;
    case "hapusmessage" :

    if(isset($_GET['id'])){
      $del = mysqli_query($con, "DELETE FROM contact_person where id_con_per='$_GET[id]'");
      if($del){
    	  echo "<script>
                 alert('Data Berhasil Dihapus');
    					   window.location='index.php?module=message';
    				  </script>";
      }else{
        echo "<script>
                alert('Data Gagal Dihapus');
                window.location='index.php?module=message';
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
        Message
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Message</li>
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
                    <th>Telp</th>
                    <th>Pesan</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
        				<?php
        					$be = mysqli_query($con, "SELECT * FROM contact_person");
        					$no=1;
        					while($r=mysqli_fetch_assoc($be)){
        						$msg = substr($r['message_con'],0,500)."...";
        				?>
      				<tr>
      					<td><?= $no; ?></td>
      					<td><?= $r['nama_con'] ?></td>
      					<td><?= $r['email_con'] ?></td>
      					<td><?= $r['tel_con'] ?></td>
                <td><?= $msg ?></td>
      					<td><a href="?module=message&aksi=previewmessage&id=<?= $r['id_con_per'];?>" class="btn btn-success btn-flat">Preview</a>
      						<a href="?module=message&aksi=hapusmessage&id=<?= $r['id_con_per'];?>" class="btn btn-danger btn-flat" onclick="return confirm('Yakin Akan Menghapus Data Ini ... ?')">Hapus</a>
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
