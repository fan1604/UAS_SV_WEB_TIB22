<?php
  session_start();
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
  include "config/koneksi.php";
  if(!empty($_SESSION['username'])){
  @$user = $_SESSION['username'];
  @$level = $_SESSION['level'];
  @$iduser = $_SESSION['iduser'];
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Aplikasi E-KASIR-AN</title>

    <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="dist/css/navbar-fixed-top.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">E-KASIR-AN</a>
        </div>
    <!--Navbar-->
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
              <!--ini bagian pengaksesan(Autentication)jika..... mengakses maka ......  -->
              <?php
              if(@$level == "admin"){
              ?>
                <li class=""><a href="?p=list_barang">List Menu</a></li>
                <li class=""><a href="?p=pesan">Pesan</a></li>
                <li class=""><a href="?p=transaksi">Transaksi</a></li>
                <li class=""><a href="?p=laporan">Laporan</a></li>
              <?php } ?>
              <?php
              if(@$level == "waiter"){
              ?>
                <li class=""><a href="?p=pesan">Pesan</a></li>
                <li class=""><a href="?p=laporan">Laporan</a></li>
              <?php } ?>
              <?php
              if(@$level == "kasir"){
              ?>
                <li class=""><a href="?p=transaksi">Transaksi</a></li>
                <li class=""><a href="?p=laporan">Laporan</a></li>
              <?php } ?>
              <?php
              if(@$level == "pemilik"){
              ?>
                <li class=""><a href="?p=laporan">Laporan</a></li>
              <?php } ?>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <?php
              if(!empty($user)){
                ?>

              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <?=$user?> (<?= !empty($level) ?  $level : '' ; ?>) <span class="caret"></></a>
                <ul class="dropdown-menu">
                  <li><a href="page/keluar.php">Keluar</a></li>
                </ul>
              </li>

              <?php
              }
            ?>
          </ul>
        </div>
        <!--/.nav-collapse -->
      </div>
    </nav>

     <!-- /container -->
    <div class="container">
    
    <?php
    if(!empty($_SESSION['username'])){
      $user = $_SESSION['username'];
 
      @$p = $_GET['p'];
      switch ($p) {
        case 'home':
          # code...
          include "page/home.php";
          break;

        case 'login':
          # code...
          include "page/login.php";
          break;

        case 'list_barang':
          # code...
          include "page/list_barang.php";
          break;

        case 'tambah_barang':
          # code...
          include "page/tambah_barang.php";
          break;

        case 'pesan':
          # code...
          include "page/pesan.php";
          break;

        case 'edit_barang':
          # code...
          include "page/edit_barang.php";
          break;
        
        case 'hapus_barang':
          # code...
          include "page/hapus_barang.php";
          break;
        
        case 'transaksi':
          # code...
          include "page/transaksi.php";
          break;

        case 'detail_transaksi':
          # code...
          include "page/detail_transaksi.php";
          break;

        case 'laporan':
          # code...
          include "page/laporan.php";
          break;

        default:
          # code...
          include "page/login.php";
          break;  
      }

    }else{
      include "page/login.php";
    }
    ?>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="dist/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
