<?php 

include "../connection.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $ktp = $_POST['ktp'];
    $nama = $_POST['nama'];
    $tgllahir = $_POST['tgllahir'];
    $usia = $_POST['usia'];
    $jenkel = $_POST['jenkel'];
    $nohp = $_POST['nohp'];
    $alamat = $_POST['alamat'];

    $sql = "SELECT * FROM jemaat WHERE ktp='$ktp'";
    $checkDuplicate = mysqli_query($connect, $sql);
    
    if (mysqli_num_rows($checkDuplicate) > 0) {
        echo '
            <script>alert("Data sudah ada!");
            window.location.href = "index.php";
            </script>
            ';
    } else {
        $sql = "INSERT INTO jemaat (ktp, nama, tgllahir, usia, jenkel, nohp, alamat) VALUES ('$ktp','$nama', '$tgllahir', '$usia', '$jenkel', '$nohp', '$alamat')";

        if (mysqli_query($connect, $sql)) {
            echo '
            <script>alert("Data Berhasil Ditambah!");
            window.location.href = "index.php";
            </script>
            ';
        }
    }
}

?>