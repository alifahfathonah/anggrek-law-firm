<?php
  @$page = $_GET['page'];

  if ($page == "home") {
    include "content/home.php";
  }elseif ($page == "berita") {
    include "content/berita.php";
  }elseif ($page == "tentang-kami") {
    include "content/about.php";
  }elseif ($page == "hukum-pemerintahan") {
    include "content/hukum-pemerintahan.php";
  }elseif ($page == "hukum-bisnis") {
    include "content/hukum-bisnis.php";
  }elseif ($page == "litigasi") {
    include "content/litigasi.php";
  }elseif ($page == "kontak") {
    include "content/contact.php";
  }elseif ($page == "pendiri-kami") {
    include "content/pendiri_kami.php";
  }elseif ($page == "publikasi") {
    include "content/publikasi.php";
  }elseif ($page == "detail-berita") {
    include "content/detail-berita.php";
  }elseif ($page == "carrier") {
    include "content/carrier.php";
  }elseif ($page == "detail-carrier") {
    include "content/detail-carrier.php";
  }elseif ($page == "rubrik-hukum") {
    include "content/rubrik-hukum.php";
  }elseif ($page == "detail-rubrik") {
    include "content/detail-rubrik.php";
  }elseif ($page == "practice-area") {
    include "content/practice-area.php";
  }elseif ($page == "our-team") {
    include "content/our-team.php";
  }elseif ($page == "recent") {
    include "content/recent.php";
  }elseif ($page == "detail-recent") {
    include "content/detail-recent.php";
  }elseif ($page == "detail-team") {
    include "content/detail-team.php";
  }elseif ($page == "code-overview") {
    include "content/code-overview.php";
  }elseif ($page == "detail-code") {
    include "content/detail-code.php";
  }elseif ($page == "daftar-seminar") {
    include "content/daftar-seminar.php";
  }else {
    include "content/home.php";
  }

?>
