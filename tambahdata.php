<?php
include 'koneksidb.php';
session_start();

if (isset($_POST['logout'])) {
session_destroy();
header("Location: index.php");
exit();
}

if (isset($_POST['submit'])) {
    $latitude = $_POST['latitude'];
    $logitude = $_POST['longitude']; 
    $tanggal = $_POST['tanggal'];  
    $kabupaten = $_POST['kabupaten'];
    $alamat = $_POST['alamat'];
    $kondisi = $_POST['kondisi'];
    $keterangan = $_POST['keterangan'];
    $foto = $_FILES['foto']['name'];
    $rand = rand();
    $id_user = 2;
    $status = 1;
    
   $fotodb = $rand.'_'.$foto;   
move_uploaded_file($_FILES['foto']['tmp_name'], 'foto/'.$rand.'_'.$foto);
$sql = "INSERT INTO data_jalan (id_user, latitude, longitude, tanggal, id_kabupaten, alamat, kondisi_jalan, keterangan, foto, status)
VALUES ('$id_user','$latitude', '$logitude', '$tanggal', '$kabupaten', '$alamat', '$kondisi', '$keterangan', '$fotodb', '$status')";
mysqli_query($db, $sql);

$message = 'Data Berhasil Di Tambahkan';
echo "<SCRIPT> //not showing me this
        alert('$message')
        window.location.replace('tabeldata.php');
    </SCRIPT>";
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

    <title>SIG Kerusakan Jalan</title>

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
        #map { height: 300px;
                width: 100%;
        }
        </style>

 

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Dashboard</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="dashboard.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">


            <!-- Heading -->
            <div class="sidebar-heading">
                Addons
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Data Lokasi</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="tambahdata.php">Tambah Data Lokasi</a>
                        <a class="collapse-item" href="tabeldata.php">Tabel Lokasi</a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Data Laporan</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#collapseTwo">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="daftarlaporan.php">Daftar Laporan</a>
                        <a class="collapse-item" href="datauser.php">Data User</a>
                       
                    </div>
                </div>
            </li>

 


            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    
                  
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
 <!-- Sidebar NAME (Topbar) -->
 <h3 class="m-0 font-weight-bold text-primary"> SIG KERUSAKAN JALAN </h3>

                   

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                    

                 
                        <div class="topbar-divider d-none d-sm-block"></div>

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
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                                </div>
                           
                            <?php } elseif ($level=='admin') {?>
                                

                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">

                                <a class="dropdown-item" href="index.php">
                                    <i class="fas fa-home fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Home
                                </a>
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

                 


           
                    <!-- card -->
                    <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Tambah Data</h6>
                                </div>
                                <div class="card-body">
                                <div id="map" class='col-sm-0'></div>
                                <script>  var map = L.map('map').setView([-7.8030634,110.3229557], 12);
                                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

                                    var marker = null;

                                    function onMapClick(e) {
                                    if (marker !== null) {
                                    map.removeLayer(marker);
                                        }


                                        marker = new L.Marker(e.latlng);
                                        map.addLayer(marker);
                                        marker.bindPopup("<Center><b>Latidue dan Longitude:</b><br/></Center>"+ e.latlng.toString());
                                        
                                        
                                        

                                        var lat = e.latlng.lat;
                                        var lng = e.latlng.lng;

                                        $('#Latitude').val(lat);
                                        $('#Longitude').val(lng);
                                        
                                    }

                                    map.on('click', onMapClick);

                                </script>
                                <br>
                                 <form action="" method="POST" enctype="multipart/form-data">
                                 <label for="latlng"><b>Latitude & Longitude</b></label>
                                 <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="text" class="form-control form-control-user" id="Latitude" name="latitude" placeholder="Latitude"></div>
                                    <div class="col-sm-6">
                                    <input type="text" class="form-control form-control-user" id="Longitude" name="longitude" placeholder="Longitude"></div>
                                    </div>
                                    
                                    <label for="exampleFormControlInput1"><b>Tanggal,Waktu & Kabupaten</b></label>
                                    <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="datetime-local" class="form-control form-control-user" name="tanggal" id="tanggal"></div>
                                    <div class="col-sm-6">
                                    <select class="form-control form-control-user" name="kabupaten" placeholder="Kabupaten">
                                    <option value="1">1. Sleman</option>
                                    <option value="2">2. Bantul</option>
                                    <option value="3">3. Gunung Kidul</option>
                                    <option value="4">4. Kota Yogyakarta</option>
                                    <option value="5">5. Kulonprogo</option>
                                    </select></div></div>
                                    
                                    <label for="lokasi"><b>Lokasi</b></label>
                                    <div class="form-group">
                                    <input type="text" class="form-control form-control-user" name="alamat" placeholder="Lokasi"></div><div class="col-sm-2 "></div>
                                    <label for="exampleFormControlInput1"><b>Kondisi dan Keterangan</b></label><div class="form-group row">
                                    <div class="col-sm-4 mb-3 mb-sm-0">
                                    <label><input type="radio" name="kondisi" id="optionsRadios1" value="rusak ringan" checked="">&nbsp;&nbsp;Rusak Ringan</label><br>
                                    <label><input type="radio" name="kondisi" id="optionsRadios2"  value="rusak berat">&nbsp;&nbsp;Rusak Berat</label><br>
                                    <label><input type="radio" name="kondisi" id="optionsRadios3"  value="berbahaya">&nbsp;&nbsp;Berbahaya Dilalui</label><br>
                                    
                                    <label><input type="file" name="foto"></label>
                                   
                                </div>
                                    <div class="col-sm-8">
                                    <textarea class="form-control" rows="5" name="keterangan" placeholder="Keterangan"></textarea>

                                     </div>
                                      </div>     
                                      
                                      <div class="form-group row" ><div class="col-sm-3"><input type="submit" name="submit" class="btn btn-primary rounded-pill "></div></div>
                                    


                                </form>
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
                        <span>SKRIPSI &copy; Dhani Aprilaksana Jati</span>
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

    <!-- Bootstrap core JavaScript-->
    <script> $('#tanggal').datepicker({
        "setDate": new Date(),
        "autoclose": true
});</script>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>