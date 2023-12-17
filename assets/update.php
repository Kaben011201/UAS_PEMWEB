<?php

include "../connection.php";

$ktp = $_POST['ktp'];
$nama = $_POST['nama'];
$tgllahir = $_POST['tgllahir'];
$usia = $_POST['usia'];
$jenkel = $_POST['jenkel'];
$nohp = $_POST['nohp'];
$alamat = $_POST['alamat'];

$sql = "UPDATE jemaat SET
        nama = '$nama', tgllahir = '$tgllahir', usia = '$usia', jenkel = '$jenkel', nohp = '$nohp', alamat = '$alamat'
        WHERE ktp = '$ktp'";

$result = $connect->query($sql);

if ($result) {
    echo '<script>alert("Data berhasil diedit");
    window.location.href = "read.php";
    </script>';
} else {
    echo "Error updating record: " . $connect->error;
}

?>
