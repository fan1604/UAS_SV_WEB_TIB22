<h2>Daftar Barang</h2>
<br>

<a class="btn btn-primary btn-md" href="?p=tambah_barang"> <span class="glyphicon glyphicon-plus"></span> </a>
<!--ini fitur cari-->
<div style='float: right'>
<form class="form-inline" method="get">
    <input type="hidden" name="p" value="list_barang" >
    <input type="text" name="cari" class="form-control" placeholder="Cari disini">
   <button type="submit" class="btn btn-sm btn-primary"> <span class="glyphicon glyphicon-search"></span></button>
</form>
</div>

<br>
<!--ini bagian table-->
<table class="table table.striped table-bordered">
    <thead>
        <tr>
            <th>NO</th>
            <th>Nama Menu</th>
            <th>Harga</th>
            <th>Tanggal Ditambah</th>
            <th>Dirubah</th>
            <th>Opsi</th>
        </tr>
    </thead>
    <tbody>

    <?php
        //nangkap pencarian (name="cari")
        @$cari = $_GET['cari'];
        $q_cari = "";
            if(!empty($cari)){
                $q_cari="and namamenu like '%".$cari."%'";
            }
        //ini pembagian halaman 
        $pembagian = 5; 
        $page = isset($_GET['halaman']) ? (int) $_GET['halaman'] : 1;
        $mulai = $page > 1 ? $page * $pembagian - $pembagian : 0;

        $sql = " SELECT * FROM menu WHERE 1=1 $q_cari LIMIT $mulai, $pembagian";
        $query = mysqli_query($koneksi, $sql);
        $cek = mysqli_num_rows($query);
        //echo $cek;
        // cari total
        $sql_total = "SELECT * FROM menu";
        $q_total = mysqli_query($koneksi, $sql_total);
        $total = mysqli_num_rows($q_total);
        $jumlahhalaman = ceil($total / $pembagian);
        if($cek> 0){
            $no = $mulai + 1;
            while($data = mysqli_fetch_array($query)){
                
            ?>
                <tr>
                    <td> <?= $no++ ?></td>
                    <td> <?= $data ['namamenu']?> </td>
                    <td> <?= $data ['harga']?> </td>
                    <td> <?= $data ['created_at']?> </td>
                    <td> <?= $data ['updated_at']?> </td>
                        <td>
                            <!-- -->
                            <a class="btn btn-danger btn-sm" href="page/hapus_barang.php?idmenu=<?= $data['idmenu']?>" onclick="return confirm('Yakin anda hapus?')"> <span class="glyphicon glyphicon-trash"></span></a>
                            <a class="btn btn-info btn-sm" href="?p=edit_barang&idmenu=<?= $data ['idmenu']?>"> <span class="glyphicon glyphicon-edit"></span></a>
                        </td>
                </tr>
            <?php
            }
        }else{
            ?>
                <tr>
                    <td colspan="6">
                        Menu tidak ada!
                    </td>
                </tr>
            <?php
        }
    ?>
       <!--<tr>
            <th>1</th>
            <th>Geprek</th>
            <th>15000</th>
            <th>23-09-2024</th>
            <th>01-09-2024</th>
            <td>
                <a class="btn btn-danger btn-sm" href=""> <span class="glyphicon glyphicon-trash"></span></a>
                <a class="btn btn-info btn-sm" href=""> <span class="glyphicon glyphicon-edit"></span></a>
            </td>
        </tr>-->
    </tbody>
</table>
<!--table end-->
<div class="float-left">
    jumlah : <?=$total ?>
</div>

<div style="float: right;" class="">
<nav aria-label="Page navigation">
  <ul class="pagination">
    <li>
      <a href="?p=list_barang&halaman=<?= $page -1 ?>"  aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>

   <?php

        for ($i = 1; $i <= $jumlahhalaman; $i++){
            ?>
             <li class="<?= ($i == $_GET['halaman'] ? 'active' : '')
             ?>"><a href="?p=list_barang&halaman=<?=$i?>">
            <?= $i ?> </a></li>
        <?php
        }
    ?>
    <!--<li><a href="#">1</a></li>
    <li><a href="#">2</a></li>-->
    <li>
      <a href="?p=list_barang&halaman=<?= $page +1 ?>" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>
</nav>
</div>

