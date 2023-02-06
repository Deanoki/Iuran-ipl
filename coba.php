<?php
include ('koneksi.php');

$urutan_bulan = [
   '01' => 'Januari',
   '02' => 'Februari',
   '03' => 'Maret',
   '04' => 'April',
   '05' => 'Mei',
   '06' => 'Juni',
   '07' => 'Juli',
   '08' => 'Agustus',
   '09' => 'September',
   '10' => 'Oktober',
   '11' => 'November',
   '12' => 'Desember',
];

echo $urutan_bulan['02']; 
echo $urutan_bulan['01'];
/* 
Regular Sort Function: 
ape apple banana elephant eye picnic pie zoo 
*/
/*
$awaltempo = date('Y-m-d');
    for ($i=0; $i++){
        // tanggal jatuh tempo setiap tanggal 10
        $jatuhtempo = date("Y-m-d", strtotime("+$i month" , strtotime($awaltempo)));
    }
*/
?>

<option value="not_option">
                            Silahkan Pilih Petugas
                        </option>
                        <?php
                            // jalankan query untuk menampilkan semua data diurutkan berdasarkan
                            $user = $_SESSION['username'];
                            $query = "SELECT id_petugas FROM petugas where username = '$user' ";
                            $result = mysqli_query($koneksi,$query);
                            //mengecek apakah ada error ketika menjalankan query
                            if (!$result) {
                                die("Query Error: " . mysqli_errno($koneksi) .
                                  " - " . mysqli_error($koneksi));
                              }

                                //buat perulangan untuk element tabel dari data mahasiswa
                                $no = 1; //variabel untuk membuat nomor urut
                                // hasil query akan disimpan dalam variabel $data dalam bentuk array
                                // kemudian dicetak dengan perulangan while
                                while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <option value="<?php echo $row['id_petugas'];?>">
                            <?php
                            echo $row['id_petugas'];
                            ?>
                        </option>
                        <?php
                            $no++;  //untuk nomor urut terus bertambah 1
                                }
                        ?>      
                        ?>

<!-- AJAX.PHP -->
// // variable nik yang dikirimkan form.php
// $nik = $_GET['nik'];

// //mengambil data
// $query = mysqli_query($koneksi, "SELECT * FROM warga where nik = '$nik'");
// $warga = mysqli_fetch_array($query);
// $data = array(
//     'nama' =>@$warga['nama'],
//     'id_unit' =>@$warga['id_unit'],
//     'alamat' =>@$warga['alamat'],
//     'no_telpon' =>@$warga['no_telpon'],
//     );

// //tampil data
// echo json_encode($data);
?>

<table border="2">
    <tr>
        <th align="center" >No</th>
        <th align="center">Bulan</th>
        <th align="center">Tanggal Bayar</th>
        <th align="center">jumlah</th>
        <th align="center">Keterangan</th>
    </tr>
    <tbody>
   

<?php
    if(in_array($row['bulan_dibayar'], $array)){
        $tgl_bayar = $row['tgl_bayar'];
        $ket = $row['ket'];
    } else{
        $tgl_bayar = "";
        $ket = "";
    }
?>
    <tr>
        <td align="center"><?php echo $no ?></td>
        <td align="center"><?php $array ?></td>
        <td align="center"><?php echo $tgl_bayar; ?></td>
        <td align="center"><?php echo $row['biaya']; ?></td>
        <td align="center"><?php echo $ket; ?></td>
	</tr>

    <?php
        $no++;
    ?>
    </tbody>
</table>