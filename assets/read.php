<?php
session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UAS PEMWEB</title>
    <link rel="stylesheet" href="../style/read.css">
    <script>
        function validateForm() {
            var ktp = document.forms["myForm"]["ktp"].value;
            var nama = document.forms["myForm"]["nama"].value;
            var tgllahir = document.forms["myForm"]["tgllahir"].value;
            var usia = document.forms["myForm"]["usia"].value;
            var jenkel = document.forms["myForm"]["jenkel"].value;
            var nohp = document.forms["myForm"]["nohp"].value;
            var alamat = document.forms["myForm"]["alamat"].value;

            if (ktp == "" || nama == "" || tgllahir == "" || usia == "" || jenkel == "" || nohp == "" || alamat == "") {
                alert("Semua field harus diisi");
                return false;
            }
        }
    </script>
</head>
<body>
    <form class="cari" method="post" action="">
        <input class="column" type="text" name="search" id="search">
        <button class="cari" type="submit" name="submit" value="Cari">Cari</button>
    </form><br>

    <button class="create" onclick="forCreate()">Create</button>
    
    <div class="displayInputFrame"></div>
    <div class="frame-display">
    <?php
        include '../connection.php';
        $search = isset($_POST['search']) ? $connect->real_escape_string($_POST['search']) : '';
        
        $sql = "SELECT * FROM jemaat";

        if (!empty($search)) {
            $sql .= " WHERE nama LIKE '%$search%'";
        }

        $result = $connect->query($sql);
        
        $data = array(); 
        
        if ($result->num_rows > 0) {
            while ($get_row = $result->fetch_assoc()) {
                $data[] = array(
                    'ktp' => $get_row['ktp'],
                    'nama' => $get_row['nama'],
                    'tgllahir' => $get_row['tgllahir'],
                    'usia' => $get_row['usia'],
                    'jenkel' => $get_row['jenkel'],
                    'nohp' => $get_row['nohp'],
                    'alamat' => $get_row['alamat'],
                );
        
                echo "
                    <section class='display' id='display'>
                        <div class='dis'>
                            <label>KTP</label><span>:</span>{$get_row['ktp']}
                        </div>
                        <div class='dis'>
                            <label>Nama</label><span>:</span>{$get_row['nama']}
                        </div>
                        <div class='dis'>
                            <label>Tanggal Lahir</label><span>:</span>{$get_row['tgllahir']}
                        </div>
                        <div class='dis'>
                            <label>Usia</label><span>:</span>{$get_row['usia']}
                        </div>
                        <div class='dis'>
                            <label>Jenis Kelamin</label><span>:</span>{$get_row['jenkel']}
                        </div>
                        <div class='dis'>
                            <label>NoHP</label><span>:</span>{$get_row['nohp']}
                        </div>
                        <div class='dis'>
                            <label>Alamat</label><span>:</span>{$get_row['alamat']}
                        </div>
                ";

                echo "<div class='tombol'>
                    <form method='post' action='delete.php'>
                        <input type='hidden' name='ktp' value='" . $get_row['ktp'] . "'>
                        <input class='hapus' type='submit' value='Hapus'>
                    </form>
                    <button class='edit' onclick='showEdit(" . $get_row['ktp'] . ")'>Edit</button><br><br>
                    </div>
                    </section>
            
                    <div class='editValue' id='editForm{$get_row['ktp']}' style='display:none;'>
                        <form class='inputValue' method='post' action='update.php'>
                            <div class='inputform'>
                                <label for=''>KTP</label><span>:</span>
                                <input type='text' name='ktp' value='{$get_row['ktp']}' disabled>
                            </div>

                            <div class='inputform'>
                                <label for=''>Nama</label><span>:</span>
                                <input type='text' name='nama' id='nama' value='{$get_row['nama']}'>
                            </div>

                            <div class='inputform'>                                
                                <label for=''>Tanggal Lahir</label><span>:</span>
                                <input type='date' name='tgllahir' id='tgllahir' value='{$get_row['tgllahir']}'>
                            </div>

                            <div class='inputform'>                                
                                <label for=''>Usia</label><span>:</span>
                                <input type='usia' name='usia' id='usia' value='{$get_row['usia']}'>
                            </div>

                            <div class='inputform'>                            
                                <label for=''>Jenis Kelamin</label><span>:</span>  
                                <select name='jenkel' id='jenkel'>
                                <option value='Pria' <?php if ({$get_row['jenkel']} === 'Pria') echo 'selected='selected''; ?>Pria</option>
                                <option value='Wanita' <?php if ({$get_row['jenkel']} === 'Wanita') echo 'selected='selected''; ?>Wanita</option>
                                
                                </select>
                            </div>

                            <div class='inputform'>                                
                                <label for=''>No HP</label><span>:</span>
                                <input type='tel' name='nohp' id='nohp' value='{$get_row['nohp']}'>
                            </div>

                            <div class='inputform'>                                
                                <label for=''>Alamat</label><span>:</span>
                                <textarea name='alamat' id='alamat' cols='30' rows='5''>{$get_row['alamat']}</textarea>
                            </div>

                            <input class='create' type='submit' value='Simpan Perubahan'>
                        </form>
                    </div>
                ";
            }
        }  
    ?>
    </div>

    <script>
            function forCreate(){
                let html = `
                    <form id="form" name='myForm' class="inputValue" action="create.php" method="POST">
                        <div class="inputform">
                            <label for="">KTP</label><span>:</span> 
                            <input type="number" name="ktp" id="ktp">
                        </div>

                        <div class="inputform">
                            <label for="">Nama Lengkap</label><span>:</span> 
                            <input type="text" name="nama" id="nama">
                        </div>

                        <div class="inputform">
                            <label for="">Tanggal Lahir</label><span>:</span> 
                            <input type="date" name="tgllahir" id="tgllahir">
                        </div>

                        <div class="inputform">
                            <label for="">Usia</label><span>:</span> 
                            <input type="number" name="usia" id="usia">
                        </div>

                        <div class="inputform">
                        <label for=''>Jenis Kelamin</label><span>:</span> 
                                <select name='jenkel' id='jenkel'>
                                    <option value='pria'>Pria</option>
                                    <option value='wanita'>Wanita</option>
                                </select>
                        </div>

                        <div class="inputform">
                            <label for="">No HP</label><span>:</span> 
                            <input type="tel" name="nohp" id="nohp">
                        </div>

                        <div class="inputform">
                            <label for="">Alamat</label><span>:</span> 
                            <textarea name='alamat' id='alamat' cols='30' rows='5'></textarea>
                        </div>
                        <input onclick="validateForm()" class="submit" style="width: 60px;" type="submit" name="submit" id="submit">
                    </form>
                `;
                document.querySelector('.displayInputFrame').innerHTML = html;

            }

            function showEdit(ktp) {
                document.querySelectorAll('[id^="editForm"]').forEach(form => {
                    form.style.display = 'none';
                });

                document.getElementById(`editForm${ktp}`).style.display = 'block';
            }

            
        </script>
</body>
</html>