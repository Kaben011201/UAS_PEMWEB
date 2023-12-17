<?php

include "../connection.php";

$ktp = $_POST['ktp'];

$sql = "DELETE FROM jemaat WHERE ktp = '$ktp'";

$result = $connect->query($sql);

if($result){
    echo '<script>alert("Data dihapus");
    window.location.href = "read.php";
    </script>';
}