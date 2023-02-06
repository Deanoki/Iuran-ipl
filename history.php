<?php
    include('koneksi.php'); //agar index terhubung dengan database, maka koneksi sebagai penghubung harus di include

?>
<!DOCTYPE html>
<html>
<head>
    <title>Riwayat Transaksi</title>

</head>
<body>

    <?php

    include ('tampilan/header.php');
    include ('tampilan/footer.php');
    include ('tampilan/sidebar.php');
?>

    <!-- main content -->
    <div class="main-content bg-primary">
        <section class="section">
          <div class="section-header">
            <h1>HISTORY</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="history.php">History</a></div>
            </div>
        </div>
        <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <h4>History Pembayaran</h4>
                    <div class="card-header-form">
                    </div>
                  </div>
                  <?php
                    $user = $_SESSION['username'];
                    $query= mysqli_query($koneksi, "SELECT nama_petugas FROM petugas where username = '$user'");
                    $row = mysqli_fetch_assoc($query);
                  ?>
        <!-- <form action="" method="get">
                      <table class="table">
                      <tr>
                      <td>NIK</td>
                      <td>:</td>
                      <td>
                      <input class="form-control" type="text" name="nik" placeholder="-- Masukan NIK Anda --">
                      </td>
                      <td>
                      <button class="btn btn-success" type="submit" name="cari">Cari</button>
                      </td>
                      </tr>

                      </table>
                      </form> -->
                <?php 
                // if (isset($_GET['nik']) && $_GET['nik']!='') {
                  $query = mysqli_query($koneksi, "SELECT warga. *,unit.*,petugas. * FROM warga,unit,petugas WHERE warga.id_unit = unit.id_unit && petugas.nik = warga.nik  AND username = '$user'");
                  $data = mysqli_fetch_array($query);
                  $nik = $data['nik'];
                
                // ?>
                
                <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Data Warga</h4>
                    <div class="card-header-form">
                    </div>
                  </div>
                <table class="table table-striped">
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
                        <th scope="col">id petugas</th>
                        <th scope="col"> Tanggal Bayar</th>
                        <th scope="col">Bulan Bayar</th>
                        <th scope="col">Tahun</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Keterangan</th>                
                    </tr>
                </thead>

                <tbody>
                <?php 
                    $query = mysqli_query($koneksi,"SELECT * FROM pembayaran WHERE id_pembayaran && nik = '$nik' ");
                    while ($data=mysqli_fetch_array($query)) {
                        echo" 
                        <tr>                          
                          <td>$data[id_petugas]</td>
                          <td>$data[tgl_bayar]</td>
                          <td>$data[bulan_dibayar]</td>
                          <td>$data[tahun]</td>
                          <td>$data[biaya]</td>
                          <td>$data[ket]</td>
                        </tr>";
                  }
                ?>

                </tbody>

              </table>  
                
    
        
        </div>
  </body>
</html>