<div class="col-lg-8">
    <div class="panel panel-default">
        <div class="panel-heading">Data pesanan yang belum lunas</div>
                                <!-- tapi sudah dilayani-->
        <div class="panel-body">
            <table class="table table-bordered table.striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pelanggan</th>
                        <th>Menu</th>
                        <th>Jumlah</th>
                        <th>Status</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <!--membuat table transaksi -->
                <tbody>
                  <?php
                   $d_pesanan = "SELECT * FROM pesanan 
                   left join pelanggan on pelanggan.idpelanggan= pesanan.idpelanggan
                   left join menu on menu.idmenu = pesanan.idmenu WHERE pesanan.status = '1'";
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
                                   <a href="?p=detail_transaksi&idpesanan=<?= $data_d['idpesanan']?>" class="btn btn-sm btn-primary">Proses</a>
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