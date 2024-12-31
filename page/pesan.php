<?php
//<!--membuat idpelangan otomatis di ?p= pesan & mencari maxKode id Pelanggan-->
    $sql = "SELECT max(idpelanggan) as maxKode FROM 
        pelanggan";
    $query = mysqli_query($koneksi, $sql);
    //ambil data
    $data = mysqli_fetch_array($query);
    //ambil data maxKodenya
    $idpelanggan = $data['maxKode'];
    //bikin nomor urut
    $noUrut = (int) substr($idpelanggan,3,3);
    $noUrut++;
    //bikin kata depan pada idpelanggan
    $char ="PLG";
    //kode pelanggan
    $kodePelanggan = $char . sprintf("%03s", $noUrut);
?>  
<div class="row">
    <center>
    <h2>Pesanan</h2>
    </center>
    <div class="col-lg-5">
        <div class="panel panel-primary">
            <div class="panel-heading">Input pesanan</div>
            <div class="panel-body">
                <form action="" method="post">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>ID Pelanggan</label>
                        <input type="text" name="idpelanggan" class="form-control" readonly="readonly" value="<?= $kodePelanggan?>">
                    </div>

                    <div class="form-group">
                        <label>Nama Pelanggan</label>
                        <input type="text" name="namapelanggan" class="form-control" >
                    </div>

                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <select name="jeniskelamin" class="form-control">
                            <option value=""> --- Jenis kelamin --- </option>
                            <option value="L">Laki-Laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>No Telpon</label>
                        <input type="number" name="nohp" class="form-control">    
                    </div>

                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea name="alamat" class="form-control"></textarea>   
                    </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Menu</label>
                            <select name="idmenu" class="form-control">
                                <option value=""> - Pilih Menu - </option>
                                <?php
                                    $sql_menu ="SELECT * FROM menu";
                                    $query_menu = mysqli_query($koneksi, $sql_menu);
                                    while($menu = mysqli_fetch_array($query_menu)){
                                        ?>
                                            <option value=" <?= $menu['idmenu']?>"> <?=$menu['namamenu']?> </option>
                                        <?php
                                    }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Jumlah</label>
                            <input type="number" name="jumlah" class="form-control">
                        </div>

                        <div class="form-group">
                            <input type="submit" name="simpan" class="btn btn-md btn-primary" value="Simpan">
                        </div>
                    
                </div>
                </form>  
            
            </div>
            <?php
                if(isset($_POST['simpan'])){
                    $idpelanggan = $_POST['idpelanggan'];
                    $namapelanggan = $_POST['namapelanggan'];
                    $jeniskelamin = $_POST['jeniskelamin'];
                    $nohp = $_POST['nohp'];
                    $alamat = $_POST['alamat'];
                    $idmenu = $_POST['idmenu'];
                    $jumlah = $_POST['jumlah'];

                    $sql_pelanggan = "INSERT INTO pelanggan SET
                    idpelanggan='$idpelanggan',
                    namapelanggan='$namapelanggan',
                    jeniskelamin='$jeniskelamin',
                    nohp='$nohp',
                    alamat='$alamat'";
                    $query_input =mysqli_query($koneksi, $sql_pelanggan);
                    if($query_input){

                        $sql_pesanan = "INSERT INTO pesanan SET
                        idmenu='$idmenu',
                        idpelanggan='$idpelanggan',
                        jumlah='$jumlah',
                        iduser='$iduser',
                        status='0'";
                        $query_pesan = mysqli_query($koneksi, $sql_pesanan);
                    if($query_pesan){
                        ?>
                        <!--Melakukan reflesh menggunakan js ketika sudah sudahberhasil-->
                        <script type="text/javascript">
                                    window.location.href="?p=pesan";
                        </script>
                        <!--<div class="alert alert-success">Berhasil menyimpan!</div>-->
                        <?php
                    }else{
                        ?>
                        <div class="alert alert-danger">Gagal menyimpan!</div>
                        <?php
                    }
                    }else{
                        ?>
                        <div class="alert alert-danger">Gagal menyimpan!</div>
                        <?php
                    }
                }
            ?>     
        </div>
    </div>

    <div class="col-lg-7">
        <div class="panel panel-default">
            <div class="panel-heading">
                Daftar pesanan hari ini
            </div>
            <div class="panel-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>Nama pelanggan</th>
                            <th>Menu</th>
                            <th>Jumlah</th>
                            <th>Status</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <!--menampilkan data pesanan yang ada dipesanan menggunakan tbody-->
                    <tbody>
                        <?php
                            $d_pesanan = "SELECT * FROM pesanan 
                            left join pelanggan on pelanggan.idpelanggan= pesanan.idpelanggan
                            left join menu on menu.idmenu = pesanan.idmenu";
                            $d_query = mysqli_query($koneksi, $d_pesanan);
                            $cek = mysqli_num_rows($d_query);
                            if($cek > 0){
                                $no = 1;
                                while($data_d = mysqli_fetch_array($d_query)){
                                    ?>
                                    <tr>
                                        <td><?=$no++ ?></td>
                                        <td><?=$data_d['namapelanggan']?></td>
                                        <td><?=$data_d['namamenu']?></td>
                                        <td><?= $data_d['jumlah']?></td>
                                        <td>
                                            <?php
                                                if($data_d['status'] == '0'){
                                                    echo "<label class='label label-primary'>Belum</label>";
                                                }else if ($data_d['status'] == '1'){
                                                    echo "<label class='label label-success'>Sudah</label>";
                                                }else{
                                                    echo "<label class='label label-info'>Lunas</label>";
                                                }
                                            ?>
                                        </td>
                                            <td>
                                            <!--menambahkan buttun sudah dilayani apa tidak dan harus menambahkan file tandai-->
                                            <a onclick="return confirm('Yakin pesanan sudah diterima ke pelanggan?')" href="page/tandai.php?idpesanan=<?= $data_d['idpesanan']?>" class="btn btn-sm btn-primary">Tandai</a>
                                            </td>
                                    </tr>
                                    <?php     
                                }
                                ?><?php
                            }else{
                                ?>
                                <tr>
                                    <td colspan="6">Tidak ada data!</td>
                                </tr>
                                <?php
                            }
                           
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>