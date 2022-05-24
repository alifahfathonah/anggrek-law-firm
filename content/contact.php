<?php
include "config/config_lang.php";

  $sql = mysqli_query($con, "SELECT * FROM cover WHERE id_cover='8'");
  $data1 = mysqli_fetch_assoc($sql);
?>

<section class="portfolio-header parallax parallax1" style="background:#000 url('<?= $base_url ?>img/cover/<?= $data1[gambar] ?>') 50% 0 no-repeat fixed;">
    <div class="yeye-overlay p-t-b-80" data-overlay-opacity="0.8">
        <div class="container">
            <div class="row">
                <p class="col-sm-12 text-light text-center" data-aos="fade-down" data-aos-delay="0"></p>
                <h2 class="text-light text-center emphasis" data-in-effect="fadeInUp"><?php echo $bahasa['contact'] ?></h2>
                <p class="col-sm-12 text-light text-center" data-aos="fade-up" data-aos-delay="300"></p>
            </div>
        </div>
    </div>
</section>

<section id="contact-field" class="p-t-b-80">
    <div class="container">
      <div class="row">
          <div class="col-sm-2 col-md-offset-3 text-center">
              <a href="https://www.facebook.com/<?= $contact['fb'] ?>" target="_blank">
                  <div class="social-frame">
                      <span class="text-colored ion-social-facebook icon-3x"></span>
                  </div>
                  <h4>Facebook</h4>
              </a>
          </div>
          <div class="col-sm-2 text-center">
              <a href="https://www.twitter.com/<?= $contact['twitter'] ?>" target="_blank">
                  <div class="social-frame">
                      <span class="text-colored ion-social-twitter icon-3x"></span>
                  </div>
                  <h4>Twitter</h4>
              </a>
          </div>
          <div class="col-sm-2 text-center">
              <a href="https://www.instagram.com/<?= $contact['ig'] ?>" target="_blank">
                  <div class="social-frame">
                      <span class="text-colored ion-social-instagram icon-3x"></span>
                  </div>
                  <h4>Instagram</h4>
              </a>
          </div>
      </div>
      <br>
        <div class="col-md-8 col-md-offset-2">
            <div class="text-center">
                <div>
                    <h2><?php echo $bahasa['leave'] ?> <span class="emphasis text-colored"><?php echo $bahasa['message'] ?></span></h2>
                </div>
            </div>
            <form method="POST" action="" data-toggle="validator">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <input type="text" class="form-control input-lg" id="name" name="name" placeholder="Name*" required data-error="Please fill in your name">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <input type="email" class="form-control input-lg" name="email" placeholder="Email*" required data-error="Please enter a valid e-mail address">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <input type="text" class="form-control input-lg" name="tel" placeholder="Tel">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <textarea id="comments" rows="10" class="form-control input-lg" name="message" placeholder="Message*" required data-error="Please write your message"></textarea>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-submitted">
                        <img class="svg-loader" src="<?= $base_url ?>img/assets/loader.svg" alt="loader message">
                    </div>
                </div>
                <button type="submit" name="kirim" class="btn btn-colored btn-lg center-block m-t-20"><?php echo $bahasa['sent'] ?></button>
            </form>
            <?php
              if (isset($_POST['kirim'])) {
			  $email= $_POST['email'];
			  $nama= $_POST['name'];
			  $nohp= $_POST['tel'];
			  $pesan= $_POST['message'];
			  $body= "
Nama 	 : $nama

No HP				 : $nohp

Email				 : $email 

Pesan			 : $pesan";
				$tgl = date('Y-m-d H:i:s');
                $insert = mysqli_query($con, "INSERT INTO contact_person VALUES ('', '$_POST[name]', '$_POST[email]', '$_POST[tel]', '$_POST[message]', '$tgl')");
ini_set( 'display_errors', 1 );   
    error_reporting( E_ALL );    
    $from = "$email";    
    $to = "info@mkamal.co.id";    
    $subject = "PESAN";    
    $message = "$body";   
    $headers = "From:" . $from;    
    mail($to,$subject,$message, $headers);    
                if($insert){ ?>
                  <div id="status-notification" class="text-colored"><h3>Sukses</h3></div>
                <?php
                }
              }
             ?>
        </div>
    </div>
</section>
<section class="maps" id="maps">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.2745373753387!2d100.35658401413346!3d-0.9459731356149049!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2fd4b937b7b03a01%3A0xe4e6a279e63bf46b!2sMiko+Kamal+%26+Associates!5e0!3m2!1sen!2sid!4v1536121323264" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
</section>
