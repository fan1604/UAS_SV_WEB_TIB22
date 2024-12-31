<?php
//bukan inputan di indexnya tapi menggunakan includ dan unutk koneksinyua keluar dulu
include "../config/koneksi.php";
//mengambil variabel idpesanan
$idpesanan = $_GET['idpesanan'];
    if(empty($idpesanan)){
        //maka kita kembalikan ke halaman pesan
        header('location : ../index.php?p=pesan');
    }
    //cara mengubah statusnya
    $sql = "UPDATE pesanan SET status='1' WHERE idpesanan='$idpesanan'";
    $query = mysqli_query($koneksi, $sql);
    //jika dijalankan dan langsung kemabli
    if($query){
        ?>
            <script type="text/javascript">
                window.location.href="../index.php?p=pesan";
            </script>
        <?php
    //jika dijalankan gagal
    }else{
        ?>
        <script type="text/javascript">
            alert('Gagal mengubah status!');
            window.location.href="../index.php?p=pesan";
        </script>
        <?php
    }

?>