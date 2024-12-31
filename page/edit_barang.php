<!--Menangkap dari list barang yang icon edit-->
<?php
    @$idmenu = $_GET['idmenu'];
    if(empty($idmenu)){
        ?>
        <script type="text/javascript">
            window.location.href="?p=list_barang";
        </script>
        <?php
     }
    $sql = "SELECT * FROM menu WHERE idmenu='$idmenu'";
    $query = mysqli_query($koneksi, $sql);
    $cek = mysqli_num_rows($query);
        if($cek > 0){
            $data = mysqli_fetch_array($query);
        }else {
            $data = NULL;
        }
?>

<div class="row">
    <h2>Edit Menu</h2>
    <div class="col-lg-4">
        <form class="form" action="" method="post">
            <div class="form-group">
            <label>Nama Menu</label>
            <input type="text" name="namamenu" class="form-control" placeholder="Masukkan nama menu" value="<?= $data['namamenu']?>">
            </div>

            <div class="form-group">
                <label>Harga</label>
                <input type="number" name="harga" class="form-control" value="<?= $data['harga']?>">
            </div>

            <div class="form-group">
                <input type="submit" name="simpan"  class="btn btn-md btn-primary" value="Simpan">
                <a href="?p=list_barang" class="btn btn-md btn-default">Kembali</a>
            </div>
        </form>

        <?php
        if(isset($_POST['simpan'])){
            $namamenu = $_POST['namamenu'];
            $harga = $_POST['harga'];
            $sql_update = "UPDATE menu SET namamenu='$namamenu', harga='$harga' WHERE idmenu='$idmenu'";
            $q = mysqli_query($koneksi, $sql_update);
            if ($q){
                ?>
                   <!--<div class="alert alert-success">Berhasil diubah</div>-->
                    <script type="text/javascript">
                         window.location.href="?p=list_barang";
                    </script>
                <?php
            }else {
                ?>
                <div class="alert alert-danger">Gagal diubah</div>
                <?php
            }
        }
        ?>
    </div>
</div>