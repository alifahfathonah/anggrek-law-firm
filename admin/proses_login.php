<?php
	include "../config/koneksi.php";
	$user = mysqli_real_escape_string($con,$_POST['username']);
	$pass = mysqli_real_escape_string($con,md5($_POST['password']));
	
	$sql	= mysqli_query($con,"SELECT * from tbl_admin where password = '$pass' AND username = '$user'");
	$data	= mysqli_fetch_array($sql);

	if(mysqli_num_rows($sql) > 0){
		session_start();
		$_SESSION['id']			= $data['idadmin'];
		$_SESSION['username']	= $data['username'];
		$_SESSION['password']	= $data['password'];
		$_SESSION['id_client']  = $data['namalengkap'];
		$_SESSION['level']      = $data['level'];
		if($_SESSION['level']=="client"){
		echo "<Script>
			alert('Selamat Datang $_SESSION[username]');
			window.location='User/index.php?module=kasus';
			</script>";
		exit;
		}else {
			echo "<script>
			alert('Selamat Datang $_SESSION[username]');
			window.location='User/index.php';
			</script>";
			exit;
		}
		
	}else{
        echo "<script>
                alert('Password atau username anda salah !');
                window.location='login.php';
              </script>";
      
	}
	
?>