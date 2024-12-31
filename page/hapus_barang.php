<?php
    //includ koneski
    include "../config/koneksi.php";

    $idmenu = $_GET['idmenu'];
    //echo $idmenu;
    //exit;
    $sql = "DELETE FROM menu WHERE idmenu ='$idmenu'";
    $query = mysqli_query($koneksi, $sql);
    if($query){
        ?>
        <script type="text/javascript">
            window.location.href="../index.php?p=list_barang";
        </script>
        <?php
    }else {
        ?>
        <script type="text/javascript">
            alert('Terjadi Kesalahan!');
            window.location.href="../index.php?p=list_barang";
        </script>
        <?php
    }
?>