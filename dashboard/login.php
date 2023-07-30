<?php
session_start();
if (isset($_SESSION['admin'])) {
    $id = $_SESSION['id'];
    $role = $_SESSION['role'];
    header("Location: index.php");
    exit;
}
if (isset($_SESSION['login'])) {
    $id = $_SESSION['id'];
    $role = $_SESSION['role'];
    header("Location: profil.php");
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
            <div class="input-login-1">

                <form action="login_fcn.php" method="post">
                    <h1>Log In Petani Kita !</h1>
                    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                        <symbol id="check-circle-fill" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                        </symbol>
                        <symbol id="info-fill" viewBox="0 0 16 16">
                            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
                        </symbol>
                        <symbol id="exclamation-triangle-fill" viewBox="0 0 16 16">
                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                        </symbol>
                    </svg>
                    <?php
                    if (isset($_GET['pesan'])) {
                        if ($_GET['pesan'] == 1) {
                            echo "
                <div style='color:red' align='center'>
                    Data Anda Tidak Ditemukan!

                </div>";
                        } else if ($_GET['pesan'] == 2) {
                            echo "
                <div style='color:green' align='center'>
                    Data Berhasil Disimpan, Silahkan Login!
                </div>";
                        }
                    }
                    ?>
            </div>
            <div class="input-login-1">
                <label for="">Nomor Telfon</label>
                <input type="text" name="phone" <?php
                                                if (isset($_GET['phone'])) {
                                                    $phone = $_GET['phone'];
                                                    echo "value = '$phone'";
                                                }
                                                ?> />
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