<?php 

include "class/jemaat.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $nama = $_POST['nama'];
    $tgllahir = $_POST['tgllahir'];
    $usia = $_POST['usia'];
    $jenkel = $_POST['jenkel'];
    $nohp = $_POST['nohp'];
    $alamat = $_POST['alamat'];

    $inputJemaat = new Jemaat();
    $hasilJemaat = $inputJemaat->inputData($nama, $tgllahir, $usia, $jenkel, $nohp, $alamat);

    if($hasilJemaat === false){
        $pesan = "Data jemaat sudah ada";
    }else{
        $pesan = "Data berhasil ditambahkan";
        header("location : index.php");
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Church</title>
</head>
<body>
    <header>Website Gereja</header>
    <main>
        <form action="create.php" method="POST">
            <div>
                <label for="">Nama Lengkap</label>
                <input type="text" name="nama" id="nama">
            </div>
            <div>
                <label for="">Tanggal Lahir</label>
                <input type="date" name="tgllahir" id="tgllahir">
            </div>
            <div>
                <label for="">Usia</label>
                <input type="number" name="usia" id="usia">
            </div>
            <div>
                <label for="">Jenis Kelamin</label>
                <select name="jenkel" id="jenkel">
                    <option value="pria">Pria</option>
                    <option value="wanita">Wanita</option>
                </select>
            </div>
            <div>
                <label for="">No.HP/WA</label>
                <input type="tel" name="nohp" id="nohp">
            </div>
            <div>
                <label for="">Alamat</label>
                <textarea name="alamat" id="alamat" cols="30" rows="5"></textarea>
            </div>
            <div>
                <input type="submit" name="submit" id="submit">
            </div>
        </form>
    </main>
    <footer></footer>
</body>
</html>