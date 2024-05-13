<?php
include 'koneksidb.php';
session_start();

if (isset($_POST['logout'])) {
session_destroy();
header("Location: index.php");
exit();
}


?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SIG</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">


<link rel="stylesheet" type="text/css" href="https://unpkg.com/leaflet@1.3.3/dist/leaflet.css">
<script src='https://unpkg.com/leaflet@1.3.3/dist/leaflet.js'></script>
  <style type="text/css">
        #mapid { height: 500px; }
        </style>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
     crossorigin=""/>
     <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
     integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
     crossorigin=""></script>
     <style type="text/css">
        #maplapor { height: 300px; 
        
        }
        </style>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>



</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar NAME (Topbar) -->
                     <h3> SIG KERUSAKAN JALAN </h3>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        

                        
                        
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php if(isset($_SESSION['nama'])){echo $_SESSION['nama'];}else{echo "Login ?";} ?></span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <?php if (isset($_SESSION['level'])){ $level = $_SESSION['level']; if ($level=='user'){ ?>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="index.php">
                                    <i class="fas fa-home fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Home
                                </a>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                                </div>
                           
                            <?php } elseif ($level=='admin') {?>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="dashboard.php">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Dashboard
                                </a>
                    
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                                <?php }} else { ?>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                            aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="login.php" >
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    login
                                </a>
                            <?php } ?>
                           
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="card shadow mb-4">
                        <div class="card-header text-center py-3">
                        <ul class="nav justify-content-center nav-pills" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-maps-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Maps</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-statistik-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Statistik</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-lapor-tab" data-toggle="pill" href="#pills-lapor" role="tab" aria-controls="pills-contact" aria-selected="false">Lapor</a>
                        </li>
                        </ul>
                
                    </div>


  <div class="card-body tab-content" id="pills-tabContent">


                            
 <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        <div id="mapid"></div>
                

</div>

<div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
<div style="margin: 0px auto;">
<canvas id="myChart" ></canvas>
</div>

                           

</div>

<div class="tab-pane fade" id="pills-lapor" role="tabpanel" aria-labelledby="pills-lapor-tab">
    <div>
<?php if(!isset($_SESSION['level'])) {  ?>
    <h4 class="m-0 text-center font-weight-bold text-primary"> Please Login First </h4>

    <h4 class="m-0 text-center font-weight-bold text-primary"> <a href="login.php">Click here... </a></h4>
</div>
    <?php }else {  ?>   
        <h4 class="m-0 text-center font-weight-bold text-primary"> History Laporan </h4><br>

        <a type="button" class="btn btn-primary" href="tambahdatauser.php">Buat Laporan</a>        <br><br>
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead><tr>
                                    <th width="5%">No</th>
                                    <th width="16%">Tanggal Laporan</th>
                                    <th>Keterangan</th>
                                    <th width="16%">Lokasi</th>
                                    <th width="16%">Status</th>
                                    </tr></thead>
                                    <tfoot><tr>
                                    <th width="5%">No</th>
                                    <th width="16%">Tanggal Laporan</th>
                                    <th>Keterangan</th>
                                    <th width="16%">Lokasi</th>
                                    <th width="16%">Status</th>
                                    </tr></tfoot>
                                    <tbody>
                                    <?php

                                    $id_u = $_SESSION['id_user'];

                                    $result = mysqli_query($db, "SELECT * FROM data_jalan 
                                    WHERE id_user = $id_u"); $i=1;
                                    while($data_jalan = mysqli_fetch_array($result)) { ?>
                                    <tr><td><?php echo $i; $i++; ?></td>
                                    <td><?php echo $data_jalan['tanggal'];?></td>
                                    <td><?php echo $data_jalan['keterangan'];?></td>
                                    <td><?php echo $data_jalan['alamat'];?></td>
                                    <td><?php if ($data_jalan['status']=='1') {echo "Diterima";}else{echo "Pending";};?></td>
                                    
                                    </form>
                                    <?php } ?></tbody>
                                    </table>
                                


    <?php } ?>

    </div>
   
  


                        </div>
                   
                    </div>
                    
                </div>
                <!-- /.container-fluid -->
               

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Skripsi &copy; Dhani Aprilaksana Jati</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="test"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Logout</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Yakin Keluar dari akun ini ?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <form action="" method="POST">
                    <button name="logout"  class="btn btn-primary">Logout</button>
                    </from>
                </div>
            </div>
        </div>
    </div>
  

     <!-- buat lapor Modal-->
     <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Buat Laporan</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body"> 

                <div id="maplapor"></div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <form action="" method="POST">
                    <button name="logout"  class="btn btn-primary">Logout</button>
                    </from>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
<script> 
                            var mymap = L.map('mapid').setView([-7.8030634,110.3229557], 11);
                            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(mymap);
            

            <?php 
            include("koneksidb.php");
            $result = mysqli_query($db, "SELECT * FROM data_jalan 
            WHERE status=1");
            while($data_lokasi = mysqli_fetch_array($result)) { ?>
            L.marker([<?php echo $data_lokasi['latitude'];?>,<?php echo $data_lokasi['longitude'];?>]).addTo(mymap)
            .bindPopup('<Center><b>Lokasi:</b><br><?php echo $data_lokasi['alamat'];?><br><b>Keterangan:</b><br><?php echo $data_lokasi['keterangan'];?><br><br><a href="detail.php?id=<?php echo $data_lokasi['id']; ?>" class="btn btn-primary rounded-pill">Detail</a>');
            <?php } ?>

</script>



<script> 

            var mapl = L.map('maplapor').setView([-7.8030634,110.3229557], 11);
    
  
 
            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(mapl);


$('#exampleModal').on('shown.bs.modal', function (event) {
  setTimeout(function() {
    map.invalidateSize();
  }, 10);
 });


</script>
<script>
        <?php include("koneksidb.php"); ?>
        var ctx = document.getElementById("myChart").getContext('2d');
        var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
        labels: ["Sleman", "Bantul", "Gunung Kidul", "Kota Yogyakarta","Kulon Progo"],
        datasets: [{
        label: '',
        data: [
        <?php
        $sleman = mysqli_query($db,"select id_kabupaten from data_jalan where id_kabupaten=1 and status=1");
        echo mysqli_num_rows($sleman);
        ?>,
        <?php
        $bantul = mysqli_query($db,"select id_kabupaten from data_jalan where id_kabupaten=2 and status=1");
        echo mysqli_num_rows($bantul);
        ?>,
        <?php
        $gk = mysqli_query($db,"select id_kabupaten from data_jalan where id_kabupaten=3 and status=1");
        echo mysqli_num_rows($gk);
        ?>,
        <?php
        $ky = mysqli_query($db,"select id_kabupaten from data_jalan where id_kabupaten=4 and status=1");
        echo mysqli_num_rows($ky);
        ?>
        ,<?php
        $kp = mysqli_query($db,"select id_kabupaten from data_jalan where id_kabupaten=5 and status=1");
        echo mysqli_num_rows($kp);
        ?>
        ],
        backgroundColor: [
        'rgba(255, 99, 132, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)'
        ],
        borderColor: [
        'rgba(255,99,132,1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)'
        ],
        borderWidth: 1}]
        },
        options: {
        scales: {
        yAxes: [{
        ticks: {
        beginAtZero:true
        }
        }]
        }
        }
        });

</script>



  

</body>

</html>