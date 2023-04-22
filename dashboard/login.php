<?php
session_start();
if (isset($_SESSION['admin'])) {
    $id = $_SESSION['id'];
    $role = $_SESSION['role'];
    header("Location: index.php?id=$id&role=$role");
    exit;
}
if (isset($_SESSION['login'])) {
    $id = $_SESSION['id'];
    $role = $_SESSION['role'];
    header("Location: profil.php?id=$id&role=$role");
    exit;
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Masuk</title>
    <link rel="icon" href="assets/img/rose.png">
    <link rel="stylesheet" href="css/login_style.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Poppins:ital,wght@0,100;0,400;0,500;1,100;1,400;1,500&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" />
    <title>Document</title>
</head>

<body>
    <div class="login">
        <img src="assets/img/Login.png" alt="" width="50%" />

        <div class="form-login">
            <form action="login_fcn.php" method="post">
                <h1>Log In Petani Kita !</h1>
                <div class="input-login-1">
                    <label for="">Nomor Telfon</label>
                    <input type="text" name="phone" />
                </div>
                <div class="input-login-2">
                    <label for="">Password</label>
                    <input type="password" id="id_password" name="password" />
                    <i class="far fa-eye" id="togglePassword"></i>
                    <p>Biasanya Mengandung Minimal 6 Karakter</p>
                </div>
                <button>Masuk</button>
                <a href="register.php">Anda Belum Daftar? Daftar Sekarang!</a>
            </form>
        </div>
        </form>
    </div>

    <script src="js/login.js" type="text/javascript"></script>
</body>

</html>