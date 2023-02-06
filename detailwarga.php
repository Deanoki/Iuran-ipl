<?php
    //agar index terhubung dengan database, maka koneksi sebagai penghubung harus di include
    include('koneksi.php'); 

    //mengecek apakah di url ada nilai GET id
    if (isset($_GET['id'])) {
        // ambil nilai id dari url dan disimpan dalam variabel $id
        $id = ($_GET['id']);

        // menampilkan data dari database yang mempunyai id=$id
        $query = "SELECT warga.*,unit.* FROM warga,unit WHERE warga.id_unit = unit.id_unit && nik = '$id'";
        $res = mysqli_query($koneksi, $query);

        //jika data gagal diambil maka akan tampil error berikut
        if (!$res) {
            die("Query Error : " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
        }

        // mengambil data dari database
        $data = mysqli_fetch_assoc($res);

        // apabila data tidak ada pada database maka akan dijalankan perintah ini
        if (!count($data)) {
            # code...
            echo "<script>alert('Data tidak ditemukan pada database'); window.location='warga.php';</script>";
        }
    } else {
        # code...
        // apabila tidak ada data GET id pada akan di redirect ke index.php
        echo "<script>alert('Masukkan data id.'); window.location='warga.php';</script>";
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Warga</title>
</head>
<body>          
    <?php
        include('tampilan/header.php');
        include('tampilan/sidebar.php');
        include('tampilan/footer.php');
    ?>

     <!-- Main Content -->
  <div class="main-content bg-primary">
    <section class="section">
      <div class="section-header">
        <h1>DATA WARGA</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="dashboard.php">Dashboard</a></div>
          <div class="breadcrumb-item active"><a href="warga.php">Data Warga</a></div>
          <div class="breadcrumb-item text-primary">Detail Warga</div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4>DETAIL WARGA</h4>
            </div>
              <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Data Warga</h4>
                        <div class="card-header-form">
                    </div>
                </div>
              <table class="table table-striped ">
                <thead>
                  <tr>
                      <th scope="col">NIK</th>
                      <th scope="col">NAMA WARGA</th>
                      <th scope="col">NAMA BLOCK</th>
                      <th scope="col">NO UNIT</th>
                  </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $data['nik']; ?></td>
                        <td><?php echo $data['nama']; ?></td>
                        <td><?php echo $data['nama_block']; ?></td>
                        <td><?php echo $data['nama_unit']; ?></td> 
                    </tr>  
                </tbody>
              </table>
              
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Data IPL Warga</h4>
                        <div class="card-header-form">
                    </div>
                </div>
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
                    $query = mysqli_query($koneksi,"SELECT * FROM pembayaran WHERE id_pembayaran And nik='$id' ORDER BY tgl_bayar");

                    $no = 1;
                    while($data = mysqli_fetch_assoc($query)) {
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
                }
                ?>
                   

                </tbody>

              </table>

           

          </div>
                

        </table>
</body>
</html>