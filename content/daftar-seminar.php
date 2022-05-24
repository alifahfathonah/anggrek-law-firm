<?php
  $sql = mysqli_query($con, "SELECT * FROM cover WHERE id_cover='8'");
  $data1 = mysqli_fetch_assoc($sql);
  
  $r=mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM brosur"));
?>

<style>
.control {
  display: block;
  position: relative;
  padding-left: 30px;
  margin-bottom: 15px;
  cursor: pointer;
  font-size: 18px;
}
.control input {
  position: absolute;
  z-index: -1;
  opacity: 0;
}
.control__indicator {
  position: absolute;
  top: 2px;
  left: 0;
  height: 20px;
  width: 20px;
  background: #e6e6e6;
}
.control:hover input ~ .control__indicator,
.control input:focus ~ .control__indicator {
  background: #ccc;
}
.control input:checked ~ .control__indicator {
  background: #2aa1c0;
}
.control__indicator:after {
  content: '';
  position: absolute;
  display: none;
}
.control input:checked ~ .control__indicator:after {
  display: block;
}
.control--checkbox .control__indicator:after {
  left: 8px;
  top: 4px;
  width: 3px;
  height: 8px;
  border: solid #fff;
  border-width: 0 2px 2px 0;
  transform: rotate(45deg);
}
</style>

<section class="portfolio-header parallax parallax1" style="background:#000 url('<?= $base_url ?>img/cover/<?= $data1[gambar] ?>') 50% 0 no-repeat fixed;">
    <div class="yeye-overlay p-t-b-80" data-overlay-opacity="0.8">
        <div class="container">
            <div class="row">
                <p class="col-sm-12 text-light text-center" data-aos="fade-down" data-aos-delay="0"></p>
                <h2 class="text-light text-center emphasis" data-in-effect="fadeInUp">DAFTAR PELATIHAN</h2>
                <p class="col-sm-12 text-light text-center" data-aos="fade-up" data-aos-delay="300"></p>
            </div>
        </div>
    </div>
</section>

<section id="contact-field" class="p-t-b-80">
    <div class="container">
        <div class="col-md-8 col-md-offset-2">
            <div class="text-center">
                <div>
                    <img src="<?= $base_url ?>img/brosur/<?= $r['gambar_brosur'] ?>" alt="brosurmkamal">
                </div>
            </div>
            
            <div class="text-center">
                <div>
                    <h2><span class="emphasis text-colored">Daftar Pelatihan</span></h2>
                </div>
            </div>
            
            <form method="POST" action="" data-toggle="validator">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <input type="text" class="form-control input-lg" id="name" name="nama" placeholder="Nama" required data-error="Nama harus diisi">
                            <span style="color: red;">*) Wajib diisi</span>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <input type="text" class="form-control input-lg" id="name" name="sku" placeholder="KTP / SIM / KITAS">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <input type="email" class="form-control input-lg" name="email" placeholder="Email Pribadi" required data-error="E-mail pribadi harus diisi">
                            <span style="color: red;">*) Wajib diisi</span>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <input type="email" class="form-control input-lg" name="emailperu" placeholder="Email Perusahaan" required data-error="Email perusahaan harus diisi">
                            <span style="color: red;">*) Wajib diisi</span>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <select name="jk" class="form-control">
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                    </div>
                     <div class="col-sm-12">
                        <div class="form-group">
                            <input type="text" class="form-control input-lg" name="perusahaan" placeholder="Perusahaan" required data-error="Please enter a valid company">
                            <span style="color: red;">*) Wajib diisi</span>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    
                    <div class="col-sm-6">
                        <div class="form-group">
                            <input type="text" class="form-control input-lg" name="no_telp" placeholder="No Telp Pribadi" required data-error="No telp pribadi harus diisi">
                            <span style="color: red;">*) Wajib diisi</span>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <input type="text" class="form-control input-lg" name="no_telp_peru" placeholder="No Telp Perusahaan" required data-error="No telp perusahaan harus diisi">
                            <span style="color: red;">*) Wajib diisi</span>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <input type="text" class="form-control input-lg" name="jabatan" placeholder="Jabatan di perusahaan" required data-error="Jabatan harus diisi">
                            <span style="color: red;">*) Wajib diisi</span>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <textarea id="comments" rows="10" class="form-control input-lg" name="alamat" placeholder="Alamat Pribadi"></textarea>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <textarea id="comments" rows="10" class="form-control input-lg" name="alamatperu" placeholder="Alamat Perusahaan"></textarea>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="control-group">
                            <label class="control control--checkbox">Data yang saya masukkan adalah benar
                            <input type="checkbox" id="remember" onclick="validate()">
                            <div class="control__indicator"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-submitted">
                        <img class="svg-loader" src="<?= $base_url ?>img/assets/loader.svg" alt="loader message">
                    </div>
                </div>
                <button type="submit" name="kirim" class="btn btn-colored btn-lg center-block m-t-20" style="display: none;" id="send">SEND</button>
            </form>
            <?php
              if (isset($_POST['kirim'])) {
              $nama= $_POST['nama'];
              $sku= $_POST['sku'];
			  $email= $_POST['email'];
			  $emailperu= $_POST['emailperu'];
			  $jk= $_POST['jk'];
			  $perusahaan= $_POST['perusahaan'];
			  $no_telp= $_POST['no_telp'];
			  $no_telp_peru= $_POST['no_telp_peru'];
			  $jabatan= $_POST['jabatan'];
			  $alamat= $_POST['alamat'];
			  $alamatperu= $_POST['alamatperu'];
		      $tgl = date('Y-m-d H:i:s');
            
              $insert = mysqli_query($con, "INSERT INTO daftar_seminar VALUES ('', '$nama', '$sku', '$email', '$emailperu','$jk', '$perusahaan', '$no_telp', '$no_telp_peru', '$jabatan', '$alamat', '$alamatperu', '$tgl')");
              
                require 'PHPMailerAutoload.php';
                require 'credential.php';

                $mail = new PHPMailer(true);                              
                try {
                //Server settings
                //$mail->SMTPDebug = 4;                                 
                $mail->Host = 'smtp.gmail.com';  
                $mail->SMTPAuth = true;                            
                $mail->Username = EMAIL;                 
                $mail->Password = PASS;                          
                $mail->SMTPSecure = 'tls';                           
                $mail->SMTPAuth = true;  
                $mail->Port = 587;                                  
                $mail->setFrom(EMAIL, 'Miko Kamal & Associate');
                
                $mail->addAddress($email); 
                $mail->isHTML(true);
                $mail->Subject = 'Daftar Pelatihan';
                $mail->Body    = "Salam, $nama
                                  <h3>Terima Kasih telah melakukan Pendaftaran untuk Acara</h3>
                                  <h3>\"Pelatihan Pengelolaan BUMD se-Indonesia\"</h3>
                                  <h3>Berikut data-data yang Anda kirimkan:</h3>
                                  <p>
                                  <table>
                                    <tr>
                                        <td>Nama</td> <td>:</td> <td>$nama</td>
                                    </tr>    
                                    <tr>
                                        <td>KTP/SIM/KITAS</td> <td>:</td> <td>$sku</td>
                                    </tr>
                                    <tr>
                                     <td>Email</td> <td>:</td> <td>$email</td>
                                    </tr>
                                    <tr>
                                     <td>Email Perusahaan</td> <td>:</td> <td>$emailperu</td>
                                    </tr>
                                    <tr>
                                     <td>Jenis Kelamin</td> <td>:</td> <td>$jk</td>
                                    </tr>
                                    <tr>
                                     <td>Perusahaan</td> <td>:</td> <td>$perusahaan</td>
                                    </tr>
                                    <tr>
                                     <td>No Telp</td> <td>:</td> <td>$no_telp</td>
                                    </tr>
                                    <tr>
                                     <td>No Telp Perusahaan</td> <td>:</td> <td>$no_telp_peru</td>
                                    </tr>
                                    <tr>
                                     <td>Jabatan</td> <td>:</td> <td>$jabatan</td>
                                    </tr>
                                    <tr>
                                     <td>Alamat</td> <td>:</td> <td>$alamat</td>
                                    </tr>
                                    <tr>
                                     <td>Alamat Perusahaan</td> <td>:</td> <td>$alamatperu</td>
                                    </tr>
                                    <tr>
                                     <td>Tanggal Daftar</td> <td>:</td> <td>$tgl</td>
                                    </tr>
                                  </table>
                                </p>
                                <p>
                                    Untuk proses selanjutnya, silahkan: <br><br>
                                    Transfer dana anda ke Bank Muamalat<br>
                                    No. Rekening &nbsp;&nbsp;&nbsp;&nbsp; : 4210039570<br>
                                    Atas Nama &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : Miko Kamal & Associates Anggrek Law Firm<br><br>
                                    Setelah Transfer Dana, silahkan balas email ini dengan mengisikan:<br>
                                    &nbsp;&nbsp;&nbsp; 1. <i>Screenshot</i>/foto/hasil <i>scan</i> bukti pembayaran<br>
                                    &nbsp;&nbsp;&nbsp; 2. Pas Foto yang akan ditempel di kartu peserta pelatihan<br><br>
                                    Terima Kasih,<br>
                                    Panitia Pelatihan
                                    
                                </p>";
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                $mail->send();
                
                
                
                
                } catch (Exception $e) {
                    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
                }
                
                
                $mail1 = new PHPMailer(true);                              
                try {
                //Server settings
                //$mail1->SMTPDebug = 4;                                 
                $mail1->Host = 'smtp.gmail.com';  
                $mail1->SMTPAuth = true;                            
                $mail1->Username = EMAIL;                 
                $mail1->Password = PASS;                          
                $mail1->SMTPSecure = 'tls';                           
                $mail1->SMTPAuth = true;  
                $mail1->Port = 587;                                  
                $mail1->setFrom(EMAIL, 'Miko Kamal & Associate');
            
                $mail1->addAddress('rego.yasendalika@mkamal.co.id'); 
                $mail1->isHTML(true);
                $mail1->Subject = 'Daftar Pelatihan';
                $mail1->Body    = "Salam, $nama
                                  <h3>Terima Kasih telah melakukan Pendaftaran untuk Acara</h3>
                                  <h3>\"Pelatihan Pengelolaan BUMD se-Indonesia\"</h3>
                                  <h3>Berikut data-data yang Anda kirimkan:</h3>
                                  <p>
                                  <table>
                                    <tr>
                                        <td>Nama</td> <td>:</td> <td>$nama</td>
                                    </tr>    
                                    <tr>
                                        <td>KTP/SIM/KITAS</td> <td>:</td> <td>$sku</td>
                                    </tr>
                                    <tr>
                                     <td>Email</td> <td>:</td> <td>$email</td>
                                    </tr>
                                    <tr>
                                     <td>Email Perusahaan</td> <td>:</td> <td>$emailperu</td>
                                    </tr>
                                    <tr>
                                     <td>Jenis Kelamin</td> <td>:</td> <td>$jk</td>
                                    </tr>
                                    <tr>
                                     <td>Perusahaan</td> <td>:</td> <td>$perusahaan</td>
                                    </tr>
                                    <tr>
                                     <td>No Telp</td> <td>:</td> <td>$no_telp</td>
                                    </tr>
                                    <tr>
                                     <td>No Telp Perusahaan</td> <td>:</td> <td>$no_telp_peru</td>
                                    </tr>
                                    <tr>
                                     <td>Jabatan</td> <td>:</td> <td>$jabatan</td>
                                    </tr>
                                    <tr>
                                     <td>Alamat</td> <td>:</td> <td>$alamat</td>
                                    </tr>
                                    <tr>
                                     <td>Alamat Perusahaan</td> <td>:</td> <td>$alamatperu</td>
                                    </tr>
                                    <tr>
                                     <td>Tanggal Daftar</td> <td>:</td> <td>$tgl</td>
                                    </tr>
                                  </table>
                                </p>
                                <p>
                                    Untuk proses selanjutnya, silahkan: <br><br>
                                    Transfer dana anda ke Bank Muamalat<br>
                                    No. Rekening &nbsp;&nbsp;&nbsp;&nbsp; : 4210039570<br>
                                    Atas Nama &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : Miko Kamal & Associates Anggrek Law Firm<br><br>
                                    Setelah Transfer Dana, silahkan balas email ini dengan mengisikan:<br>
                                    &nbsp;&nbsp;&nbsp; 1. <i>Screenshot</i>/foto/hasil <i>scan</i> bukti pembayaran<br>
                                    &nbsp;&nbsp;&nbsp; 2. Pas Foto yang akan ditempel di kartu peserta pelatihan<br><br>
                                    Terima Kasih,<br>
                                    Panitia Pelatihan
                                    
                                </p>";
                $mail1->AltBody = 'This is the body in plain text for non-HTML mail clients';

                $mail1->send();
                
                
                
                
                } catch (Exception $e) {
                    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
                }
                
                

              if($insert){ ?>
                <script>
                  alert('Terima kasih sudah melakukan pendaftaran. Kami akan segera menghubungi Anda melalui email untuk mengarahkan ke proses selanjutnya. Silahkan pantau email Anda dalam kurun waktu 2x24 jam');
                </script>
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

<script type=text/javascript>
  function validate(){
    if (remember.checked == 1){
      $('#send').show();
    } else {
      $('#send').hide();
    }
  }
</script>
