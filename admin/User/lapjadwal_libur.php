<div class="content-wrapper">
        <!-- Content Header (Page header) -->




<section class="content-header">
      <h1>
      Jadwal Libur
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Jadwal Libur</li>
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
								echo "<option value='$cln[nama_pengacara]'> $cln[nama_pengacara] </option>";
							}
							?>
						</select>
              </div>
              <div class="col-sm-2">
               <button type="submit" name="cari" class="btn btn-primary">Cari</button>  <a href="cetakjadwal.php?awal=<?php echo $_POST['awal'] ?>&akhir=<?php echo $_POST['akhir'] ?>&pengacara=<?php echo $_POST['id_pengacara'] ?>" target="_blank" class="btn btn-primary">
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
          <th colspan="2" style="text-align: center;">Tanggal Jadwal</th>
		  <th rowspan="2">Kategori Libur</th>
		  <th rowspan="2">Nama </th>
					<th rowspan="2">Keterangan</th>
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
    
	 
     
		$be = mysqli_query($con, "SELECT * FROM tbl_jlibur where tanggal_libur between '$awal' and '$akhir' and id_pengacara like '%$pengacara%' order by id_libur desc");
    }else{
   
		$be = mysqli_query($con, "SELECT * FROM tbl_jlibur where tanggal_libur='$hari_ini' order by id_libur desc");
    }
					
					$no=1;
					while($r=mysqli_fetch_assoc($be)){
				?>

				<tr>
					<td><?= $no; ?></td>
          <td><?= $r["tanggal_libur"];?></td>
          <td><?= $r["tanggal_liburakhir"];?></td>
		  <td><?= $r["kategori"];?></td>
		  <td><?= $r["id_pengacara"];?></td>
					<td><?= $r["keterangan"];?></td>
					
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
