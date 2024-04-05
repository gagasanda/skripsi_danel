<?php
  // include database connection file
        include("koneksidb.php");

    // Check If form submitted, insert form data into users table.
    if(isset($_POST['submit'])) {
        $latitude = $_POST['latitude'];
        $longitude = $_POST['longitude'];
        $alamat = $_POST['alamat'];
        $tanggal = $_POST['tanggal'];
        $keterangan = $_POST['keterangan'];
        $kondisi_jalan = $_POST['kondisi_jalan'];



      
        // Insert user data into table
        $result = mysqli_query($db, "INSERT INTO data_jalan(latitude,longitude,alamat,tanggal,keterangan,kondisi_jalan,status) VALUES('$latitude','$longitude','$alamat','$tanggal,'$keterangan','$kondisi_jalan','accept')");

        // Show message when user added
        echo "<script>alert('Data Di Input');
        window.location.href = 'tambahdata.php';
        </script>";
    }
    ?>