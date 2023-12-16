<?php

include '../../connection.php';

class Jemaat{

    //input data
    public function inputData($nama, $tgllahir, $usia, $jenkel, $hp, $alamat){
    
        $checkDuplicate = mysqli_query($connect, "SELECT * FROM jemaat WHERE nama='$nama' AND tgllahir='$tgllahir' AND nohp='$hp'");
        
        if (mysqli_num_rows($checkDuplicate) > 0) {
            echo '
                <script>alert("Data sudah ada!")</script>
                ';
            return false;
        } else {
            $sql = "INSERT INTO jemaat (nama, tgllahir, usia, jenkel, nohp, alamat) VALUES ('$nama', '$tgllahir', '$usia', '$jenkel', '$hp', '$alamat')";
    
            if (mysqli_query($connect, $sql)) {
                echo '
                <script>alert("Data Berhasil Ditambah!")</script>
                ';
                return true;
            } else {
                return false;
            }
        }
    }

    //
    
        
}