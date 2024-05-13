<?php
include 'koneksidb.php';
session_start();

if (isset($_POST['logout'])) {
session_destroy();
header("Location: index.php");
exit();
}

if (isset($_POST['acc'])) {
    $id_dt = $_POST['id_data'];
    $result = mysqli_query($db, "UPDATE data_jalan SET status='1' WHERE id=$id_dt");
    $message = 'Data berhasil di acc';

    echo "<SCRIPT> //not showing me this
        alert('$message')
        window.location.replace('daftarlaporan.php');
    </SCRIPT>";
    }

if (isset($_POST['hapus'])) {
$id_dt = $_POST['id_data'];
$result = mysqli_query($db, "DELETE FROM data_jalan WHERE id=$id_dt");
header("Location:daftarlaporan.php");
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
    
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.6/css/dataTables.bootstrap4.css" />
  
<script defer src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script defer src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script defer src="https://cdn.datatables.net/2.0.6/js/dataTables.js"></script>
<script defer src="https://cdn.datatables.net/2.0.6/js/dataTables.bootstrap4.js"></script>

    
    
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
     crossorigin=""/>
     <link href='https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.0.3/leaflet.css' rel='stylesheet'>
     <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
     integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
     crossorigin=""></script>
    <style>
        #map { height: 180px; 
              
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
                                    <h6 class="m-0 font-weight-bold text-primary">Data Laporan</h6>
                                </div>
                                <div class="card-body">
                                <table class="table table-bordered" id="data" name="data" width="100%" cellspacing="0">
                                    <thead><tr>
                                    <th width="5%">No</th>
                                    <th width="10%">Tanggal</th>
                                    <th>Lokasi</th>
                                    <th width="9%">Kabupaten</th>
                                    <th>Keterangan</th>
                                    <th width="13%">Kondisi Jalan</th>
                                    <th width="12%">Action</th>
                                    </tr></thead>
                                    <tfoot><tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Lokasi</th>
                                    <th>Kabupaten</th>
                                    <th>Keterangan</th>
                                    <th>Kondisi Jalan</th>
                                    <th>Action</th>
                                    </tr></tfoot>
                                    <tbody>
                                    <?php
                                    
                                    $result = mysqli_query($db, "SELECT * FROM data_jalan JOIN 
                                    kabupaten ON data_jalan.id_kabupaten=kabupaten.id_kabupaten
                                    WHERE status=0"); $i=1;
                                    while($data_jalan = mysqli_fetch_array($result)) { ?>
                                    <tr><td><?php echo $i; $i++; ?></td>
                                    <td><?php echo date('d/m/Y ',  strtotime($data_jalan['tanggal']));?></td>
                                    <td><?php echo $data_jalan['alamat'];?></td>
                                    <td><?php echo $data_jalan['nm_kab'];?></td>
                                    <td><?php echo $data_jalan['keterangan'];?></td>
                                    <td><?php echo $data_jalan['kondisi_jalan'];?></td>
                                    
                                 <form action="" method="POST" enctype="multipart/form-data">
                                    
                                 <input type="hidden" name="id_data" value="<?php echo $data_jalan['id'];?>">
                                    <td>
                                        
                                    <input type="submit" name="acc" class="btn btn-success btn-circle " data-toggle="modal" data-target="#acc" value="&#10003;">
                                    
                                    <button type="submit" name="hapus" class="btn btn-danger btn-circle " value="&#10003;"  onclick="return confirm('Yakin menghapus laporan ini ??')">&#10008;</button>
                                       
                                    </a>
                                    </form>
                                    <?php } ?></tbody>
                                    </table>
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

      <!-- Logout Modal-->
      <div class="modal fade" id="hapus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" ">Tolak Data</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body" >
                Anda Akan Menghapus Data, Lanjut?


                </div>
                <div class="modal-footer">
                    
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <form action="" method="POST">
                        
                    <input type="hidden" name="id_data" value="<?php echo $data_jalan['id'];?>">
                    <button name="hapusdat"  class="btn btn-primary">Delete</button>


                    </from>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    
    <script> $('#tanggal').datepicker({
        "setDate": new Date(),
        "autoclose": true});
$('hapus').on('shown', function(){
    var id = $data_jalan['id'];
    //Do whatever you want with the id
});
</script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<!-- Datatables -->
<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>

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
    <script >

$(document).ready( function () {
    $('#data').DataTable( {
    responsive: true });
} );
</script>

</body>

</html>