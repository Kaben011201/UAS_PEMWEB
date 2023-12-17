<?php
session_start();
include "../connection.php";

$response = array("success" => false, "message" => "");

if (isset($_POST['username']) && isset($_POST['password'])) {
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $username = validate($_POST['username']);
    $password = validate($_POST['password']);

    if (empty($username)) {
        $_SESSION['error'] = "username anda kosong";
    } else if (empty($password)) {
        $_SESSION['error'] = "Password anda kosong";
    } else {
        $sql = "SELECT * FROM akun WHERE username='$username' AND password='$password'";
        $result = $connect->query($sql);

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if ($row['username'] === $username && $row['password'] === $password) {
                $response['success'] = true;
                $response['message'] = "Berhasil login";
            } else {
                $_SESSION['error'] = "username dan Passwor anda salah";
            }
        } else {
            $_SESSION['error'] = "username dan Passwor anda salah";
        }
    }
} else {
    $_SESSION['error'] = "Invalid request";
}

echo json_encode($response);
?>