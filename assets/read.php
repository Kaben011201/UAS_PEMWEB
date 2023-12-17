<?php
session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UAS PEMWEB</title>
    <style>
        .inputValue {
            background-color: #B4B4B3;
            width: 60%;
            padding: 20px;
            border-radius: 10px;
        }
        input {
            width: auto;
            padding: 2px;
        }
        label{
            width: 30%;
        }
        span {
            margin-right: 5px;
        }
        .inputform {
            display: flex;
            margin-bottom: 7px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .create, .edit, .hapus{
            background: gray;
            border: none;
            border-radius: 3px;
            color: white;
            padding: 3px 5xp;
            margin-bottom: 10px;
        }
        .display{
            display: flex;
            flex-direction: column;
            margin-bottom: 10px;
        }

        .dis{
            display: flex;
            width: 50%;
        }

    </style>
</head>
<body>
    <form method="post" action="">
        <input type="text" name="search" id="search">
        <input type="submit" name="submit" value="Cari">
    </form><br>

    <button class="create" onclick="forCreate()">Create</button>
    
    <div class="displayInputFrame"></div>

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
                    </section>
                ";

                echo "<form method='post' action='delete.php'>
                        <input type='hidden' name='ktp' value='" . $get_row['ktp'] . "'>
                        <input class='hapus' type='submit' value='Hapus'>
                    </form>
                    <button class='edit' onclick='showEdit(" . $get_row['ktp'] . ")'>Edit</button><br><br>

                    <div id='editForm{$get_row['ktp']}' style='display:none;'>
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

                            <div class='inputform'><span>:</span>                              
                                <label for=''>Jenis Kelamin</label>
                                <select name='jenkel' id='jenkel'>
                                <option value='Pria' <?php if ({$get_row['jenkel']} === 'Pria') echo 'selected='selected''; ?>>Pria</option>
                                <option value='Wanita' <?php if ({$get_row['jenkel']} === 'Wanita') echo 'selected='selected''; ?>>Wanita</option>
                                
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

    <script>
            function forCreate(){
                let html = `
                    <form class="inputValue" action="create.php" method="POST">
                        <div class="inputform">
                            <label for="">KTP</label><span>:</span> 
                            <input type="number" name="ktp" id="ktp" placeholder="contoh : 121140087" required>
                        </div>

                        <div class="inputform">
                            <label for="">Nama Lengkap</label><span>:</span> 
                            <input type="text" name="nama" id="nama" required>
                        </div>

                        <div class="inputform">
                            <label for="">Tanggal Lahir</label><span>:</span> 
                            <input type="date" name="tgllahir" id="tgllahir" required>
                        </div>

                        <div class="inputform">
                            <label for="">Usia</label><span>:</span> 
                            <input type="number" name="usia" id="usia" required>
                        </div>

                        <div class="inputform">
                        <label for=''>Jenis Kelamin</label>
                                <select name='jenkel' id='jenkel'>
                                    <option value='pria'>Pria</option>
                                    <option value='wanita'>Wanita</option>
                                </select>
                        </div>

                        <div class="inputform">
                            <label for="">No HP</label><span>:</span> 
                            <input type="tel" name="nohp" id="nohp" required>
                        </div>

                        <div class="inputform">
                            <label for="">Alamat</label><span>:</span> 
                            <textarea name='alamat' id='alamat' cols='30' rows='5'></textarea>
                        </div>
                        <input style="width: 60px;" type="submit" name="submit" id="submit">
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