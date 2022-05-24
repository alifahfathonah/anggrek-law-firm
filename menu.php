<?php 
  include "config/config_lang.php";
  if($_SESSION['bahasa'] == 'bs'){
    include "language/bs.php";
  } else if($_SESSION['bahasa'] == 'en'){
    include "language/en.php";
  }
?>

<nav class="navbar navbar-head navbar-fixed-top" style="background-color: white;">
  <div class="col-md-12" style="background: #083d1a; color: #fff; padding: 10px;">
    <!-- Top bar Left -->
    <div class="col-md-7 col-sm-7 col-xs-9 col-md-offset-1">
        <i class="fa fa-home" aria-hidden="true"></i> <?= $contact['alamat'] ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <i class="fa fa-volume-control-phone" aria-hidden="true"></i> <?= $contact['telp'] ?>
      </ul>
    </div>
    <!-- Top bar Right -->
    <div class="col-md-3 col-sm-4">
      <ul class="text-right">
        <li class="li-last">
          <a target="_blank" href="https://www.twitter.com/<?= $contact['twitter'] ?>"><i class="fa fa-twitter" style="color: #fff;"></i></a>&nbsp;&nbsp;
          <a target="_blank" href="https://www.facebook.com/<?= $contact['fb'] ?>"><i class="fa fa-facebook" style="color: #fff;"></i></a>&nbsp;&nbsp;
          <a target="_blank" href="https://www.instagram.com/<?= $contact['ig'] ?>"><i class="fa fa-instagram" style="color: #fff;"></i> </a></li>
      </ul>
    </div>
    <div class="col-md-1">
      &nbsp;
    </div>
  </div>

    <div class="container">
    <div class="col-lg-10 col-md-10 col-md-offset-1">
        <div class="navbar-header">
          
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar top-bar"></span>
                <span class="icon-bar middle-bar"></span>
                <span class="icon-bar bottom-bar"></span>
            </button>
            
            <a class="navbar-brand logo-white" href="<?= $base_url ?>./"><img src="<?= $base_url ?>img/logomka.png" alt="logo-mkamal" width="150" style="margin-top : -10px;"></a>
            <a class="navbar-brand logo-dark" href="<?= $base_url ?>./"><img src="<?= $base_url ?>img/logomka.png" alt="logo-mkamal" width="150" style="margin-top : -10px;"></a>
            
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a class="local-scroll" href="<?= $base_url ?>./" style="color: #333;"><?php echo $bahasa['home'] ?></a></li>
                <li class="dropdown"><a href="#" data-toggle="dropdown" class="dropdown-toggle" style="color: #333;"><?php echo $bahasa['about'] ?><b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                          <div class="elements-row">
                             <ul class="megamenu-lists">
                                <li><a href="<?= $base_url ?>about-us/"><?php echo $bahasa['about-us'] ?></a></li>
                                <br>
                                <li><a href="<?= $base_url ?>our-founder/"><?php echo $bahasa['our-founder'] ?></a></li>
                                <br>
                                <li><a href="<?= $base_url ?>our-team/"><?php echo $bahasa['our-team'] ?></a></li>
                             </ul>
                          </div>
                        </li>
                    </ul>
                </li>
                <li class="dropdown"><a href="#" data-toggle="dropdown" class="dropdown-toggle" style="color: #333;"><?php echo $bahasa['practice-area'] ?><b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                          <div class="elements-row">
                             <ul class="megamenu-lists">
                                <?php
                                
                                    if($_SESSION['lang'] == 'bs'){
                                        $sql = mysqli_query($con, "SELECT * FROM practice_area where language='bs'");
   
                                    } else if($_SESSION['lang'] == 'en'){
                                         $sql = mysqli_query($con, "SELECT * FROM practice_area where language='en'");
    
                                    }
                                    
                                 
                                  while($data = mysqli_fetch_assoc($sql)){
                                ?>
                                
                                <li><a href="<?= $base_url ?>practice-area/<?= $data['judulseo_practice'] ?>"><?= $data['judul_practice'] ?></a></li>
                                <br>
                                <?php  } ?>
                             </ul>
                          </div>
                        </li>
                    </ul>
                </li>

                <li class="dropdown"><a href="#" data-toggle="dropdown" class="dropdown-toggle" style="color: #333;"><?php echo $bahasa['publication'] ?><b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                          <div class="elements-row">
                             <ul class="megamenu-lists">
                                <li><a href="<?= $base_url ?>news/"><?php echo $bahasa['news-&-activities'] ?></a></li>
                                <br>
                                <li><a href="<?= $base_url ?>legal-rubric/"><?php echo $bahasa['legal-rubric'] ?></a></li>
                                <br>
                                <li><a href="<?= $base_url ?>journals/"><?php echo $bahasa['journals'] ?></a></li>
                             </ul>
                          </div>
                        </li>
                    </ul>
                </li>
                <li><a href="<?= $base_url ?>career/" style="color: #333;"><?php echo $bahasa['career'] ?></a></li>
                <li><a href="<?= $base_url ?>contact/" style="color: #333;"><?php echo $bahasa['contact'] ?></a></li>
                <li><a href="<?= $base_url ?>admin/" style="color: #333;"><?php echo $bahasa['login'] ?></a></li>
                <script>
                  function bahasa(lang)
                  {
                    $.ajax({
                      url : '<?= $base_url; ?>bahasa.php',
                      type : 'POST',
                      dataType : 'JSON',
                      data : {
                        lang : lang,
                      },
                    })
                    .done(function(res){
                        console.log(res.isi)
                        location.reload();
                        '<?= $_SESSION['lang'] ?>'
                        
                    })
                    .fail(function(){
                      console.log('error');
                    })
                  }
                </script>
                <li><a onclick="bahasa('en')" href="javascript:void(0)" style="color: #333;"><img src="<?= $base_url ?>img/english.png" width="30" style="margin-top : -10px"; ></a></li>
               <li><a onclick="bahasa('bs')" href="javascript:void(0)" style="color: #333;"><img src="<?= $base_url ?>img/indonesia.png" width="30" style="margin-top : -10px"; ></a></li>
               
            </ul>
        </div>
        <!--/.nav-collapse -->
    </div>
</div>
</nav>
