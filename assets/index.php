<?php
session_start(); ?>


<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <p class="info-login">Username : admin<br>Password : 123456</p>
    <p class="title">Jemaat Gereja</p>
    <form action="login.php" method="POST">
        <h2>MASUKKAN AKUN</h2>
        <?php if (isset($_SESSION['error'])) { ?>
            <p class="error">
                <?php echo $_SESSION['error']; ?>
            </p>
            <?php unset($_SESSION['error']); ?>
        <?php } ?>
        <label>username:</label>
        <input type="text" name="username" placeholder="username">

        <label>Password :</label>
        <input type="password" name="password" placeholder="Password">

        <button type="submit">Login</button>
    </form>

    <script>
        function checkCookie() {
            var userIdCookie = getCookie('user_id');
            if (userIdCookie) {
                window.location.href = 'read.php';
            }
        }

        function getCookie(name) {
            var match = document.cookie.match(new RegExp('(^| )' + name + '=([^;]+)'));
            return match ? match[2] : null;
        }
        checkCookie();
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
    </script>

</body>

</html>