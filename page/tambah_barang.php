<div class="row">
    <h2>Tambah Menu</h2>
    <div class="col-lg-4">
        <form action="" method="post" class="form">
            <div class="form-group">
            <label>Nama Menu</label>
            <input type="text" name="namamenu" class="form-control" placeholder="Masukkan nama menu">
            </div>

            <div class="form-group">
                <label>Harga</label>
                <input type="number" name="harga" class="form-control">
            </div>

            <div class="form-group">
                <input type="submit" name="simpan"  class="btn btn-md btn-primary" value="Simpan">
                <a href="?p=list_barang" class="btn btn-md btn-default">Kembali</a>
            </div>
        </form>

            <?php
                if(isset($_POST['simpan'])){
                    //echo "string";
                    $namamenu = $_POST['namamenu'];
                    $harga    = $_POST['harga'];
                    $sql      = "INSERT INTO menu SET namamenu='$namamenu', harga='$harga'";
                    $query    = mysqli_query($koneksi, $sql);
                    if($query){
                        ?>
                        <div class="alert alert-success">Berhasil Menambah Menu!</div>
                        <?php
                    }else{
                        ?>
                        <div class="alert alert-danger">Gagal Menambah Menu!</div>
                        <?php
                    }
                }
            ?>

    </div>
</div>