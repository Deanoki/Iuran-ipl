<?php
include ('koneksi.php');

$array = array(
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
'Desember'
);
$res = mysqli_query($koneksi, "SELECT * FROM pembayaran Order BY bulan_dibayar && tgl_bayar && ket");

$no = 1;

echo "<table>";
echo "<tr><th>Bulan</th><th>Tanggal bayar</th><th>keterangan</th></tr>";
while($row = mysqli_fetch_assoc($res)){
    $totalArray = count($array) ;
    for($i=0; $i<=$totalArray; $i++){
    if(in_array($row['bulan_dibayar'], $array)){
        echo "<tr><td>" . $array[$i] . "</td><td>". $row['tgl_bayar'] ."</td><td>". $row['ket'] ."</td></tr>";
    }else{
        echo "<tr><td>" . $row['bulan_dibayar'] . "</td><td>" ."</td><td>"."</td></tr>";
    }
}
}

echo "</table>";

mysqli_close($koneksi);

