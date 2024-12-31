<?php
//<!--membuat idtransaksi otomatis di ?p= pesan & mencari maxKode id Pelanggan-->
    $sql_kode = "SELECT max(idtransaksi) as maxKode FROM transaksi";
    $query_kode = mysqli_query($koneksi, $sql_kode);
    //ambil data
    $data_kode = mysqli_fetch_array($query_kode);
    //ambil data maxKodenya
    $idtransaksi = $data_kode['maxKode'];
    //bikin nomor urut
	$noUrut = (int) substr($idtransaksi,3,3);
    $noUrut++;
    //bikin kata depan pada idpelanggan
    $char ="TRX";
    //kode pelanggan
    $kodetransaksi = $char . sprintf("%03s", $noUrut);

    //menangkap idpesanan yang ada ditansaksi
    $idpesanan =$_GET['idpesanan'];
        if(empty($idpesanan)){
            ?>
                <script type="text/javascript">
                    window.location.href="?p=transaksi";
                </script>
            <?php
        }
     $d_pesanan = "SELECT * FROM pesanan 
        left join pelanggan on pelanggan.idpelanggan= pesanan.idpelanggan
        left join menu on menu.idmenu = pesanan.idmenu WHERE idpesanan= '$idpesanan'";
     $d_query = mysqli_query($koneksi, $d_pesanan);
     $data =mysqli_fetch_array($d_query);
    // print_r($data);  
?>

<div class="col-lg-6">
    <div class="panel panel-default">
        <div class="panel-heading">Input pembayaran </div>
        <div class="panel-body">  
            <div class="row">
            <form action="" method="post">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Nama pelanggan</label>
                    <input type="text" name="" class="form-control" value="<?=$data['namapelanggan']?>" readonly>
                </div>
                <div class="form-group">
                    <label>Menu</label>
                    <input type="text" name="" class="form-control" value="<?=$data['namamenu']?>" readonly>
                </div>  
                <div class="form-group">
                    <label>Harga satuan</label>
                    <input type="text" name="" class="form-control" value="<?=$data['harga']?>" readonly>
                </div>   
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Jumlah</label>
                    <input type="text" name="" class="form-control" value="<?=$data['jumlah']?>" readonly>
                </div>   
                <div class="form-group">
                    <label>Total bayar</label>
                    <input type="text" name="total" class="form-control" value="<?=$data['jumlah'] * $data['harga'] ?>" readonly>  
            </div>
                <div class="form-group">
                    <label>Uang pelanggan</label>
                    <input type="number" name="bayar" class="form-control">
                </div>  
                <input class="btn btn-sm btn-primary" type="submit" name="simpan" value="Simpan">
            </div>
            </form>
            </div>

                <br/>
                <div class="row">
                <?php
                if(isset($_POST['simpan'])){
                    $total =$_POST['total'];
                    $bayar =$_POST['bayar'];
                    //kembalian
                    if($bayar < $total){
                        ?>
                        <div class="alert alert-danger">Nominal Uang Kurang!</div>
                        <?php
                    }else{
                        $kembalian = $bayar - $total; 
                        $sql_insert ="INSERT INTO transaksi SET 
                        idtransaksi='$kodetransaksi',
                        idpesanan='$idpesanan',
                        total='$total',
                        bayar='$bayar',
                        kembalian='$kembalian'";
                        $query_insert = mysqli_query($koneksi, $sql_insert);
                        if($query_insert){
                            //mengubah status dari pesanan jadi lunas
                            $update= "UPDATE pesanan SET status='2' WHERE idpesanan='$idpesanan'";
                            $query_update = mysqli_query($koneksi, $update);
                            //jika dijalankan maka akan menampilkan kembalian
                            if($query_update){
                                ?>
                                <div class="col-md-6">
                                <p>Uang kembalian : <?= $kembalian?></p>
                                <span><a href="page/struk.php?idtransaksi=<?=$kodetransaksi?>">Cetak</a></span>
                                </div>
                                <?php
                            }
                        }
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>