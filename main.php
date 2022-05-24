<?php
    session_start();
  include "config/koneksi.php";
  include "config/fungsi_indotgl.php";
  include "config/fungsi_seo.php";
  include "config/config_lang.php";
  
  // error_reporting(0);
  $contact = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM contact"));
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Open Graph Information -->
    <meta property="og:title" content="We are ready to serve you – Public Governance – Private Governance – Litigation & Dispute Resolution">
    <meta property="og:description" content="Miko Kamal & Associates (Previously known as “Anggrek Law Firm”) - “MKA” is a domestic law firm which serves both international and domestic clients.

tentang, we have handled several government affairs. The Managing Partner of MKA, Miko Kamal, Ph.D., has good relationship with local government and he also serves as a commissioner in a City-owned Company.

While in government law section, we partner with the Executive and Legislative arms of Government as well as Extra-Governmental agencies in order to achieve the goal of establishing sustainable and robust public governance structures. We also provide legal drafting training, and advise local governments on developing local laws.

For our commercial clients, we are a trusted partner assisting them in conducting their affairs.
Our lawyers advise both foreign and domestic investors on the proper methods to establish businesses and develop commercial contracts. We provide consulting support to the companies who wish to develop corporate governance documents (code of corporate governance, company by-laws, codes of conduct, whistle-blower policies).

Finally, we assist companies in dealing with complicated issues like workplace relations law, competition law, bankruptcy law and intellectual property right issues.



Practice Areas
These are our Practice Areas that we are able to handle.

1. Government Laws

[caption id=attachment_1827 align=alignleft width=136] Legal Advocacy of Local Election[/caption]

[caption id=attachment_1828 align=alignleft width=136] Training of Local Legal Drafting[/caption]

[caption id=attachment_1829 align=alignleft width=136] Local Regulation Drafting[/caption]

a
a
a
a
a
aa
a
2. Business Laws


 	Intelectual Property Rights
 	Workplace Relations
 	Competition Law
 	Health and Medicine Law
 	Commecial Contract Drafting
 	Islamic Banking
 	Banking & Finance
 	Corporate Governance
 	Insurance and re-Insurance
 	Corporate Restructuring and Insolvency
 	Foreign Direct Investment and Joint Ventures

3. Litigation and Dispute Resolution

 	Civil Law
 	Commercial Litigation
 	Criminal Law
 	Arbitration
 	Bankruptcy
 	State Administrative Law
 	Family Law




Our Office
Padang
Anggrek Building 2nd Floor
Jl. Permindo No. 61-63 Padang 25111
+6275124552 (phone), +6275122609 (facs)

[caption id=attachment_1822 align=alignleft width=900] Click the map to explore the location on Googl[/caption]

Jakarta
Jl. Garuda No. 71B, Lt. 1 Kemayoran
Jakarta Pusat 10610
+622146776655 (phone) +62214243469 (facs)

 ">
    <meta property="og:type" content="website">
    <!-- CSS links -->
    <link rel="stylesheet" type="text/css" href="<?= $base_url ?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= $base_url ?>css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= $base_url ?>css/jquery.bxslider.css" />
    <link rel="stylesheet" type="text/css" href="<?= $base_url ?>css/animate.min.css">
    <link rel="stylesheet" type="text/css" href="<?= $base_url ?>css/aos.css">
    <link rel="stylesheet" type="text/css" href="<?= $base_url ?>css/magnific-popup.css" />
    <link rel="stylesheet" href="<?= $base_url ?>css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?= $base_url ?>css/ionicons.min.css">
    <link rel="stylesheet" href="<?= $base_url ?>css/style.css">
    <link rel="stylesheet" href="<?= $base_url ?>css/colors/blue.css">
    <link rel="stylesheet" href="<?= $base_url ?>admin/assets/css/bootstrap3-wysihtml5.min.css">
    <!-- Font Family and Favicon-->
        <link href="https://fonts.googleapis.com/css?family=Dosis:400,700,800%7CPoppins:300,400,700" rel="stylesheet">
    <link rel="shortcut icon" href="<?= $base_url ?>img/favicon.png">
    <script src="<?= $base_url ?>js/jquery.min.js"></script>

    <!-- Title -->
    <title><?php echo $bahasa['title'] ?></title>

</head>

<body>
    <!-- Preloader -->
    
    <div class="homepage">
        <?php
          include "menu.php";
          include "content.php";
        ?>

        <!-- Footer -->
        <footer style="background-color: #083d1a;">
            <div class="container footer-widgets">
                <div class="row">
                  <aside class="col-md-12 text-center" data-aos="fade-up" data-aos-delay="0">
                    <h3 style="color:#c3c70a;" ><i><?php echo $bahasa['jumbotron-TX'] ?></i></h3>
                    <hr>
                  </aside>
                </div>

                <div class="row col-lg-12">
                  <?php
                  
                         if($_SESSION['lang'] == 'bs'){
                        $sql = mysqli_query($con, "SELECT * FROM practice_area  where language='bs' ");
                       
                       
                      } else if($_SESSION['lang'] == 'en'){
                        $sql = mysqli_query($con, "SELECT * FROM practice_area  where language='en' ");
                        
                      }
                    // $sql = mysqli_query($con, "SELECT * FROM practice_area where");
                    while($data = mysqli_fetch_assoc($sql)){
        
                  ?>
                  <div class="col-lg-4">
                    <a href="<?= $base_url ?>practice-area/<?= $data['judulseo_practice'] ?>"><h4 style="color:#c3c70a;"><b><?= $data['judul_practice'] ?></b></h4></a>
                    <br>
                      <ul class="text-light">
                        <?php
                        
                      if($_SESSION['lang'] == 'bs'){
                        $sql1 = mysqli_query($con, "SELECT * FROM practice_area_detail  where  id_practice='$data[id_practice]' AND language='bs' ");
                       
                       
                      } else if($_SESSION['lang'] == 'en'){
                        $sql1 = mysqli_query($con, "SELECT * FROM practice_area_detail  where  id_practice='$data[id_practice]' AND language='en' ");
                        
                      }
                        //   $sql1 = mysqli_query($con, "SELECT * FROM practice_area_detail WHERE  id_practice='$data[id_practice]'");
                          while($data1 = mysqli_fetch_assoc($sql1)){
                        ?>
                        <li class="text-light" style="margin-top: -10px;"><i class="fa fa-check-square"></i> <?= $data1['judul_detail'] ?></li>
                        <br>
                        <?php } ?>
                      </ul>
                  </div>
                  <?php } ?>
                 
                </div>
            </div>
            <div id="copyright" data-aos-delay="0" style="background-color: #a60202;">
                <div class="container">
                    <div class="row text-center">
                        <a href="#" target="_blank">&copy; Copyright Miko Kamal & Associates | Web Design by CV. Mediatama Web Indonesia - <?= date('Y') ?></a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <script src="<?= $base_url ?>js/plugins.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;key=AIzaSyAC0h0f0HXUzD3JGdO0SOEyJl22aNxAm1g"></script>
    <script src="<?= $base_url ?>js/main1f63.js?_=jdu878d7"></script>

    <script src="<?= $base_url ?>js/jquery.bxslider.min.js"></script>
    <script src="<?= $base_url ?>admin/assets/ckeditor/ckeditor.js"></script>
    <script type="text/javascript" src="<?= $base_url ?>admin/assets/js/bootstrap3-wysihtml5.all.min.js"></script>
    <script>
        $(document).ready(function(){
          $('.textarea').wysihtml5();

          slider = $('.bxslider').bxSlider();
          slider.startAuto();
        });
    </script>
    
    <script>
        $(document).ready(function(){
            $('#btnkirim').hide();
        });
    </script>
</body>
</html>

