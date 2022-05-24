<div class="content-wrapper">
<section class="content-header">
      <h1>
        Laporan Sump Lump
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Laporan Sump Lump</li>
      </ol>
</section>
<section class="content">
      <div class="row">
        <div class="col-md-12">

          <div class="box-footer">
            <div class="form-group">
             <form role="form" class="form-horizontal" method="POST" action="">
          <div class="box-body">

            <div class="form-group">
              <label class="col-sm-1">Dari</label>
              <div class="col-sm-2">
                <input type="date" name="awal" class="form-control" >
              </div>
              <div class="col-sm-1">
                <label class="col-sm-1">Sampai</label>
              </div>
              <div class="col-sm-2">
                <input type="date" name="akhir" class="form-control" >
              </div>
			  
              <div class="col-sm-3">
                <select type="text" name="id_pengacara" id="kdp" class="form-control">
						<option value="">--Pilih Pengacara--</option>
						
							<?php 
							$sql = mysqli_query($con, "SELECT * FROM tbl_pengacara");
							while($cln=mysqli_fetch_assoc($sql)){
								echo "<option value='$cln[id_pengacara]'> $cln[nama_pengacara] </option>";
							}
							?>
						</select>
              </div>
              <div class="col-sm-2">
               <button type="submit" name="search" class="btn btn-primary">Cari</button>  <a href="cetaksump.php?awal=<?php echo $_POST['awal'] ?>&akhir=<?php echo $_POST['akhir'] ?>&pengacara=<?php echo $_POST['id_pengacara'] ?>" target="_blank" class="btn btn-primary"> Cetak
               </a>
              </div>
            </div>
           
          </div>
          
          
        </form>
        <table class="table table-bordered" id="example1">
  <thead>
    <tr>
      <th>No</th>
      <th>Tanggal</th>
      <th>Nama Client</th>
      <th>No Kasus</th>
      <th>Keterangan</th>
      <th>Nama Pengacara</th>
    </tr>
  </thead>
  <tbody>
    <?php 
	 $hari_ini = date("Y-m-d");
    if(isset($_POST['search'])){
      $awal     = $_POST['awal'];
      $akhir    = $_POST['akhir'];
	  $pengacara = $_POST['id_pengacara'];  
      $no=1;
      if($awal == '' && $akhir == '' && $pengacara == null){
        echo "<script>alert('Lengkapi Form Terlebih Dahulu');</script>";
      } elseif ($awal != '' && $akhir != '' && $pengacara != ''){
        $ambil=$con->query("SELECT * FROM tbl_lump p LEFT JOIN tbl_kasus k ON p.no_kasus=k.id_kasus LEFT JOIN tbl_client c On c.id_client=p.nama_client LEFT JOIN tbl_pengacara pe ON pe.id_pengacara=p.idpengacara where p.tanggal between '$awal' and '$akhir' and p.idpengacara='$pengacara'");    
      } elseif ($awal != '' && $akhir != ''){
        $ambil=$con->query("SELECT * FROM tbl_lump p LEFT JOIN tbl_kasus k ON p.no_kasus=k.id_kasus LEFT JOIN tbl_client c On c.id_client=p.nama_client LEFT JOIN tbl_pengacara pe ON pe.id_pengacara=p.idpengacara where p.tanggal between '$awal' and '$akhir'");
      }

    }else{
      $no=1; 
      $ambil=$con->query("SELECT * FROM tbl_lump p LEFT JOIN tbl_kasus k ON p.no_kasus=k.id_kasus LEFT JOIN tbl_client c On c.id_client=p.nama_client LEFT JOIN tbl_pengacara pe ON pe.id_pengacara=p.idpengacara where p.tanggal='$hari_ini' ");
      }
    while($pecah = $ambil->fetch_assoc()) {?>
    <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo $pecah['tanggal']; ?></td>
      <td><?php echo $pecah['nama_client']; ?></td>
      <td><?php echo $pecah['no_kasus']; ?></td>
      <td><?php echo $pecah['keterangan']; ?></td>
      <td><?php echo $pecah['nama_pengacara']; ?></td>
    </tr>
    <?php $no++; ?>
    <?php } ?>
    
  </tbody>
 </table>
            <div class="form-group">
             
               
          </div>
          </div>
      </div>
  </div></div></section>
</div>