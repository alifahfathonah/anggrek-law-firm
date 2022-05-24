<div class="content-wrapper">
        <!-- Content Header (Page header) -->



<section class="content-header">
      <h1>
      Forgotten Activities
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Forgotten Activities</li>
      </ol>
</section>
<section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-info">
            
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table table-responsive">
			  <form role="form" class="form-horizontal" method="POST" action="">
          <div class="box-body">

            <div class="form-group">
              <label class="col-sm-1">Dari</label>
              <div class="col-sm-2">
                <input type="date" name="awal" class="form-control"  required>
              </div>
              <div class="col-sm-1">
                <label class="col-sm-1">Sampai</label>
              </div>
              <div class="col-sm-2">
                <input type="date" name="akhir" class="form-control" required>
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
               <button type="submit" name="cari" class="btn btn-primary">Cari</button>  <a href="cetakforget.php?awal=<?php echo $_POST['awal'] ?>&akhir=<?php echo $_POST['akhir'] ?>&pengacara=<?php echo $_POST['id_pengacara'] ?>" target="_blank" class="btn btn-primary">
                   Cetak
               </a>
              </div>
            </div>
           
          </div>
          
          
        </form>
		
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
					<th rowspan="2">No</th>
					<th rowspan="2">Jenis Kegiatan</th>
					<th rowspan="2">Kegiatan</th>
          <th rowspan="2">Tanggal Kegiatan</th>
					<th colspan="2" style="text-align: center;">Jadwal</th>
          <th rowspan="2">Keterangan</th>
		  <th rowspan="2">Nama Pengacara </th>
                </tr>
                <tr>
                  <th>Mulai</th>
                  <th>Akhir</th>
                </tr>
                </thead>
                <tbody>
				<?php
				 $hari_ini = date("Y-m-d");
				  if(isset($_POST['cari'])){
      $awal     = $_POST['awal'];
      $akhir    = $_POST['akhir'];
	  $pengacara = $_POST['id_pengacara'];  
      $no=1; 
	 
     
		$be = mysqli_query($con, "SELECT * FROM tbl_forget,tbl_pengacara where tbl_forget.nama=tbl_pengacara.id_pengacara and tbl_forget.tanggal_kegiatan between '$awal' and '$akhir' and tbl_forget.nama like '%$pengacara%'  order by tbl_forget.idkegiatan desc");
    }else{
   
		$be = mysqli_query($con, "SELECT * FROM tbl_forget,tbl_pengacara where tbl_forget.nama=tbl_pengacara.id_pengacara and tbl_forget.tanggal_kegiatan='$hari_ini'  order by tbl_forget.idkegiatan desc");
    }
					$no=1;
					while($r=mysqli_fetch_assoc($be)){
				?>

				<tr>
					<td><?= $no; ?></td>
					<td><?= $r["jenis_kegiatan"];?></td>
					<td><?= $r["kegiatan"];?></td>
					<td><?=  tgl_indo($r["tanggal_kegiatan"]);?></td>
					<td><?= $r["jam_mulai"];?></td>
					
          <td><?= $r["jam_akhir"];?></td>
          <td><?= $r["keterangan"];?></td>
          <td><?= $r["nama_pengacara"];?></td>
		 
					
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

      </div>
