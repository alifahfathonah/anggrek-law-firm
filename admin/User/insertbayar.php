<?php 
    include "../../config/koneksi.php";
    
    $id = $_POST['id'];
    
    $sql = mysqli_query($con,"SELECT id_kasus, tgl_exp FROM tbl_kasus WHERE id_kasus='$id'");
    $data = mysqli_fetch_assoc($sql);
    
    mysqli_query($con, "INSERT INTO tbl_bayar VALUES('', '$id', '$data[tgl_exp]')");
    
    $tglexp = date('Y-m-d', strtotime("+1 month", strtotime($data['tgl_exp'])));
    
    mysqli_query($con, "UPDATE tbl_kasus SET tgl_exp='$tglexp' WHERE id_kasus='$id'");

?>