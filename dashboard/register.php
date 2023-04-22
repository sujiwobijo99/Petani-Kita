<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar</title>
    <link rel="icon" href="assets/img/rose.png">
    <link rel="stylesheet" href="css/regist.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Poppins:ital,wght@0,100;0,400;0,500;1,100;1,400;1,500&display=swap" rel="stylesheet">
    <title>Document</title>
</head>

<body>
    <div class="daftar">
        <div class="form-daftar">
            <form action="regist_fcn.php" method="POST">
                <h1>Daftar Petani Kita !</h1>
                <div class="input-daftar-1">
                    <label for="">Nama Akun</label>
                    <input type="text" name="nama">
                </div>
                <div class="input-daftar-2">
                    <label for="">Nomor Telfon</label>
                    <input type="number" name="phone">
                </div>
                <div class="input-daftar-3">
                    <label for="">Password</label>
                    <input type="password" name="password">
                </div>
                <button type="submit" id="btn-daftar">Daftar Sekarang</button>
                <a href="login.php">Sudah Memiliki Akun? Masuk!</a>
            </form>
        </div>
        <img src="assets/img/Daftar.png" alt="" width="50%">
        <div class="popup" id="popup">
            <h1>INFORMASI SISTEM</h1>
            <p>Akun Telah Teregistrasi Ke Sistem, Silahkan Login</p>
            <a href="login.php"><button type="button" id="login">Login</button></a>
        </div>
    </div>


    <script src="js/regist.js" type="text/javascript"></script>
</body>

</html>