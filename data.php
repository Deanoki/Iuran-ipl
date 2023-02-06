<?php
include('koneksi.php');
include('tampilan/header.php');
include('tampilan/footer.php');

?>

<table class="table table-striped ">
                <thead>
                    <tr>
                        <!-- <th scope="col">Id Pembayaran</th> -->
                        <th scope="col"> NO</th>
                        <th scope="col">Bulan</th>
                        <th scope="col"> Tanggal Bayar</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Keterangan</th>                
                        <th scope="col">Aksi</th>                
                    </tr>
                </thead>

                <tbody>
                <?php
                    $urutan_bulan = array(
                        'Januari',
                        'Februari',
                        'Maret',
                        'April',
                        'Mei',
                        'Juni',
                        'Juli',
                        'Agustus',
                        'September',
                        'Oktober',
                        'November',
                        'Desember',
                    );
                ?>
                 <?php
                    $totalArray = count($urutan_bulan);

                ?>
                
                <?php 
                    $query = mysqli_query($koneksi,"SELECT * FROM pembayaran WHERE id_pembayaran ORDER BY tgl_bayar");

                    $no = 1;
                    $data = mysqli_fetch_assoc($query)
                ?>
                <?php
                    for($i=0; $i<$totalArray; $i++){
                ?>
                <?php
                    if($data['tgl_bayar'] !== ""){

                        $ket = "";
                    }else{
                        $ket = $data['ket'];
                    }
                ?>
                              
                    <tr>
						<td><?php echo $no ?></td>
                        <td><?php echo $urutan_bulan[$i];?></td>
                        <td><?php echo $data['tgl_bayar']; ?></td>
						<td><?php echo $data['biaya']; ?></td>
						<td><?php echo $ket;?></td>
                        <td><a href="Api/wa_api.php" class="btn"><img src="img/avatar/wa1.png" alt="Kirim Whatsapps" style="width: 24px; height: 24px; border:2px;" ></i></a></td>
					</tr>
                <?php                 
                    $no++;
                    }
                ?>
                   

                </tbody>

              </table>