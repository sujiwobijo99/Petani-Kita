<?php
session_start();
include "query.php";
if (!isset($_SESSION['login'])) {
    header("Location: login.php");

    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Leaderboard</title>
    <link rel="icon" href="assets/img/rose.png">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
</head>

<?php
include "template/sidebar.php"
?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Ubah Password</h1>

    <img src="gambar.php?<?php echo "id=$id"; ?>" alt="">
    <div class="row">
        <div class="col-lg-8" style="margin-top: -2vw;">
            <div class="form-group row">
                <label for="email" class="col-sm-3 col-form-label"></label>
                <div class="col-sm-8">
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
                <div class='alert alert-success d-flex align-items-center' style='width: fit-content; padding: 0.5rem;' role='alert'>
                <svg class='bi flex-shrink-0' style='width: 1.5rem ;height: 2rem; margin-right:1rem' role='img' aria-label='Success:'><use xlink:href='#check-circle-fill'/></svg>
                <div>
                    Data Berhasil Disimpan!
                </div>
                </div>";
                        } else {
                            echo "
                <div class='alert alert-danger d-flex align-items-center' style='width: fit-content; padding: 0.5rem;' role='alert'>
                <svg class='bi flex-shrink-0' style='width: 1.5rem ;height: 2rem; margin-right:1rem' role='img' aria-label='Success:'><use xlink:href='#exclamation-triangle-fill'/></svg>
                <div>
                    Data Gagal Disimpan!
                </div>
                </div>";
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="form-group row">
                <label for="prev_pass" class="col-sm-3 col-form-label">Password Saat Ini</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="prev_pass" name="prev_pass" value="<?php echo $data['pass'] ?>" readonly>
                </div>
            </div>

            <div class="form-group row mt-4">
                <div class="col-sm-3">
                </div>
                <div class="col-sm-4">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Ubah Password
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Passsword</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="ubah_pass_fcn.php" method="post">
                                        <div> <input style=" opacity:0" name="id" value="<?php echo $_GET['id'] ?>">
                                        </div>
                                        <div> <input style="opacity:0" name="role" value="<?php echo $_GET['role'] ?>"></div>
                                        <div class="col-sm" style="margin-top: -4rem;">
                                            <label for="new_password" class="col-form-label">Masukkan Password Baru</label>
                                            <div class="col">
                                                <input type="password" class="form-control" id="new_password" name="new_password" onkeyup='check();'>
                                                <span id="StrengthDisp" class="badge displayBadge mt-2" style="height: 1.rem">Weak</span>
                                                <script>
                                                    // Password Strength
                                                    // timeout before a callback is called

                                                    let timeout;

                                                    // traversing the DOM and getting the input and span using their IDs

                                                    let password = document.getElementById('new_password')
                                                    let strengthBadge = document.getElementById('StrengthDisp')

                                                    // The strong and weak password Regex pattern checker

                                                    let strongPassword = new RegExp('(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^A-Za-z0-9])(?=.{8,})')
                                                    let mediumPassword = new RegExp('((?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^A-Za-z0-9])(?=.{6,}))|((?=.*[a-z])(?=.*[A-Z])(?=.*[^A-Za-z0-9])(?=.{8,}))')

                                                    function StrengthChecker(PasswordParameter) {
                                                        // We then change the badge's color and text based on the password strength

                                                        if (strongPassword.test(PasswordParameter)) {
                                                            strengthBadge.style.backgroundColor = "green"
                                                            strengthBadge.textContent = 'Kuat'
                                                        } else if (mediumPassword.test(PasswordParameter)) {
                                                            strengthBadge.style.backgroundColor = 'blue'
                                                            strengthBadge.textContent = 'Sedang'

                                                        } else {
                                                            strengthBadge.style.backgroundColor = 'red'
                                                            strengthBadge.textContent = 'Lemah'
                                                        }
                                                    }

                                                    // Adding an input event listener when a user types to the  password input 

                                                    password.addEventListener("input", () => {

                                                        //The badge is hidden by default, so we show it

                                                        strengthBadge.style.display = 'block'
                                                        clearTimeout(timeout);

                                                        //We then call the StrengChecker function as a callback then pass the typed password to it

                                                        timeout = setTimeout(() => StrengthChecker(password.value), 500);

                                                        //Incase a user clears the text, the badge is hidden again

                                                        if (password.value.length !== 0) {
                                                            strengthBadge.style.display != 'block'
                                                        } else {
                                                            strengthBadge.style.display = 'none'
                                                        }
                                                    });
                                                </script>
                                            </div>
                                            <label for="confirm_password" class="col-form-label">Ulangi Password Baru</label>
                                            <div class="col">
                                                <input type="password" class="form-control" id="confirm_password" onkeyup='check();'>
                                                <span id='message'></span>
                                            </div>
                                            <script>
                                                let pass_match;
                                                var check = function() {
                                                    if (document.getElementById('new_password').value ==
                                                        document.getElementById('confirm_password').value) {
                                                        document.getElementById('message').style.color = 'green';
                                                        document.getElementById('message').innerHTML = 'Password Sesuai';
                                                        if (strongPassword.test(password.value)) {
                                                            document.getElementById('submit_btn').disabled = false;
                                                        }
                                                    } else {
                                                        document.getElementById('message').style.color = 'red';
                                                        document.getElementById('message').innerHTML = 'Password Tidak Sesuai';
                                                        document.getElementById('submit_btn').disabled = true;
                                                    }
                                                }
                                            </script>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary" id="submit_btn" disabled>Simpan</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

        </div>
    </div>
    <div class="col-lg-4" style="margin-top: -2vw;">
        <img src="<?php echo 'assets/img/foto/' . $foto ?>" alt="" width="300vw" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px; border-radius: 8%">
    </div>

</div>
</div>


<?php
include "template/footer.php"
?>