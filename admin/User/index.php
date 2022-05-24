<?php
@session_start();
include "../../config/koneksi.php";
include "../../config/fungsi_seo.php";
include "../../config/fungsi_indotgl.php";
error_reporting(0);
?>
<?php
if (!$_SESSION['id']) {
    header('Location: ../login.php');
} else{?>

<!-- /*Create Nopen rianto - date 2017-06-02 */ -->
<!DOCTYPE html>

<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <link rel="shortcut icon" href="../../foto/icon.jpg"/>
    <title>Administrator</title>

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/fontawesome/css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/datatables.min.css"/>
    <link rel="stylesheet" href="../assets/css/AdminLTE.min.css">
    <link rel="stylesheet" href="../assets/css/bootstrap3-wysihtml5.min.css">
    <link rel="stylesheet" href="../assets/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="../assets/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="../assets/select2/dist/css/select2.min.css">

  </head>

  <body class="hold-transition skin-blue sidebar-mini">

    <div class="wrapper">
          <div class="logo">
            <img src="../../img/logomka.png" class="img-logo">
            <span class="jd-logo">Miko Kamal & Associates</span>
            <span class="nm-sek"></span>
        </div>
      <header class="main-header">
        <!-- Logo -->
        <div href="#" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>Adm</b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Selamat Datang</b></span>
        </div>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->


              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="../assets/images/user.png" class="user-image" alt="User Image">
                  <span class="hidden-xs"><?php echo $_SESSION['username'];?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="../assets/images/user.png" class="img-circle" alt="User Image">
                    <p>
                      <?php echo $_SESSION['username'];?>
                    </p>
                  </li>
                  <!-- Menu Body -->
                  <li class="user-body">

                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                        <a href="index.php" class="btn btn-default btn-flat"><i class="fa fa-user"> Profil</i></a>
                    </div>
                    <div class="pull-right">
                        <a href="logout.php" class="btn btn-default btn-flat"><i class="fa fa-sign-out"> Keluar</i></a>
                    </div>
                  </li>
                </ul>
              </li>

            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar" style="margin-top: 60px;">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar" style="">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="../assets/images/user.png" class="img-rounded" alt="User Image">
            </div>
            <div class="pull-left info">
              <p><?php echo $_SESSION['username'];?></p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>

          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li>
               <a href="?module=home">
                 <i class="fa fa-dashboard"></i> <span>Dashboard</span>

               </a>
             </li>
          <?php if($_SESSION['level']=="superadmin") {?>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-list"></i>
                  <span>About</span>
                  <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="?module=tentang_kami"><i class="fa fa-bookmark"></i> <span>About-Us</span></a></li>
                <li><a href="?module=pendiri_kami"><i class="fa fa-bookmark"></i> <span>Our Founder</span></a></li>
                <li><a href="?module=our_team"><i class="fa fa-group"></i> <span>Our Team</span></a></li>
                <li><a href="?module=our_partner"><i class="fa fa-group"></i> <span>Our Partner</span></a></li>
                <li><a href="?module=contact"><i class="fa fa-industry"></i> <span>Contact</span></a></li>
              </ul>
            </li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-list"></i>
                  <span>Website Data</span>
                  <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">

                <li>
                  <a href="?module=publication">
                    <i class="fa fa-book"></i> <span>Journals</span>
                  </a>
                </li>

                <li>
                  <a href="?module=practice-area">
                    <i class="fa fa-book"></i> <span>Practice Area</span>
                  </a>
                </li>

                <li>
                  <a href="?module=practice-area-detail">
                    <i class="fa fa-book"></i> <span>Practice Area Detail</span>
                  </a>
                </li>

                <li>
                  <a href="?module=recent">
                    <i class="fa fa-book"></i> <span>Recent Success Story</span>
                  </a>
                </li>

                <li>
                  <a href="?module=rubrik_hukum">
                    <i class="fa fa-question-circle"></i> <span>Legal Rubrik</span>
                  </a>
                </li>

                <li>
                  <a href="?module=berita">
                    <i class="fa fa-files-o"></i> <span>News & Activities</span>
                  </a>
                </li>

                <li>
                  <a href="?module=codeoverview">
                    <i class="fa fa-question-circle"></i> <span>Code Overview</span>
                  </a>
                </li>

                <li>
                  <a href="?module=message">
                    <i class="fa fa-envelope-o"></i> <span>Message</span>
                  </a>
                </li>

                <li>
                  <a href="?module=career">
                    <i class="fa fa-newspaper-o"></i> <span>Career</span>
                  </a>
                </li>

                <li>
                  <a href="?module=testimoni">
                    <i class="fa fa-send"></i> <span>Testimoni</span>
                  </a>
                </li>

                <li>
                  <a href="?module=logo">
                    <i class="fa fa-circle-o"></i> <span>Logo</span>
                  </a>
                </li>
				
				 <li>
                  <a href="?module=cover">
                    <i class="fa fa-image"></i> <span>Cover</span>
                  </a>
                </li>
				
				<li>
                  <a href="?module=slider">
                    <i class="fa fa-image"></i> <span>Slider</span>
                  </a>
                </li>
                
                <li>
                  <a href="?module=brosur">
                    <i class="fa fa-image"></i> <span>Brosur</span>
                  </a>
                </li>

              </ul>
            </li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-book"></i>
                <span>Master Data</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
          				<li><a href="?module=pengacara"><i class="fa fa-circle-o"></i> Pengacara/Staff</a></li>
          				<li><a href="?module=client"><i class="fa fa-circle-o"></i> Client</a></li>
						 <li>
              <a href="?module=libur">
                <i class="fa fa-circle-o"></i> <span>Jadwal Libur </span>
              </a>
            </li>
			  <li>
              <a href="?module=officeadmin">
                <i class="fa fa-circle-o"></i> <span>Beyond Office Hour </span>
              </a>
            </li>
						<li><a href="?module=laporan"><i class="fa fa-circle-o"></i> Kegiatan</a></li>
          				<li><a href="?module=kasus"><i class="fa fa-circle-o"></i> Kasus</a></li>
          				<li><a href="?module=jeniskasus"><i class="fa fa-circle-o"></i> Jenis Kasus</a></li>
              </ul>
            </li>
			<li class="treeview">
              <a href="#">
                <i class="fa fa-book"></i>
                <span>Grafik</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
			  
                  <li><a href="?module=grafikofficeadmin"><i class="fa fa-circle-o"></i>Beyond Office Hour</a></li>
                  <li><a href="?module=grafikadmin"><i class="fa fa-circle-o"></i> Perhari</a></li>
                  <li><a href="?module=grafikbulanadmin"><i class="fa fa-circle-o"></i> Perbulan</a></li>
                  <li><a href="?module=grafikadmintahun"><i class="fa fa-circle-o"></i> Pertahun</a></li>
              </ul>
            </li>
			<!--
            <li>
              <a href="?module=lump">
                <i class="fa fa-file-text"></i> <span>Agenda Lump Sum </span>
              </a>
            </li>-->
          <li class="treeview">
              <a href="#">
                <i class="fa fa-book"></i>
                <span>Laporan</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                  <li><a href="?module=lapsump"><i class="fa fa-circle-o"></i> Lump Sum</a></li>
                  <li><a href="?module=lapoffice"><i class="fa fa-circle-o"></i> Beyond Office Hour </a></li>
				  
				   <li><a href="?module=lapforget"><i class="fa fa-circle-o"></i> Forgotten Activities</a></li>
                  <li><a href="?module=lapjadwal_libur"><i class="fa fa-circle-o"></i> Jadwal Libur</a></li>
              </ul>
            </li>
             <li><a href="?module=daftar_seminar"><i class="fa fa-book"></i> <span>Daftar Seminar</span></a></li>
            <!--
			<li>
              <a href="?module=laporan">
                <i class="fa fa-file-pdf-o"></i> <span>Laporan </span>
              </a>
            </li>-->
        <?php }else if($_SESSION['level']=="pengacara") {?>
		  <li>
            <a href="?module=kasus">
              <i class="fa fa-desktop"></i> <span>Kasus </span>
            </a>
          </li>
        <li>
              <a href="?module=kegiatan">
                <i class="fa fa-file-text"></i> <span>Kegiatan </span>
              </a>
        </li>
		 <li>
              <a href="?module=forget">
                <i class="fa fa-file-text"></i> <span>Forgotten Activities</span>
              </a>
            </li>
        <li>
              <a href="?module=libur">
                <i class="fa fa-file-text"></i> <span>Jadwal Libur </span>
              </a>
            </li>
            <li>
              <a href="?module=lump">
                <i class="fa fa-file-text"></i> <span>Agenda Lump Sum </span>
              </a>
            </li>
        <li>
              <a href="?module=office">
                <i class="fa fa-file-text"></i> <span>Beyond Office Hour </span>
              </a>
            </li>
            


             <li class="treeview">
              <a href="#">
                <i class="fa fa-book"></i>
                <span>Grafik</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                  <li><a href="?module=grafikoffice"><i class="fa fa-circle-o"></i> Beyond Office Hour</a></li>
                  <li><a href="?module=grafikhari"><i class="fa fa-circle-o"></i> Perhari</a></li>
                  <li><a href="?module=grafikbulan"><i class="fa fa-circle-o"></i> Perbulan</a></li>
                  <li><a href="?module=grafiktahun"><i class="fa fa-circle-o"></i> Pertahun</a></li>
              </ul>
            </li>
			<li class="treeview">
              <a href="#">
                <i class="fa fa-book"></i>
                <span>Laporan</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                  <li><a href="?module=lapsump"><i class="fa fa-circle-o"></i> Lump Sum</a></li>
                  <li><a href="?module=lapoffice"><i class="fa fa-circle-o"></i> Beyond Office Hour </a></li>
				   <li><a href="?module=lapforget"><i class="fa fa-circle-o"></i> Forgotten Activities</a></li>
                  <li><a href="?module=lapjadwal_libur"><i class="fa fa-circle-o"></i> Jadwal Libur</a></li>
              </ul>
            </li>
			

        <?php }else if($_SESSION['level']=="client") {?>
          <li>
            <a href="?module=kasus">
              <i class="fa fa-desktop"></i> <span>Kasus </span>
            </a>
          </li>
      <?php } ?>
			<!-- <li>
              <a href="?module=admin">
                <i class="fa fa-user"></i> <span>Admin</span>
              </a>
            </li> -->
			     <li>
              <a href="logout.php">
                <i class="fa fa-sign-out"></i> <span>Logout</span>
              </a>
            </li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
	  <content>
		<?php include"content.php"; ?>
	  </content>
      <!-- /.content-wrapper -->

      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b></b>
        </div>
         &copy; Copyright <?php echo date('Y');  ?> CV. Mediatama Web Indonesia
      </footer>

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark" style="top:50px;">
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">

        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
          <!-- Home tab content -->
          <div class="tab-pane" id="control-sidebar-home-tab">
          </div>
        </div>
      </aside><!-- /.control-sidebar -->
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->

    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="../assets/js/jquery-1.10.2.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <!-- Bootstrap 3.3.5 -->
    <script src="../assets/js/bootstrap.min.js"></script>

    <script type="text/javascript" src="../assets/js/datatables.min.js"></script>
    <script type="text/javascript" src="../assets/js/bootstrap3-wysihtml5.all.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../assets/js/app.min.js"></script>
    <script src="../assets/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="../assets/js/backtoTop.js"></script>
    <script src="../assets/ckeditor/ckeditor.js"></script>
    <script src="../assets/select2/dist/js/select2.full.min.js"></script>
 <script>
      $(function () {
        $('.textarea').wysihtml5();
        $('.select2').select2();
        
        $( "#insert" ).click(function() {
            var id_kasus = $('#insert').attr('data-id');
            console.log(id_kasus);
             	$.ajax({
             		type: "POST",
             		url: "insertbayar.php",
             		data: 'id='+id_kasus,
             		cache: false,
             		success: function(response)
             		{
             		    location.reload();
             		}
             	});
        });

        $("#nmc").change(function(){
                var nmclient = $("#nmc").val();
                $.ajax({
                url: "ambilkasus.php",
                data: "nmclient="+nmclient,
                cache: false,
                    success: function(msg){
                //jika data sukses diambil dari server kita tampilkan
                //di <select id=kota>
                    $("#nok").html(msg);
                }
                });
                });


        $('#datepicker').datepicker({
          autoclose: true
        });

        $("#example1").DataTable();
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });

        CKEDITOR.replace( 'editor');
         
      });
    </script>
  </body>
</html>
<?php
}
?>
