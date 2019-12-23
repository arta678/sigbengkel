<?php
session_start();
$title = "Data Bengkel";
include 'config.php';
$dataBengkel = query("SELECT * FROM bengkel");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?= $title ?></title>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/simple-sidebar.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <div class="d-flex" id="wrapper">
      <?php include 'sidebar.php'; ?>
      <div id="page-content-wrapper">
        <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
          <button class="btn btn-light" id="menu-toggle"><span class="navbar-toggler-icon"></span></button>
        </nav>
        <div class="container-fluid">
          <h2 class="mt-3 mb-3"><?= $title ?></h2>
            <a href="tambahBengkel.php"><button type="button" class="btn btn-info">Tambah</button></a>
          <table class="table table-striped mt-3 table-sm">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Nama Bengkel</th>
                <th scope="col">Pemilik</th>
                <th scope="col">Nomor Hp</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              
                <?php $i=1; ?>
                <tr>
                <?php foreach ($dataBengkel as $baris) {?>
                    <th scope="row"><?= $i ?></th>
                    <td><?= $baris["nama_bengkel"]; ?></td>
                    <td><?= $baris["pemilik"]; ?></td>
                    <td><?= $baris["hp"]; ?></td>
                    <td><a href="editBengkel.php?id=<?= $baris["id"]; ?>"><button class="btn btn-info" type="button">Edit</button></a></td>
                    <?php $i++ ?>
                    </tr>
              <?php   } ?>
                
             
            </tbody>
          </table>
          
        </div>
      </div>
    </div>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

      <script>
      $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
      });

      </script>
   </body>
</html>