<?php 
    include "../../config/koneksi.php";
    $nama = $_GET['nmclient'];
    $stmt = mysqli_query($con, "SELECT * FROM tbl_kasus WHERE id_client='$nama'"); ?>
     <option value="">Pilih Judul Kasus</option>
<?php
    while($row = mysqli_fetch_assoc($stmt)){ 
        $idkasus = $row['id_kasus'];
    ?>
        <option value="<?php echo $idkasus ?>"><?php echo $row['judul_kasus'] ?></option>
<?php
    }
?>