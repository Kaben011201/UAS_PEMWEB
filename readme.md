# UAS Pemrograman Web
## Bendry Lakburlawal, 121140111, RB
Website (hosting) : loremIpsum

Username : 

Password :


## Bagian 1: Client-side Programming
berikut merupakan kode yang berfungsi untuk melakukan update pada data website
```php
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
```

berikut merupakan kode yang berfungsi untuk menambahkan data pada website
```php
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
            window.location.href = "read.php";
            </script>
            ';
    } else {
        $sql = "INSERT INTO jemaat (ktp, nama, tgllahir, usia, jenkel, nohp, alamat) VALUES ('$ktp','$nama', '$tgllahir', '$usia', '$jenkel', '$nohp', '$alamat')";

        if (mysqli_query($connect, $sql)) {
            echo '
            <script>alert("Data Berhasil Ditambah!");
            window.location.href = "read.php";
            </script>
            ';
        }
    }
}
?>
```

berikut merupakan kode yang berfungsi untuk menghapus data pada website
```php
<?php

include "../connection.php";

$ktp = $_POST['ktp'];

$sql = "DELETE FROM jemaat WHERE ktp = '$ktp'";

$result = $connect->query($sql);

if($result){
    echo '<script>alert("Data dihapus");
    window.location.href = "read.php";
    </script>';
} ?>
```

## Bagian 2: Server-side Programming

1. `login.php`: Verifikasi pengguna untuk login dan akses ke website dengan menggunakan metode POST.
2. `create.php`: Tambahkan input data makanan dari website ke database dengan menggunakan metode POST.
3. `update.php`: Perbarui data yang sudah dimasukkan berdasarkan ID yang dipilih dengan menggunakan metode metode POST.
4. `delete.php`: Hapus data berdasarkan ID yang diberikan dengan menggunakan metode metode GET.
5. `read.php`: Ambil data dari database untuk ditampilkan di website dengan menggunakan metode metode GET.

## Bagian 3: Manajemen Database

Query konfigurasi database:

```sql
-- Active: 1682758151526@@127.0.0.1@3306@uas_pemweb_bendry

CREATE TABLE jemaat(
    ktp INT(16) PRIMARY KEY,
    nama VARCHAR(100),
    tgllahir DATE,
    usia INT(3),
    jenkel TEXT(50),
    nohp VARCHAR(12),
    alamat VARCHAR(200)
);

INSERT INTO jemaat (ktp, nama, tgllahir, usia, jenkel, nohp, alamat)
VALUES
    (123, 'John Doe', '1990-05-15', 32, 'Male', '1234567890', '123 Main Street'),
    (456, 'Jane Smith', '1985-08-22', 37, 'Female', '9876543210', '456 Oak Avenue'),
    (789, 'Bob Johnson', '1995-03-10', 27, 'Male', '5551234567', '789 Pine Lane');

CREATE TABLE akun(
    username VARCHAR(100),
    password VARCHAR(100)
)


INSERT INTO akun (username, password) VALUES
('aku', '123456');

```

## Query Script PHP:

### login.php
```php
$sql = "SELECT * FROM akun WHERE username='$username' AND password='$password'";
```
### create.php
```php
$sql = "INSERT INTO jemaat (ktp, nama, tgllahir, usia, jenkel, nohp, alamat) VALUES ('$ktp','$nama', '$tgllahir', '$usia', '$jenkel', '$nohp', '$alamat')";
```
### update.php
```php
$sql = "UPDATE jemaat SET
        nama = '$nama', tgllahir = '$tgllahir', usia = '$usia', jenkel = '$jenkel', nohp = '$nohp', alamat = '$alamat'
        WHERE ktp = '$ktp'";
```
### delete.php
```php
$sql = "DELETE FROM jemaat WHERE ktp = '$ktp'";
```
### read.php
```php
$sql = "SELECT * FROM jemaat";
$sql .= " WHERE nama LIKE '%$search%'";
```
### Bagian 4: State Management
Pada index.php terdapat state management yang akan berguna untuk menyimpan pesan error ketika dibuat session. Dapat dilihat dari kode pada dibawah ini. 
```php
<?php if (isset($_SESSION['error'])) { ?>
            <p class="error">
                <?php echo $_SESSION['error']; ?>
            </p>
            <?php unset($_SESSION['error']); ?>
        <?php  }?>
```

Selain itu, website ini juga menggunakan javascript untuk menyimpan cookie (yang akan tersimpan pada computer pengguna). Cookie ini ditetapkan dengan masa durasi selama 30 hari dan berada pada index.php.
```script
document.addEventListener("DOMContentLoaded", function () {
    const loginForm = document.querySelector('form');

    loginForm.addEventListener('submit', function (event) {
        event.preventDefault();

        const username = document.getElementsByName("username")[0].value;
        const password = document.getElementsByName("password")[0].value;

        fetch('login.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({
                'username': username,
                'password': password,
            }),
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.cookie = "user_id=" + encodeURIComponent(data.user_id) + "; expires=" + new Date(new Date().getTime() + 30 * 24 * 60 * 60 * 1000).toUTCString() + "; path=/";
                    window.location.href = 'read.php';
                } else {                            
                    window.location.href = 'index.php';
                }
            });
    });
});
```

index.php juga menggunakan fungsi checkCookie() yang berguna untuk memeriksa cookie yang tersimpan pada komputer pengguna. 
```script
function checkCookie() {
            var userIdCookie = getCookie('user_id');
            if (userIdCookie) {
                window.location.href = 'read.php';
            }
        }
```

## Bagian Bonus: Hosting Aplikasi Web

### 1. Apa langkah-langkah yang Anda lakukan untuk meng-host aplikasi web Anda?
1. Buka situs 000webhost.com
2. Lakukan proses sign up untuk membuat akun 000webhost 
3. Pilih "create website" dan plan yang gratis.
4. Masukkan nama website dan password.
5. Pilih menu "Upload File" dan upload semua file website ke folder public_html.
6. Masuk ke menu "Database Manager", buat database baru, catat nama, user, dan password database, dan update variabel di connection.php.
7. Website dapat diakses dengan database yang berfungsi.
   
### 2. Pilih penyedia hosting web yang menurut Anda paling cocok untuk aplikasi web Anda. Berikan alasan Anda.
    000webhost.com dipilih sebagai layanan hosting karena mudah untuk diimplementasikan dan tidak memungut biaya apapun.
 
### 3. Bagaimana Anda memastikan keamanan aplikasi web yang Anda host?
1. Penerapan protokol HTTPS dengan sertifikat SSL guna mengamankan enkripsi data.
2. Pemanfaatan HTTPS sebagai langkah perlindungan terhadap data sensitif saat proses transmisi.
3. Eksploitasi Web Server Nginx untuk kebutuhan tertentu.
4. Penerapan mekanisme cookies pada saat login untuk mencegah akses pengguna yang belum terautentikasi ke halaman manajemen.
 
### 4. Jelaskan konfigurasi server yang Anda terapkan untuk mendukung aplikasi web Anda.
Untuk membuat situs web atau aplikasi yang tidak dapat diabaikan, sertifikat SSL/TLS dan protokol HTTPS sangat penting. Sertifikat SSL/TLS menjaga koneksi aman, sedangkan protokol HTTPS mengenkripsi data selama transmisi, melindungi data dari orang yang tidak berhak mengaksesnya. Pilihan web server Nginx meningkatkan responsivitas situs web dengan kinerja cepat dan efisien. Dengan menggunakan cookies saat login, halaman manajemen lebih aman, karena hanya pengguna yang terautentikasi yang dapat mengakses informasi pribadi. Secara keseluruhan, tindakan ini menghasilkan lingkungan pengembangan yang aman, responsif, dan efektif.